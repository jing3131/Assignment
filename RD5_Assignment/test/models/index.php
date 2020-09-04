<?php
session_start();

if($_GET["logout"]){
    unset($_SESSION["account"]);
    unset($_SESSION["accountId"]);
}

require("views/index.php");
?>

