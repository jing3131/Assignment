<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript"></script>
    <!-- <link href="css/bootstrap.css" rel="stylesheet"> -->
    <style type="text/css">
        #container {
            margin: 0 auto;
            width: 25%;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body style="background-color:#fdfcd4">

    <div class="container" style="text-align:center; margin-left:500px">
        <br>
        <table width="500px" style="border:5px wheat solid;">
            <tr>
                <td>
                    <h4>歡迎光臨線上網路銀行系統</h4>
                </td>
            </tr>
            <tr>
                <td>
                    <h5>會員登入/login</h5>
                </td>
                <td><button type="submit" name="loginbtn" id="loginbtn" class="btn btn-outline-primary" onclick="window.location='login.php'">登入</button></td>
            </tr>
            <tr>
                <td>
                    <h5>還不是會員? signup</h5>
                </td>
                <td> <button type="submit" name="signupbtn" id="signupbtn" class="btn btn-outline-success" onclick="window.location='signup.php'">註冊</button></td>
            </tr>
        </table>
    </div>






</body>

</html>