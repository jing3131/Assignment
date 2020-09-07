<?php

session_start();
require("config.php");
require("getSql.php");

if (isset($_POST["signupbtn"])) {
    header("Location: signup.php");
    exit();
}

if (isset($_POST["loginbtn"])) {
    $account = $_POST["accountTF"];
    $password = $_POST["passwordTF"];


    $dataAccount = getAccount($link, $account);


    $dataPassword = getPassword($link, $account, $password);


    if ($account == null || $password == null) {
        echo "<script>alert('請輸入帳號或密碼');</script>";
    } else if ($dataAccount == null) {
        echo "<script>alert('帳號或密碼錯誤');</script>";
    } else if ($dataPassword == null) {
        echo "<script>alert('帳號或密碼錯誤');</script>";
    } else {
        $_SESSION["account"] = $account;

        $id = getId($link, $account);               // 用使用者名稱查詢ID
        $_SESSION["accountId"] = $id;


        echo "<script>alert('歡迎登入');</script>";
        header("refresh:1;url=memberIndex.php");
    }
}

require("view/loginView.php");
?>

