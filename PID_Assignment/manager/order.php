<?php

session_start();
require("../config.php");
$idManager = $_SESSION["accountIdManager"];



if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = <<<sqlCommand
        SELECT p.productName, quantity, deliveryTo, od.address, pay, od.creditCard, a.account, od.totalAmount FROM product as p
        JOIN orderDetail as od ON p.productId = od.productId
        JOIN account as a ON a.accountId = od.accountId
        WHERE managerId = ? AND od.accountId = ?
        ORDER BY od.accountId
    sqlCommand;
    $result = $link->prepare($sql);
    $result->execute(array($idManager, $id));
} else {
    $sql = <<<sqlCommand
        SELECT p.productName, quantity, deliveryTo, od.address, pay, od.creditCard, a.account, od.totalAmount FROM product as p
        JOIN orderDetail as od ON p.productId = od.productId
        JOIN account as a ON a.accountId = od.accountId
        WHERE managerId = ?
        ORDER BY od.accountId
    sqlCommand;
    $result = $link->prepare($sql);
    $result->execute(array($idManager));
}


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
        <table class="table table-hover table-active">
            <thead class="table-primary">
                <th>用戶名稱</th>
                <th>商品名稱</th>
                <th>數量</th>
                <th>總金額</th>
                <th>寄送地址</th>
                <th>付款方式</th>
                <!-- <th>&nbsp;</th> -->
            </thead>
            <tbody>
                <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?= $row["account"] ?></td>
                        <td><?= $row["productName"] ?></td>
                        <td><?= $row["quantity"] ?></td>
                        <td>$ <?= number_format($row["totalAmount"]) ?></td>
                        <td><?= $row["deliveryTo"] . "(" . $row["address"] . ")" ?></td>
                        <td><?= $row["pay"] ?></td>
                        <!-- <td><button type="button">刪除訂單</button></td> -->
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>