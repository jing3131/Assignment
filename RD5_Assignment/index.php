<?php
$type=0;                // 判斷狀況
require("config.php");

if(isset($_POST["updatebtn"])){
    //require("databaseUpdate.php");
}

if(isset($_GET["twoDaysbtn"])){
    //echo $_GET["locationName"];
    $locationId = $_GET["locationName"];
    
    $sql = <<<sqlCommand
        SELECT l.locationName, wdn.startTime, wdn.endTime, wdn.value FROM location as l
        JOIN WeatherDescription AS wdn ON l.locationId = wdn.locationId
        WHERE l.locationId = $locationId;
    sqlCommand;
    $result = mysqli_query($link,$sql);
    $type=1;
    //print_r($result);
}
else{
    // $sql = <<<sqlCommand
    //     SELECT l.locationName, wdn.startTime, wdn.endTime, wdn.value FROM location as l
    //     JOIN WeatherDescription AS wdn ON l.locationId = wdn.locationId
    // sqlCommand;
    // $result = mysqli_query($link,$sql);
}

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

    <div class="container"> 
        <form action="" method="post">
            <button type="submit" name="updatebtn">更新資料庫</button> <br>
        </form>

        <br>

        <form action="index.php?locationName=" method="">                

            <label for="locationName">選擇地區</label>
            <select name="locationName" id="locationName">
                <option value=""></option>
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

            <button type="submit" name="twoDaysbtn">未來兩天天氣預報</button>
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
                <td>
                    <?php switch($type){ 
                        case 1:
                            echo "天氣狀況"; break;
                        case 2:
                            echo "降雨機率"; break;
                        case 3:
                            echo "最高溫度"; break;
                        case 4:
                            echo "最低溫度"; break;
                        case ５:
                            echo "體感溫度"; break;
                    } ?>
                </td>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)){ ?>
                <?php $today = date("Y-m-d"); ?>
                <?php if(strpos("XXX".$row["endTime"],"$today")) { ?>           <!-- 只顯示出今天天氣 -->
                    <tr>
                        <td width="10px"><?= $row["locationName"] ?></td>
                        <td width="10px"><?= $row["startTime"] ?></td>
                        <td width="10px"><?= $row["endTime"] ?></td>
                        <td width="100px"><?= $row["value"] ?></td>
                    </tr>
                <?php } ?>                                    
            <?php } ?>
        </table>
    </div>
    
</body>
</html>