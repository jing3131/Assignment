<?php
session_start();
if(isset($_POST["cancelbtn"])){
    header("Location: withdraw.php");
    exit();
}
if(isset($_POST["submitbtn"])){
    $withdraw = $_POST["withdrawTF"];
    if(!is_numeric($withdraw)){                          // is_numeric 判斷是否為數字
        echo "<script> alert('請輸入數字(不可含有英中文)'); </script>";
    }

    else{
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

require("view/anotherWithdrawView.php");

?>

