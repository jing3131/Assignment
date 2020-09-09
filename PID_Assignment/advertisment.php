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
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDiscount">
        Launch
        modal
    </button>

    <!--Modal: modalAdvertisment-->
    <div class="modal fade right" id="modalAdvertisment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
        <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <!-- <div class="modal-header">
                    <p class="heading">Discount offer:
                    <strong>10% off</strong>
                    </p>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div> -->

                <!--Body-->
                <div class="modal-body">

                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button> -->

                    <div class="row">
                        <!-- <div class="col-1">
                            <p></p>
                            <p class="text-center">
                                <i class="fas fa-gift fa-4x"></i>
                            </p>
                            <br>
                            
                        </div>
                        <div class="col-10">
                            <p>Sharing is caring. Therefore, from time to time we like to give our visitors small gifts. Today is
                                one of those days.</p>
                            <p>
                                <strong>Copy the following code and use it at the checkout. It's valid for
                                    <u>one day</u>.</strong>
                            </p>
                            <h2>
                                <span class="badge">v52gs1</span>
                            </h2>
                            
                        </div> -->

                        <div style="background-color: wheat; height:700px; width:500px">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> &times; </button>
                            夏日新品拍賣
                            <h3><strong>全館最低下殺三折</strong></h3>
                            <a href="productDetail.php?id=36"><img src="img/stair.jpg" style="width: 495px; height:650px" alt=""></a>
                        </div>
                        <div style="background-color: #e4d9be;  width:500px">
                            
                            <!-- <a href="productDetail.php?id=22"><img src="img/car.jpg" style="width: 495px;" alt=""></a> -->
                        </div>

                    </div>
                </div>

                <!--Footer-->
                <!-- <div class="modal-footer flex-center">
                    <a href="https://mdbootstrap.com/pricing/jquery/pro/" class="btn btn-danger">Get it
                        now
                        <i class="far fa-gem ml-1 white-text"></i>
                    </a>
                    <a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">No, thanks</a>
                </div> -->
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