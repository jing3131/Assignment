<?php
session_start();
require("../config.php");
if (isset($_POST["submitbtn"])) {
  if ($_POST["nameTF"] != null || $_POST["accountTF"] != null || $_POST["passwordTF"] != null) {
    $name = $_POST["nameTF"];
    $account = $_POST["accountTF"];
    $password = $_POST["passwordTF"];
    $credit = $_POST["creditTF"];
    $address = $_POST["addressTF"];
    $password2 = $_POST["password2TF"];
    if ($_POST["creditTF"] == "") $credit = null;
    if ($_POST["addressTF"] == "") $address = null;

    if ($password != $password2) {
      echo "<script>alert('密碼需相等')</script>";
    } else {

      require("../getAccountSql.php");

      $compare = compareAcount($link, $account);                               // 是否有被註冊過
      if($compare != null){
        echo "<script>alert('帳號名稱已註冊過，請再試一次')</script>";
      }
      else{
        setAccount($link, $name, $account, $password, $credit, $address);

        $_SESSION["account"] = $account;

        echo "<script>alert('註冊成功！')</script>";
        header("refresh:0.5;url=../index.php");
      }
      
    }
  }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="js/jquery.js">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="bootstrap-4.5.2-dist/css/bootstrap.css" rel="stylesheet">
  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="../images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!--===============================================================================================-->

    <script type="text/javascript" src="jquery.js"></script>
    <script src="../bootstrap-4.5.2-dist/js/bootstrap.min.js"></script>
    <script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="../vendor/animsition/js/animsition.min.js"></script>
    <script src="../vendor/bootstrap/js/popper.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/select2/select2.min.js"></script>
    <script src="../vendor/daterangepicker/moment.min.js"></script>
    <script src="../vendor/daterangepicker/daterangepicker.js"></script>
    <script src="../vendor/countdowntime/countdowntime.js"></script>
    <script src="../js/main.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-sm bg-light navbar-light">
    <ul class="navbar-nav">
      <a class="navbar-brand" style="margin-left:70px;" href="../index.php">MaMa購物網</a>
      <!-- <li class="nav-item">
        <a class="nav-link btn btn-outline-dark" href="../index.php" style="margin-left:750px;">首頁</a>
      </li> -->

    </ul>
  </nav>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


  <!-- <div style="text-align:center; background-color:#ADD8E6">
    <div class="form-group row">
      <label for="nameTF" class="col-4 col-form-label">歡迎註冊：</label>
    </div>
    <form method="post" class="needs-validation">
      <div class="form-group row">
        <label for="nameTF" class="col-4 col-form-label">姓名/Name</label>
        <div class="col-6">
          <input id="nameTF" name="nameTF" type="text" class="form-control" required>
            <?php if (isset($_POST["submitbtn"])) echo "<div class='invalid-feedback'>必要欄位</div>";  ?>

        </div>
      </div>
      <div class="form-group row">
        <label for="accountTF" class="col-4 col-form-label">帳號/Account</label>
        <div class="col-6">
          <input id="accountTF" name="accountTF" type="text" class="form-control" required>
        </div>
      </div>
      <div class="form-group row">
        <label for="passwordTF" class="col-4 col-form-label">密碼/Password</label>
        <div class="col-6">
          <input id="passwordTF" name="passwordTF" type="password" class="form-control" required>
        </div>
      </div>
      <div class="form-group row">
        <label for="passwordTF" class="col-4 col-form-label">再輸入一次密碼</label>
        <div class="col-6">
          <input id="password2TF" name="password2TF" type="password" class="form-control">
        </div>
      </div>
      <div class="form-group row">
        <label for="passwordTF" class="col-4 col-form-label">信用卡</label>
        <div class="col-6">
          <input id="creditTF" name="creditTF" type="text" class="form-control">
        </div>
      </div>
      <div class="form-group row">
        <label for="passwordTF" class="col-4 col-form-label">住址</label>
        <div class="col-6">
          <input id="addressTF" name="addressTF" type="text" class="form-control">
        </div>
      </div>
      <div class="form-group row">
        <div class="offset-4 col-6" style="text-align:right">
          <button name="submitbtn" id="submitbtn" type="submit" class="btn btn-outline-primary">申請</button>
        </div>
      </div>
    </form>
  </div> -->

  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100 p-t-50 p-b-90">
        <form class="login100-form validate-form flex-sb flex-w needs-validation" method="post">
          <span class="login100-form-title p-b-51">
            註冊
          </span>


          <div class="wrap-input100 validate-input m-b-16" data-validate="Username is required">
            <input class="input100" type="text" name="nameTF" placeholder="姓名/Name" required>
            <span class="focus-input100"></span>
          </div>


          <div class="wrap-input100 validate-input m-b-16" data-validate="Account is required">
            <input class="input100" type="text" name="accountTF" placeholder="帳號/Account" required>
            <span class="focus-input100"></span>
          </div>


          <div class="wrap-input100 validate-input m-b-16" data-validate="Password is required">
            <input class="input100" type="password" name="passwordTF" placeholder="Password" required>
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input m-b-16" data-validate="Password is required">
            <input class="input100" type="password" name="password2TF" placeholder="Password again" required>
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input m-b-16" data-validate="Password is required">
            <input class="input100" type="text" name="addressTF" placeholder="地址/Address" >
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input m-b-16" data-validate="Password is required">
            <input class="input100" type="text" name="creditTF" placeholder="信用卡/CreditCard" >
            <span class="focus-input100"></span>
          </div>

          <div class="container-login100-form-btn m-t-17">
            <button class="login000-form-btn" name="submitbtn">
              signUp
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>

</body>

</html>