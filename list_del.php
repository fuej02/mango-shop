<?php require_once('Connections/conn_sql.php'); ?>
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

  $OrderID= $_POST['OrderID'];
  if ((isset($_GET['OrderID'])) && ($_GET['OrderID'] != "") && (isset($_GET['del']))) {
    $deleteSQL ="DELETE FROM orders WHERE OrderID=".$_GET['OrderID'];
                         //GetSQLValueString($_GET['productid'], "int"));
  
    //mysql_select_db($database_conn_sql, $conn_sql);
    $Result1 = mysqli_query( $conn_sql,$deleteSQL) or die("oops");
  
    $deleteGoTo = "list_main.php";
    if (isset($_SERVER['QUERY_STRING'])) {
      $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
      $deleteGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $deleteGoTo));
  }
  
  $colname_Recordset1 = "-1";
  if (isset($_GET['OrderID'])) {
    $colname_Recordset1 = $_GET['OrderID'];
  }
  //mysql_select_db($database_conn_sql, $conn_sql);
  $query_Recordset1 = "SELECT * FROM orders WHERE OrderID = ".$_GET['OrderID']; //GetSQLValueString($colname_Recordset1, "int"));
  $Recordset1 = mysqli_query( $conn_sql,$query_Recordset1) or die("failed");
  $row_Recordset1 = mysqli_fetch_assoc($Recordset1);
  $totalRows_Recordset1 = mysqli_num_rows($Recordset1);
  ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改訂單</title>
    <style type="text/css">
    h1 {
	text-align: center;
    }
    body{
    background-color: #F8E9AD;
    }
    form {
	width: 600px;
	margin-right: auto;
	margin-left: auto;
}
</style>
</head>
<body>
<h1>訂單刪除</h1>
<table width="1412" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
     <!-- <td height="50" align="center" valign="middle" bgcolor="#FCC449"><strong><a href="m_news_main.php">最新消息後台</a></strong></td> -->
    <!-- <td height="50" align="center" valign="middle" bgcolor="#FCC449"><strong><a href="m_guest_main.php">留言板後台</a></strong></td> -->
    <td height="50" align="center" valign="middle" bgcolor="#FCC449"><strong><a href="m_products_main.php">產品管理</a></strong></td>
    <td height="50" align="center" valign="middle" bgcolor="#FCC449"><strong><a href="list_main.php">訂單管理</a></strong></td>
    <td height="50" align="center" valign="middle" bgcolor="#FCC449"><strong><a href="member_main.php">會員管理</a></strong></td>
    <td height="50" align="center" valign="middle" bgcolor="#FCC449"><strong><a href="m_login_passwd.php">站長管理</a></strong></td>
    <td align="center" valign="middle" bgcolor="#FCC449"><a href="<?php echo $logoutAction ?>">登出</a></td>
  </tr>
</table>
    <form method="post" action="">
        <p><br>
          <label for="newCustomerName">顧客名稱：</label>
          <input type="text" name="newCustomerName" id="newCustomerName" value="<?php echo $order_data['CustomerName']; ?>" required><br>
          <br>
          <label for="newCustomerAddress">顧客地址：</label>
          <input type="text" name="newCustomerAddress" id="newCustomerAddress" value="<?php echo $order_data['CustomerAddress']; ?>" required><br>
          <br>
          <label for="newCustomerPhone">顧客電話：</label>
          <input type="text" name="newCustomerPhone" id="newCustomerPhone" value="<?php echo $order_data['CustomerPhone']; ?>" required><br>
          <br>
          <label for="newCustomerEmail">顧客信箱：</label>
          <input type="email" name="newCustomerEmail" id="newCustomerEmail" value="<?php echo $order_data['CustomerEmail']; ?>" required><br>
          <br>
          <label for="newGrandTotal">購買金額：</label>
          <input type="text" name="newGrandTotal" id="newGrandTotal" value="<?php echo $order_data['GrandTotal']; ?>" required>
          <br><br>
          <input type="submit" name="button" id="button" value="刪除">
          <input name="button2" type="button" id="button2" onClick="MM_callJS('javascript:history.back();')" value="回上一頁">
        </p>
        <p>
          <input type="hidden" name="MM_insert" value="form1">
        </p>
    </form>
</body>
</html>

