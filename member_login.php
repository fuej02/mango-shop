<?php
session_start();
header("Content-Type:text/html; charset-utf-8");
$link = new PDO("mysql:host=localhost; dbname=112-3-1;charset=utf8", "112-3-1", "Qz1NUWo7");

$tel=$_POST['phone'];
$pwd=$_POST['password'];
$sql = "select * from member where tel = :tel";
$stmt=$link->prepare($sql);
$stmt->bindPARAM(":tel", $tel, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll();

if($result[0]==null){
    echo "<script>
    alert('手機輸入錯誤');
    this.location = 'member.php';
    </script>";
}else{
    if($result[0]['pwd']==$pwd){
        $_SESSION['a_id'] = $result[0]['a_id'];
        $_SESSION['phone'] = $tel;
        $_SESSION['level'] = $result[0]['level'];
        if($_SESSION['level'] == '會員' || $_SESSION['level'] == '管理員'){
            echo "<script>
            alert('登入成功');
            this.location = 'index.php';
            </script>";
        }
    }else{
            echo "<script>
            alert('密碼錯誤');
            this.location ='member.php';
            </script>";
        }
}
?>