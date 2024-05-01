<?php 
require_once('cart/EDcart.php');
session_start();
$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 
 ?>
 <?php
 if ($cart->itemcount == 0){
    header("Location:product.php");
 }
 ?>
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
  
//mysql_select_db($database_conn_sql, $conn_sql);
$query_Recordset1 = "SELECT * FROM orders where OrderID = " .$_GET['OrderID'];
$Recordset1 = mysqli_query($conn_sql,$query_Recordset1) or die('failed');
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["MM_insert"])) {

  $grandtotal = 0 + 150;
  
  foreach($cart->get_contents() as $item) {
    $iteminfo = $item['info'];
    $itemprice = $item['price'];
    $itemqtys = $item['qty'];
    $total = $item["subtotal"];
    $itempic = $item["pic"];
    $OrderID = $_POST['id'];

    $grandtotal = $grandtotal + (int)$total;

  $sql = "INSERT INTO list_detail (productname, price, quantity, totalprice, productimage, OrderID)
          VALUES ('$iteminfo', '$itemprice', '$itemqtys', '$total', '$itempic', '$OrderID')";

  $Result1 = mysqli_query($conn_sql, $sql) or die('failed');

  }

  $sql2 = "UPDATE orders SET `GrandTotal` = '$grandtotal' WHERE `OrderID` = '$OrderID'";
  $Result2 = mysqli_query($conn_sql, $sql2) or die('failed');
  // $id = mysqli_insert_id($conn_sql);

  include_once("sendmail-number.php");

  $insertGoTo = "cartFinish.php".$id;
  if (isset($_SERVER['QUERY_STRING'])) {
      $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
      $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
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
        background-color: #FFF8E3;
    }
    .frame{
        margin-top: 6%;
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
        <h3 class="text-center">訂單確認</h3>
	     <form action="" name="form1" method="POST">
	       <p><strong>訂單內容</strong></p>
	       <table width="100%" border="0" cellpadding="4" cellspacing="0">
             <tr class="head3">
               <td align="center" bgcolor="FFF4E0">商品名稱</td>
               <td width="80" align="center" bgcolor="FFF4E0">單價</td>
               <td width="80" align="center" bgcolor="FFF4E0">數量</td>
               <td width="150" align="center" bgcolor="FFF4E0">金額</td>
             </tr>
             <?php if($cart->itemcount > 0) {
                foreach($cart->get_contents() as $item) {
            ?>    
<tr>
               <td align="center" bgcolor="FFF4E0" color="orange"><font color="#EC9F43" size="3" class="font-weight">&nbsp;<input name="itemid[]" type="hidden" id="itemid[]" value="<?php echo $item['id'];?>"><?php echo $item['info'];?></font></td>
               <td width="80" align="center" bgcolor="FFF4E0">$<?php echo $item['price'];?></td>
               <td width="80" align="center" bgcolor="FFF4E0">&nbsp;<?php echo $item['qty'];?></td>
               <td width="150" align="center" bgcolor="FFF4E0"><strong>$ <?php echo $item['subtotal'];?></strong></td>
             </tr>
             <?php
            }
    }
    ?>
<tr>
               <td colspan="3" align="left" bgcolor="FFF4E0" class="upline"><strong>小計</strong></td>
               <td width="150" align="center" bgcolor="FFF4E0" class="upline"><strong>$ <?php echo $cart->total;?></strong></td>
             </tr>
             <tr>
               <td colspan="3" align="left" bgcolor="FFF4E0" class="upline"><strong>運費</strong></td>
               <td width="150" align="center" bgcolor="FFF4E0" class="upline"><strong>$ <?php echo $cart->deliverfee;?>  </strong></td>
             </tr>
             <tr>
             <td colspan="3" align="left" bgcolor="FFF4E0" class="downline"><strong>總計</strong></td>
             <td width="150" align="center" bgcolor="FFF4E0" class="downline"><strong><font color="#FF0000">$ <?php echo $cart->grandtotal;?></font></strong></td>
             </tr>
           </table>
            <p>&nbsp;</p>
            <p><strong>客戶資訊</strong></p>
            <tr class="head3">
            <table width="100%" border="0" cellspacing="0" cellpadding="4">
            <?php
            
            ?>
              <tr class="head3">
                <td width="100" align="center">資訊</td>
                <td align="center">內容</td>
              </tr>
              <tr>
                <td width="100" align="center" bgcolor="FFF4E0"><strong>姓名</strong></td>
                <td bgcolor="FFF4E0" align="center"><?php echo $row_Recordset1['CustomerName']; ?></td>
              </tr>
              <tr>
                <td width="100" align="center" bgcolor="FFF4E0"><strong>手機</strong></td>
                <td bgcolor="FFF4E0" align="center"><?php echo $row_Recordset1['CustomerPhone']; ?></td>
              </tr>
              <tr>
                <td align="center" bgcolor="FFF4E0"><strong>信箱</strong></td>
                <td bgcolor="FFF4E0" align="center"><?php echo $row_Recordset1['CustomerEmail']; ?></td>
              </tr>
              <tr>
                <td align="center" bgcolor="FFF4E0"><strong>地址</strong></td>
                <td bgcolor="FFF4E0" align="center"><?php echo $row_Recordset1['CustomerAddress']; ?></td>
              </tr>
              <tr>
                <td align="center" bgcolor="FFF4E0"><strong>付款方式</strong></td>
                <td bgcolor="FFF4E0" align="center"><?php echo $row_Recordset1['paytype']; ?></td>
              </tr>
            </table>
           <p>&nbsp;</p>
           <table border="0" align="center" cellpadding="4" cellspacing="0">
              <tr>
                <td><input type="button" name="Submit" value="繼續購物" class="btn img-responsive" onclick="window.location='product.php'">&nbsp;&nbsp;</td>
                <td><input type="button" name="Submit4" value="修改購物車內容" class="btn img-responsive"  onclick="window.location='shopcar.php'">&nbsp;&nbsp;</td>
                <td><input type="submit" name="Submit2" value="確認訂單" class="btn img-responsive"></td>
                <input type="hidden" name="MM_insert" value="form1">
                <input type="hidden" name="id" value="<?php echo $_GET['OrderID'];?>">
              </tr>
            </table>
	     </form>	     
          </td>
    </div>
    </div>      
</body>
</html>
<?php
mysqli_free_result($Recordset1);
?>
