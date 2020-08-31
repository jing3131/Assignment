<?php

session_start();
require("../config.php");
$id =$_SESSION["accountIdManager"];
$sql="select productName from product where managerId = ?";
$result = $link->prepare($sql);
$result->execute(array($id));

$n=0;
if(isset($_POST["updatebtn$n"])){
    echo $n;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <table>  
            <?php while($row = $result->fetch(PDO::FETCH_ASSOC)){ ?>
                <tr>
                    <?php  echo "<td>".$row["productName"]."</td>"; ?>            
                    <td><button type="submit" name="updatebtn<?=$n ?>">修改</button></td>
                    <td><button type="submit" name="deletebtn<?=$n ?>">刪除</button></td>
                </tr>
            <?php } $n++; ?>
            
            <!-- <tr><td>sdfsdf</td></tr> -->
        </table>
    </form>
    
</body>
</html>