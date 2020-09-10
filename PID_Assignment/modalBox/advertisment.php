<?php
// require_once("config.php");
// require_once("getSql.php");
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
    <style>
        .form-dark .font-small {
            font-size: 0.8rem;
        }

        .form-dark [type="radio"]+label,
        .form-dark [type="checkbox"]+label {
            font-size: 0.8rem;
        }

        .form-dark [type="checkbox"]+label:before {
            top: 2px;
            width: 15px;
            height: 15px;
        }

        .form-dark .md-form label {
            color: #fff;
        }

        .form-dark input[type=email]:focus:not([readonly]) {
            border-bottom: 1px solid #00C851;
            -webkit-box-shadow: 0 1px 0 0 #00C851;
            box-shadow: 0 1px 0 0 #00C851;
        }

        .form-dark input[type=email]:focus:not([readonly])+label {
            color: #fff;
        }

        .form-dark input[type=password]:focus:not([readonly]) {
            border-bottom: 1px solid #00C851;
            -webkit-box-shadow: 0 1px 0 0 #00C851;
            box-shadow: 0 1px 0 0 #00C851;
        }

        .form-dark input[type=password]:focus:not([readonly])+label {
            color: #fff;
        }

        .form-dark input[type="checkbox"]+label:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 17px;
            height: 17px;
            z-index: 0;
            border: 1.5px solid #fff;
            border-radius: 1px;
            margin-top: 2px;
            -webkit-transition: 0.2s;
            transition: 0.2s;
        }

        .form-dark input[type="checkbox"]:checked+label:before {
            top: -4px;
            left: -3px;
            width: 12px;
            height: 22px;
            border-style: solid;
            border-width: 2px;
            border-color: transparent #00c851 #00c851 transparent;
            -webkit-transform: rotate(40deg);
            -ms-transform: rotate(40deg);
            transform: rotate(40deg);
            -webkit-backface-visibility: hidden;
            -webkit-transform-origin: 100% 100%;
            -ms-transform-origin: 100% 100%;
            transform-origin: 100% 100%;
        }

        .form-dark .modal-header {
            border-bottom: none;
        }
    </style>
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="modalAdvertisment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog form-dark" role="document">
            <!--Content-->
            <div class="modal-content card card-image" style="background-image: url('data:image/jpeg;base64, <?= $row["productPic"] ?>');">
                <div class="text-white rgba-stylish-strong py-5 px-5 z-depth-4">
                    <!--Header-->
                    <div class="modal-header text-center pb-4">
                        <h3 class="modal-title w-100 white-text font-weight-bold" id="myModalLabel"><strong>夏日熱銷商品</strong> <a class="green-text font-weight-bold" href="popular.php"><strong>人氣UP</strong></a></h3>
                        <button type="button" class="close white-text" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!--Body-->
                    <div class="modal-body" style="width: 300px; height:300px">
                        <!--Body-->
                                                
                        <!--Grid row-->
                        <div class="row d-flex align-items-center mb-4">

                            <!--Grid column-->
                            <div class="" style="margin-left: 400px">
                                <button type="button" class="btn btn-block btn-rounded z-depth-1" onclick="window.location='productDetail.php?id= <?= $row['productId'] ?>'">了解更多>>></button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!-- Modal -->

    <!-- <div class="text-center">
        <a href="" class="btn btn-default btn-rounded" data-toggle="modal" data-target="#modalAdvertisment">Launch modal
            register Form</a>
    </div> -->
</body>

</html>