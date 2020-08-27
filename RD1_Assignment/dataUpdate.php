<?php

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
    
                if($elementName == "WeatherDescription") {      // $elementName == "PoP12h" || $elementName == "PoP6h" || $elementName == "Wx" || 
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
        }

?>