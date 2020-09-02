<?php
session_start();
require("../config.php");
$sql= <<<sqlCommand
    SELECT * FROM account
sqlCommand;
$result = $link->prepare($sql);
$result->execute();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap-4.5.2-dist/css/bootstrap.css">
</head>

<body>
<nav class="navbar navbar-expand-sm bg-light navbar-light">
    <ul class="navbar-nav">
        
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
                <label for="">商品管理</label>
                <button type="button" class="btn btn-outline-dark" onclick="window.location='addItem.php'">新增商品</button>
                <button type="button" class="btn btn-outline-dark" onclick="window.location='Item.php'">修改/刪除商品</button>
            </div> -->
            <div class="col-9">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>名稱</th>
                            <th>用戶名</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td><?= $row["name"] ?></td>
                                <td><?= $row["account"] ?></td>
                                <td>
                                    <span class="float-right">
                                        <?php if($row["canUse"] == "Y") { ?>
                                            <a href="banAccount.php?id=<?= $row["accountId"] ?>&canUse=1 " class="btn btn-outline-danger">停用會員</a>
                                        <?php } else { ?>
                                            <a href="banAccount.php?id=<?= $row["accountId"] ?>&canUse=0" class="btn btn-outline-success">啟用會員</a>
                                        <?php } ?>
                                        
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