<?php

session_start();

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
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript"></script>
</head>
<body>
        <button type="submit" name="loginbtn" id="loginbtn" class="btn btn-primary" onclick="window.location='login.php'">登入</button>
        <button type="submit" name="signupbtn" id="signupbtn" class="btn btn-success" onclick="window.location='signup.php'">註冊</button>



</body>
</html>