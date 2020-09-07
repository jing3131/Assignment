<?php

session_start();

if ($_GET["logout"]) {
    unset($_SESSION["account"]);
    unset($_SESSION["accountId"]);
}
if(isset($_SESSION["account"])){
    header("Location: memberIndex.php");
    exit();
}


require("view/indexView.php");
?>

