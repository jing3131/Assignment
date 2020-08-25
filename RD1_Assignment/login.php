<?php

session_start();
require("config.php");

if(isset($_POST["signupbtn"])){
    header("Location: signup.php");
    exit();
}

if(isset($_POST["loginbtn"])){
    $account = $_POST["accountTF"];
    $password = $_POST["passwordTF"];
    $sqlAcc = "select account from member where account = '$account' ";
    $resultAcc = mysqli_query($link,$sqlAcc);

    $row["account"] = mysqli_fetch_assoc($resultAcc);           // 確認是否有此帳號
    // echo "row".$row["account"];
    // print_r($row["account"]);


    $sqlPwd = "select account, password from member where password = '$password' ";
    $resultPwd = mysqli_query($link,$sqlPwd);
    $row["password"] = mysqli_fetch_assoc($resultPwd);          // 確認密碼正確與否
    // echo "row".$row["password"];
    // print_r($row["password"]);
    

    if($account == null || $password == null){
        echo "<script>alert('請輸入帳號或密碼');</script>";
    }
    else if($row["account"] == null){
        echo "<script>alert('帳號或密碼錯誤');</script>";
    }
    else if($row["password"] == null){
        echo "<script>alert('帳號或密碼錯誤');</script>";
    }
    else{
        $_SESSION["account"] = $account;

        $sqlId = "select accountId from member where account = '$account'";   
        $resultId = mysqli_query($link,$sqlId); 
        $row["accountId"]= mysqli_fetch_assoc($resultId);
        $id = implode("",$row["accountId"]);                                            // 用使用者名稱查詢ID
        $_SESSION["accountId"] = $id;

        echo "<script>alert('歡迎登入');</script>";
        header("refresh:1;url=memberIndex.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <div style="text-align:center; background-color:#E0FFFF;">      <!-- style="text-align:center;" 置中 -->
        <form method="post" id="loginForm" name="loginForm">
            <div class="form-group row">
                <label class="col-4 col-form-label">登入/Login</label>
            </div>
            
            <div class="form-group row">
                <label for="accountTF" class="col-4 col-form-label">帳號/Account</label> 
                <div class="col-6">
                <input id="accountTF" name="accountTF" type="text" class="form-control" require>
                </div>
            </div>
            <div class="form-group row">
                <label for="passwordTF" class="col-4 col-form-label">密碼/Password</label> 
                <div class="col-6">
                <input id="passwordTF" name="passwordTF" type="password" class="form-control" require>
                </div>
            </div> 
            <div class="form-group row">                
                <div class="col-10" style="text-align:right"><button name="loginbtn" type="submit" class="btn btn-outline-primary">登入</button> </div>
            </div>      
            <div class="form-group row">
                <label class="col-4 col-form-label">註冊/Signup</label>
                <button name="signupbtn" type="submit" class="btn btn-outline-success">GoSignup</button>                
            </div>            

        </form>
    </div>
    
</body>
</html>