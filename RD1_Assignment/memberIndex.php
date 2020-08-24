<?php

session_start();
require("config.php");

if(isset($_POST["moneybtn"])){
    $id = $_SESSION["accountId"];
    // $sqlId = "select accountId from member where account = '$account'";   
    // $resultId = mysqli_query($link,$sqlId); 
    // $row["accountId"]= mysqli_fetch_assoc($resultId);
    // $id = implode("",$row["accountId"]);                                            // 用使用者名稱查詢ID

    $sql = <<< sqlCommand
        SELECT money FROM memberBank WHERE accountId = $id;
    sqlCommand;
    $result = mysqli_query($link,$sql);
    $row["money"] = mysqli_fetch_assoc($result);
    $money=implode("",$row["money"]);                  // 查詢餘額的值
    echo "<script> alert('剩餘金額為 $ NTD $money'); </script>";
}

if(isset($_POST["depositbtn"])){
    header("Location: deposit.php");
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
</head>
<body>
    <a href="index.php?logout=1">登出</a>
    <form action="" method="post">
        <div>
            存款：
            <button type="submit" name="depositbtn" id="depositbtn">存款</button> 
            提款：
            <button type="submit" name="withdrawbtn" id="withdrawbtn">提款</button>
            查詢餘額：
            <button type="submit" name="moneybtn" id="moneybtn">查詢餘額</button>
            查詢明細：
            <button type="submit" name="detailbtn" id="detailbtn">查詢明細</button>   
        </div>
    </form>


</body>
</html>