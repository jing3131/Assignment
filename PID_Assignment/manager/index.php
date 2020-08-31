<?php
session_start();
if(isset($_SESSION["accountManager"])){
    $userName = $_SESSION["accountManager"];
    if(isset($_POST["addbtn"])){
        header("Location: addItem.php");
        exit();
    }
    if(isset($_POST["updatebtn"])){
        header("Location: updateItem.php");
        exit();
    }
}
if($_GET["logout"]){
    unset($_SESSION["accountManager"]);
    unset($_SESSION["accountIdManager"]);
}

require("../config.php");
$id = $_SESSION["accountIdManager"];
$sql = <<<sqlCommand
    select * from product where managerId = ?;
sqlCommand;
$result = $link->prepare($sql);
$result->execute(array($id));


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../bootstrap-4.5.2-dist/css/bootstrap.css" rel="stylesheet">
</head>
<body>
    

    <div class="container">
        <!-- <div class="row">
            <div class="col-4">
            <img src="https://c.ecimg.tw/items/DBAA00A900536FU/000002_1596626402.jpg" style="width:150px" id="item1"><br>
            <label for="item1">QQQ</label>
            </div>
            <div class="col-4">546</div>
            <div class="col-4">21</div>
        </div> -->
        <?php if(isset($_SESSION["accountManager"])) { ?>
            歡迎登入： <?= $userName ?>
            <a href="index.php?logout=1" style="margin-left:70px">登出</a>
        <?php } else{ ?>
            請先登入
            <button type="submit" name="loginbtn" id="loginbtn" onclick="window.location='login.php'">登入</button>
        <?php } ?>


        <form action="" method="post">
            <button type="submit" name="addbtn" id="addbtn">新增商品</button>
            <button type="submit" name="updatebtn" id="updatebtn">修改/刪除商品</button>
        </form>
        <!-- <table width="300" cellpadding="50">
            <tr>
                <td > <img src="https://c.ecimg.tw/items/DBAA00A900536FU/000002_1596626402.jpg" style="width:150px"></td>   //style="padding:8px;"
                <td > <img src="https://c.ecimg.tw/items/DBAA00A900536FU/000002_1596626402.jpg" style="width:150px"></td>
                <td > <img src="https://c.ecimg.tw/items/DBAA00A900536FU/000002_1596626402.jpg" style="width:150px"></td>
            </tr>
            <tr>
                <td align="center"><a href="https://www.google.com"> QQQ</a></td>
                <td align="center">QQQ</td>
                <td align="center">QQQ</td>
            </tr>
            <tr>
                <td> <img src="https://c.ecimg.tw/items/DBAA00A900536FU/000002_1596626402.jpg" style="width:150px"></td>
                <td> <img src="https://c.ecimg.tw/items/DBAA00A900536FU/000002_1596626402.jpg" style="width:150px"></td>
                <td> <img src="https://c.ecimg.tw/items/DBAA00A900536FU/000002_1596626402.jpg" style="width:150px"></td>
            </tr>
            <tr>
                <td align="center">QQQ</td>
                <td align="center">QQQ</td>
                <td align="center">QQQ</td>
            </tr>
        </table> -->
        <table width="300" cellpadding="50">
            <tr>
                <td > 
                    <!-- <img src="" style="width:150px"> -->
                    <?php 
                        // list($a,$img) = $result->fetch(PDO::FETCH_NUM);
                        // header("Content-Type:image/jpeg");
                        // echo $image;
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                            echo $row["productName"];
                        }
                     ?>
                </td> 
            </tr>
            <tr>
                <td align="center"><a href="https://www.google.com"> QQQ</a></td>
            </tr>
        </table>
    </div>
</body>
</html>