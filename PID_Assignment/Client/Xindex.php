<?php
session_start();
$userName;

if (isset($_SESSION["account"])) {
    $userName = $_SESSION["account"];
}
// else{
//     $userName = "Guest";
// }
if ($_GET["logout"]) {
    unset($_SESSION["account"]);
    unset($_SESSION["accountId"]);
}

require("../config.php");
$id = $_SESSION["accountId"];
$sql = <<<sqlCommand
    select * from product;
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

            <?php if (isset($_SESSION["account"])) { ?>
                <span class="navbar-text" style="margin-left:30px;">歡迎登入： <?= $userName ?></span>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?logout=1"> 登出 </a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php" style="margin-left:30px;"> 登入 </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php"> 註冊 </a>
                </li>
            <?php } ?>

        </ul>
    </nav>
    <div class="container">
        <br>
        <div class="row">
            <?php foreach($result->fetchAll() as $row) { ?>
                <?php //$pic = base64_encode($row["productPic"]); ?>
                <div class="col-3">
                <div class=row><img src="data:image/jpeg;base64, <?= $row["productPic"] ?>" style="width:150px;height:150px" id="img"></td></div>
                <div class=row><a href="../productDetail.php?id=<?= $row["productId"] ?>"><?= $row["productName"]; ?></a></div>
            </div>    
            <?php } ?>       
        </div>
    </div>

</body>

</html>