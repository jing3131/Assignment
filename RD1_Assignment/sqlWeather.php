<?php

function getWeather($link, $locationId){                      // 取得天氣資訊(weatherDescription)
    $sql = <<<sqlCommand
        SELECT l.locationName, wdn.startTime, wdn.endTime, wdn.value FROM location as l
        JOIN WeatherDescription AS wdn ON l.locationId = wdn.locationId
        WHERE l.locationId = $locationId;
    sqlCommand;
    $result = mysqli_query($link,$sql); 

    return $result;
}

function getWeekWeather($link, $locationId){                  // 取得一週的天氣資訊(weatherdescription)
    $sql = <<<sqlCommand
        SELECT l.locationName, wdn.startTime, wdn.endTime, wdn.value FROM location as l
        JOIN WeatherDescription AS wdn ON l.locationId = wdn.locationId
        WHERE l.locationId = $locationId
        ORDER BY endTime DESC
    sqlCommand;
    $result = mysqli_query($link, $sql);

    return $result;
}



?>