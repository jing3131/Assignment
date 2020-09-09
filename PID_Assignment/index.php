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

// $cnt = 0;       // 計數 商品列表
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="bootstrap-4.5.2-dist/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-4.5.2-dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .banner {
            background: #fff url('img/shopping.jpg');
            padding-top: 150px;
            padding-bottom: 150px;
            text-align: center;
            opacity: 0.7;
        }

        .bannerAvd {
            background-color: wheat;
            padding-top: 80px;
            padding-bottom: 10px;
            text-align: center;
            opacity: 0.7;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-xl bg-light navbar-light">

        <a class="navbar-brand" style="margin-left:70px;" href="index.php">MaMa購物網</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- <?php if (!isset($_SESSION["accountManager"])) { ?>
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



    <div class="container" style="background-color: #eaefe4;"><br>

        <div class="carousel slide" data-ride="carousel" id="carousel">
            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#carousel" data-slide-to="0" class="active"></li>
                <li data-target="#carousel" data-slide-to="1"></li>
                <li data-target="#carousel" data-slide-to="2"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="img-box p-1 border m-auto">
                        <img src="img/shopping.jpg" width="1100" height="300">
                        <h4 class="mt-4 mb-0"><strong class="text-success text-uppercase">歡迎光臨MaMa購物網好神</strong></h4>
                        <h6 class="text-dark m-0">MaMa的最愛?</h6>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="img-box p-1 border m-auto">
                        <img src="img/cartoon4.jpg" width="1100" height="300">
                        <h4 class="mt-4 mb-0"><strong class="text-success text-uppercase">滿額送好禮</strong></h4>
                        <br>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="img-box p-1 border m-auto">
                        <img src="img/cartoon5.jpg" width="1100" height="300">
                        <h5 class="mt-4 mb-0"><strong class="text-success text-uppercase">知名產品任你挑 :D</strong></h5>
                        <br>
                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#carousel" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#carousel" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>

        </div>

        <br>
        <h3>本季新商品</h3>
        <hr>


        <div class="row">
            <?php foreach ($result->fetchAll() as $row) { //$cnt++; 
            ?>
                <?php //if($cnt <= 12) { 
                ?>
                <div class="col-3">
                    <div class="row" style="margin-left: 50px;"><a href="productDetail.php?id=<?= $row["productId"] ?>"><img src="data:image/jpeg;base64, <?= $row["productPic"] ?>" style="width:170px;height:170px" id="img"></a></td>
                    </div>
                    <div class="row" style="margin-left: 50px;"><a href="productDetail.php?id=<?= $row["productId"] ?>"><?= $row["productName"]; ?></a>
                        <?= "&nbsp; $ " . $row["productPrice"]; ?>
                    </div>
                    <div class="row">&nbsp;</div>
                </div>
            <?php // }
            } ?>

            <a href="more.php" style="margin-left: 1020px;">查看更多>>></a>
        </div>

        <br>
        <div class="bannerAvd">
            <p><a href="">歡迎置入 (MaMa好神關心你 :D)</a></p>
        </div>
    </div>


    <!--Modal: modalAdvertisment-->
    <div class="modal fade right" id="modalAdvertisment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
        <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
            <!--Content-->
            <div class="modal-content">

                <!--Body-->
                <div class="modal-body">

                    <div class="row">

                        <div style="background-color: wheat; height:700px; width:500px">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> &times; </button>
                            夏日新品拍賣
                            <h3><strong>全館最低下殺三折</strong></h3>
                            <a href="productDetail.php?id=36"><img src="img/stair.jpg" style="width: 495px; height:650px" alt=""></a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--Modal: modalAdvertisment-->
    <script>
        $(function() {
            $("#modalAdvertisment").modal();
        })
    </script>
</body>

</html>