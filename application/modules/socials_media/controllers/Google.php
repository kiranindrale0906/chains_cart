<?php 
class Google extends BaseController {
	protected $load_helper = false;
	
	function __construct() {
    parent::__construct();
    $this->load->model('users/user_model');
    $this->initialize_google_client();
  }

	public function index(){
		echo $this->client->createAuthUrl();
	}

	public function store(){
    $user_data = $this->get_user_data();
    if(!empty($user_data)){
      $user_id = $this->user_model->find('id', array('email_id' => $user_data['email_id']));
      if (!empty($user_id)) {
        $user_data['id'] = $user_id['id'];
        unset($user_data['name']);
      } else {
        $user_data['password'] = md5(rand(999999, 999999999));
      }
      $user = new User_model($user_data);
      $user->save();
      $session_data = $this->user_model->set_user_data_in_session(array('email_id' => $user_data['email_id']));
      $this->session->set_userdata($session_data);
    }
    redirect(base_url()); 
  }

	private function get_user_data() {
		$user = array();
	  if (isset($_GET['code'])) {
      $this->client->authenticate($_GET['code']);
      $google_authentication = $this->client->getAccessToken();
    }
    
    if (isset($google_authentication) && $google_authentication) {
      $this->client->setAccessToken($google_authentication);
      $data = $this->client->verifyIdToken();
      $user['google_access_token'] = $google_authentication['access_token'];
      $user['email_id'] = $data['email'];
      $user['name'] = $data['name'];
    }
    return $user;
	}

	private function initialize_google_client() {
		$this->client = new Google_Client();
    $this->client->setClientId(GOOGLE_CLIENT_ID);
    $this->client->setClientSecret(GOOGLE_CLIENT_SECRET);
    $this->client->setRedirectUri(GOOGLE_REDIRECT_URL);
    $this->client->setScopes(array("https://www.googleapis.com/auth/plus.login",
                              		 "https://www.googleapis.com/auth/plus.me",
                                   "https://www.googleapis.com/auth/userinfo.email",
                                   "https://www.googleapis.com/auth/userinfo.profile"));
  }
}