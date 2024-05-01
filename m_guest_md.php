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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	$boardname=$_POST['boardname'];
	$boardsex=$_POST['boardsex'];
	$boardsubject=$_POST['boardtitle'];
	$boardtime=$_POST['boarddate'];
	//$boardmail=$_POST['boardmail'];
	$boardcontent=$_POST['boardcontent'];
	$a1=$_POST['a1'];
	$a2=$_POST['a2'];
	$a3=$_POST['a3'];


  $updateSQL = "UPDATE board SET boardname='$boardname', boardsex='$boardsex', boardsubject='$boardsubject', boardtime='$boardtime', boardcontent='$boardcontent', a1='$a1', a2='$a2', a3='$a3' WHERE boardid=".$_POST['boardid'];
                      // GetSQLValueString($_POST['boardname'], "text"),
//                       GetSQLValueString($_POST['boardsex'], "text"),
//                       GetSQLValueString($_POST['boardtitle'], "text"),
//                       GetSQLValueString($_POST['boarddate'], "date"),
//                       GetSQLValueString($_POST['boardcontent'], "text"),
//                       GetSQLValueString($_POST['a1'], "text"),
//                       GetSQLValueString($_POST['a2'], "text"),
//                       GetSQLValueString($_POST['a3'], "text"),
//                       GetSQLValueString($_POST['boardid'], "int"));

  //mysql_select_db($database_conn_sql, $conn_sql);
  $Result1 = mysqli_query($conn_sql,$updateSQL) or die("oops");

  $updateGoTo = "m_guest_main.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['boardid'])) {
  $colname_Recordset1 = $_GET['boardid'];
}
//mysql_select_db($database_conn_sql, $conn_sql);
$query_Recordset1 = "SELECT * FROM board WHERE boardid =".$_GET['boardid']; //GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysqli_query($conn_sql,$query_Recordset1) or die("failed");
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
<h1>留言板修改</h1>
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
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <p>
    <label for="boardtitle">標題:</label>
    <input name="boardtitle" type="text" id="boardtitle" value="<?php echo $row_Recordset1['boardsubject']; ?>">
  </p>
  <p>
    <label for="boarddate">張貼日期:</label>
    <input name="boarddate" type="text" id="boarddate" value="<?php echo $row_Recordset1['boardtime']; ?>">
    <input name="boardid" type="hidden" id="boardid" value="<?php echo $row_Recordset1['boardid']; ?>">
  </p>
  <p>
    <label for="boardname">發布人:</label>
    <input name="boardname" type="text" id="boardname" value="<?php echo $row_Recordset1['boardname']; ?>">
  </p>
  <p>請選擇項目：
    <input <?php if (!(strcmp($row_Recordset1['boardsex'],"建議"))) {echo "checked=\"checked\"";} ?> type="radio" name="boardsex" id="radio" value="建議">
    <label for="boardsex">建議</label>
    <input <?php if (!(strcmp($row_Recordset1['boardsex'],"產品維修"))) {echo "checked=\"checked\"";} ?> type="radio" name="boardsex" id="radio2" value="產品維修">
    <label for="boardsex">產品維修</label>
  </p>
  <p>請複選項目：
    <input <?php if (!(strcmp($row_Recordset1['a1'],"電器"))) {echo "checked=\"checked\"";} ?> name="a1" type="checkbox" id="a1" value="電器">
    <label for="a1">電器</label>
    <input <?php if (!(strcmp($row_Recordset1['a2'],"手機"))) {echo "checked=\"checked\"";} ?> name="a2" type="checkbox" id="a2" value="手機">
    <label for="a2">手機</label>
    <input <?php if (!(strcmp($row_Recordset1['a3'],"電腦"))) {echo "checked=\"checked\"";} ?> name="a3" type="checkbox" id="a3" value="電腦">
    <label for="a3">電腦</label>
  </p>
  <p>
    <label for="boardcontent">發布內容:</label>
    <textarea name="boardcontent" cols="50" rows="10" id="boardcontent"><?php echo $row_Recordset1['boardcontent']; ?></textarea>
  </p>
  <p>
    <input type="submit" name="button" id="button" value="修改">
    <input name="button2" type="button" id="button2" onClick="MM_callJS('javascript:history.back();')" value="回上一頁">
</p>
  <input type="hidden" name="MM_update" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysqli_free_result($Recordset1);
?>
