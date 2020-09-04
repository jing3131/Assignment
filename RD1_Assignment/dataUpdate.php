<?php

// $record = $data["records"]["locations"][0]["location"]; //print_r($record);
// $recordWeek = $dataWeek["records"]["locations"][0]["location"];
// $recordRain = $dataRain["records"]["location"];
// $itemId =1;

$locationName = $val["locationName"];        // 地區
// echo $locationName;

foreach($val["weatherElement"] as $element){
    $elementName =$element["elementName"];                  // elementName
    $sqlId = <<<sqlCommand
        select locationId from location
        where locationName = '$locationName'
    sqlCommand;
    // echo $sqlId;
    $result = mysqli_query($link,$sqlId);
    $row["locationId"] = mysqli_fetch_assoc($result); //print_r($result);
    $id = implode("",$row["locationId"]);                   // id
    //echo $id."id";
              
    foreach($element["time"] as $time){
        $values =$time["elementValue"][0]["value"];
        //echo $values;

        // $values = $element["time"][0]["elementValue"][0]["value"];           // value
        
        if($elementName == "WeatherDescription") {      // $elementName == "PoP12h" || $elementName == "PoP6h" || $elementName == "Wx" || 
            $startTime = $time["startTime"];
            $endTime = $time["endTime"];
            $sql =<<<sqlCommand
                UPDATE $elementName SET startTime = '$startTime', endTime = '$endTime', `value` = '$values'
                WHERE id = $itemId AND locationId = $id
            sqlCommand;
            echo $sql ."<br>";
            $itemId ++;
            //mysqli_query($link,$sql);
        }        
        
    }
}

?>