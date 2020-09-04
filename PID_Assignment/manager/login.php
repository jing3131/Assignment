<?php

session_start();
require("../config.php");

if (isset($_POST["loginbtn"])) {
    $account = $_POST["accountTF"];
    $password = $_POST["passwordTF"];

    $sqlAcc = "select account from manager where account = ? ";
    $resultAcc = $link->prepare($sqlAcc);
    $resultAcc->execute(array($account));


    $row["account"] = $resultAcc->fetch(PDO::FETCH_ASSOC);

    $sqlPwd = "select `password` from manager where account = ? and `password` = ?";
    $resultPwd = $link->prepare($sqlPwd);
    $resultPwd->execute(array("$account", "$password"));
    $row["password"] = $resultPwd->fetch(PDO::FETCH_ASSOC);         // 確認密碼正確與否


    if ($account == null || $password == null) {
        echo "<script>alert('請輸入帳號或密碼');</script>";
    } else if ($row["account"] == null) {
        echo "<script>alert('帳號或密碼錯誤');</script>";
    } else if ($row["password"] == null) {
        echo "<script>alert('帳號或密碼錯誤');</script>";
    } else {
        $_SESSION["accountManager"] = $account;

        $sqlId = "select managerId from manager where account = ?";
        $resultId = $link->prepare($sqlId);
        $resultId->execute(array("$account"));
        $row["managerId"] = $resultId->fetch(PDO::FETCH_ASSOC);

        $id = implode("", $row["managerId"]);                                            // 用使用者名稱查詢ID
        $_SESSION["accountIdManager"] = $id;


        echo "<script>alert('歡迎登入');</script>";
        header("refresh:1;url=../index.php");
    }
}

if ($_GET["logout"]) {
    unset($_SESSION["accountManager"]);
    unset($_SESSION["accountIdManager"]);
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="../images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!--===============================================================================================-->

    <script type="text/javascript" src="jquery.js"></script>
    <script src="../bootstrap-4.5.2-dist/js/bootstrap.min.js"></script>
    <script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="../vendor/animsition/js/animsition.min.js"></script>
    <script src="../vendor/bootstrap/js/popper.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/select2/select2.min.js"></script>
    <script src="../vendor/daterangepicker/moment.min.js"></script>
    <script src="../vendor/daterangepicker/daterangepicker.js"></script>
    <script src="../vendor/countdowntime/countdowntime.js"></script>
    <script src="../js/main.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-sm bg-light navbar-light">
        <ul class="navbar-nav">
            <a class="navbar-brand" style="margin-left:70px;" href="../index.php">MaMa購物網</a>
            <!-- <li class="nav-item">
            <a class="nav-link btn btn-outline-dark" href="../index.php"style="margin-left:750px;">首頁</a>
            </li> -->

        </ul>
    </nav>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- style="text-align:center;" 置中 -->
    <!-- <div style="text-align:center; background-color:#E0FFFF;">
       
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

        </form>
    </div> -->

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-t-50 p-b-90">
                <form class="login100-form validate-form flex-sb flex-w" method="post">
                    <span class="login100-form-title p-b-51">
                        Login
                    </span>


                    <div class="wrap-input100 validate-input m-b-16" data-validate="Username is required">
                        <input class="input100" type="text" name="accountTF" placeholder="Username">
                        <span class="focus-input100"></span>
                    </div>


                    <div class="wrap-input100 validate-input m-b-16" data-validate="Password is required">
                        <input class="input100" type="password" name="passwordTF" placeholder="Password">
                        <span class="focus-input100"></span>
                    </div>

                    <!-- <div class="flex-sb-m w-full p-t-3 p-b-24">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                            <label class="label-checkbox100" for="ckb1">
                                Remember me
                            </label>
                        </div>

                        <div>
                            <a href="#" class="txt1">
                                Forgot?
                            </a>
                        </div>
                    </div> -->

                    <div class="container-login100-form-btn m-t-17">
                        <button class="login100-form-btn" name="loginbtn">
                            Login
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div id="dropDownSelect1"></div>
</body>

</html>