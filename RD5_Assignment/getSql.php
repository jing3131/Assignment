<?php

function getBalance($link, $id){
    $sql = <<< sqlCommand
            SELECT money FROM memberBank WHERE accountId = ?;
        sqlCommand;
    $result = $link->prepare($sql);
    $result->execute(array($id));
    $row = $result->fetch(PDO::FETCH_ASSOC);

    $money = $row["money"];                             // 查詢餘額的值

    return $money;
}


function updateBalance($link, $money, $id){                             // 更新餘額
    $sqldpt = <<< sqlCommand
        UPDATE memberBank SET money = ? where accountId = ?
    sqlCommand;
    $result =$link->prepare($sqldpt);
    $result->execute(array($money,$id));
}

function setDetail($link, $id, $type, $deposit, $date, $money){                // 新增明細
    $sqld = <<< sqlCommand
        INSERT INTO accountDetail (accountId, type, moneyChange, dates, balance)
        VALUES (?, ?, ?, ?, ?);
    sqlCommand;
    $result = $link->prepare($sqld);
    $result->execute(array($id,"$type",$deposit,"$date",$money));
}

function getDetail($link, $id){
    $sql = <<<sqlCommand
        SELECT * FROM accountDetail WHERE accountId = ?
        ORDER BY dates
    sqlCommand;
    $result = $link->prepare($sql);
    $result->execute(array($id));
    return $result;
}

function getAccount($link, $account){
    $sqlAcc = "select account from member where account = ? ";
    $resultAcc = $link->prepare($sqlAcc);
    $resultAcc->execute(array($account));
    $row = $resultAcc->fetch(PDO::FETCH_ASSOC);
    return $row["account"];
}

function getPassword($link, $account, $password){
    $sqlPwd = "select `password` from member where account = ? and `password` = MD5(?)";
    $resultPwd = $link->prepare($sqlPwd);
    $resultPwd->execute(array("$account", "$password"));
    $row = $resultPwd->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function getId($link, $account){                                   // 用使用者名稱查詢ID
    $sqlId = "select accountId from member where account = ?";
    $resultId = $link->prepare($sqlId);
    $resultId->execute(array("$account"));
    $row = $resultId->fetch(PDO::FETCH_ASSOC);
    return $row["accountId"] ;
}

function setAccount($link, $name, $account, $password){
    $sqlAdd = <<< sqlCommand
        INSERT INTO member (name, account, password)
        VALUES(?,?,MD5(?));
    sqlCommand; 
    $resultAdd = $link->prepare($sqlAdd);
    $resultAdd->execute(array("$name","$account","$password"));
}

function setAccountBank($link, $id){
    $sqlAddBank = <<< sqlCommand
        INSERT INTO memberBank (accountId, money) VALUES (?,0);
    sqlCommand;
    $result = $link->prepare($sqlAddBank);
    $result->execute(array($id));
}

function compareAccount($link, $account){
    $sql = "select account from member where account = ? ";
    $result = $link->prepare($sql);
    $result->execute(array($account));
    $row = $result->fetch(PDO::FETCH_ASSOC);
    return $row["account"];
}

?>