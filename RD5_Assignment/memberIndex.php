<?php

session_start();
require("config.php");
$userName=$_SESSION["account"];

if(isset($_POST["moneybtn"])){
    $id = $_SESSION["accountId"];
    
    $sql = <<< sqlCommand
        SELECT money FROM memberBank WHERE accountId = ?;
    sqlCommand;
    $result = $link->prepare($sql);
    $result->execute(array($id));
    $row["money"] = $result->fetch(PDO::FETCH_ASSOC);

    // $sql = <<< sqlCommand
    //     SELECT money FROM memberBank WHERE accountId = $id;
    // sqlCommand;
    // $result = mysqli_query($link,$sql);
    // $row["money"] = mysqli_fetch_assoc($result);
    $money=implode("",$row["money"]);                   // 查詢餘額的值
    $money = number_format($money);                     // number_format($money); 三位一撇
    echo "<script> alert('剩餘金額為 $ NTD $money'); </script>";
}

if(isset($_POST["depositbtn"])){                    // 導入存款頁面
    header("Location: deposit.php");
    exit();
}

if(isset($_POST["withdrawbtn"])){                   // 導入提款頁面
    header("Location: withdraw.php");
    exit();
}

if(isset($_POST["detailbtn"])){
    header("Location: accountDetail.php");          // 導入明細頁面
    exit();
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="js/jquery.js">
    <style>
        #container {
            margin: 0 auto; width: 25%;
        }
    </style>
</head>
<body style="background-color:#FAEBD7">
    <div style="text-align:center;" id="container">
        歡迎登入： <?= $userName ?>
        <a href="index.php?logout=1" style="margin-left:70px">登出</a>
        
        <form action="" method="post">
            <table width="300" style="border:5px #DEB887 solid">
            
            <tr>
            　<td align="center"> 存款：</td>           <!-- align="center" 置中 -->
            　<td align="center"><button type="submit" name="depositbtn" id="depositbtn">存款</button> </td>
        　  </tr>
            <tr>
            　<td align="center">提款：</td>
            　<td align="center"><button type="submit" name="withdrawbtn" id="withdrawbtn">提款</button></td>
        　  </tr>
            <tr>
            　<td align="center">查詢餘額：</td>
            　<td align="center"><button type="submit" name="moneybtn" id="moneybtn">查詢餘額</button></td>
        　  </tr>
            <tr>
            　<td align="center">查詢明細：</td>
            　<td align="center"><button type="submit" name="detailbtn" id="detailbtn">查詢明細</button></td>
        　  </tr>

            </table>
        </form>
    </div>
        <!--<div>
            存款：
            <button type="submit" name="depositbtn" id="depositbtn">存款</button> 
            提款：
            <button type="submit" name="withdrawbtn" id="withdrawbtn">提款</button>
            查詢餘額：
            <button type="submit" name="moneybtn" id="moneybtn">查詢餘額</button>
            查詢明細：
            <button type="submit" name="detailbtn" id="detailbtn">查詢明細</button>   
        </div>-->
    


</body>
</html>