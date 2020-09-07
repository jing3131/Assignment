<?php
session_start();
if(isset($_POST["cancelbtn"])){
    header("Location: deposit.php");
    exit();
}
if(isset($_POST["submitbtn"])){
    $deposit = $_POST["depositTF"];
    if(!is_numeric($deposit)){                          // is_numeric 判斷是否為數字
        echo "<script> alert('請輸入數字(不可含有英中文)'); </script>";
    }
    else{
        require("config.php");
        require("password.php");
        require("getSql.php");
        if($password != $pwd){
            echo "<script> alert('密碼輸入錯誤，請再次確認'); </script>";         // 密碼比對
        }
        else{                  
            $money = getBalance($link,$id);
            $money += $deposit;                                                 // 存款+原帳戶金額

            updateBalance($link, $money, $id);

            $date = date("Y-m-d");
            setDetail($link, $id, "deposit", $deposit, $date, $money);

            
            echo "<script> alert('存款成功'); </script>";
            header("refresh:0.5;url='memberIndex.php'");
            exit();
        }
    }
}

require("view/anotherDepositView.php");

?>

