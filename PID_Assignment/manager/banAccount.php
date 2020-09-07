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
    require("../getAccountSql.php");
    $canUse = $_GET["canUse"];
    $type;
    if($canUse == 1){
        $type = "N";
    }
    else{
        $type = "Y";
    }
    
    banAccount($link, $type, $id);                                // 停用/啟用會員

    echo "<script>alert('修改成功')</script>";
    header("refresh:0.5;url='member.php'");
    exit();
}

?>