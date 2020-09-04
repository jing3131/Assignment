<?php
$type;                // 判斷狀況
$timeH;
$locationId = 0;


require("config.php");

if (isset($_POST["updatebtn"])) {
    require("decodeJson.php");
}

if (isset($_GET["oneDaysbtn"])) {

    //echo $_GET["locationName"];

    $timeH = strtotime(date("Y-m-d-h"));
    $locationId = $_GET["locationName"];

    require("sqlWeather.php");
    //print_r($result);
} else if (isset($_GET["twoDaysbtn"])) {
    $timeH = strtotime(date("Y-m-d-h") . "+24 hour ");            // 現在時間+24小時
    //echo $timeH;
    $locationId = $_GET["locationName"];

    require("sqlWeather.php");
} else if (isset($_GET["weekbtn"])) {
    $type = 1;                                                  // 一週天氣預報 type = 1
    $timeH = strtotime(date("Y-m-d-h") . "+6 day ");
    $locationId = $_GET["locationName"];

    //require("sqlWeather.php");
    $sql = <<<sqlCommand
        SELECT l.locationName, wdn.startTime, wdn.endTime, wdn.value FROM location as l
        JOIN WeatherDescription AS wdn ON l.locationId = wdn.locationId
        WHERE l.locationId = $locationId
        ORDER BY endTime DESC
    sqlCommand;
    $result = mysqli_query($link, $sql);
} else {
    $timeH = strtotime(date("Y-m-d-h"));

    require("sqlWeather.php");
}



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

    <div class="container">
        <br>
        <div class="row">
            <form action="" method="post">
                <button type="submit" name="updatebtn" class="btn btn-outline-dark">更新資料庫</button> <br>
            </form>
        
            <form action="index.php?locationName=" method="">

                <label for="locationName" style="margin:10px">選擇地區</label>
                <select name="locationName" id="locationName" style="margin:10px">
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

                <button type="submit" name="oneDaysbtn" class="btn btn-outline-light text-dark">6小時天氣預報</button>
                <button type="submit" name="twoDaysbtn" class="btn btn-outline-light text-dark">明天天氣預報</button>
                <button type="submit" name="weekbtn" class="btn btn-outline-light text-dark">一週天氣預報</button>

            </form>
            
            <div class="col-1">&nbsp;</div>

            <div class="col-10">

                <div class="row">


                    <div class="col-10">

                        <table class="table table-hover">
                            <!-- style="border:5px #FFAC55 solid;" -->
                            <tr class="table-info">
                                <td>地區</td>
                                <td>開始時間</td>
                                <td>結束時間</td>
                                <td>天氣狀況</td>
                            </tr>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <?php $endTime = strtotime($row["endTime"]); ?>
                                <?php if (($endTime - $timeH > 21600) && ($endTime - $timeH < 61200)) { ?>
                                    <tr>
                                        <td width="10px"><?= $row["locationName"] ?></td>
                                        <td width="10px"><?= $row["startTime"] ?></td>
                                        <td width="10px"><?= $row["endTime"] ?></td>
                                        <td width="100px"><?= $row["value"] ?></td>
                                    </tr>
                                    <?php $i = 0; ?>
                                <?php } else if ($type == 1 && strpos($row["endTime"], "18:00")) { ?>
                                    <!--包含-->
                                    <tr>
                                        <td width="10px"><?= $row["locationName"] ?></td>
                                        <td width="10px"><?= $row["startTime"] ?></td>
                                        <td width="10px"><?= $row["endTime"] ?></td>
                                        <td width="100px"><?= $row["value"] ?></td>
                                    </tr>
                                    <?php $i++ ?>
                                    <?php if ($i == 6) break;  // 取6筆資料出來 
                                    ?>
                                <?php } ?>
                            <?php } ?>
                        </table>
                    </div>

                    <div class="col-1">
                        <div class="card" style="width:300px">
                            <div class="card-header bg-info">累計雨量</div>
                            <img class="card-img-top" src="image/<?= $locationId ?>.jpg">
                            <?php
                            $sql = <<<sqlCommand
                                select type, rainMm, locatedName from rain
                                where locationId = $locationId
                                limit 6;
                            sqlCommand;
                            $result = mysqli_query($link, $sql);

                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row["type"] == "RAIN") {
                                    $mm = $row["rainMm"];
                                    $loc = $row["locatedName"];
                                    echo "<div> - $loc</div>
                                    <div>24小時累計降雨量: $mm mm</div>";
                                } else {
                                    $mm = $row["rainMm"];
                                    $loc = $row["locatedName"];
                                    echo "<div>當前降雨量: $mm mm</div> <hr>";
                                }
                            }
                            ?>
                            <!-- <img class="card-img-top" src="image/<?= $locationId ?>-1.png"> -->
                            <div class="card" style="width:300px">
                            <div class="card-header bg-secondary">
                                <?php  
                                    $sqlName = "select locationName from location where locationId = $locationId";
                                    $resultName = mysqli_query($link,$sqlName);
                                    $row["locationName"] = mysqli_fetch_assoc($resultName);
                                    echo implode("",$row["locationName"]);
                                ?>
                            </div>
                            <div class="card-body">                                
                                現在天氣：<hr>
                                <?php
                                    $sql = <<<sqlCommand
                                        SELECT l.locationName, wdn.startTime, wdn.endTime, wdn.value FROM location as l
                                        JOIN WeatherDescription AS wdn ON l.locationId = wdn.locationId
                                        WHERE l.locationId = $locationId;
                                    sqlCommand;
                                    $resultNow = mysqli_query($link,$sql); 
                                    $now = date("Y-m-d-m-s");
                                    while($row = mysqli_fetch_assoc($resultNow)){
                                        if($now > $row["startTime"] && $now < $row["endTime"]){
                                            echo $row["value"];
                                            break;
                                        }                                    
                                    }
                                ?>
                            </div>
                        </div>                        
                    </div>

                    
                </div>

            </div>
            <div class="col-1">

            </div>
        </div>
    </div>
    </div>



</body>

</html>