<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-D0047-089?Authorization=CWB-3513982B-8566-4A56-B15B-2CC184465D30");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_HEADER, 0); 

$jsondata = curl_exec($ch);
// echo $jsondata;
curl_close($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://opendata.cwb.gov.tw/api/v1/rest/datastore/O-A0002-001?Authorization=CWB-3513982B-8566-4A56-B15B-2CC184465D30");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_HEADER, 0); 

$jsondataRain = curl_exec($ch);
curl_close($ch);
//echo $jsondataRain;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-D0047-091?Authorization=CWB-3513982B-8566-4A56-B15B-2CC184465D30");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_HEADER, 0); 

$jsondataWeek = curl_exec($ch);
curl_close($ch);

?>