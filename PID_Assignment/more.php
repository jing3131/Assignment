<?php
session_start();
require("config.php");
require("getSql.php");
$result = getAllProduct($link);                      // 商品項目

if (isset($_SESSION["account"])) {
    $userName = $_SESSION["account"];
} else if (isset($_SESSION["accountManager"])) {
    $userName = $_SESSION["accountManager"];
}

$type = "更多商品";
require_once("productView.php");

?>


