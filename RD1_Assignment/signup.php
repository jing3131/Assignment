<?php

// $link=mysqli_connect("localhost","root","root","RD1_Assignment");
// $result = mysqli_query($link,"set names utf8");



if(isset($_POST["submitbtn"])){
  if($_POST["nameTF"]!=null && $_POST["accountTF"]!=null && $_POST["passwordTF"]!=null){
    $name = $_POST["nameTF"];
    $account = $_POST["accountTF"];
    $password = $_POST["passwordTF"];
    $password2 = $_POST["password2TF"];
    // echo "$name <br> $account <br> $password";

    if($password != $password2){
      echo "<script>alert('密碼不相等，請重新輸入')</script>";
    }
    else{
      require("config.php");
      $sqlAdd = <<< sqlCommand
        INSERT INTO member (name, account, password)
        VALUES('$name','$account','$password');
      sqlCommand;  
      mysqli_query($link,$sqlAdd);                      // 新建帳戶

      $sqlId= <<< sqlCommand
        SELECT accountId from member where account = '$account'
      sqlCommand;
      $resultId = mysqli_query($link,$sqlId);
      $row["accountId"] =mysqli_fetch_assoc($resultId);     // 找尋新建帳戶的ID
      $id =implode("",$row["accountId"]);                   // 將陣列轉成字串
    
      // echo $id;
      $sqlAddBank = <<< sqlCommand
        INSERT INTO memberBank (accountId, money) VALUES ($id,0);
      sqlCommand;
      mysqli_query($link,$sqlAddBank);                // 新增帳戶銀行
      
      echo "<script>alert('註冊成功！')</script>";
      header("refresh:1;url=index.php");
      exit();
    }
   
  }
  else{
    echo "<script>alert('帳號和密碼不能為空')</script>";
  }
  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="js/jquery.js">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


  <div style="text-align:center; background-color:#ADD8E6">    
    <div class="form-group row">
        <label for="nameTF" class="col-4 col-form-label">歡迎註冊：</label> 
      </div>
    <form method="post">
      <div class="form-group row">
        <label for="nameTF" class="col-4 col-form-label">姓名/Name</label> 
          <div class="col-6">
            <input id="nameTF" name="nameTF" type="text" class="form-control" require>
          </div>
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
        <label for="passwordTF" class="col-4 col-form-label">再輸入一次密碼</label> 
          <div class="col-6">
            <input id="password2TF" name="password2TF" type="password" class="form-control" require>
          </div>
      </div> 
      <div class="form-group row">
        <div class="offset-4 col-6" style="text-align:right">
          <button name="submitbtn" id="submitbtn" type="submit" class="btn btn-outline-primary">申請</button>
        </div>
      </div>
    </form>
  </div>

</body>
</html>