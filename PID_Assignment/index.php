<?php
session_start();
$userName = "";

if (isset($_SESSION["account"])) {
    $userName = $_SESSION["account"];
}
else if(isset($_SESSION["accountManager"])){
    $userName = $_SESSION["accountManager"];
}
// else{
//     $userName = "Guest";
// }


require("config.php");
$id = $_SESSION["accountId"];
$sql = <<<sqlCommand
    select * from product;
sqlCommand;
$result = $link->prepare($sql);
$result->execute();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="bootstrap-4.5.2-dist/css/bootstrap.css" rel="stylesheet">
</head>
<body>
    
<nav class="navbar navbar-expand-sm bg-light navbar-light">
    <ul class="navbar-nav">
        
        <?php if(isset($_SESSION["accountManager"])) { ?>
            <span class="navbar-text" style="margin-left:70px;">歡迎登入： <?= $userName ?></span>
            <li class="nav-item">
                <a class="nav-link" href="manager/login.php?logout=1"> 登出 </a>
            </li>

            <span class="navbar-text" style="margin-left:70px;">商品管理</span>
            <li class="nav-item">
            <a class="nav-link btn btn-outline-dark" href="manager/addItem.php"style="margin-left:30px;">新增商品</a>
            </li>
            <li class="nav-item">
            <a class="nav-link btn btn-outline-dark" href="manager/Item.php"style="margin-left:10px;">修改/刪除商品</a>
            </li>

            <span class="navbar-text" style="margin-left:70px;">會員管理</span>
            <li class="nav-item">
            <a class="nav-link btn btn-outline-dark" href="manager/order.php"style="margin-left:30px;">訂單管理</a>
            </li>
            <li class="nav-item">
            <a class="nav-link btn btn-outline-dark" href="manager/member.php"style="margin-left:10px;">會員列表</a>
            </li>
            <li class="nav-item">
            <a class="nav-link btn btn-outline-dark" href="index.php"style="margin-left:50px;">首頁</a>
            </li>

        <?php } else if(isset($_SESSION["account"])){ ?>
            <span class="navbar-text" style="margin-left:70px;">歡迎登入： <?= $userName ?></span>
            <li class="nav-item">
                <a class="nav-link" href="client/login.php?logout=1"> 登出 </a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-outline-dark" href="client/shoppingCar.php" style="margin-left:50px;"> 購物車 </a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-outline-dark" href="client/history.php" style="margin-left:50px;"> 購買歷史 </a>
            </li>
            <li class="nav-item">
            <a class="nav-link btn btn-outline-dark" href="index.php"style="margin-left:500px;">首頁</a>
            </li>
        <?php } else{ ?>
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

    <div class="container"><br>
        <!-- <div class="row">
            <div class="col-4">
            <img src="https://c.ecimg.tw/items/DBAA00A900536FU/000002_1596626402.jpg" style="width:150px" id="item1"><br>
            <label for="item1">QQQ</label>
            </div>
            <div class="col-4">546</div>
            <div class="col-4">21</div>
        </div> -->
        <!-- <?php if(isset($_SESSION["accountManager"])) { ?>
            歡迎登入： <?= $userName ?>
            <a href="index.php?logout=1" style="margin-left:70px">登出</a>
        <?php } else{ ?>
            請先登入
            <button type="submit" name="loginbtn" id="loginbtn" onclick="window.location='login.php'">登入</button>
        <?php } ?> -->


        <!-- <form action="" method="post"><br>
            <div class="col-12">
                <span>
                    <label for="">商品管理</label>
                    <button type="submit" name="addbtn" id="addbtn" class="btn btn-outline-dark">新增商品</button>
                    <button type="submit" name="updatebtn" id="updatebtn" class="btn btn-outline-dark">修改/刪除商品</button>
                </span>
                <span style="padding:50px">
                    <label for="">會員管理</label>
                    <button type="submit" name="orderbtn" id="orderbtn" class="btn btn-outline-dark">訂單管理</button>
                    <button type="submit" name="memberbtn" id="memberbtn" class="btn btn-outline-dark">會員列表</button>
                </span>
            </div>
            
        </form> -->

        <div class="row">
            <?php foreach($result->fetchAll() as $row) { ?>
                <?php //$pic = base64_encode($row["productPic"]); ?>
                <div class="col-3">
                <div class=row><img src="data:image/jpeg;base64, <?=$row["productPic"]?>" style="width:150px;height:150px" id="img"></td></div>
                <div class=row><a href="productDetail.php?id=<?= $row["productId"] ?>"><?= $row["productName"]; ?></a>
                    <?= "&nbsp; $ ".$row["productPrice"]; ?>
                </div>
            </div>    
            <?php } ?>       
        </div>
    </div>
</body>
</html>