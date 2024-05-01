<?php require_once('./0104-1/Connections/conn_sql.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_Recordset1 = "-1";
if (isset($_SESSION['OrderID'])) {
  $colname_Recordset1 = $_SESSION['OrderID'];
}
//mysql_select_db($database_conn_sql, $conn_sql);
$query_Recordset1 ="SELECT * FROM orders ORDER BY OrderID DESC";
$Recordset1 = mysqli_query( $conn_sql,$query_Recordset1) or die('failed'());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script type="text/JavaScript">
<script src="js/code.jquery.com_jquery-3.7.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/member.css">
<style>
    body{
        background-color: #FFF8E3;
    }
    .inside{
        background-color: #F3D7CA;
    }
    .frame{
        margin-top: 10%;
    }
    h3{
        font-weight: bolder;
        color: #CE5A67;
    }
    .btn{
        background-color: #CE5A67;
        color: white;
        letter-spacing: 3px;
    }
    .bg-img{
      background-image: url(./images/pinkbackground.jpg);
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
      background-size: cover;
    }
    .bg{
      background-color:#FFF6F6;
    }
    .title-font{
      color: #CE5A67;
    }
    .font-weight{
      font-weight: bolder;
    }
</style>
<body class="bg-img">
    <div class="container bg img-responsive frame">
        <div class="row">
    <tr valign="top">
	   <td class="mainbg"><h3 class="text-center title-font">芒果園線上購物</h3>
        <h3 class="text-center"><p>感謝您的光臨，您已經成功的完成訂購程序。</p><p>我們將儘快把您選購的商品郵寄給您！</p><p> 再次感謝您的支持。<p><br></p></p><p>您的訂單編號為：<?php echo $row_Recordset1['OrderID']; ?></p>
         <p>訂單編號已寄送至您的信箱，</p><p>您可以使用這個編號回到網站中查詢訂單的詳細內容。</p><br></h3>	     
        </td>
        </tr>
        <table border="0" align="center" cellpadding="4" cellspacing="0">
        <td><input type="button" name="Submit" value="回首頁" class="btn img-responsive" onclick="window.location='index.php'"></td>
        </table>
        </div>
    </div>      
</body>
</html>
<?php
mysqli_free_result($Recordset1);
?>
