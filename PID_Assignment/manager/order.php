<?php

session_start();

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
</body>

</html>