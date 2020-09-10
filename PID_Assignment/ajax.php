<?php
header('Content-Type: application/json; charset=UTF-8');
session_start();

require("getSql.php");
require("config.php");
$account = $_SESSION["account"];
$sql =<<<sqlCommand
SELECT accountId FROM account WHERE account = ?
sqlCommand;
$result = $link->prepare($sql);
$result->execute(array("$account"));
$row = $result->fetch(PDO::FETCH_ASSOC);
$id = $row["accountId"];                            // accountId


if($_SERVER["REQUEST_METHOD"]=="POST"){     // 如果是post請求

    // $name = $_POST["productName"];
    $quantity = $_POST["productQuantity"];
    $buyOrShopping = $_POST["buyOrShopping"];               // 直接購買 or 放購物車
    $credit = $_POST["credit"];                         // null 變 ""
    $address = $_POST["address"];   
    $productPrice = $_POST["productPrice"];

    $productId;
    if(isset($_POST["productId"])){
        $productId = $_POST["productId"];
    }
    else{
        $productId = $_SESSION["productId"];
    }

    


    if($buyOrShopping == 0){                // 放購物車
        $sql= <<<sqlCommand
            INSERT INTO shoppingCar (accountId, quantity, productId)
            VALUES (?,?,?)
        sqlCommand;
        $result = $link->prepare($sql);
        $result->execute(array($id,$quantity,$productId));
    }
    else if($buyOrShopping == 2){            // 刪除購物車
        $shoppingCarId = $_POST["shoppingCarId"];
        deleteShoppingCar($link, $shoppingCarId);           // 刪除購物車的資料
    }
    else{
        // 新增訂單
        $deliveryTo = $_POST["deliveryTo"];
        $pay = $_POST["pay"];
        $creditCardNum = $_POST["creditCardNum"];
        $totalAmount = $productPrice * $quantity;
        $shoppingCarId = $_POST["shoppingCarId"];

        $sql= <<<sqlCommand
            INSERT INTO orderDetail (accountId, productId, quantity, deliveryTo, address, pay, creditCard, totalAmount)
            VALUES (?,?,?,?,?,?,?,?)
        sqlCommand;
        $result = $link->prepare($sql);
        $result->execute(array($id,$productId,$quantity,"$deliveryTo","$address","$pay","$creditCardNum",$totalAmount));

        deleteShoppingCar($link, $shoppingCarId);           // 刪除購物車的資料


        // 更新產品數量        
        $sql = <<<sqlCommand
            SELECT * FROM product WHERE productId = ?
        sqlCommand;
        $result = $link->prepare($sql);
        $result->execute(array($productId));
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $qntSold = $row["quantitySold"] + $quantity;            // 原本已銷售數量 + 此訂單的銷售數量
        $qnt = $row["productQuantity"] - $quantity;             // 原有的數量 - 購買的數量


        $sql = <<<sqlCommand
            UPDATE product SET productQuantity = ?, quantitySold = ? WHERE productId = ?
        sqlCommand;
        $result = $link->prepare($sql);
        $result->execute(array($qnt,$qntSold,$productId));

        

        // 更新帳戶
        $sql = <<<sqlCommand
            UPDATE account set creditCard = ?, address = ? WHERE accountId = ?
        sqlCommand;
        $result = $link->prepare($sql);
        $result->execute(array("$creditCardNum","$address",$id));
    }

} 
?>