<?php

session_start();

if(isset($_POST["cancelbtn"])){
    header("Location: memberIndex.php");
    exit();
}

if(isset($_POST["btnOther"])){
    header("Location: anotherWithdraw.php");
    exit();
}

if(isset($_POST["submitbtn"])){
    $withdraw;
    if($_POST["rdobtn"]== null){
        echo "<script> alert('請勾選金額') </script>";
    }
    else{
        $withdraw = $_POST["rdobtn"];
        require("config.php");
        require("password.php");
        require("getSql.php");
        if($password != $pwd){
            echo "<script> alert('輸入密碼錯誤，請再次確認') </script>";        // 密碼比對
        }
        else{
            $money = getBalance($link, $id);

            if($withdraw > $money){
                echo "<script> alert('已到達提款上限，請重新填寫') </script>";      // 判斷是否超出原存款金額
            }
            else{                                
                $money -= $withdraw;
                updateBalance($link, $money, $id);
    
                $date = date("Y-m-d");
                setDetail($link, $id, "withdraw", $withdraw, $date, $money);

    
                echo "<script> alert('提款成功') </script>";
                header("refresh:0.5;url='memberIndex.php'");
                exit();
            }
        }
    }
    
    
}
require("view/withdrawView.php");

?>


