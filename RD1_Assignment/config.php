<?php

$link = @mysqli_connect('localhost','root','root','RD1_Assignment') or die(mysqli_connect_error());     // RD1_Assignment
$result = mysqli_query($link,"set names utf8");

?>