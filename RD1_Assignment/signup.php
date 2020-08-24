<?php

// $link=mysqli_connect("localhost","root","root","RD1_Assignment");
// $result = mysqli_query($link,"set names utf8");



if(isset($_POST["submitbtn"])){
  if($_POST["nameTF"]!=null && $_POST["accountTF"]!=null && $_POST["passwordTF"]!=null){
    $name = $_POST["nameTF"];
    $account = $_POST["accountTF"];
    $password = $_POST["passwordTF"];
    // echo "$name <br> $account <br> $password";

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="js/jquery.js">
</head>
<body>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  歡迎註冊：
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
          <input id="passwordTF" name="passwordTF" type="text" class="form-control" require>
        </div>
    </div> 
    <div class="form-group row">
      <div class="offset-4 col-8">
        <button name="submitbtn" id="submitbtn" type="submit" class="btn btn-primary">申請</button>
      </div>
    </div>
  </form>

</body>
</html>