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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 5;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

//mysql_select_db($database_conn_sql, $conn_sql);
$query_Recordset1 = "SELECT * FROM product ORDER BY productid DESC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysqli_query($conn_sql,$query_Recordset1) or die("failed");
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  //$all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysqli_num_rows($Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script src="js/code.jquery.com_jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
<title>無標題文件</title>
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
</style>
<script type="text/javascript">
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
function tfm_confirmLink(message) { //v1.0
	if(message == "") message = "Ok to continue?";	
	document.MM_returnValue = confirm(message);
}
</script></head>

<body>
<h1 class="text_height"><font face="微軟正黑體">產品管理</font></h1>
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
<table width="1412" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr class="text-center">
    <th width="120" height="50" align="center" bgcolor=" #FFF8E3">編號</th>
    <th width="326" height="50" align="center" bgcolor=" #FFF8E3">圖片</th>
    <th width="223" height="50" align="center" bgcolor=" #FFF8E3">品名</th>
    <th width="223" height="50" align="center" bgcolor=" #FFF8E3">說明</th>
    <th width="173" height="50" align="center" bgcolor=" #FFF8E3">單價</th>
    <th width="174" align="center" bgcolor=" #FFF8E3">編輯</th>
  </tr>
  <?php do { ?>
    <tr class="border_style product_margin">
      <td height="50" align="center" bgcolor=" #FFF8E3"><?php echo $row_Recordset1['productid']; ?></td>
      <td height="50" align="center" bgcolor=" #FFF8E3"><img name="" src="productimages/<?php echo $row_Recordset1['productimages']; ?>" width="106" height="115" alt=""></td>
      <td height="50" align="center" bgcolor=" #FFF8E3"><?php echo $row_Recordset1['productname']; ?></td>
      <td height="50" align="center" bgcolor=" #FFF8E3"><?php echo $row_Recordset1['description']; ?>&nbsp;</td>
      <td height="50" align="center" bgcolor=" #FFF8E3"><?php echo $row_Recordset1['productprice']; ?></td>
      <td align="center" bgcolor=" #FFF8E3"><a href="m_product_add.php">新增</a> / <a href="m_product_md.php?productid=<?php echo $row_Recordset1['productid']; ?>">修改</a> / <a href="m_product_del.php?productid=<?php echo $row_Recordset1['productid']; ?>&del=true" onClick="tfm_confirmLink('你確定要刪除嗎??');return document.MM_returnValue">刪除</a></td>
    </tr>
    <?php } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>
</table>

<table border="0" align="center">
  <tr>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">第一頁</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">上一頁</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">下一頁</a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">最後一頁</a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysqli_free_result($Recordset1);
?>
