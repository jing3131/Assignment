<?php
$type;                // 判斷狀況
$timeH;
$locationId =0;


require("config.php");

if(isset($_POST["updatebtn"])){
    //require("decodeJson.php");
}

if(isset($_GET["oneDaysbtn"])){
    
    //echo $_GET["locationName"];

    $timeH = strtotime(date("Y-m-d-h")); 
    $locationId = $_GET["locationName"];
     
    require("sqlWeather.php");
    //print_r($result);
}
else if(isset($_GET["twoDaysbtn"])){  
    $timeH = strtotime(date("Y-m-d-h")."+23 hour ");            // 現在時間+23小時
    //echo $timeH;
    $locationId = $_GET["locationName"];

    require("sqlWeather.php");
}
else if(isset($_GET["weekbtn"])){
    $type=1;
    $timeH = strtotime(date("Y-m-d-h")."+6 day ");
    $locationId = $_GET["locationName"];

    //require("sqlWeather.php");
    $sql = <<<sqlCommand
    SELECT l.locationName, wdn.startTime, wdn.endTime, wdn.value FROM location as l
        JOIN WeatherDescription AS wdn ON l.locationId = wdn.locationId
        WHERE l.locationId = $locationId
        ORDER BY endTime DESC
    sqlCommand;
    $result = mysqli_query($link,$sql); 
}
else{
    $timeH = strtotime(date("Y-m-d-h")); 
                        
    require("sqlWeather.php");
}

// if(isset($_GET["rain1hbtn"])){

// }

// if(isset($_GET["PoPbtn"])){
//     $locationId = $_GET["locationName"];
//     require("config.php");
//     $sql = <<<sqlCommand
//         SELECT locationName, p.startTime, p.endTime, p.parameterName FROM location as l 
//         JOIN PoP AS p ON p.locationId = l.locationId
//         WHERE l.locationId = $locationId
//     sqlCommand;
//     $result = mysqli_query($link,$sql);
//     $type =2;       
// }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="bootstrap-4.5.2-dist/css/bootstrap.css" rel="stylesheet">
</head>
<body>

    <div class="container" style="height:100px"> 

        <br>
        <form action="" method="post">
            <button type="submit" name="updatebtn">更新資料庫</button> <br>
        </form>
        <!-- <img src="image/NewTaipeiiii.jpg" style="margin-left:500px" >         -->
        

        <form action="index.php?locationName=" method=""> 

            <label for="locationName">選擇地區</label>
            <select name="locationName" id="locationName">
                <!-- <option value=""></option> -->
                <option value="0">嘉義縣</option>
                <option value="1">新北市</option>
                <option value="2">嘉義市</option>
                <option value="3">新竹縣</option>
                <option value="4">新竹市</option>
                <option value="5">臺北市</option>
                <option value="6">臺南市</option>
                <option value="7">宜蘭縣</option>
                <option value="8">苗栗縣</option>
                <option value="9">雲林縣</option>
                <option value="10">花蓮縣</option>
                <option value="11">臺中市</option>
                <option value="12">臺東縣</option>
                <option value="13">桃園市</option>
                <option value="14">南投縣</option>
                <option value="15">高雄市</option>
                <option value="16">金門縣</option>
                <option value="17">屏東縣</option>
                <option value="18">基隆市</option>
                <option value="19">澎湖縣</option>
                <option value="20">彰化縣</option>
                <option value="21">連江縣</option>
            </select>

            <button type="submit" name="oneDaysbtn">6小時天氣預報</button>
            <button type="submit" name="twoDaysbtn">明天天氣預報</button>
            <button type="submit" name="weekbtn">一週天氣預報</button>
            
            <!-- <button type="submit" name="PoPbtn">降雨機率</button>
            <button type="submit" name="MinTbtn">最低溫度</button>
            <button type="submit" name="MaxTbtn">最高溫度</button>
            <button type="submit" name="CIbtn">體感狀況</button> -->

        </form>

        <br>

       
        <table width="800px" class="table table-hover">       <!-- style="border:5px #FFAC55 solid;" -->
            <tr class="table-info">
                <td>地區</td>
                <td>開始時間</td>
                <td>結束時間</td>
                <td>天氣狀況</td>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)){ ?> 
                   <?php $endTime = strtotime($row["endTime"]); ?>
                   <?php if(($endTime - $timeH > 21600) && ($endTime - $timeH < 61200)) { ?>
                    <tr>
                        <td width="10px"><?= $row["locationName"] ?></td>
                        <td width="10px"><?= $row["startTime"] ?></td>
                        <td width="10px"><?= $row["endTime"] ?></td>
                        <td width="100px"><?= $row["value"] ?></td>
                    </tr>
                    <?php $i=0; ?>
                <?php } else if($type==1 && strpos($row["endTime"],"18:00")){ ?> 
                    <!--包含-->
                    <tr>
                        <td width="10px"><?= $row["locationName"] ?></td>
                        <td width="10px"><?= $row["startTime"] ?></td>
                        <td width="10px"><?= $row["endTime"] ?></td>
                        <td width="100px"><?= $row["value"] ?></td>
                    </tr>
                    <?php $i++ ?>
                    <?php if($i == 6) break;  // 取6筆資料出來 ?>
                <?php } ?>
            <?php } ?>
        </table>       
        

        <div class="row">
            <div class="card" style="width:300px">
                <div class="card-header bg-info">累計雨量</div>
                <img class="card-img-bottom" src="image/<?= $locationId ?>.jpg" >
                <?php 
                    $sql=<<<sqlCommand
                        select type, rainMm, locatedName from rain
                        where locationId = $locationId
                        limit 6;
                    sqlCommand;
                    $result = mysqli_query($link,$sql);
                    
                    while($row = mysqli_fetch_assoc($result)){
                        if($row["type"] == "HOUR_24"){
                            $mm = $row["rainMm"]; $loc = $row["locatedName"];
                            echo "<div> - $loc</div>
                                <div>24小時累計降雨量: $mm mm</div>";                            
                        }
                        else{
                            $mm = $row["rainMm"]; $loc = $row["locatedName"];
                            echo "<div>當前降雨量: $mm mm</div> <hr>";  
                        }
                    }
                ?>
            </div>

            <div class="card" style="width:400px " >
                <div class="card-header bg-info">地理位置</div>
                <img class="card-img-bottom" src="image/<?=$locationId?>-1.png" >
            </div>
        </div>
    </div>

    
    
</body>
</html>