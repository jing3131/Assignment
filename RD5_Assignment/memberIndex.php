<?php

session_start();
require("config.php");
require("getSql.php");
$userName = $_SESSION["account"];


$id = $_SESSION["accountId"];
$money = getBalance($link, $id);
$money = number_format($money);                     // number_format($money); 三位一撇


// $sql = <<< sqlCommand
//     SELECT money FROM memberBank WHERE accountId = $id;
// sqlCommand;
// $result = mysqli_query($link,$sql);
// $row["money"] = mysqli_fetch_assoc($result);


require("view/memberIndexView.php");


?>


