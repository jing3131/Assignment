<?php
session_start();
$userName = "";

if (isset($_SESSION["account"])) {
    $userName = $_SESSION["account"];
} else if (isset($_SESSION["accountManager"])) {
    $userName = $_SESSION["accountManager"];
}


require("config.php");
require("getSql.php");
$id = $_SESSION["accountId"];

$result = getProduct($link);                      // 商品項目

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="bootstrap-4.5.2-dist/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .banner{
            background: #fff url('shopping.jpg');
            padding-top: 150px;
            padding-bottom: 150px;
            text-align: center;
            opacity:0.7;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-xl bg-light navbar-light">

        <a class="navbar-brand" style="margin-left:70px;" href="index.php">MaMa購物網</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- <?php if(!isset($_SESSION["accountManager"])){ ?>
            <input class="mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-success" type="submit">Search</button>
        <?php } ?> -->
        
        <div class="collapse navbar-collapse" id="collapsibleNavbar">                    

            <ul class="navbar-nav">

                <?php if (isset($_SESSION["accountManager"])) { ?>
                    <span class="navbar-text" style="margin-left:50px;">歡迎登入： <?= $userName ?></span>
                    <li class="nav-item">
                        <a class="nav-link" href="manager/login.php?logout=1" style="margin-left:50px;"> 登出 </a>
                    </li>

                    <span class="navbar-text" style="margin-left:70px;">商品管理</span>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="manager/addItem.php" style="margin-left:10px;">新增商品</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="manager/Item.php" style="margin-left:10px;">修改/刪除商品</a>
                    </li>

                    <span class="navbar-text" style="margin-left:70px;">會員管理</span>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="manager/order.php" style="margin-left:10px;">訂單管理</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="manager/member.php" style="margin-left:10px;">會員列表</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="index.php" style="margin-left:10px;">首頁</a>
                    </li> -->

                <?php } else if (isset($_SESSION["account"])) { ?>
                    <span class="navbar-text" style="margin-left:50px;">歡迎登入： <?= $userName ?></span>
                    <li class="nav-item">
                        <a class="nav-link" href="client/login.php?logout=1" style="margin-left:50px;"> 登出 </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="client/shoppingCar.php" style="margin-left:50px;"> 購物車 </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="client/history.php" style="margin-left:50px;"> 購買歷史 </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="index.php" style="margin-left:50px;">首頁</a>
                    </li> -->
                <?php } else { ?>
                    <span class="navbar-text" style="margin-left:30px;">(管理請先登入)</span>
                    <li class="nav-item">
                        <a class="nav-link" href="manager/login.php"> 管理登入 </a>
                    </li>
                    <span class="navbar-text" style="margin-left:30px;">(一般會員登入)</span>
                    <li class="nav-item">
                        <a class="nav-link" href="client/login.php"> 會員登入 </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="client/signup.php"> 會員註冊 </a>
                    </li>
                <?php } ?>

            </ul>
        </div>

    </nav>

    <div class="banner">
        <h1 style="color:white">歡迎光臨MaMa購物網好神</h1>
        <p>MaMa的最愛?</p>
    </div>

    <div class="container"><br>

        <h3>本季主打商品</h3><hr>


        <div class="row">
            <?php foreach ($result->fetchAll() as $row) { ?>
                <?php
                ?>
                <div class="col-3">
                    <div class=row><a href="productDetail.php?id=<?= $row["productId"] ?>"><img src="data:image/jpeg;base64, <?= $row["productPic"] ?>" style="width:150px;height:150px" id="img"></a></td>
                    </div>
                    <div class=row><a href="productDetail.php?id=<?= $row["productId"] ?>"><?= $row["productName"]; ?></a>
                        <?= "&nbsp; $ " . $row["productPrice"]; ?>
                    </div>
                    <div class="row">&nbsp;</div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>