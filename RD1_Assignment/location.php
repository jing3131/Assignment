<?php

function getLocation($defaultLocation){         // option 下拉式選單 $defaultLocation 有被選取下拉式選單就不會跑回第一格
    require("config.php");
    $sql = "select * from location";
    $result = mysqli_query($link,$sql);

    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        $data[$row["locationId"]]  = $row["locationName"];
    }

    $option = [];
    foreach($data as $locationId => $locationName){
        $value = "";
        if($defaultLocation == $locationId){
            $value = "selected";
        }
        $option[] = "<option value='$locationId' $value>$locationName</option>";
    }
    return implode("\n",$option);
}

?>