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
$productid= $_POST['productid'];
if ((isset($_GET['productid'])) && ($_GET['productid'] != "") && (isset($_GET['del']))) {
  $deleteSQL ="DELETE FROM product WHERE productid=".$_GET['productid'];
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
if (isset($_GET['productid'])) {
  $colname_Recordset1 = $_GET['productid'];
}
//mysql_select_db($database_conn_sql, $conn_sql);
$query_Recordset1 = "SELECT * FROM product WHERE productid = ".$_GET['productid']; //GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysqli_query( $conn_sql,$query_Recordset1) or die("failed");
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
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
<script type="text/javascript">
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
</script></head>

<body>
<h1>產品刪除</h1>
<table width="1412" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
     <!-- <td height="50" align="center" valign="middle" bgcolor="#FCC449"><strong><a href="m_news_main.php">最新消息後台</a></strong></td> -->
    <!-- <td height="50" align="center" valign="middle" bgcolor="#FCC449"><strong><a href="m_guest_main.php">留言板後台</a></strong></td> -->
    <td height="50" align="center" valign="middle" bgcolor="#FCC449"><strong><a href="m_products_main.php">產品管理</a></strong></td>
    <td height="50" align="center" valign="middle" bgcolor="#FCC449"><strong>訂單管理 </strong></td>
    <td height="50" align="center" valign="middle" bgcolor="#FCC449"><strong><a href="m_login_passwd.php">站長管理</a></strong></td>
    <td align="center" valign="middle" bgcolor="#FCC449"><a href="<?php echo $logoutAction ?>">登出</a></td>
  </tr>
</table>
<form name="form1" method="POST" action="#" enctype="multipart/form-data">
  <!--form tag中要增加enctype="multipart/form-data"-->
  <p>
    <label for="productname">產品名稱:</label>
    <input name="productname" type="text" id="productname" value="<?php echo $row_Recordset1['productname']; ?>">
    </p>
  <p>
    <label for="productprice">產品單價:</label>
    <input name="productprice" type="text" id="productprice" value="<?php echo $row_Recordset1['productprice']; ?>">
  </p>
  <p>
    <!--  &nbsp;<img src="icon_prev.gif" alt="這是顯示上傳預覽圖片的位置" name="showImg" id="showImg" onClick='javascript:alert("這是顯示上傳預覽圖片的位置");'>
    <input type="button" name="Submit" value="上傳圖片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg&amp;upUrl=products_images&amp;ImgS=&amp;ImgW=&amp;ImgH=&amp;reItem=rePic','fileUpload','width=400,height=180')">
    <input name="rePic" type="hidden" id="rePic" size="4">
    <input name="rePicW" type="hidden" id="rePicW" />
    <input name="rePicH" type="hidden" id="rePicH" />-->
    <label for="productimages">產品圖片</label>
  <img src="productimages/<?php echo $row_Recordset1['productimages']; ?>" width="200" alt="">  </p>
  <p>產品分類：
    <input <?php if (!(strcmp($row_Recordset1['a1'],"蛋糕"))) {echo "checked=\"checked\"";} ?> name="a1" type="checkbox" id="a1" value="蛋糕">
    <label for="a1">蛋糕</label>
    <input <?php if (!(strcmp($row_Recordset1['a2'],"水果"))) {echo "checked=\"checked\"";} ?> name="a2" type="checkbox" id="a2" value="水果">
    <label for="a2">水果</label>
    <input <?php if (!(strcmp($row_Recordset1['a3'],"小吃"))) {echo "checked=\"checked\"";} ?> name="a3" type="checkbox" id="a3" value="小吃">
    <label for="a3">小吃</label>
  </p>
  <p>
    <label for="pdescription">產品說明:</label>
    <textarea name="pdescription" cols="40" rows="10" id="pdescription"><?php echo $row_Recordset1['description']; ?></textarea>
  </p>
  <p>
    <input type="submit" name="button" id="button" value="刪除">
    <input name="button2" type="button" id="button2" onClick="MM_callJS('javascript:history.back();')" value="回上一頁">
  </p>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysqli_free_result($Recordset1);
?>