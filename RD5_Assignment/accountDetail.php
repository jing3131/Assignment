<?php

session_start();
require("config.php");
require("getSql.php");

$id = $_SESSION["accountId"];
$result = getDetail($link, $id);


require("view/accountDetailView.php");

?>

