<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    header("Content-Type:text/html; charset=utf-8");

    $link = new PDO("mysql:host=localhost; dbname=112-3-1;charset=utf8", "112-3-1", "Qz1NUWo7");

    $name=$_POST['text'];
    $tel=$_POST['phone'];
    $e_mail=$_POST['email'];
    $address=$_POST['url'];
    $pwd=$_POST['password'];

    $sql = "insert into member(name,tel,e_mail,address, pwd) values(:name, :tel, :e_mail, :address, :pwd)";
    $stmt=$link->prepare($sql);
    $stmt->bindPARAM(":name", $name, PDO::PARAM_STR);
    $stmt->bindPARAM(":tel", $tel, PDO::PARAM_STR);
    $stmt->bindPARAM(":e_mail", $e_mail, PDO::PARAM_STR);
    $stmt->bindPARAM(":address", $address, PDO::PARAM_STR);
    $stmt->bindPARAM(":pwd", $pwd, PDO::PARAM_STR);
    

    // $sql = "insert into member(name, password, age) values(?, ?, ?)";
    // $stmt=$link->prepare($sql);
    // $stmt->bindPARAM(1, $name, PDO::PARAM_STR);
    // $stmt->bindPARAM(2, $password, PDO::PARAM_STR);
    // $stmt->bindPARAM(3, $age, PDO::PARAM_STR);

    $result = $stmt->execute();
    if($result){
        echo "<script>alert('完成新增會員資料')
        this.location='member.php'
        </script>";
    }else{
        echo "<script>alert('未完成')
        this.location='member_in.php'
        </script>";
    }
    $link=null;
    ?>
</body>
</html>