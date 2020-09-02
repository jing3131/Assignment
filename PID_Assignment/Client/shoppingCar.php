<?php
session_start();
$userName = $_SESSION["account"];
$id = $_SESSION["accountId"];

require("../config.php");
$sql = <<<sqlCommand
    SELECT s.accountId,s.productName,s.quantity,p.productId,p.productPic,p.productPrice,p.productQuantity FROM shoppingCar as s 
    JOIN product as p on s.productName = p.productName
    WHERE accountId = ?
sqlCommand;
$result = $link->prepare($sql);
$result->execute(array($id));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../bootstrap-4.5.2-dist/css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="../jquery.js"></script>
    <style> 
    input[type=number] { 
        height: 30px; 
        line-height: 30px; 
        font-size: 16px; 
        padding: 0 8px; 
    } 
    input[type=number]::-webkit-inner-spin-button { 
        -webkit-appearance: none; 
        cursor:pointer; 
        display:block; 
        width:8px; 
        color: #333; 
        text-align:center; 
        position:relative; 
    }  
    input[type=number]:hover::-webkit-inner-spin-button { 
        background: #eee url('http://i.stack.imgur.com/YYySO.png') no-repeat 50% 50%; 
        width: 14px; 
        height: 14px; 
        padding: 4px; 
        position: relative; 
        right: 4px; 
        border-radius: 28px; 
    } 
    </style> 
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-light navbar-light">
        <ul class="navbar-nav">


            <?php if (isset($_SESSION["account"])) { ?>
                <span class="navbar-text" style="margin-left:70px;">歡迎登入： <?= $userName ?></span>
                <li class="nav-item">
                    <a class="nav-link" href="login.php?logout=1"> 登出 </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-dark" href="client/shoppingCar.php" style="margin-left:50px;"> 購物車 </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-dark" href="client/history.php" style="margin-left:50px;"> 購買歷史 </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-dark" href="index.php" style="margin-left:500px;">首頁</a>
                </li>
            <?php } else { ?>
                <span class="navbar-text" style="margin-left:30px;">(管理請先登入)</span>
                <li class="nav-item">
                    <a class="nav-link" href="manager/login.php"> 管理登入 </a>
                </li>
                <span class="navbar-text" style="margin-left:60px;">(一般會員登入)</span>
                <li class="nav-item">
                    <a class="nav-link" href="client/login.php"> 會員登入 </a>
                </li>
            <?php } ?>

        </ul>
    </nav>
    <div class="container">
        <br><br>
        <div class="row">
            <?php foreach($result->fetchAll() as $row) { ?>
                <div class="col-1">
                    <input type="checkbox" name="" id="ckbx<?= $row["productId"] ?>">
                </div>
                <div class="col-2">
                    <img src="data:image/jpeg;base64,<?= $row["productPic"] ?>" style="width:50px; height:50px" alt="">
                </div>
                <div class="col-6">
                    <div class="row">產品名稱：<?= $row["productName"] ?></div>
                    <div class="row">
                        <label for="">數量</label>
                        <input type="number" name="quantityTF" min="0" max="<?= $row["productQuantity"] ?>" id="qty<?= $row["productId"] ?>" value="<?= $row["quantity"] ?>">
                    </div>
                </div>
            <?php } ?>

            
            

        </div>
    </div>
</body>

</html>