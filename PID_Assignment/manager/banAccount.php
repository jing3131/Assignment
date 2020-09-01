<?php

if(!isset($_GET["id"])){
    die("not found id");
}
$id = $_GET["id"];
if(!is_numeric($id)){
    die("id is not a number");
}

else{

    if(!isset($_GET["canUse"])){
        die("not found canUse");
    }
    if(!is_numeric($_GET["canUse"])){
        die("canUse is not a number");
    }

    require("../config.php");
    $canUse = $_GET["canUse"];
    if($canUse == 1){
        $sql = <<<sqlCommand
            UPDATE account SET canUse = 'N' WHERE accountId = ?
        sqlCommand;
    }
    else{
        $sql = <<<sqlCommand
            UPDATE account SET canUse = 'Y' WHERE accountId = ?
        sqlCommand;
    }
    
    $result = $link->prepare($sql);
    $result->execute(array($id));

    echo "<script>alert('修改成功')</script>";
    header("refresh:0.5;url='member.php'");
    exit();
}

?>