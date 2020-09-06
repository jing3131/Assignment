<?php

function getLocation (){
    $sql = "select * from location";
    require("config.php");
    $result = mysqli_query($link,$sql);

    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        $data[$row['locationId']] = $row['locationName'];
    }

    return $data;
}

function getLocationOption ($defaultLocation){
    $location = getLocation();

    $option = [] ;
    foreach ($location as $locationId => $locationName) {
        $value = "";
        if($defaultLocation == $locationId) $value ="selected";
        $option[] = "<option value='{$locationId}' $value >".$locationName."</option>";
    }

    return implode("\n",$option);
}

?>