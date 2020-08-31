<?php 
if(isset($_POST["submit"])){
    $fp = fopen($_FILES['myFile']['tmp_name'],'rb'); 
    $buf = addslashes(fread($fp,$_FILES['myFile']['size'])); 
    //print_r($buf);
    $link = mysqli_connect("localhost","root","root","PID_Assignment");
    $result = mysqli_query($link,"set names utf8");
    $sql =<<<CC
        insert into test (img) values ("$buf")
    CC;
    mysqli_query($link,$sql);
}

if(isset($_POST["pic"])){
    $link = mysqli_connect("localhost","root","root","PID_Assignment");
    $result = mysqli_query($link,"set names utf8");
    $sql ="select * from test";
    $result = mysqli_query($link,$sql);
    $row=mysqli_fetch_object($result);
    Header("Content-type:image/jpeg");
    echo$row->Image;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data" name="mainForm" id="mainForm"> 
<input type="file" name="myFile" /> 
<input type="submit" name="submit" value="Submit"/> 
<input type="submit" name="pic" value="Submit0"/> 
</form>
</body>
</html>