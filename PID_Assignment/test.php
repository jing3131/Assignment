<?php
if (isset($_POST["submit"])) {
    $fp = fopen($_FILES['myFile']['tmp_name'], 'rb');
    $buf = addslashes(fread($fp, $_FILES['myFile']['size']));
    //print_r($buf);
    $link = mysqli_connect("localhost", "root", "root", "PID_Assignment");
    $result = mysqli_query($link, "set names utf8");
    $sql = <<<CC
        insert into test (img) values ("$buf")
    CC;
    mysqli_query($link, $sql);
}

if (isset($_POST["pic"])) {
    $link = mysqli_connect("localhost", "root", "root", "PID_Assignment");
    $result = mysqli_query($link, "set names utf8");
    $sql = "select * from test";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_object($result);
    Header("Content-type:image/jpeg");
    echo $row->Image;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-xl bg-dark navbar-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
        </div>
    </nav>
    <br>

    <div class="container">
        <h3>Collapsible Navbar</h3>
        <p>In this example, the navigation bar is hidden on small screens and replaced by a button in the top right corner (try to re-size this window).</p>
        <p>Only when the button is clicked, the navigation bar will be displayed.</p>
        <p>Tip: You can also remove the .navbar-expand-md class to ALWAYS hide navbar links and display the toggler button.</p>
    </div>

</body>

</html>