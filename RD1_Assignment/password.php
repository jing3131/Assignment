<?php

$password = $_POST["passwordTF"];
$id = $_SESSION["accountId"];

$sql=<<< sqlCommand
    select password from member
    where accountId = $id;
sqlCommand;
$result = mysqli_query($link,$sql);
$row["password"] = mysqli_fetch_assoc($result);
$pwd = implode("",$row["password"]);



?>