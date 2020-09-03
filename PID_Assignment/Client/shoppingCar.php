<?php
session_start();
$userName = $_SESSION["account"];
$id = $_SESSION["accountId"];
$pdtId = [];

require("../config.php");
$sql = <<<sqlCommand
    SELECT sc.quantity, p.productName, p.productPic, p.productPrice, p.productId, p.productQuantity
    FROM shoppingCar AS sc
    JOIN product as p ON p.productId = sc.productId
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
    <nav class="navbar navbar-expand-sm bg-light navbar-light">
        <ul class="navbar-nav">

            <span class="navbar-brand" style="margin-left:70px;">MaMa購物網</span>
            <?php if (isset($_SESSION["account"])) { ?>
                <span class="navbar-text" style="margin-left:70px;">歡迎登入： <?= $userName ?></span>
                <li class="nav-item">
                    <a class="nav-link" href="login.php?logout=1"> 登出 </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-dark" href="shoppingCar.php" style="margin-left:50px;"> 購物車 </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-dark" href="history.php" style="margin-left:50px;"> 購買歷史 </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-dark" href="../index.php" style="margin-left:500px;">首頁</a>
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
        <!-- <div class="row"> -->
        <?php foreach ($result->fetchAll() as $row) { ?>
            <!-- <div class="col-1">
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
                </div> -->
            <?php //$pdtId[]= $row["productId"]; 
            ?>
            <table class="table-primary table-bordered" width="1000px">
                <tr>
                    <td Rowspan="3" Align="Center" width="150px"><input type="checkbox" name="ckbx" value="<?= $row["productId"] ?>"></td>
                    <td Rowspan="3" Align="Center" width="150px"><img src="data:image/jpeg;base64,<?= $row["productPic"] ?>" style="width:150px; height:150px" alt=""></td>
                    <td>產品名稱：<label for="" id="productNameL"><?= $row["productName"] ?></label></td>
                <tr>
                    <td><label for="">數量</label>
                        <input type="number" name="quantityTF" min="0" max="<?= $row["productQuantity"] ?>" id="qty<?= $row["productId"] ?>" value="<?= $row["quantity"] ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        $ <label for="" id="productPrice<?= $row["productId"] ?>"><?= $row["productPrice"] ?></label>
                    </td>
                </tr>
            </table>
        <?php } ?>
        <br>
        <!-- <div class="row"> -->
        <table class="table-active" style="width: 1000px;">
            <tr>
                <td><label for="">地址：</label></td>
                <td class="custom-control cusmtom-radio custom-control-inline"><input type="radio" name="deliveryTo" class="custom-control-inline" value="7-11" checked> 7-11</td>
                <td class="custom-control cusmtom-radio custom-control-inline"><input type="radio" name="deliveryTo" class="custom-control-inline" value="family"> 全家</td>
                <td class="custom-control cusmtom-radio custom-control-inline"><input type="radio" name="deliveryTo" class="custom-control-inline" value="home"> 住家</td>
                <td class="custom-control cusmtom-radio custom-control-inline"><input type="text" name="addressTF" id="addressTF" required></td>
            </tr>
            <tr>
                <td><label for="">付款方式：</label></td>
                <td class="custom-control cusmtom-radio custom-control-inline"><input type="radio" name="pay" class="custom-control-inline" value="cash" checked> 貨到付款</td>
                <td class="custom-control cusmtom-radio custom-control-inline"><input type="radio" name="pay" class="custom-control-inline" value="credit"> 信用卡</td>
                <td class="custom-control cusmtom-radio custom-control-inline"><input type="text" name="creditTF" id="creditTF" required></td>
            </tr>
        </table>
        <!-- </div> -->
        <form action="" method="post">
            <button type="submit" id="okbtn" name="okbtn" style="float:right" class="btn btn-outline-success">確認送出</button>
        </form>


        <!-- </div> -->
    </div>


    <script>
        $("#okbtn").on("click", function() {
            if ($("input:checkbox[name=ckbx]:checked").length == 0) { // 如果checkedbox被勾選的項目數 = 0
                alert("請勾選項目");
            } else {
                if ($("#addressTF").val() == "") {
                    alert("請填寫住址(店名)");
                } else if ($("input:radio[name=pay]:checked").val() == "credit" && $("#creditTF").val() == "") {
                    alert("請填寫信用卡卡號");
                } else {
                    // var ckLan = $("input:checkbox[name=ckbx]:checked").length;          // 被勾選的項目有幾筆
                    var ckLan = $("input:checkbox[name=ckbx]").length;
                    // alert(ckLan);
                    var ckbxId = document.getElementsByName('ckbx'); // 取得所有checkbox name='ckbx'
                    for (let i = 0; i < ckLan; i++) {
                        //alert(ckbxId[i].value);                                         // 找到每個checkbox的值(value) ->productId
                        var pdtId;
                        if (ckbxId[i].checked) { // 找到有被勾選的productId
                            pdtId = ckbxId[i].value;
                            // alert(pdtId);
                            $.ajax({
                                type: "post",
                                url: "../ajax.php",
                                dataType: "json",
                                data: {
                                    productId: pdtId,
                                    productQuantity: $("#qty"+pdtId).val(),                     // "#"+變數 可串接成變動id
                                    buyOrShopping: 1,
                                    deliveryTo: $("input:radio[name=deliveryTo]:checked").val(),
                                    address: $("#addressTF").val(),
                                    pay: $("input:radio[name=pay]:checked").val(),
                                    creditCardNum: $("#creditTF").val(),
                                    productPrice: $("#productPrice"+pdtId).text()
                                }
                            });
                            alert("購買成功"); 
                        }
                    }
                }
            }
        })
    </script>
</body>

</html>