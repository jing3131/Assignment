<?php

function updateItem($link, $productName, $productText, $productQty, $productPrice, $id){            // 更新產品(不含圖片)
    $sql = <<<sqlCommand
        UPDATE product SET productName = ?, productText = ?, productQuantity = ?, productPrice = ?
        WHERE productId = ?
    sqlCommand;
    $result = $link->prepare($sql);
    $result->execute(array("$productName", "$productText", $productQty, $productPrice, $id));
}

function updateIncludePic($link, $productName, $productText, $img64, $productQty, $productPrice, $id){
    $sql = <<<sqlCommand
        UPDATE product SET productName = ?, productText = ?, productPic= ?, productQuantity = ?, productPrice = ?
        WHERE productId = ?
    sqlCommand;
    $result = $link->prepare($sql);
    $result->execute(array("$productName", "$productText", "$img64", $productQty, $productPrice, $id));           // 更新產品(含圖片)
}

function addProduct($link, $id, $ItemName, $Itemtext, $img64, $price, $quantity){
    $sql = <<<sqlCommand
            INSERT INTO product (managerId, productName, productText, productPic, productPrice, productQuantity)
            VALUES (?,?,?,?,?,?)
    sqlCommand;
    $result = $link->prepare($sql);
    $result->execute(array($id, "$ItemName", "$Itemtext", "$img64", $price, $quantity));
}

?>