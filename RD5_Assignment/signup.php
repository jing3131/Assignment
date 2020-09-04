<?php



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
        VALUES(?,?,?);
      sqlCommand; 
      $resultAdd = $link->prepare($sqlAdd);
      $resultAdd->execute(array("$name","$account","$password"));
      // $sqlAdd = <<< sqlCommand
      //   INSERT INTO member (name, account, password)
      //   VALUES('$name','$account','$password');
      // sqlCommand;  
      // mysqli_query($link,$sqlAdd);                      // 新建帳戶

      $sqlId= <<< sqlCommand
        SELECT accountId from member where account = ?
      sqlCommand;
      $resultId = $link->prepare($sqlId);
      $resultId->execute(array($id));
      $row["accountId"] = $resultId->fetch(PDO::FETCH_ASSOC);
      // $sqlId= <<< sqlCommand
      //   SELECT accountId from member where account = '$account'
      // sqlCommand;
      // $resultId = mysqli_query($link,$sqlId);
      // $row["accountId"] =mysqli_fetch_assoc($resultId);     // 找尋新建帳戶的ID
      $id =implode("",$row["accountId"]);                   // 將陣列轉成字串
    
      // echo $id;
      $sqlAddBank = <<< sqlCommand
        INSERT INTO memberBank (accountId, money) VALUES (?,0);
      sqlCommand;
      $result = $link->prepare($sqlAddBank);
      $result->execute(array($id));
      // $sqlAddBank = <<< sqlCommand
      //   INSERT INTO memberBank (accountId, money) VALUES ($id,0);
      // sqlCommand;
      // mysqli_query($link,$sqlAddBank);                // 新增帳戶銀行
      
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
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
</head>
<body>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


  <!-- <div style="text-align:center; background-color:#ADD8E6">    
    <div class="form-group row">
        <label for="nameTF" class="col-4 col-form-label">歡迎註冊：</label> 
      </div>
    <form method="post">
      <div class="form-group row">
        <label for="nameTF" class="col-4 col-form-label">姓名/Name</label> 
          <div class="col-6">
            <input id="nameTF" name="nameTF" type="text" class="form-control" required>
          </div>
      </div>
      <div class="form-group row">
        <label for="accountTF" class="col-4 col-form-label">帳號/Account</label> 
          <div class="col-6">
            <input id="accountTF" name="accountTF" type="text" class="form-control" required>
          </div>
      </div>
      <div class="form-group row">
        <label for="passwordTF" class="col-4 col-form-label">密碼/Password</label> 
          <div class="col-6">
            <input id="passwordTF" name="passwordTF" type="password" class="form-control" required>
          </div>
      </div> 
      <div class="form-group row">
        <label for="passwordTF" class="col-4 col-form-label">再輸入一次密碼</label> 
          <div class="col-6">
            <input id="password2TF" name="password2TF" type="password" class="form-control" required>
          </div>
      </div> 
      <div class="form-group row">
        <div class="offset-4 col-6" style="text-align:right">
          <button name="submitbtn" id="submitbtn" type="submit" class="btn btn-outline-primary">申請</button>
        </div>
      </div>
    </form>
  </div> -->

  <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
                <form class="login100-form validate-form flex-sb flex-w" method="post">
                    <span class="login100-form-title p-b-32">
                        註冊
                    </span>

                    <span class="txt1 p-b-11">
                        姓名/UserName
                    </span>
                    <div class="wrap-input100 validate-input m-b-36" data-validate="Username is required">
                        <input class="input100" type="text" name="nameTF">
                        <span class="focus-input100"></span>
                    </div>

                    <span class="txt1 p-b-11">
                        帳號/Account
                    </span>
                    <div class="wrap-input100 validate-input m-b-36" data-validate="Username is required">
                        <input class="input100" type="text" name="accountTF">
                        <span class="focus-input100"></span>
                    </div>

                    <span class="txt1 p-b-11">
                        密碼/Password
                    </span>
                    <div class="wrap-input100 validate-input m-b-12" data-validate="Password is required">
                        <span class="btn-show-pass">
                            <i class="fa fa-eye"></i>
                        </span>
                        <input class="input100" type="password" name="passwordTF">
                        <span class="focus-input100"></span>
                    </div>

                    <span class="txt1 p-b-11">
                        再輸入一次密碼/Password
                    </span>
                    <div class="wrap-input100 validate-input m-b-12" data-validate="Password is required">
                        <span class="btn-show-pass">
                            <i class="fa fa-eye"></i>
                        </span>
                        <input class="input100" type="password" name="password2TF">
                        <span class="focus-input100"></span>
                    </div>

                    <!-- <div class="flex-sb-m w-full p-b-48">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                            <label class="label-checkbox100" for="ckb1">
                                Remember me
                            </label>
                        </div>

                        <div>
                            <a href="#" class="txt3">
                                Forgot Password?
                            </a>
                        </div>
                    </div> -->

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" name="submitbtn">
                            SignUp
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</body>
</html>