<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="js/jquery.js"></script>
    <link rel="stylesheet" href="bootstrap-4.5.2-dist/css/bootstrap.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- <style>
        #container {
            margin: 0 auto;
            width: 25%;
        }
    </style> -->
</head>

<body style="background-color:#FAEBD7">
    <br>


    <div class="container" style="margin-left:550px">
        歡迎登入： <?= $userName ?>
        <a href="index.php?logout=1" style="margin-left:70px">登出</a>

        <table width="300" style="border:5px #DEB887 solid">

            <tr>
                <td align="center"> 存款：</td> <!-- align="center" 置中 -->
                <td align="center"><button class="btn btn-outline-dark" type="submit" name="depositbtn" id="depositbtn" onclick="window.location='deposit.php'">存款</button> </td>
            </tr>
            <tr>
                <td align="center">提款：</td>
                <td align="center"><button type="submit" class="btn btn-outline-dark" name="withdrawbtn" id="withdrawbtn" onclick="window.location='withdraw.php'">提款</button></td>
            </tr>
            <tr>
                <td align="center">查詢餘額：</td>
                <td align="center"><button type="submit" class="btn btn-outline-dark" name="moneybtn" id="moneybtn">查詢餘額</button></td>                
            </tr>
            <tr>
                <td align="center">查詢明細：</td>
                <td align="center"><button type="submit" class="btn btn-outline-dark" name="detailbtn" id="detailbtn" onclick="window.location='accountDetail.php'">查詢明細</button></td>
            </tr>

        </table>

    </div>

    <!-- 存款對話盒 -->
    <div class="modal" id="moneyModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">存款餘額</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    $ NTD：  <?= $money ?>
                </div>
            </div>
        </div>
    </div>
    <!-- 存款對話盒結束 -->

    <script>
        $("#moneybtn").on("click", function() {
            $("#moneyModal").modal();
        });
    </script>


</body>

</html>