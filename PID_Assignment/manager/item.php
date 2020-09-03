<?php

session_start();
require("../config.php");
$id = $_SESSION["accountIdManager"];
$sql = "select * from product where managerId = ?";
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
<nav class="navbar navbar-expand-sm bg-light navbar-light">
    <ul class="navbar-nav">
        <span class="navbar-brand" style="margin-left:70px;">MaMa購物網</span>
        <?php if(isset($_SESSION["accountManager"])) { ?>
            <span class="navbar-text" style="margin-left:70px;">歡迎登入： <?= $_SESSION["accountManager"] ?></span>
            <li class="nav-item">
                <a class="nav-link" href="login.php?logout=1"> 登出 </a>
            </li>

            <span class="navbar-text" style="margin-left:70px;">商品管理</span>
            <li class="nav-item">
            <a class="nav-link btn btn-outline-dark" href="addItem.php"style="margin-left:30px;">新增商品</a>
            </li>
            <li class="nav-item">
            <a class="nav-link btn btn-outline-dark" href="Item.php"style="margin-left:10px;">修改/刪除商品</a>
            </li>

            <span class="navbar-text" style="margin-left:70px;">會員管理</span>
            <li class="nav-item">
            <a class="nav-link btn btn-outline-dark" href="order.php"style="margin-left:30px;">訂單管理</a>
            </li>
            <li class="nav-item">
            <a class="nav-link btn btn-outline-dark" href="member.php"style="margin-left:10px;">會員列表</a>
            </li>
            <li class="nav-item">
            <a class="nav-link btn btn-outline-dark" href="../index.php"style="margin-left:50px;">首頁</a>
            </li>

        <?php } else{ ?>
            <span class="navbar-text" >請先登入</span>
            <li class="nav-item">
                <a class="nav-link" href="login.php"> 登入 </a>
            </li>
        <?php } ?>
        
    </ul>
</nav>
    <div class="container">
        <br>
        <div class="row">
            <!-- <div class="col-2">
                <label for="">會員管理</label>
                <button type="button" class="btn btn-outline-dark" onclick="window.location='order.php'">訂單管理</button>
                <button type="button" class="btn btn-outline-dark" onclick="window.location='member.php'">會員列表</button>
                <label for="">商品管理</label>
                <button type="button" class="btn btn-outline-dark" onclick="window.location='addItem.php'">新增商品</button>
            </div> -->
            <br>
            <div class="col-10">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>產品名稱</th>
                            <th>產品描述</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td><?= $row["productName"] ?></td>
                                <td><?= $row["productText"] ?></td>
                                <td>
                                    <span class="float-right">
                                        <a href="updateItem.php?id=<?= $row["productId"] ?>" class="btn btn-outline-primary">修改</a>
                                        <a href="DeleteItem.php?id=<?= $row["productId"] ?>" class="btn btn-outline-warning">刪除</a>
                                    </span>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>


    </div>

</body>

</html>