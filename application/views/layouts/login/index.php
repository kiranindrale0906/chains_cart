<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Page</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      margin: 0;
      padding: 0;
      background: #1b1e29;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-container {
      width: 850px;
      height: 500px;
      display: flex;
      background: rgba(255, 255, 255, 0.02);
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.4);
      backdrop-filter: blur(10px);
    }

    .image-side {
      flex: 1;
      background: url('../../assets/login/images/common/login_bg.png') center center/cover no-repeat;
    }

    .form-side {
      flex: 1;
      padding: 50px;
      background: rgba(20, 20, 30, 0.7);
      color: #fff;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .form-side h2 {
      font-size: 28px;
      margin-bottom: 20px;
    }

    .form-side input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      background: transparent;
      border: none;
      border-bottom: 1px solid #666;
      color: white;
      font-size: 14px;
      outline: none;
    }

    .form-side label {
      font-size: 13px;
      color: #bbb;
    }

    .form-options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 12px;
      color: #aaa;
      margin: 10px 0 20px;
    }

    .form-side .btn {
      padding: 12px;
      width: 100%;
      border-radius: 20px;
      border: none;
      font-weight: bold;
      margin: 10px 0;
      cursor: pointer;
      background: linear-gradient(to right, #00c6ff, #0072ff);
      color: white;
      transition: all 0.3s ease;
    }

    .form-side .btn:hover {
      background: linear-gradient(to right, #0099cc, #005ecf);
    }

    .form-side .footer-links {
      margin-top: 20px;
      font-size: 11px;
      color: #777;
      text-align: center;
    }

    .form-side .footer-links a {
      margin: 0 10px;
      color: #aaa;
      text-decoration: none;
    }

    .form-side .signup-switch {
      margin-top: 10px;
      text-align: right;
      font-size: 14px;
      color: #888;
    }

    .form-side .signup-switch span {
      color: #ccc;
      margin-right: 15px;
      border-bottom: 1px solid transparent;
      cursor: pointer;
    }

    .form-side .signup-switch span.active {
      border-color: #00c6ff;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="image-side"></div>
    <div class="form-side">
      <div class="signup-switch">
        <span class="active">Sign In</span>
      </div>

      <h2>Sign In</h2>
      <form method="post" 
      class="" 
      enctype="multipart/form-data"
      action="<?= ADMIN_PATH.'users/login/store' ?>">
      <?php load_field('text', array('field' => 'email_id'))?>
      <?php load_field('password',array('field' => 'password', 'name' => 'password')) ?>
      <div class="form-options">
        <label></label>
        <a href="#" style="color:#00c6ff; text-decoration:none;">Forgot password?</a>
      </div>

      <button class="btn">SIGN IN</button>
    </div>
  </div>
</body>
</html>
