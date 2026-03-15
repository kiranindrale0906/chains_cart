<?php
class Linkedin extends BaseController {
	public function __construct() {
		parent::__construct();
		$this->load->library('auto_share_linkedin');
		$this->load->model('users/user_model');
	}

	public function index(){
		$url = 'https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id='.LINKEDIN_CLIENT_ID.'&redirect_uri='.urlencode(LINKEDIN_REDIRECT_URL).'&state=fooobar&scope=r_liteprofile%20r_emailaddress%20w_member_social';
		redirect($url);
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
			$getAcessToken ='https://www.linkedin.com/oauth/v2/accessToken';
			$parameter='grant_type=authorization_code&code='.$_GET['code'].'&redirect_uri='.urlencode(LINKEDIN_REDIRECT_URL).'&client_id='.LINKEDIN_CLIENT_ID.'&client_secret='.LINKEDIN_CLIENT_SECRET;	
			$accessToken = $this->auto_share_linkedin->getLinkedInAccessToken($getAcessToken,$parameter);
			if(!empty($accessToken['access_token'])){
				$getEmailAdress='https://api.linkedin.com/v2/emailAddress?q=members&projection=(elements*(handle~))'; 
				$email = $this->auto_share_linkedin->getLinkedInUserdata($getEmailAdress,$accessToken['access_token']);
				$getUserName= 'https://api.linkedin.com/v2/me';
				$username = $this->auto_share_linkedin->getLinkedInUserdata($getUserName,$accessToken['access_token']);
				$user['linkedin_access_token'] = $accessToken['access_token'];
				$user['email_id'] = $email['elements'][0]['handle~']['emailAddress'];
				$user['name'] =$username['localizedFirstName'].' '.$username['localizedLastName'];  
			}
		}
		return $user;
	}
}