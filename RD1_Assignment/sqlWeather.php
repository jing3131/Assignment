<?php

$sql = <<<sqlCommand
    SELECT l.locationName, wdn.startTime, wdn.endTime, wdn.value FROM location as l
    JOIN WeatherDescription AS wdn ON l.locationId = wdn.locationId
    WHERE l.locationId = $locationId;
sqlCommand;
$result = mysqli_query($link,$sql); 

?>