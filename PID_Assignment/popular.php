<?php

session_start();
require("config.php");
require("getSql.php");
$result = getProduct($link,8,"desc");                      // 商品項目

if (isset($_SESSION["account"])) {
    $userName = $_SESSION["account"];
} else if (isset($_SESSION["accountManager"])) {
    $userName = $_SESSION["accountManager"];
}

$type = "熱門商品Top 8"; $top = "Top 1";
require_once("productView.php");

?>

