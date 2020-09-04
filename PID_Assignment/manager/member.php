<?php
session_start();
require("../config.php");
$sql = <<<sqlCommand
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-xl bg-light navbar-light">
        <a class="navbar-brand" style="margin-left:70px;" href="../index.php">MaMa購物網</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">

                <?php if (isset($_SESSION["accountManager"])) { ?>
                    <span class="navbar-text" style="margin-left:50px;">歡迎登入： <?= $_SESSION["accountManager"] ?></span>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php?logout=1" style="margin-left:50px;"> 登出 </a>
                    </li>

                    <span class="navbar-text" style="margin-left:70px;">商品管理</span>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="addItem.php" style="margin-left:10px;">新增商品</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="Item.php" style="margin-left:10px;">修改/刪除商品</a>
                    </li>

                    <span class="navbar-text" style="margin-left:70px;">會員管理</span>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="order.php" style="margin-left:10px;">訂單管理</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="member.php" style="margin-left:10px;">會員列表</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="../index.php" style="margin-left:10px;">首頁</a>
                    </li> -->

                <?php } else { ?>
                    <span class="navbar-text">請先登入</span>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"> 登入 </a>
                    </li>
                <?php } ?>

            </ul>
        </div>

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
            <div class="col-11">
                <table class="table table-hover">
                    <thead class="table-active">
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
                                        <?php if ($row["canUse"] == "Y") { ?>
                                            <a href="banAccount.php?id=<?= $row["accountId"] ?>&canUse=1 " class="btn btn-outline-danger">停用會員</a>
                                        <?php } else { ?>
                                            <a href="banAccount.php?id=<?= $row["accountId"] ?>&canUse=0" class="btn btn-outline-success">啟用會員</a>
                                        <?php } ?>
                                        <a href="order.php?id=<?= $row["accountId"] ?>" class="btn btn-outline-dark">訂單明細</a>
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