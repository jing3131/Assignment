<?php
session_start();
$userName = $_SESSION["accountManager"];
if (!isset($_GET["id"])) {
    die("id not found");
}
$id = $_GET["id"];
if (!is_numeric($id)) {
    die("id not a number");
}

require("../config.php");
require("../getUpdateAddSql.php");
require("../getSql.php");

$result = getProductInId($link, $id);
$row = $result->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["submitbtn"])) {
    $productQty = $_POST["quantityTF"];
    $productPrice = $_POST["priceTF"];
    if (!is_numeric($productPrice) || $productPrice <= 0 || !is_numeric($productQty) || $productQty < 0) {
        echo "<script>alert('請輸入正整數');</script>";
    } else {
        $productName = $_POST["ItemNameTF"]; 
        $productText = $_POST["Itemtextarea"]; 

        if ($_FILES['ImgFileInput']['tmp_name'] == null) {
            updateItem($link, $productName, $productText, $productQty, $productPrice, $id);             // 圖片沒有更新
        } else {
            $tmpName = $_FILES['ImgFileInput']['tmp_name'];
            $fp = fopen($tmpName, "r");
            $file_img = fread($fp, filesize(($tmpName)));
            $img64 = base64_encode($file_img);


            updateIncludePic($link, $productName, $productText, $img64, $productQty, $productPrice, $id);   // 圖片有更新
        }


        echo "<script>alert('更新成功');</script>";
        header("refresh:0.5;url='item.php'");
        exit();
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../bootstrap-4.5.2-dist/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/input.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <nav class="navbar navbar-expand-xl bg-light navbar-light">

        <a class="navbar-brand" style="margin-left:70px;" href="../index.php">MaMa購物網</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">

                <?php if (isset($_SESSION["accountManager"])) { ?>
                    <span class="navbar-text" style="margin-left:50px;">歡迎登入： <?= $_SESSION["accountManager"] ?></span>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php?logout=1" style="margin-left:50px;"> 登出 </a>
                    </li>

                    <span class="navbar-text" style="margin-left:70px;">商品管理</span>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="addItem.php" style="margin-left:10px;">新增商品</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="Item.php" style="margin-left:10px;">修改/刪除商品</a>
                    </li>

                    <span class="navbar-text" style="margin-left:70px;">會員管理</span>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="order.php" style="margin-left:10px;">訂單管理</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="member.php" style="margin-left:10px;">會員列表</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="../index.php" style="margin-left:10px;">首頁</a>
                    </li> -->

                <?php } else { ?>
                    <span class="navbar-text">請先登入</span>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"> 登入 </a>
                    </li>
                <?php } ?>

            </ul>
        </div>

    </nav>

    <div class="container"> <br>
        <form method="post" class="needs-validation" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="ItemNameTF" class="col-4 col-form-label">商品名稱</label>
                <div class="col-6">
                    <input id="ItemNameTF" name="ItemNameTF" placeholder="請輸入商品名稱" type="text" class="form-control" value="<?= $row["productName"] ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="Itemtextarea" class="col-4 col-form-label">商品描述</label>
                <div class="col-6">
                    <textarea id="Itemtextarea" name="Itemtextarea" cols="40" rows="5" class="form-control" required> <?= $row["productText"] ?> </textarea>
                </div>
            </div>


            <div class="form-group row">
                <div class="col-1"><label for="quantity">數量</label></div>
                <div class="offset-1 col-2">
                    <input type="number" name="quantityTF" min="0" oninput="if(value<0) value=0;" value="<?= $row["productQuantity"] ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-1"><label for="price">金額</label></div>
                <div class="offset-1 col-2">
                    <input type="text" name="priceTF" value="<?= $row["productPrice"] ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <section class="button-box">
                    <input id="ImgFileInput" name="ImgFileInput" type="file" accept="image/*" class="btn btn-outline-light">
                    <!-- <label for="customFileInput" class="button-primary">
                <img class="icon" src="../add.jpg" alt="上傳檔案" width="50px">
                <span>選擇檔案按鈕</span>
                </label> -->
                </section>
                <figure>
                    <img id="file_thumbnail">
                </figure>
            </div>

            <div class="form-group row">
                <img src="data:image/jpeg;base64, <?= $row["productPic"] ?>" width="200px" height="200px" id="productPic">
            </div>

            <div class="form-group row">
                <div class="offset-4 col-4" style="margin-left:865px">
                    <button name="submitbtn" id="submitbtn" type="submit" class="btn btn-outline-primary">確定</button>
                </div>
                <!-- <button name="cancelbtn" id="cancelbtn" type="submit" class="btn btn-outline-warning">取消</button> -->
            </div>

        </form>
    </div>

    <script>
        var inputFile = document.getElementById('ImgFileInput');
        inputFile.addEventListener('change', function(e) {
            var fileData = e.target.files[0];
            console.log(fileData);
            // document.getElementById('file_thumbnail').src = URL.createObjectURL(fileData);
            document.getElementById('productPic').src = URL.createObjectURL(fileData);
        }, false);
    </script>
</body>

</html>