<?php

session_start();
if (isset($_SESSION["account"])) {
    $userName = $_SESSION["account"];
    $id = $_SESSION["accountId"];
}

require("../config.php");
$sql = <<<sqlCommand
    SELECT * FROM orderDetail WHERE accountId = ?
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
    <link rel="stylesheet" href="../bootstrap-4.5.2-dist/css/bootstrap.css">
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-light navbar-light">
        <ul class="navbar-nav">

            <span class="navbar-brand" style="margin-left:70px;">MaMa購物網</span>
            <?php if (isset($_SESSION["account"])) { ?>
                <span class="navbar-text" style="margin-left:70px;">歡迎登入： <?= $userName ?></span>
                <li class="nav-item">
                    <a class="nav-link" href="login.php?logout=1"> 登出 </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-dark" href="shoppingCar.php" style="margin-left:50px;"> 購物車 </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-dark" href="history.php" style="margin-left:50px;"> 購買歷史 </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-dark" href="../index.php" style="margin-left:500px;">首頁</a>
                </li>
            <?php } else { ?>
                <span class="navbar-text" style="margin-left:30px;">(管理請先登入)</span>
                <li class="nav-item">
                    <a class="nav-link" href="manager/login.php"> 管理登入 </a>
                </li>
                <span class="navbar-text" style="margin-left:60px;">(一般會員登入)</span>
                <li class="nav-item">
                    <a class="nav-link" href="client/login.php"> 會員登入 </a>
                </li>
            <?php } ?>

        </ul>
    </nav>

    <br>
    <div class="container">
        <table class="table table-hover table-active">
            <thead class="table-primary">
                <th>購買產品</th>
                <th>數量</th>
                <th>地址</th>
                <th>付款方式</th>
                <th>總金額</th>
            </thead>
            <tbody>
                <?php while($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?= $row["productName"] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>