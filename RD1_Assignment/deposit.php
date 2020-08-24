<?php

session_start();

if(isset($_POST["cancelbtn"])){
    header("Location: memberIndex.php");
    exit();
}

if(isset($_POST["submitbtn"])){
    $deposit = $_POST["depositTF"];
    if(!is_numeric($deposit)){                          // is_numeric 判斷是否為數字
        echo "<script> alert('請輸入數字(不可含有英中文)'); </script>";
    }
    else{
        require("config.php");
        $id = $_SESSION["accountId"];
        $sql="select password from member where accountId = $id";
        $result = mysqli_query($link,$sql);
        $row["password"] = mysqli_fetch_assoc($result);
        $pwd = implode("",$row["password"]);

        
        $pwdTF = $_POST["passwordTF"];
        if($pwdTF != $pwd){
            echo "<script> alert('密碼輸入錯誤，請再次確認'); </script>";
        }
        else{
            $sqlmoney = "select money from memberBank where accountId = $id";
            $result = mysqli_query($link,$sqlmoney);
            $row["money"] = mysqli_fetch_assoc($result);
            $money = implode("",$row["money"]);                                 // 原帳戶有的金額
            $money += $deposit;                                                 // 存款+原帳戶金額

            $sqldpt = <<< sqlCommand
                UPDATE memberBank SET money = $money where accountId = $id
            sqlCommand;
            mysqli_query($link,$sqldpt);
            echo "<script> alert('存款成功'); </script>";
            header("refresh:0.5;url='memberIndex.php'");
            exit();
        }
    }
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <form method="post">
        <div class="form-group row">
            <label for="depositTF" class="col-4 col-form-label">欲存款金額</label> 
            <div class="col-6">
            <input id="depositTF" name="depositTF" type="text" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="passwordTF" class="col-4 col-form-label">請輸入密碼</label> 
            <div class="col-6">
            <input id="passwordTF" name="passwordTF" type="text" class="form-control">
            </div>
        </div> 
        <div class="form-group row">
            <div class="offset-4 col-6">
            <button name="submitbtn" id="submitbtn" type="submit" class="btn btn-primary">確定</button>
            <button name="cancelbtn" id="cancelbtn" type="submit" class="btn btn-wrong">取消</button>
            </div>
        </div>
    </form>
</body>
</html>