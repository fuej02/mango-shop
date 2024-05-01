<?php require_once('Connections/conn_sql.php'); ?>
<?php require_once('../cart/EDcart.php');
session_start();
$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 
 ?>
  <?php
 $cart->deliverfee =150;
 ?>
 <?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "m_login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "m_login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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
$query_Recordset1 = "SELECT * FROM list_detail where OrderID = " .$_GET['OrderID'];
$Recordset1 = mysqli_query($conn_sql,$query_Recordset1) or die('failed');
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

$totalprice = 0 + 150;

// 添加新的商品細節
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_detail"])) {
//     $orderID = $_POST["orderID"];
//     $productID = $_POST["productID"];
//     $productName = $_POST["productName"];
//     $price = $_POST["price"];
//     $quantity = $_POST["quantity"];
//     $productImage=$_POST['productimage'];
//     $totalPrice = $price * $quantity;

//     $sql = "INSERT INTO list_detail (OrderID, productid, productname, price, quantity, totalprice, productimage)
//             VALUES ('$orderID', '$productID', '$productName', '$price', '$quantity', '$totalPrice', '$productImage')";

//     if ($conn->query($sql) === TRUE) {
//         echo "商品細節添加成功";
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }
// }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/JavaScript">
<script scr="js/code.jquery.com_jquery-3.7.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/member.css">
    <style type="text/css">
h1 {
	text-align: center;
}
body{
    background-color: #F8E9AD;
}
.border_style{
  border: 1px solid;
  border-color: #96616b;
}
.text_height{
  margin-top: 30px;
  margin-bottom: 25px;
  font-size: 32px; 
  font-weight: bold;
}
.head3{
    padding-right:500px;
}
.box{
    width:40%;
    color: #888;
    line-height: 80px;
    background-color: #FFF8E3;
    border-radius: 3px;
    margin: 0 auto;
    text-align: center;
    margin-top:20px;
    font-size:20px;
    }
</style>
</head>
<body>
<h1 class="text_height"><font face="微軟正黑體">訂單細節</font></h1>
    <table width="1412" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr class="text-center">
    <th width="120" height="50" align="center" bgcolor=" #FCC449">編號</th>
    <th width="326" height="50" align="center" bgcolor=" #FCC449">產品圖片</th>
    <th width="223" height="50" align="center" bgcolor=" #FCC449">產品名稱</th>
    <th width="223" height="50" align="center" bgcolor=" #FCC449">產品價格</th>
    <th width="173" height="50" align="center" bgcolor=" #FCC449">產品數量</th>
  </tr>
  <?php do { ?>
    <tr class="border_style product_margin">
      <td height="50" align="center" bgcolor=" #FFF8E3"><?php echo $row_Recordset1['detailid']; ?></td>
      <td height="50" align="center" bgcolor=" #FFF8E3"><img src="./productimages/<?php echo $row_Recordset1['productimage']; ?>"width='200'></img></td>
      <td height="50" align="center" bgcolor=" #FFF8E3"><?php echo $row_Recordset1['productname']; ?></td>
      <td height="50" align="center" bgcolor=" #FFF8E3"><?php echo $row_Recordset1['price']; ?>元</td>
      <td height="50" align="center" bgcolor=" #FFF8E3"><?php echo $row_Recordset1['quantity']; ?></td>
    </tr>
    <?php 
    $totalprice = $totalprice + $row_Recordset1['totalprice'];
  } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>
  </table>
  <div class="container">
            <div class="box">
                <p><font color="black">運費：<?php echo $cart->deliverfee;?>元</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="black">總金額：<?php echo $totalprice ?>元</font></p>
            </div>
  </div>
  <div  class="text-center">
  <a href="list_main.php"><input name="button2" type="button" id="button2" value="回上一頁"></a>
  </div>    
</table>
</body>
</html>
<?php
mysqli_free_result($Recordset1);
?>
