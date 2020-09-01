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
    DELETE FROM product WHERE productId = ?
sqlCommand;

$result = $link->prepare($sql);
$result->execute(array($id));

echo "<script>alert('刪除成功')</script>";
header("refresh:0.5;url='item.php'");
exit();

?>