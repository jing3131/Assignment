<?php
session_start();
if(isset($_POST["cancelbtn"])){
    header("Location: withdraw.php");
    exit();
}
if(isset($_POST["submitbtn"])){
    $withdraw = $_POST["withdrawTF"];
    if(!is_numeric($withdraw)){                          // is_numeric 判斷是否為數字
        echo "<script> alert('請輸入數字(不可含有英中文)'); </script>";
    }

    else{
        require("config.php");        
        require("password.php");

        if($password != $pwd){
            echo "<script> alert('輸入密碼錯誤，請再次確認') </script>";        // 密碼比對
        }
        else{
            $sqlm = <<< sqlCommand
                select money from memberBank
                where accountId = $id;
            sqlCommand;
            $result = mysqli_query($link,$sqlm);
            $row["money"] = mysqli_fetch_assoc($result);
            $money = implode("",$row["money"]);
            if($withdraw > $money){
                echo "<script> alert('已到達提款上限，請重新填寫') </script>";      // 判斷是否超出原存款金額
            }
            else{                                
                $money -= $withdraw;
                $sqlw = <<< sqlCommand
                    UPDATE memberBank SET money = $money where accountId = $id
                sqlCommand;
                mysqli_query($link,$sqlw);                                  // 將memberBank資料更新

                $date = date("Y-m-d");
                $sqld = <<< sqlCommand
                    INSERT INTO accountDetail (accountId, type, moneyChange, dates, balance)
                    VALUES ($id, 'withdraw', $withdraw, '$date', $money);
                sqlCommand;
                mysqli_query($link,$sqld);                                  // 新增資料進accountdetail

                echo "<script> alert('提款成功') </script>";
                header("refresh:0.5;url='memberIndex.php'");
                exit();
            }

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

    <div style="text-align:center;  background-color:#FFEBCD">
            <form method="post">
                <br>
                <div class="form-group row">
                    <label for="withdrawTF" class="col-4 col-form-label">欲存款金額</label> 
                    <div class="col-4">
                        <input id="withdrawTF" name="withdrawTF" type="text" class="form-control">
                    </div>
                </div>                

                    <div class="form-group row">
                        <label for="passwordTF" class="col-4 col-form-label">請輸入密碼</label> 
                        <div class="col-4">
                            <input id="passwordTF" name="passwordTF" type="password" class="form-control">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <div class="offset-4 col-7">
                        <button name="submitbtn" id="submitbtn" type="submit" class="btn btn-outline-primary">確定</button>
                        <button name="cancelbtn" id="cancelbtn" type="submit" class="btn btn-outline-warning">取消</button>
                    </div>
                </div>
            </form>
    </div>
</body>
</html>