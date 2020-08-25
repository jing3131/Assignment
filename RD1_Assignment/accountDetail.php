<?php

session_start();
require("config.php");

$id = $_SESSION["accountId"];
$sql = <<<sqlCommand
    SELECT * FROM accountDetail WHERE accountId = $id
    ORDER BY dates
sqlCommand;

$result = mysqli_query($link,$sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        #container {
            margin: 0 auto; width: 30%;
        }
    </style>
</head>
<body style="background-color:#F5DEB3">
    <div style="text-align:center;" id="container">
        <table style="border:5px #FFAC55 solid;" width="400">
            <br>
            帳戶明細
            <tr>
            <td>日期</td>
            <td>存款/提款</td>
            <td>金額(NTD)</td>
            <td>餘額(NTD)</td>

            </tr>
            <?php while($row = mysqli_fetch_assoc($result)){ ?>
                <tr>
                <td><?= $row["dates"] ?></td>
                <td><?= $row["type"] ?></td>
                <td><?= number_format($row["moneyChange"]) ?></td>
                <td><?php
                    $m =$row["balance"] % 1000;
                    if($m<10){
                        $balance = str_replace("00$m","***",number_format($row["balance"]));
                    }
                    else if($m<100){
                        $balance = str_replace("0$m","***",number_format($row["balance"]));
                    }
                    else{
                        $balance = str_replace($m,"***",number_format($row["balance"]));
                    }
                    
                    echo $balance;
                 ?></td>
                </tr>
            <?php } ?>
        </table>
        <br>
        <button type="button" onclick="javascript:location.href='memberIndex.php'" name="ckeckbtn" class="btn btn-outline-primary">確認</button>
    </div>
</body>
</html>