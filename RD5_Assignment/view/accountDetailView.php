<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <style>
        #container {
            margin: 0 auto; width: 30%;
        }
    </style> -->
</head>
<body style="background-color:#F5DEB3">
<div class="container">
<div style="text-align:center;">
        <br>
        帳戶明細
        <table style="border:5px #FFAC55 solid; margin-left: 350px;" class="table-hover" width="400">
            
        <thead>
            <th>日期</th>
            <th>存款/提款</th>
            <th>金額(NTD)</th>
            <th>餘額(NTD)</th>
        </thead>

            <?php while($row = $result->fetch(PDO::FETCH_ASSOC)){ ?>
                <tr>
                <td><?= $row["dates"] ?></td>
                <td><?= $row["type"] ?></td>
                <td><?= number_format($row["moneyChange"]) ?></td>
                <td><?php
                    $m =$row["balance"] % 1000; 
                    if($m<10){
                        $balance = str_replace("00$m","***",number_format($row["balance"]));
                    }
                    else if($m<100){
                        $balance = str_replace("0$m","***",number_format($row["balance"]));
                    }
                    else{
                        $balance = str_replace($m,"***",number_format($row["balance"]));
                    }
                    
                    echo $balance;
                 ?></td>
                </tr>
            <?php } ?>
        </table>
        <br>
        <button type="button" onclick="javascript:location.href='memberIndex.php'" name="ckeckbtn" class="btn btn-outline-primary">確認</button>
    </div>
</div>

</body>
</html>