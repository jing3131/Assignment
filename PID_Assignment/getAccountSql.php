<?php

function getAllAccount($link){
    $sql = <<<sqlCommand
        SELECT * FROM account
    sqlCommand;
    $result = $link->prepare($sql);
    $result->execute();

    return $result;
}

function getManagerAccount($link, $account){
    $sqlAcc = "select account from manager where account = ? ";
    $resultAcc = $link->prepare($sqlAcc);
    $resultAcc->execute(array($account));


    $row = $resultAcc->fetch(PDO::FETCH_ASSOC);
    return $row["account"];
}

function getManagerPassword($link, $account, $password){
    $sqlPwd = "select `password` from manager where account = ? and `password` = MD5(?)";
    $resultPwd = $link->prepare($sqlPwd);
    $resultPwd->execute(array("$account", "$password"));
    $row = $resultPwd->fetch(PDO::FETCH_ASSOC);         // 確認密碼正確與否
    return $row["password"];
}

function getManagerId($link, $account){
    $sqlId = "select managerId from manager where account = ?";
    $resultId = $link->prepare($sqlId);
    $resultId->execute(array("$account"));
    $row = $resultId->fetch(PDO::FETCH_ASSOC);

    return $row["managerId"];                                            // 用使用者名稱查詢ID
}

function setAccount($link, $name, $account, $password, $credit, $address){
    $sql = <<<sqlCommand
        INSERT INTO account (name, account, `password`, creditCard, address, canUse)
        VALUES(?,?,MD5(?),?,?,?);
    sqlCommand;
    $result = $link->prepare($sql);
    $result->execute(array($name, $account, $password, $credit, $address, 'Y'));
}


// 一般會員登入
function getAccount($link, $account){ 
    $sqlAcc = "select account from account where account = ? ";
    $resultAcc = $link->prepare($sqlAcc);
    $resultAcc->execute(array($account));

    $row = $resultAcc->fetch(PDO::FETCH_ASSOC);
    return $row["account"] ;
}

function getPassword($link, $account, $password){
    $sqlPwd = "select `password` from account where account = ? and `password` = MD5(?)";
    $resultPwd = $link->prepare($sqlPwd);
    $resultPwd->execute(array("$account", "$password"));
    $row = $resultPwd->fetch(PDO::FETCH_ASSOC);         // 確認密碼正確與否
    return $row["password"] ;
}

function getAccountId($link, $account){
    $sqlId = "select accountId, canUse from account where account = ?";
    $resultId = $link->prepare($sqlId);
    $resultId->execute(array("$account"));
    $row = $resultId->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function compareAcount($link, $account){                                // 是否有被註冊過
    $sql = "select account from account where account = ?";
    $result = $link->prepare($sql);
    $result->execute(array("$account"));
    $row = $result->fetch(PDO::FETCH_ASSOC);
    return $row["account"];
}

function banAccount($link, $type, $id){                                 // 停用/啟用會員
    $sql = <<<sqlCommand
        UPDATE account SET canUse = ? WHERE accountId = ?
    sqlCommand;
    $result = $link->prepare($sql);
    $result->execute(array($type, $id));
}

?>