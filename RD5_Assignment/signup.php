<?php

session_start();

if (isset($_POST["submitbtn"])) {
  if ($_POST["nameTF"] != null && $_POST["accountTF"] != null && $_POST["passwordTF"] != null) {
    $name = $_POST["nameTF"];
    $account = $_POST["accountTF"];
    $password = $_POST["passwordTF"];
    $password2 = $_POST["password2TF"];
    // echo "$name <br> $account <br> $password";

    // echo strlen($password);
    require("config.php");
    require("getSql.php");

    $compare = compareAccount($link, $account);
    if ($compare != null) {
      echo "<script>alert('帳號名稱已註冊過，請再試一次')</script>";
    }
    else if(!preg_match('/\w{3,12}$/i',$account)){
      echo "<script>alert('帳號名稱至少3碼，至多12碼，只允許包含英文數字與底線')</script>";
    }
    else if(!preg_match('/\w{3,12}$/',$password)){
      echo "<script>alert('密碼需至少6碼，至多12碼，只允許包含英文數字與底線')</script>";
    }
    else if ($password != $password2) {
      echo "<script>alert('密碼不相等，請重新輸入')</script>";
    } else {

      // else{
      setAccount($link, $name, $account, $password);                     // 新建帳戶

      $id = getId($link, $account);                               // 找尋新建帳戶的ID

      // echo $id;
      setAccountBank($link, $id);                                 // 新增帳戶銀行
      $_SESSION["accountId"] = $id;
      $_SESSION["account"] = $account;

      echo "<script>alert('註冊成功！')</script>";
      header("refresh:1;url=index.php");
      exit();
      // }
    }
  } else {
    echo "<script>alert('帳號和密碼不能為空')</script>";
  }
}

require("view/signupView.php");
