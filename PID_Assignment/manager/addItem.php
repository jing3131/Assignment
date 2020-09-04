<?php
session_start();
$fp;
$buf;

if (isset($_POST["submitbtn"])) {
    $price = $_POST["priceTF"];
    $quantity = $_POST["quantityTF"];
    if (!is_numeric($price) || $price <= 0 || !is_numeric($quantity) || $quantity <= 0) {
        echo "<script>alert('請輸入正整數');</script>";
    } else if ($_POST["ItemNameTF"] != null && $_POST["Itemtextarea"] != null) {
        $ItemName = $_POST["ItemNameTF"];
        $Itemtext = $_POST["Itemtextarea"];
        $id = $_SESSION["accountIdManager"]; //echo $id."id";

        // $fp = fopen($_FILES['ImgFileInput']['tmp_name'],'rb');         //  讀寫打開一個二進制文件，允許讀寫數據，文件必須存在
        // $imgBlob = addslashes(fread($fp,$_FILES['ImgFileInput']['size']));      // addslashes在 " 前加 /    fread讀取文件        
        // fclose($fp);
        //$imgBlob =addslashes(file_get_contents($_FILES['ImgFileInput']['tmp_name']));
        $tmpName = $_FILES['ImgFileInput']['tmp_name'];
        $fp = fopen($tmpName, "r");
        $file_img = fread($fp, filesize(($tmpName)));
        $img64 = base64_encode($file_img);

        require("../config.php");

        $sql = <<<sqlCommand
            INSERT INTO product (managerId, productName, productText, productPic, productPrice, productQuantity)
            VALUES (?,?,?,?,?,?)
        sqlCommand;
        $result = $link->prepare($sql);
        $result->execute(array($id, "$ItemName", "$Itemtext", "$img64", $price, $quantity));
        fclose($fp);

        echo "<script>alert('新增成功！')</script>";
        header("refresh:0.5;url='../index.php'");
        exit();
    }
}
if (isset($_POST["cancelbtn"])) {
    header("Location: ../index.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../bootstrap-4.5.2-dist/css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="../jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- <style>
    .upload_cover {
        position: relative;
        width: 100px;
        height: 100px;
        text-align: center;
        cursor: pointer;
        background: #efefef;
        border: 1px solid #595656;
    }
    #upload_input {
        display: none;
    }
    .upload_icon {
        font-weight: bold;
        font-size: 180%;
        position: absolute;
        left: 0;
        width: 100%;
        top: 20%;
    }
    .delAvatar {
        position: absolute;
        right: 2px;
        top: 2px;
    }
    </style> -->
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <form method="post" class="needs-validation" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="ItemNameTF" class="col-4 col-form-label">商品名稱</label>
                <div class="col-6">
                    <input id="ItemNameTF" name="ItemNameTF" placeholder="請輸入商品名稱" type="text" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="Itemtextarea" class="col-4 col-form-label">商品描述</label>
                <div class="col-6">
                    <textarea id="Itemtextarea" name="Itemtextarea" cols="40" rows="5" class="form-control" required></textarea>
                </div>
            </div>


            <div class="form-group row">
                <div class="col-1"><label for="quantity">數量</label></div>
                <div class="offset-1 col-2">
                    <input type="number" name="quantityTF" min="0" value="0" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-1"><label for="price">金額</label></div>
                <div class="offset-1 col-2">
                    <input type="text" name="priceTF" value="0" required>
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
                <img src="" id="productPic" width="200px" height="200px">
            </div>

            <div class="form-group row">
                <div class="offset-4 col-4" style="margin-left:865px">
                    <button name="submitbtn" id="submitbtn" type="submit" class="btn btn-outline-primary">確定</button>
                </div>
                <!-- <button name="cancelbtn" id="cancelbtn" type="submit" class="btn btn-outline-warning">取消</button> -->
            </div>

        </form>
        <!-- <label class="upload_cover">
        <input id="upload_input" type="file" onchange="handleFiles(this.files)" accept="image/gif,image/jpeg,image/jpg,image/png,image/svg">
        <span class="upload_icon">➕</span>
        <i class="delAvatar fa fa-times-circle-o" title="刪除"></i>
        </label> -->

        <!-- <form action="" name="formx" method="post" enctype="multipart/form-data">
            <span>選擇檔案</span>
            <input type="file" name="userfile" onchange="handleFiles(this.files)" accept="image/gif,image/jpeg,image/jpg,image/png,image/svg">
            <div><p></p></div>
            <ul id="list">
            </ul>
        </form> -->





    </div>

    <script>
        //var inputFile = $("#ImgFileInput");
        var inputFile = document.getElementById('ImgFileInput');

        inputFile.addEventListener('change', function(e) {

            var fileData = e.target.files[0]; // 檔案資訊   一個Blob物件的陣列，裡面可以取得使用者所有想要上傳的檔案
            console.log(fileData); // 用開發人員工具可看到資料
            // document.getElementById('file_thumbnail').src = URL.createObjectURL(fileData);  // 將圖片產生出一個URL ->(縮圖)
            document.getElementById('productPic').src = URL.createObjectURL(fileData); // 將圖片產生出一個URL ->(縮圖)

        }, false);
    </script>

</body>

</html>