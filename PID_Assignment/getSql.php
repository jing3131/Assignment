<?php

function getAllProduct($link){                                  // 商品項目
    $sql = <<<sqlCommand
        SELECT * FROM product WHERE productQuantity <> 0
        ORDER BY productId DESC 
    sqlCommand;                                                 // 新增的優先放在前面
    $result = $link->prepare($sql);
    $result->execute();

    return $result;
}

function getProduct($link, $limit, $desc){                                  // 商品項目
    $sql = <<<sqlCommand
        SELECT * FROM product WHERE productQuantity <> 0
        ORDER BY quantitySold $desc, productId
        LIMIT $limit
    sqlCommand;                                                 // 新增的優先放在前面，只取?筆
    $result = $link->prepare($sql);
    $result->execute();

    return $result;
}

function deleteShoppingCar($link, $shoppingCarId){           // 刪除購物車的資料
    $sql =  <<<sqlCommand
            DELETE FROM shoppingCar WHERE shoppingCarId = ?
    sqlCommand;
    $result = $link->prepare($sql);
    $result->execute(array($shoppingCarId));
}

function getProductInId($link, $id){                          // 商品細項
    $sql = <<<sqlCommand
        select * from product
        where productId = ?;
    sqlCommand;
    $result = $link->prepare($sql);
    $result->execute(array($id));
    return $result;
}

function getOrderInId($link, $idManager, $id){
    $sql = <<<sqlCommand
        SELECT p.productName, quantity, deliveryTo, od.address, pay, od.creditCard, a.account, od.totalAmount FROM product as p
        JOIN orderDetail as od ON p.productId = od.productId
        JOIN account as a ON a.accountId = od.accountId
        WHERE managerId = ? AND od.accountId = ?
        ORDER BY od.accountId
    sqlCommand;
    $result = $link->prepare($sql);
    $result->execute(array($idManager, $id));

    return $result;
}

function getOrder($link, $idManager){
    $sql = <<<sqlCommand
        SELECT p.productName, quantity, deliveryTo, od.address, pay, od.creditCard, a.account, od.totalAmount FROM product as p
        JOIN orderDetail as od ON p.productId = od.productId
        JOIN account as a ON a.accountId = od.accountId
        WHERE managerId = ?
        ORDER BY od.accountId
    sqlCommand;
    $result = $link->prepare($sql);
    $result->execute(array($idManager));

    return $result;
}

function getManagerProduct($link, $id){
    $sql = "select * from product where managerId = ?";
    $result = $link->prepare($sql);
    $result->execute(array($id));

    return $result;
}

function getShoppingCarInId($link, $id){
    $sql = <<<sqlCommand
        SELECT sc.quantity, p.productName, p.productPic, p.productPrice, p.productId, p.productQuantity, sc.shoppingCarId
        FROM shoppingCar AS sc
        JOIN product as p ON p.productId = sc.productId
        WHERE accountId = ?
    sqlCommand;
    $result = $link->prepare($sql);
    $result->execute(array($id));
    return $result;
}

function getPopular($link){
    $sql = "select * from product ORDER BY quantitySold DESC LIMIT 1";          // 挑出銷售數量最高的商品
    $result = $link->prepare($sql);
    $result->execute();
    return $result;
}

?>