<?php
session_start();
$fp; $buf;
if(isset($_POST["submitbtn"])){
    if($_POST["ItemNameTF"]!=null && $_POST["Itemtextarea"]!=null){
        $ItemName = $_POST["ItemNameTF"];
        $Itemtext = $_POST["Itemtextarea"];
        $id = $_SESSION["accountIdManager"]; //echo $id."id";
    }

    
    $fp = fopen($_FILES['ImgFileInput']['tmp_name'],'rb');         //  讀寫打開一個二進制文件，允許讀寫數據，文件必須存在
    $buf = addslashes(fread($fp,$_FILES['ImgFileInput']['size']));      // addslashes在 " 前加 /    fread讀取文件
    fclose($fp);

    require("../config.php");

    $sql = <<<sqlCommand
        INSERT INTO product (managerId, productName, productText, productPic)
        VALUES (?,?,?,?)
    sqlCommand;
    $result = $link->prepare($sql);
    $result->execute(array($id, "$ItemName", "$Itemtext", "$buf"));

    echo "<script>alert('新增成功！')</script>";
    header("refresh:0.5;url='index.php'");
    exit();
}
if(isset($_POST["cancelbtn"])){
    header("Location: index.php");
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
    <script type="text/javascript" src="jquery.js"></script>
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
</head>
<body>
    <div class="container"> <br>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <form method="post" class="needs-validation"  enctype="multipart/form-data">
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
        document.getElementById('file_thumbnail').src = URL.createObjectURL(fileData);  // 將圖片產生出一個URL ->(縮圖)

      }, false);

    </script>

</body>
</html>