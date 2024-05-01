<?php
ini_set("SMTP","smtp.gmail.com");
ini_set("smtp_port","587");
ini_set("sendmail_from","a0960120181@gmail.com");
ini_set("sendmail_path","sendmail\sendmail.exe\ -t");

header("Content-Type:text/html; charset-utf-8");

    $link = new PDO("mysql:host=localhost; dbname=112-3-1;charset=utf8", "112-3-1", "Qz1NUWo7");
    // $link->exec('set names utf8'); //prior to PHP 5.3.6 must do this way

    $e_mail=$_POST['email'];

    $sql="select a_id from member where e_mail=:e_mail";
    $stmt=$link->prepare($sql);
    $stmt->bindPARAM(":e_mail", $e_mail, PDO::PARAM_STR);
    $stmt->execute();
    $result=$stmt->fetchAll();
    $id = $result[0]["a_id"];//陣列

    // echo "共有".$result->rowCount()."筆記錄<br />";

    // while($rs=$result->fetch(PDO::FETCH_ASSOC)){ //FETCH_ASSOC PDO::FETCH_BOTH, PDO::FETCH_NUM
    //     echo "姓名: ".$rs['name']." ";
    // }

mb_internal_encoding('UTF-8');
$to = $_POST['email'];
$subject = mb_encode_mimeheader('【快樂芒果園】修改密碼','UTF-8');
$message = " 點擊地址前往修改密碼    http://localhost:3000/alter_passwd.php?id=$id";
$header = "MIME-VERsion: 1.0\r\n";
$header .= "Content-type: text/html; charset=UTF-8\r\n";
$header .= "From: " . "=?UTF-8?B?" . base64_encode("a0960120181@gmail.com") . "?=";
$header .= "&amp;lt;a0960120181@gmail.com&amp;gt;";
// $headers = "From: a0960120181@gmail.com\r\n";

if (mail($to, $subject, $message, $header)) {
echo "寄件成功!請至信箱查看";
} else {
echo "寄件失敗!請確認信箱是否正確";
}
?>