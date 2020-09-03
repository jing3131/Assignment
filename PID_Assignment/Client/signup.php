<?php
//session_start();
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
      $sql = <<<sqlCommand
        INSERT INTO account (name, account, `password`, creditCard, address, canUse)
        VALUES(?,?,?,?,?,?);
      sqlCommand;
      $result = $link->prepare($sql);
      $result->execute(array($name, $account, $password, $credit, $address, 'Y'));

      echo "<script>alert('註冊成功！')</script>";
      header("refresh:0.5;url=../index.php");
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
</head>

<body>
  <nav class="navbar navbar-expand-sm bg-light navbar-light">
    <ul class="navbar-nav">
      <span class="navbar-brand" style="margin-left:70px;">MaMa購物網</span>
      <li class="nav-item">
        <a class="nav-link btn btn-outline-dark" href="../index.php" style="margin-left:750px;">首頁</a>
      </li>

    </ul>
  </nav>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


  <div style="text-align:center; background-color:#ADD8E6">
    <div class="form-group row">
      <label for="nameTF" class="col-4 col-form-label">歡迎註冊：</label>
    </div>
    <form method="post" class="needs-validation">
      <div class="form-group row">
        <label for="nameTF" class="col-4 col-form-label">姓名/Name</label>
        <div class="col-6">
          <input id="nameTF" name="nameTF" type="text" class="form-control" required>
          <!-- <?php if (isset($_POST["submitbtn"])) echo "<div class='invalid-feedback'>必要欄位</div>";  ?> -->

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
  </div>

</body>

</html>