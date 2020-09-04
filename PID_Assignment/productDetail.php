<?php
session_start();
$productName;
$productText;
$productPrice;
$productQuantity;
$userName;

if (isset($_SESSION["account"])) {
    $userName = $_SESSION["account"];
} else if (isset($_SESSION["accountManager"])) {
    $userName = $_SESSION["accountManager"];
}

if (!isset($_GET["id"])) {
    die("not found id");
}

$id = $_GET["id"];
$_SESSION["productId"] = $id;           // 紀錄產品編號
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        input[type=number] {
            height: 30px;
            line-height: 30px;
            font-size: 16px;
            padding: 0 8px;
        }

        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            cursor: pointer;
            display: block;
            width: 8px;
            color: #333;
            text-align: center;
            position: relative;
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

    <nav class="navbar navbar-expand-xl bg-light navbar-light">

        <a class="navbar-brand" style="margin-left:70px;" href="index.php">MaMa購物網</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
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
                        <a class="nav-link btn btn-outline-dark" href="index.php" style="margin-left:50px;">首頁</a>
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
                    <span class="navbar-text" style="margin-left:60px;">(一般會員登入)</span>
                    <li class="nav-item">
                        <a class="nav-link" href="client/login.php"> 會員登入 </a>
                    </li>
                <?php } ?>

            </ul>
        </div>

    </nav>

    <div class="container">
        <br><br>
        <div class="row">
            <?php foreach ($result->fetchAll() as $row) { ?>
                <?php // $pic = base64_encode($row["productPic"]);
                $productName = $row["productName"];
                $productText = $row["productText"];
                $productPrice = $row["productPrice"];
                $productQuantity = $row["productQuantity"];
                ?>
                <div class="col-7">
                    <img src="data:image/jpeg;base64, <?= $row["productPic"] ?>" style="width:450px" id="img">
                    <!-- <img src="add.jpg" style="width:450px"> -->
                </div>
                <div class="col-5">
                    <div class="row" style="margin-bottom: 30px;">
                        <?= "商品名稱：" . $productName; ?>
                    </div>
                    <div class="row" style="margin-bottom: 30px;">
                        <?= $productText; ?>
                    </div>
                    <div class="row" style="margin-bottom: 30px;">
                        價格：<label for="" id="price"><?= $productPrice; ?> </label>$ NTD
                    </div>
                    <div class="row" style="margin-bottom: 30px;">
                        <?= "剩餘數量：" . $productQuantity; ?>
                    </div>

                    <?php if (isset($_SESSION["account"])) { ?>
                        <div class="row" style="margin-bottom: 30px;">
                            <button name="buybtn" id="buybtn" type="button" class="btn btn-outline-success">直接購買</button> <!-- data-toggle="modal" data-target="#buyModal" -->
                            <button name="shoppingCarbtn" id="shoppingCarbtn" type="button" class="btn btn-outline-primary" style="margin-left:20px;">購物車</button>
                        </div>
                    <?php } ?>

                </div>
            <?php } ?>


            <!--購買/購物車對話盒-->
            <div class="modal" id="buyModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">購買/購物車</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            產品名稱： <label for="" id="productNameL"><?= $productName; ?></label> <br>
                            數量： <input type="number" name="quantityTF" id="quantityTF" min="0" max="<?= $productQuantity ?>" value="1" required> <br>
                            <!-- 價格： <?= $productPrice; ?> -->
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" id="okbtn" class="btn btn-outline-danger" data-dismiss="modal">確認</button>
                        </div>

                    </div>
                </div>
            </div>
            <!--購買/購物車對話盒結束-->

            <!-- 交易對話盒 -->
            <form action="" class="needs-validation">
                <div class="modal" id="transactionModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">地址與付款方式</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <label for="">地址：</label>

                                <label for="address">7-11</label>
                                <input type="radio" name="deliveryTo" id="address711" value="7-11" checked>
                                <label for="address">全家</label>
                                <input type="radio" name="deliveryTo" id="addressFM" value="family">
                                <label for="address">住家</label>
                                <input type="radio" name="deliveryTo" id="addressHome" value="home">
                                <input type="text" name="addressTF" id="addressTF" required>
                                <br>

                                <label for="">付款方式：</label>
                                <label for="pay">貨到付款</label>
                                <input type="radio" name="pay" id="payCash" value="cash">
                                <label for="pay">信用卡</label>
                                <input type="radio" name="pay" id="payCrdt" value="credit" checked>
                                <input type="text" name="creditTF" id="creditTF" required>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" id="payOkbtn" class="btn btn-outline-danger" onclick="window.location='index.php'">確認</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
            <!--交易對話盒結束-->

        </div>
    </div>

    <script>
        var buy;
        $(function() {
            $('#buybtn').on("click", function() { // productDetail路徑要改
                // 彈出對話盒
                buy = 1; // buy = 1 表示直接購買
                $("#buyModal").modal();
            });

            $('#shoppingCarbtn').on("click", function() {
                buy = 0; // buy = 0 表示放購物車
                // 彈出對話盒
                $("#buyModal").modal();
            });

            $("#okbtn").on("click", function() {
                // alert($("#quantityTF").val());
                if (buy == 0) {
                    alert("已加入購物車");
                    $.ajax({
                        type: "post",
                        url: "ajax.php",
                        dataType: "json",
                        data: {
                            productName: $("#productNameL").text(),
                            productQuantity: $("#quantityTF").val(),
                            buyOrShopping: buy,
                            // credit: null,
                            // address: null
                        }
                    });
                    $("#buyModal").modal("hide");
                } else { // 直接購買
                    // 再彈一個視窗
                    $("#transactionModal").modal({
                        backdrop: "static"
                    });
                }

                $("#payOkbtn").on("click", function() { // 購買確認
                    if ($("#addressTF").val() == "") {
                        alert("地址(店名)不能為空");
                    } else {
                        if ($("input:radio[name=pay]:checked").val() == "credit" && $("#creditTF").val() == "") {
                            alert("請輸入信用卡卡號");
                        } else {
                            $.ajax({
                                type: "post",
                                url: "ajax.php",
                                dataType: "json",
                                data: {
                                    //productName: $("#productNameL").text(),
                                    productQuantity: $("#quantityTF").val(),
                                    buyOrShopping: buy,
                                    deliveryTo: $("input:radio[name=deliveryTo]:checked").val(),
                                    address: $("#addressTF").val(),
                                    pay: $("input:radio[name=pay]:checked").val(),
                                    creditCardNum: $("#creditTF").val(),
                                    productPrice: $("#price").text()
                                }
                            });
                            alert("購買成功");
                            $("#transactionModal").modal("hide");
                        }
                    }

                });


            });
        });
    </script>
</body>

</html>