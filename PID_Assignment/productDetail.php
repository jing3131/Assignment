<?php
session_start();

if (!isset($_GET["id"])) {
    die("not found id");
}

$id = $_GET["id"];
if (!is_numeric($id)) {
    die("id si not a number");
}

$sql = <<<sqlCommand
    select * from product
    where productId = ?;
sqlCommand;

require("config.php");
$result = $link->prepare($sql);
$result->execute(array($id));

// if (isset($_POST["buybtn"])) {
//     // 彈出對話盒購買數量(bootstrap)
// }
// if (isset($_POST["shoppingCarbtn"])) {
//     // 彈出對話盒購買數量(bootstrap)
// }


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="bootstrap-4.5.2-dist/css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="jquery.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-light navbar-light">
        <ul class="navbar-nav">

            <?php if (isset($_SESSION["accountManager"])) { ?>
                <span class="navbar-text" style="margin-left:70px;">歡迎登入： <?= $_SESSION["accountManager"] ?></span>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?logout=1"> 登出 </a>
                </li>            

            <?php } else { ?>
                <span class="navbar-text">請先登入</span>
                <li class="nav-item">
                    <a class="nav-link" href="login.php"> 登入 </a>
                </li>
            <?php } ?>

        </ul>
    </nav>

    <div class="container">
        <br><br>
        <div class="row">
                <?php foreach ($result->fetchAll() as $row) { ?>
                    <?php $pic = base64_encode($row["productPic"]); ?>
                    <div class="col-7">
                        <!-- <img src="data:image/jpeg;base64, <?= $pic ?>" style="width:500px" id="img"> -->
                        <img src="add.jpg" style="width:450px">
                    </div>
                    <div class="col-5">
                        <div class="row" style="margin-bottom: 30px;">
                            <?= "商品名稱：" . $row["productName"]; ?>
                        </div>
                        <div class="row" style="margin-bottom: 30px;">
                            <?= $row["productText"]; ?>
                        </div>
                        <div class="row" style="margin-bottom: 30px;">
                            <?= "價格：" . $row["productPrice"] . "$ NTD"; ?>
                        </div>
                        <div class="row" style="margin-bottom: 30px;">
                            <?= "剩餘數量：" . $row["productQuantity"]; ?>
                        </div>

                        <div class="row" style="margin-bottom: 30px;">
                            <button name="buybtn" id="buybtn" type="button" class="btn btn-outline-success">直接購買</button>
                            <button name="shoppingCarbtn" id="shoppingCarbtn" type="submit" class="btn btn-outline-primary" style="margin-left:20px;">購物車</button>
                        </div>

                    </div>
                <?php } ?>




            </div>
    </div>

    <script>
        $(function(){
            $('#buybtn').on("click",function(){
                // 彈出對話盒
                alert("click");     // productDetail路徑要改
            });
            $('#buybtn').on("click",function(){
                // 彈出對話盒
                alert("click");
            });
        });
        
    </script>
</body>

</html>