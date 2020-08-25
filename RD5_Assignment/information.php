<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-C0032-001?Authorization=CWB-3513982B-8566-4A56-B15B-2CC184465D30");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_HEADER, 0); 

$output = curl_exec($ch);
echo $output;
curl_close($ch);

?>