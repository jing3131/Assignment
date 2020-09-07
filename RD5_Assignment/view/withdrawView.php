<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <div class="container">
        <div style="text-align:center; background-color:#FFEBCD">
            <form method="post">

                <br>
                <table style="margin-left:150px">
                    <tr>
                        <td><label for="">欲提款金額</label></td>
                        <td class="custom-control cusmtom-radio custom-control-inline"><input type="radio" name="rdobtn" id="rdobtn500" class="custom-control-inline" value="500"> 500</td>
                        <td class="custom-control cusmtom-radio custom-control-inline"><input type="radio" name="rdobtn" id="rdobtn1000" class="custom-control-inline" value="1000"> 1000</td>
                        <td class="custom-control cusmtom-radio custom-control-inline"><input type="radio" name="rdobtn" id="rdobtn3000" class="custom-control-inline" value="3000"> 3000</td>
                        <td class="custom-control cusmtom-radio custom-control-inline"><input type="radio" name="rdobtn" id="rdobtn5000" class="custom-control-inline" value="5000"> 5000</td>
                        <td class="custom-control cusmtom-radio custom-control-inline"><input type="submit" name="btnOther" id="btnOther" class="btn btn-outline-success" value="其他面額"> </td>
                    </tr>
                    <tr>
                        <td><label for="">請輸入密碼</label></td>
                        <td><input id="passwordTF" name="passwordTF" type="password" class="form-control"></td>
                    </tr>

                </table>
                <br>
                <div class="form-group row">
                    <div class="offset-4 col-4">
                        <button name="submitbtn" id="submitbtn" type="submit" class="btn btn-outline-primary">確定</button>
                        <button name="cancelbtn" id="cancelbtn" type="submit" class="btn btn-outline-warning">取消</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</body>

</html>