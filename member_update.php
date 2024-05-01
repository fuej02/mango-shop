<?php
header("Content-Type:text/html; charset-utf-8");

$link = new PDO("mysql:host=localhost; dbname=112-3-1;charset=utf8", "112-3-1", "Qz1NUWo7");

$a_id=$_POST['a_id'];
$pwd=$_POST['password'];
$pwd2=$_POST['password2'];

if($pwd != $pwd2){
    echo "<script>
    window.alert('密碼輸入不一致');
    this.location = 'alter_passwd.php';
    </script>";
}

$sql = "update member set pwd = :pwd where a_id = :a_id";
$stmt=$link->prepare($sql);
$stmt->bindPARAM(":a_id", $a_id, PDO::PARAM_STR);
$stmt->bindPARAM(":pwd", $pwd, PDO::PARAM_STR);
$result = $stmt->execute();
if($result){
    echo "<script>
    this.location = 'alter_success.php';
</script>";
}else{
    echo "<script>
    window.alert('伺服器錯誤');
    this.location = 'alter_passwd.php';
    </script>";
}


?>
