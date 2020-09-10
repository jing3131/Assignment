<?php

require_once("config.php");
require_once("getSql.php");
$resultPopular = getPopular($link);
$row = $resultPopular->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="bootstrap-4.5.2-dist/css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDiscount">
        Launch
        modal
    </button> -->

    <!--Modal: modalAdvertisment-->
    <div class="modal fade right" id="modalAdvertisment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
        <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
            <!--Content-->
            <div class="modal-content">

                <!--Body-->
                <div class="modal-body">

                    <div class="row">

                        <div style="background-color: wheat; height:700px; width:500px">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> &times; </button>
                            夏日熱銷商品
                            <h3><strong>全館最低下殺三折</strong></h3>
                            <a href="productDetail.php?id=<?= $row["productId"] ?>"><img src="data:image/jpeg;base64, <?= $row["productPic"] ?>" style="width: 495px; height:650px" alt=""></a>
                        </div>
                        <div style="background-color: #e4d9be;  width:500px">
                            
                            <!-- <a href="productDetail.php?id=22"><img src="img/car.jpg" style="width: 495px;" alt=""></a> -->
                        </div>

                    </div>
                </div>

            </div>
            <!--/.Content-->
        </div>
    </div>
    <!--Modal: modalAdvertisment-->


    <script>
        $(function(){
            $("#modalAdvertisment").modal();
        })
    </script>
</body>

</html>