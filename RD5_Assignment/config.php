<?php

// $link=mysqli_connect("localhost","root","root","RD5_Assignment");        // RD5_Assignment
// $result = mysqli_query($link,"set names utf8");
try{
    $link = new PDO("mysql:host=localhost;dbname=RD5_Assignment","root","root");
    $link->exec("set CHARACTER SET utf8");
}
catch(PDOException $e){
    echo "Error: ".$e->getMessage();
    die();
}




?>