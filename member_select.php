<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    header("Content-Type:text/html; charset-utf-8");

    $link = new PDO("mysql:host=localhost; dbname=112-3-1;charset=utf8", "112-3-1", "Qz1NUWo7");
    // $link->exec('set names utf8'); //prior to PHP 5.3.6 must do this way

    $result = $link->query("select * from member");

    echo "共有".$result->rowCount()."筆記錄<br />";

    while($rs=$result->fetch(PDO::FETCH_ASSOC)){ //FETCH_ASSOC PDO::FETCH_BOTH, PDO::FETCH_NUM
        echo "姓名: ".$rs['name']." ";
        echo "電話: ".$rs['tel']." ";
        echo "e_mail: ".$rs['e_mail']." ";
        echo "地址: ".$rs['address']." ";
        echo "密碼: ".$rs['pwd']." <br> ";
       
    }
l;.
    // 重複使用資料
    // $resultAll=$result->fetchAll();
    // foreach($resultAll as $rs){
    //     echo "姓名: ".$rs['name']." ";
    //     echo "密碼: ".$rs['password']." ";
    //     echo "年齡: ".$rs['age']."<br>";
    // }

    $result->closeCursor();
    $link=null;
    ?>
</body>
</html>