<?php

session_start();
if (isset($_SESSION["account"])) {
    $userName = $_SESSION["account"];
    $id = $_SESSION["accountId"];
}

require("../config.php");
$sql = <<<sqlCommand
    SELECT quantity, deliveryTo, address, pay, creditCard, totalAmount, p.productName
    FROM orderDetail AS od
    JOIN product AS p ON p.productId = od.productId
    WHERE accountId = ?
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

                <?php if (isset($_SESSION["account"])) { ?>
                    <span class="navbar-text" style="margin-left:50px;">歡迎登入： <?= $userName ?></span>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php?logout=1" style="margin-left:50px;"> 登出 </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="shoppingCar.php" style="margin-left:50px;"> 購物車 </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="history.php" style="margin-left:50px;"> 購買歷史 </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="../index.php" style="margin-left:500px;">首頁</a>
                    </li> -->
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
            
        </div>

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
                <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?= $row["productName"] ?></td>
                        <td><?= $row["quantity"] ?></td>
                        <td><?= $row["address"] ?></td>
                        <td><?= $row["pay"] ?></td>
                        <td>$ <?= $row["totalAmount"] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>