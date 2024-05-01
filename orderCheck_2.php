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

if (isset($_GET['OrderID']) && $_GET['OrderID'] != '' && isset($_GET['CustomerEmail']) && $_GET['CustomerEmail'] != '') {
  //mysql_select_db($database_connSQL, $connSQL);
  $query_Recordset1 = "SELECT * FROM orders WHERE OrderID = ".$_GET['OrderID']." AND CustomerEmail='".$_GET['CustomerEmail']."'";
  $Recordset1 = mysqli_query($conn_sql,$query_Recordset1) or die('failed');
  $row_Recordset1 = mysqli_fetch_assoc($Recordset1);
  $totalRows_Recordset1 = mysqli_num_rows($Recordset1);

  //mysql_select_db($database_connSQL, $connSQL);
  $query_Recordset2 = "SELECT * FROM list_detail WHERE OrderID = ".$_GET['OrderID'];
  $Recordset2 = mysqli_query($conn_sql,$query_Recordset2) or die('failed');
  $row_Recordset2 = mysqli_fetch_assoc($Recordset2);
  $totalRows_Recordset2 = mysqli_num_rows($Recordset2);
} 

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!--Fireworks 8 Dreamweaver 8 target.  Created Sat Jul 22 16:15:20 GMT+0800 2006-->
<link href="style.css" rel="stylesheet" type="text/css">
<script src="js/code.jquery.com_jquery-3.7.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/contact.css">
<style>
    .p-font{
        color:red;
        font-weight: bolder;
    }
</style>
</head>
<body class="bg-color">
       <!-- navbar -->
       <nav class="navbar navbar-default">
    <div class="container-fluid margin-left">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-left" href="index.php"><img src="images/logo-1-1.png"></a>
        <a class="navbar-left" href="index.php" style="margin-top: 3px;"><img src="images/logo-1-2-1.png"></a>
        <!-- <a class="navbar-brand" href="#">開心芒果園</a> -->
      </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
                     <div class="collapse navbar-collapse" id="menu1">
            <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php" class="font-size" >首頁</a></li>
            <li><a href="contact.php"  class="font-size">果園介紹</a></li>
            <li><a href="things.php"  class="font-size">芒果二三事</a></li>
            <li><a href="product.php"  class="font-size">商品專區</a></li>
            <li><a href="shopcar.php" class="font-size">購物車</a></li>
            <li><a href="orderCheck_2.php" class="font-size">訂單查詢</a></li>
           <?php
                if(isset($_SESSION['level'])){
                  echo '<li><a href="member_logout.php" class="font-size">登出</a></li> ';
                }else{
                  echo '<li><a href="member.php" class="font-size">會員登入</a></li> ';
                }
                ?> 
            </li>
            <li class="dropdown">
              <a href="#" class="font-size dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">作品集<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="art.php" class="font-size">電子書</a></li>
                  <!-- <li><a href="./videos/index.html" class="font-size">影片展示</a></li> -->
                </ul>
            </li> 
            <li><a href="./0104-1/m_login.php"  class="font-size">後臺管理</a></li>  
        </div>
    </div>
 </nav>
    <table width="720" border="0" align="center" cellpadding="0" cellspacing="0">
<!-- fwtable fwsrc="dwshop.png" fwbase="shopCart.jpg" fwstyle="Dreamweaver" fwdocid = "705028150" fwnested="1" -->
  <tr>
   <td background="images/shopCart_r3_c1.jpg"><table align="left" border="0" cellpadding="20" cellspacing="0" width="720">
	  <tr valign="top">	        
            <p><strong>請輸入查詢訂單資料</strong></p>
            <?php if (@$totalRows_Recordset1 == 0) { // Show if recordset empty ?>
              <?php /*start inputVar script*/ if (isset($_GET['OrderID'])){ ?>
                <table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF" class="blackbox">
                  <tr class="head2">
                    <td>資訊</td>
                  </tr>
                  <tr>
                    <td align="center"><p class="p-font"> 請您輸入查詢訂單的相關資訊。對不起，資料庫中並沒相關的資訊，請重新輸入。 </p></td>
                  </tr>
                </table>
                  <?php } /*end inputVar script*/ ?>
              <form action="orderCheck_2.php" method="get" name="form1" onSubmit="YY_checkform('form1','OrderID','#q','0','請輸入訂單編號。','CustomerEmail','#S','2','請輸入電子郵件。');return document.MM_returnValue">
                <table width="100%" border="0" align="center" cellpadding="10" cellspacing="0">
                  <tr>
                    <td width="60">訂單編號</td>
                    <td><input name="OrderID" type="text" class="normalinput" id="OrderID" size="10"></td>
                    <td width="90">客戶電子郵件</td>
                    <td><input name="CustomerEmail" type="text" class="normalinput" id="CustomerEmail"></td>
                    <td><input type="submit" name="Submit3" value="送出"></td>
                  </tr>
                </table>
              </form>
              <?php } // Show if recordset empty ?>
            <p>&nbsp;</p>
            <?php if (@$totalRows_Recordset1 > 0) { // Show if recordset not empty ?>
  <p><strong>訂單編號：<font color="#FF0000"></font></strong><?php echo $row_Recordset1['OrderID']; ?></p>
              <table width="100%" border="0" cellpadding="4" cellspacing="0">
                <tr class="head3">
                  <td align="center" bgcolor="#FFFFFF">商品名稱</td>
                  <td width="80" align="center" bgcolor="#FFFFFF">單價</td>
                  <td width="80" align="center" bgcolor="#FFFFFF">數量</td>
                  <td width="150" align="center" bgcolor="#FFFFFF">金額</td>
                </tr>
                <?php 
                $GrandTotal = 0;
                do { 
                  $GrandTotal = $GrandTotal + $row_Recordset2['quantity'] * $row_Recordset2['price'];
                  ?>
                  <tr>
                    <td align="left" bgcolor="#FFFFFF"><?php echo $row_Recordset2['productname']; ?></td>
                    <td width="80" align="center" bgcolor="#FFFFFF">$ <?php echo $row_Recordset2['price']; ?></td>
                    <td width="80" align="center" bgcolor="#FFFFFF"><?php echo $row_Recordset2['quantity']; ?></td>
                    <td width="150" align="center" bgcolor="#FFFFFF"><strong>$ <?php echo $row_Recordset2['quantity']* $row_Recordset2['price']; ?></strong></td>
                  </tr>
                  <?php } while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2)); ?>
                <tr>
                  <td colspan="3" align="left" bgcolor="#FFFFFF" class="upline"><strong>小計</strong></td>
                  <td width="150" align="center" bgcolor="#FFFFFF" class="upline"><strong>$ <?php echo $GrandTotal; ?></strong></td>
                </tr>
                <tr>
                  <td colspan="3" align="left" bgcolor="#FFFFFF" class="upline"><strong>運費</strong> (固定運費 150 元) </td>
                  <td width="150" align="center" bgcolor="#FFFFFF" class="upline"><strong>$ 150</strong></td>
                </tr>
                <tr>
                  <td colspan="3" align="left" bgcolor="#FFFFFF" class="downline"><strong>總計</strong></td>
                  <td width="150" align="center" bgcolor="#FFFFFF" class="downline"><strong><font color="#FF0000">$ <?php echo $row_Recordset1['GrandTotal'] ; ?></font></strong></td>
                </tr>
              </table>
              <br>
              <br>
              <p><strong>客戶資訊</strong></p>
              <table width="100%" border="0" cellspacing="0" cellpadding="4">
                <tr class="head3">
                  <td width="100" align="center">資訊</td>
                  <td>內容</td>
                </tr>
                <tr>
                  <td width="100" align="center" bgcolor="#FFFFFF"><strong>姓名</strong></td>
                  <td bgcolor="#FFFFFF"><?php echo $row_Recordset1['CustomerName']; ?></td>
                </tr>
                <tr>
                  <td width="100" align="center" bgcolor="#FFFFFF"><strong>聯絡電話</strong></td>
                  <td bgcolor="#FFFFFF"><?php echo $row_Recordset1['CustomerEmail']; ?></td>
                </tr>
                <tr>
                  <td align="center" bgcolor="#FFFFFF"><strong>住址</strong></td>
                  <td bgcolor="#FFFFFF"><?php echo $row_Recordset1['CustomerAddress']; ?></td>
                </tr>
                <tr>
                  <td align="center" bgcolor="#FFFFFF"><strong>電子郵件</strong></td>
                  <td bgcolor="#FFFFFF"><?php echo $row_Recordset1['CustomerPhone']; ?></td>
                </tr>
                <tr>
                  <td align="center" bgcolor="#FFFFFF"><strong>付款方式</strong></td>
                  <td bgcolor="#FFFFFF"><?php echo $row_Recordset1['paytype']; ?></td>
                </tr>
              </table>
              <?php } // Show if recordset not empty ?>
<hr size="1" noshade>
         <table border="0" align="center" cellpadding="4" cellspacing="0">
           <tr>
             <td><input type="button" name="Submit" value="回到首頁" onclick="window.location='index.php'"></td>
           </tr>
         </table>
         <p>&nbsp;</p></td>
