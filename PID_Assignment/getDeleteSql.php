<?php

function deleteProduct($link, $id){
    $sql = <<<sqlCommand
        DELETE FROM product WHERE productId = ?
    sqlCommand;

    $result = $link->prepare($sql);
    $result->execute(array($id));
}

function deleteShoppingInProduct($link, $id){
    $sql = <<<sqlCommand
        DELETE FROM shoppingCar WHERE productId = ?
    sqlCommand;
    $result = $link->prepare($sql);
    $result->execute(array($id));
}

?>