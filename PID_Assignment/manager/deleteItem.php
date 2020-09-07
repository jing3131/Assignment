<?php

if(!isset($_GET["id"])){
    die("id not found");
}

$id = $_GET["id"];
if(!is_numeric($id)){
    die("id not a number");
}


require("../config.php");
require("../getDeleteSql.php");

deleteProduct($link, $id);

deleteShoppingInProduct($link, $id);

echo "<script>alert('刪除成功')</script>";
header("refresh:0.5;url='item.php'");
exit();

?>