<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="http://localhost/ZeeShop/image/logo/zeeshop-logo.png" type="image/x-icon">
  <link rel="stylesheet" href="http://localhost/ZeeShop/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <title>ZeeShop - Login Administrator</title>
  <style>
    body {
      background: #222D32;
      font-family: 'Rubik', sans-serif;
    }

    .login-box {
      margin-top: 75px;
      height: auto;
      background: #1A2226;
      text-align: center;
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    }

    .login-title {
      margin-top: 15px;
      text-align: center;
      font-size: 30px;
      letter-spacing: 2px;
      margin-top: 15px;
      font-weight: bold;
      color: #ECF0F5;
    }

    .login-form {
      margin-top: 25px;
      text-align: left;
    }

    input[type=text] {
      background-color: #1A2226;
      border: none;
      border-bottom: 2px solid #0DB8DE;
      border-top: 0px;
      border-radius: 0px;
      font-weight: bold;
      outline: 0;
      margin-bottom: 20px;
      padding-left: 0px;
      color: #ECF0F5;
    }

    input[type=password] {
      background-color: #1A2226;
      border: none;
      border-bottom: 2px solid #0DB8DE;
      border-top: 0px;
      border-radius: 0px;
      font-weight: bold;
      outline: 0;
      padding-left: 0px;
      margin-bottom: 20px;
      color: #ECF0F5;
    }

    .form-group {
      margin-bottom: 40px;
      outline: 0px;
    }

    .form-control:focus {
      border-color: inherit;
      -webkit-box-shadow: none;
      box-shadow: none;
      border-bottom: 2px solid #0DB8DE;
      outline: 0;
      background-color: #1A2226;
      color: #ECF0F5;
    }

    input:focus {
      outline: none;
      box-shadow: 0 0 0;
    }

    label {
      margin-bottom: 0px;
    }

    .form-control-label {
      font-size: 10px;
      color: #6C6C6C;
      font-weight: bold;
      letter-spacing: 1px;
    }

    .btn-outline-primary {
      border-color: #0DB8DE;
      color: #0DB8DE;
      border-radius: 0px;
      font-weight: bold;
      letter-spacing: 1px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    }

    .btn-outline-primary:hover {
      background-color: #0DB8DE;
      right: 0px;
    }

    .login-btm {
      float: left;
    }

    .login-button {
      padding-right: 0px;
      text-align: justify;
      margin-bottom: 25px;
    }

    .login-text {
      text-align: right;
      padding-left: 0px;
      color: #A2A4A4;
    }

    .loginbttm {
      padding: 0px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-2"></div>
      <div class="col-lg-6 col-md-8 login-box">
        <div class="col-lg-12 mt-4 login-title">
          ADMIN LOGIN
        </div>

        <div class="col-lg-12 login-form">
          <div class="col-lg-12 login-form">
            <form action="../../proses/login.php" method="post">
              <div class="form-group">
                <label class="form-control-label">USERNAME</label>
                <input type="text" name="username" class="form-control">
              </div>
              <div class="form-group">
                <label class="form-control-label">PASSWORD</label>
                <input type="password" name="password" class="form-control" i>
              </div>

              <div class="col-lg-12 loginbttm">
                <div class="col-lg-6 login-btm login-button">
                  <button type="submit" name="loginAdmin" class="btn btn-outline-primary">LOGIN</button>
                </div>
                <div class="col-lg-6 login-btm login-text">
                  <?php
                  if (array_key_exists('error', $_GET)) {
                    echo "
                <div class='text-danger'>
                  Salah Password atau Username
                </div>
              ";
                  }
                  ?>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-lg-3 col-md-2"></div>
      </div>
    </div>
</body>

</html>