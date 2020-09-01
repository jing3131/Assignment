<?php

if(!isset($_GET["id"])){
    die("id not found");
}
$id = $_GET["id"];
if(!is_numeric($id)){
    die("id not a number");
}

require("../config.php");

$sql = <<<sqlCommand
    select * from product
    where productId = ?
sqlCommand;
$result = $link->prepare($sql);
$result->execute(array($id));
$row = $result->fetch(PDO::FETCH_ASSOC);

if(isset($_POST["submitbtn"])){
    $productName = $_POST["ItemNameTF"];    // echo $productName."name"; 
    $productText = $_POST["Itemtextarea"];  // echo $productText."text";
    $fp = fopen($_FILES['ImgFileInput']['tmp_name'],"rb");
    $pic = addslashes(fread($fp,$_FILES['ImgFileInput']['size']));
    fclose($fp);
    $sql = <<<sqlCommand
        UPDATE product SET productName = ?, productText = ?, productPic= ?
        WHERE productId = ?
    sqlCommand;
    $result = $link->prepare($sql);
    $result->execute(array("$productName", "$productText", "$pic", $id));

    echo "<script>alert('更新成功');</script>";
    header("refresh:0.5;url='index.php'");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../bootstrap-4.5.2-dist/css/bootstrap.css" rel="stylesheet" >
</head>

<body>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <div class="container"> <br>
    <form method="post" class="needs-validation"  enctype="multipart/form-data">
        <div class="form-group row">
            <label for="ItemNameTF" class="col-4 col-form-label">商品名稱</label> 
            <div class="col-6">
            <input id="ItemNameTF" name="ItemNameTF" placeholder="請輸入商品名稱" type="text" class="form-control" value="<?= $row["productName"] ?>" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="Itemtextarea" class="col-4 col-form-label">商品描述</label> 
            <div class="col-6">
                <textarea id="Itemtextarea" name="Itemtextarea" cols="40" rows="5" class="form-control" required> <?= $row["productText"]?> </textarea>
            </div>
        </div> 


        <div class="form-group row">
            <div class="col-1"><label for="quantity">數量</label></div>
            <div class="offset-1 col-2">
                <input type="number" name="quantityTF" min="0" max="100" value="<?= $row["productQuantity"] ?>" required>
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
            <div class="offset-4 col-4" style="margin-left:865px">
            <button name="submitbtn" id="submitbtn" type="submit" class="btn btn-outline-primary">確定</button>
            </div>
            <!-- <button name="cancelbtn" id="cancelbtn" type="submit" class="btn btn-outline-warning">取消</button> -->
        </div>

    </form>
    </div>

    <script>
        var inputFile = document.getElementById('ImgFileInput');
        inputFile.addEventListener('change',function(e){
            var fileData = e.target.files[0];
            console.log(fileData);
            document.getElementById('file_thumbnail').src = URL.createObjectURL(fileData);
        },false);
    </script>
</body>

</html>