<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!--購買/購物車對話盒-->
    <div class="modal fade" id="buyModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">購買/購物車</h4>
                    <button type="button" class="close" id="closeBuybtn">&times;</button>
                </div>

                <!-- Modal Body -->
                <form action="" id="buyForm">
                    <div class="modal-body">
                        產品名稱： <label for="" id="productNameL"><?= $productName; ?></label> <br>
                        數量： <input type="number" name="quantityTF" id="quantityTF" min="1" oninput="if(value<0)value=0; if(value><?= $row['productQuantity'] ?>) value=<?= $row['productQuantity'] ?>" value="0" required> <br>
                        <!-- 價格： <?= $productPrice; ?> -->
                    </div>
                </form>


                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" id="okbtn" class="btn btn-outline-danger" data-dismiss="modal">確認</button>
                </div>

            </div>
        </div>
    </div>
    <!--購買/購物車對話盒結束-->


    <!-- 交易對話盒 -->
    <!-- <form action="" class="needs-validation"> -->
    <div class="modal fade" id="transactionModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">地址與付款方式</h4>
                    <button type="button" class="close" id="closeBuybtn" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <label for="">地址：</label>

                    <label for="address">7-11</label>
                    <input type="radio" name="deliveryTo" id="address711" value="7-11" checked>
                    <label for="address">全家</label>
                    <input type="radio" name="deliveryTo" id="addressFM" value="family">
                    <label for="address">住家</label>
                    <input type="radio" name="deliveryTo" id="addressHome" value="home">
                    <input type="text" name="addressTF" id="addressTF" required>
                    <br>

                    <label for="">付款方式：</label>
                    <label for="pay">貨到付款</label>
                    <input type="radio" name="pay" id="payCash" value="cash">
                    <label for="pay">信用卡</label>
                    <input type="radio" name="pay" id="payCrdt" value="credit" checked>
                    <input type="text" name="creditTF" id="creditTF" required>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" id="payOkbtn" class="btn btn-outline-danger">確認</button>
                </div>

            </div>
        </div>
    </div>
    <!-- </form> -->
    <!--交易對話盒結束-->
</body>

</html>