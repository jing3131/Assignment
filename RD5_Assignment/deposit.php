<?php

session_start();

if(isset($_POST["cancelbtn"])){
    header("Location: memberIndex.php");
    exit();
}

if(isset($_POST["btnOther"])){
    header("Location: anotherDeposit.php");
    exit();
}

if(isset($_POST["submitbtn"])){
    $deposit;

    if($_POST["rdobtn"]== null){
        echo "<script> alert('請勾選金額') </script>"; 
    }
    else{
        $deposit = $_POST["rdobtn"];
        // echo $deposit;
        require("config.php");
        require("password.php");
    
        if($password != $pwd){
            echo "<script> alert('輸入密碼錯誤，請再次確認') </script>";        // 密碼比對
        }
        else{
            $date = date("Y-m-d");
            $id = $_SESSION["accountId"];

            $sqlmoney = "select money from memberBank where accountId = ?";
            $result = $link->prepare($sqlmoney);
            $result->execute(array($id));
            $row["money"] = $result->fetch(PDO::FETCH_ASSOC);
            // $sqlmoney = "select money from memberBank where accountId = $id";
            // $result = mysqli_query($link,$sqlmoney);
            // $row["money"] = mysqli_fetch_assoc($result);
            $money = implode("",$row["money"]);                                 // 原帳戶有的金額
            $money += $deposit;                                                 // 存款+原帳戶金額
    

            $sqldpt = <<< sqlCommand
                UPDATE memberBank SET money = ? where accountId = ?
            sqlCommand;
            $result =$link->prepare($sqldpt);
            $result->execute(array($money,$id));
            // $sqldpt = <<< sqlCommand
            //     UPDATE memberBank SET money = $money where accountId = $id
            // sqlCommand;
            // mysqli_query($link,$sqldpt);
    
            $date = date("Y-m-d");
            $sqld = <<< sqlCommand
                INSERT INTO accountDetail (accountId, type, moneyChange, dates, balance)
                VALUES (?, 'deposit', ?, ?, ?);
            sqlCommand;
            $result = $link->prepare($sqld);
            $result->execute(array($id,$deposit,"$date",$money));
            // $sqld = <<< sqlCommand
            //     INSERT INTO accountDetail (accountId, type, moneyChange, dates, balance)
            //     VALUES ($id, 'deposit', $deposit, '$date', $money);
            // sqlCommand;
            // mysqli_query($link,$sqld);                                  // 新增資料進accountdetail
    
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript"></script>
    </head>
<body>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <div style="text-align:center; background-color:#FAF0E6">
        <form method="post">
            <!-- <div class="form-group row">
                <label for="depositTF" class="col-4 col-form-label">欲存款金額</label> 
                <div class="col-4">
                <input id="depositTF" name="depositTF" type="password" class="form-control">
                </div>
            </div> -->
            <br>
            <table style="margin-left:150px">
                <tr>
                    <td>欲存款金額</td>
                    <td class="custom-control cusmtom-radio custom-control-inline"><input type="radio" name="rdobtn" id="rdobtn500" class="custom-control-inline" value="500"> 500</td>
                    <td class="custom-control cusmtom-radio custom-control-inline"><input type="radio" name="rdobtn" id="rdobtn1000"class="custom-control-inline" value="1000"> 1000</td>
                    <td class="custom-control cusmtom-radio custom-control-inline"><input type="radio" name="rdobtn" id="rdobtn3000"class="custom-control-inline" value="3000"> 3000</td>
                    <td class="custom-control cusmtom-radio custom-control-inline"><input type="radio" name="rdobtn" id="rdobtn5000"class="custom-control-inline" value="5000"> 5000</td>
                    <td><input type="submit" name="btnOther" id="btnOther" class="btn btn-outline-success" value="其他面額"> </td>
                </tr>
                <tr>
                    <td>請輸入密碼</td>
                    <td><input id="passwordTF" name="passwordTF" type="password" class="form-control"></td>
                </tr>
            </table>
            <br>
            <div class="form-group row">
                <div class="offset-4 col-4">
                <button name="submitbtn" id="submitbtn" type="submit" class="btn btn-outline-primary">確定</button>
                <button name="cancelbtn" id="cancelbtn" type="submit" class="btn btn-outline-warning">取消</button>
                </div>
            </div>
            <!-- <div class=" custom-control-inline" style="margin-left:-560px">
            欲存款金額
            </div>
            <div class="custom-control cusmtom-radio custom-control-inline">
                <input type="radio" name="rdobtn" id="rdobtn500" class="custom-control-inline" value="500"> 500
            </div>
            <div class="custom-control cusmtom-radio custom-control-inline">
                <input type="radio" name="rdobtn" id="rdobtn1000"class="custom-control-inline" value="1000"> 1000
            </div>
            <div class="custom-control cusmtom-radio custom-control-inline">
                <input type="radio" name="rdobtn" id="rdobtn3000"class="custom-control-inline" value="3000"> 3000
            </div>
            <div class="custom-control cusmtom-radio custom-control-inline">
                <input type="radio" name="rdobtn" id="rdobtn5000"class="custom-control-inline" value="5000"> 5000
            </div>
            <div class=" custom-control-inline">
                <input type="submit" name="btnOther" id="btnOther" class="btn btn-outline-success" value="其他面額"> 
            </div>

            <div class="form-group row">
                <label for="passwordTF" class="col-2 col-form-label">請輸入密碼</label> 
                <div class="col-4">
                <input id="passwordTF" name="passwordTF" type="password" class="form-control">
                </div>
            </div> 
            <div class="form-group row">
                <div class="offset-4 col-4">
                <button name="submitbtn" id="submitbtn" type="submit" class="btn btn-outline-primary">確定</button>
                <button name="cancelbtn" id="cancelbtn" type="submit" class="btn btn-outline-warning">取消</button>
                </div>
            </div> -->
        </form>
    </div>
</body>
</html>