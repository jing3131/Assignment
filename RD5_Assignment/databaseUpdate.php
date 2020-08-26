<?php

require("config.php");
require("information.php");     // 產生 jsondata

$data = json_decode($jsondata,true);
$record = $data["records"]["locations"][0]["location"]; //print_r($record);

$locationName; $elementName; $startTime; $endTime; $dataTime; $values;

try{
    foreach($record as $val){    
        $locationName = $val["locationName"];        // 地區
    
        foreach($val["weatherElement"] as $element){
            //echo $element["elementName"];
            $elementName =$element["elementName"];                  // elementName
            $sqlId = <<<sqlCommand
                select locationId from location
                where locationName = '$locationName'
            sqlCommand;
            $result = mysqli_query($link,$sqlId);
            $row["locationId"] = mysqli_fetch_assoc($result);
            $id = implode("",$row["locationId"]);                   // id
            //echo $id;
              
            foreach($element["time"] as $time){
                $values =$time["elementValue"][0]["value"];
                //echo $values;

                // $values = $element["time"][0]["elementValue"][0]["value"];           // value
    
                if($elementName == "PoP12h" || $elementName == "PoP6h" || $elementName == "Wx" || $elementName == "WeatherDescription") {
                    $startTime = $time["startTime"];
                    $endTime = $time["endTime"];
                    $sql =<<<sqlCommand
                        INSERT INTO $elementName (locationId, startTime, endTime, `value`)
                        VALUES ($id,'$startTime','$endTime','$values');
                    sqlCommand;
                    //echo $startTime;
                }
                else{
                    $dataTime = $element["time"][0]["dataTime"];
                    $sql =<<<sqlCommand
                        INSERT INTO $elementName (locationId, dataTime, `value`)
                        VALUES ($id,'$dataTime','$values');
                    sqlCommand;
                }
               mysqli_query($link,$sql);
            }

            
    
            
    
            // foreach($element["time"] as $time){
            //     //echo $time["startTime"]."<br>";
            //     $values = $time["value"];
            //     if($elementName == "Wx" || "WeatherDescription" || "PoP6h" || "PoP12h"){
            //         $startTime = $time["startTime"];
            //         $endTime = $time["endTime"];
            //         $sql =<<<sqlCommand
            //             INSERT INTO $elementName (locationId, startTime, endTime, `value`)
            //             VALUES ($id,'$startTime','$endTime','$values');
            //         sqlCommand;
            //     }
            //     else{
            //         $dataTime = $time["dataTime"];
            //         $sql =<<<sqlCommand
            //             INSERT INTO $elementName (locationId, dataTime, `value`)
            //             VALUES ($id,'$dataTime','$values');
            //         sqlCommand;
            //     }                        
            //     //mysqli_query($link,$sql);            
            // }
            
        }
    }    
}
catch(Exception $e){
    echo "error";
}

?>