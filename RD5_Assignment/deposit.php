<?php

session_start();
require("getSql.php");

if(isset($_POST["cancelbtn"])){
    header("Location: memberIndex.php");
    exit();
}

if(isset($_POST["btnOther"])){
    header("Location: anotherDeposit.php");
    exit();
}

if(isset($_POST["submitbtn"])){
    $deposit;

    if($_POST["rdobtn"]== null){
        echo "<script> alert('請勾選金額') </script>"; 
    }
    else{
        $deposit = $_POST["rdobtn"];
        // echo $deposit;
        require("config.php");
        require("password.php");
    
        if($password != $pwd){
            echo "<script> alert('輸入密碼錯誤，請再次確認') </script>";        // 密碼比對
        }
        else{
            $date = date("Y-m-d");
            $id = $_SESSION["accountId"];

            $money =getBalance($link, $id);                                 // 將剩餘存款找出來並加總
            $money += $deposit;                                             // 存款+原帳戶金額

            updateBalance($link, $money, $id);                              // 將存款更新
    
            $date = date("Y-m-d");
            setDetail($link, $id, "deposit", $deposit, $date, $money);                 // 新增資料進accountdetail                   
    
            echo "<script> alert('存款成功'); </script>";
            header("refresh:0.5;url='memberIndex.php'");
            exit();
        }
    }
    
}

require("view/despositView.php");

?>
