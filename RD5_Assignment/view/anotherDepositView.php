<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript"></script>
    </head>
<body>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <div style="text-align:center; background-color:#FAF0E6">
        <form method="post">
            <br>
            <div class="form-group row">
                <label for="depositTF" class="col-4 col-form-label">欲存款金額</label> 
                <div class="col-4">
                <input id="depositTF" name="depositTF" type="text" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="passwordTF" class="col-4 col-form-label">請輸入密碼</label> 
                <div class="col-4">
                <input id="passwordTF" name="passwordTF" type="password" class="form-control">
                </div>
            </div> 
            <div class="form-group row">
                <div class="offset-4 col-6">
                <button name="submitbtn" id="submitbtn" type="submit" class="btn btn-outline-primary">確定</button>
                <button name="cancelbtn" id="cancelbtn" type="submit" class="btn btn-outline-warning">取消</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>