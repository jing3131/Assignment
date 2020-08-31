<?php
session_start();
$userName;

if(isset($_SESSION["account"])){
    $userName = $_SESSION["account"];
}
// else{
//     $userName = "Guest";
// }
if($_GET["logout"]){
    unset($_SESSION["account"]);
    unset($_SESSION["accountId"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(isset($_SESSION["account"])) { ?>
        歡迎登入： <?= $userName ?>
        <a href="index.php?logout=1" style="margin-left:70px">登出</a>
    <?php } ?>
    <br>
    <button type="button" onclick="window.location='login.php'">登入</button>
    <button type="button" onclick="window.location='signup.php'">註冊</button>
    
</body>
</html>