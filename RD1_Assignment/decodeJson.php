<?php

require("config.php");
require("information.php");     // 產生 jsondata jsondataRain jsonWeek

$data = json_decode($jsondata,true);
$dataWeek = json_decode($jsondataWeek,true);
$dataRain = json_decode($jsondataRain,true);
$record = $data["records"]["locations"][0]["location"]; //print_r($record);
$recordWeek = $dataWeek["records"]["locations"][0]["location"];
$recordRain = $dataRain["records"]["location"];

$locationName; $elementName; $startTime; $endTime; $dataTime; $values;
$locatedName;   // 縣市底下的地理位置
//$itemId =1;

try{
    $sql = "delete from weatherDescription";
    mysqli_query($link,$sql);
    $sql = "delete from rain";
    mysqli_query($link,$sql);

    foreach($record as $val){            
        require("dataInsert.php");                
    }    
    foreach($recordWeek as $val){
        require("dataInsert.php");
    }
    foreach($recordRain as $val){
        $dataTime = $val["time"]["obsTime"]; //echo $dataTime;             // Insert Into
        $locationName = $val["parameter"][0]["parameterValue"];
        $locatedName = $val["locationName"];
    
        $sqlId = <<<sqlCommand
            select locationId from location
            where locationName = '$locationName'
        sqlCommand;
        $result = mysqli_query($link,$sqlId);
        $row["locationId"] = mysqli_fetch_assoc($result);
        $id = implode("",$row["locationId"]);                           // id

        $element = [];
        foreach($val["weatherElement"] as $v){
            $elementName = $v["elementName"];
            $values = $v["elementValue"];

            $element[] = $values;                               // [0] = RAIN , [1] = HOUR_24

            // if($elementName == "RAIN" || $elementName == "HOUR_24"){
                
    
            // $sql = <<<sqlCommand
            //     INSERT INTO rain (locationId, type, rainMm, locatedName)
            //     VALUES ($id, '$elementName', $values, '$locatedName');
            // sqlCommand;
            // //echo $sql;
            // mysqli_query($link,$sql);
            // }
        }

            $sql = <<<sqlCommand
                INSERT INTO rain (locationId, RAIN, HOUR_24, locatedName)
                VALUES ($id, $element[0], $element[1], '$locatedName');
            sqlCommand;
            //echo $sql;
            mysqli_query($link,$sql);
        

        // $locationName = $val["parameter"][0]["parameterValue"];         // update rain
        // $locatedName = $val["locationName"];                            // 地區名
    
        // $sqlId = <<<sqlCommand
        //     select locationId from location
        //     where locationName = '$locationName'
        // sqlCommand;
        // $result = mysqli_query($link,$sqlId);
        // $row["locationId"] = mysqli_fetch_assoc($result);
        // $id = implode("",$row["locationId"]);      //echo $id;             // id

        // foreach($val["weatherElement"] as $v){
        //     $elementName = $v["elementName"];                           // type
        //     $values = $v["elementValue"];                               // rainMm
        //     if($elementName == "RAIN" || $elementName == "HOUR_24"){                
    
        //     $sql = <<<sqlCommand
        //         UPDATE rain SET rainMm = $values WHERE locatedName = '$locatedName' AND type = '$elementName'
        //     sqlCommand;
        //     //echo $sql;
        //     mysqli_query($link,$sql);
        //     }
        // }
    }

    
}
catch(Exception $e){
    echo "error";
}
    
?>
