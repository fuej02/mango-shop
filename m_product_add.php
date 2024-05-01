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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	if($_FILES['productimages']['error']>0){
		echo "上傳檔案失敗，請聯絡管理員";
	}else{
		move_uploaded_file($_FILES['productimages']['tmp_name'],"productimages/".$_FILES['productimages']['name']);}
$productname=$_POST['productname'];
$productprice=$_POST['productprice'];
$pedscription=$_POST['description'];
$productimages=$_FILES['productimages']['name'];
//$productimages=$_POST['rePic'];
$a1=$_POST['a1'];
$a2=$_POST['a2'];
$a3=$_POST['a3'];
  $insertSQL = "INSERT INTO product (productname, productprice, productimages, `description`, a1,a2,a3) VALUES('$productname','$productprice','$productimages','$pedscription','$a1','$a2','$a3')";


  //mysql_select_db($database_conn_sql, $conn_sql);
  $Result1 = mysqli_query($conn_sql,$insertSQL) or die("failed");

  $insertGoTo = "m_products_main.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
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
<h1>產品新增</h1>
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
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>" enctype="multipart/form-data">
  <!--form tag中要增加enctype="multipart/form-data"-->
  <p>
    <label for="productname">產品名稱:</label>
    <input type="text" name="productname" id="productname">
  </p>
  <p>
    <label for="productprice">產品單價:</label>
    <input type="text" name="productprice" id="productprice">
  </p>
  <p>
    <!--  &nbsp;<img src="icon_prev.gif" alt="這是顯示上傳預覽圖片的位置" name="showImg" id="showImg" onClick='javascript:alert("這是顯示上傳預覽圖片的位置");'>
    <input type="button" name="Submit" value="上傳圖片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg&amp;upUrl=products_images&amp;ImgS=&amp;ImgW=&amp;ImgH=&amp;reItem=rePic','fileUpload','width=400,height=180')">
    <input name="rePic" type="hidden" id="rePic" size="4">
    <input name="rePicW" type="hidden" id="rePicW" />
    <input name="rePicH" type="hidden" id="rePicH" />-->
    <label for="productimages">產品圖片:</label>
    <input type="file" name="productimages" id="productimages">
    <!-- <img src="icon_prev.gif" alt="這是顯示上傳預覽圖片的位置" name="showImg" width="200" id="showImg" onClick='javascript:alert("這是顯示上傳預覽圖片的位置");'>
    <input type="button" name="Submit" value="上傳圖片" onClick="window.open('fupload.php?useForm=form1&amp;prevImg=showImg&amp;upUrl=productimages&amp;ImgS=&amp;ImgW=&amp;ImgH=&amp;reItem=rePic','fileUpload','width=400,height=180')">
    <input name="rePic" type="hidden" id="rePic" size="4">
    <input name="rePicW" type="hidden" id="rePicW" />
    <input name="rePicH" type="hidden" id="rePicH" /> -->
  </p>
  <p>產品分類：
    <input name="a1" type="checkbox" id="a1" value="愛文">
    <label for="a1">愛文</label>
    <input name="a2" type="checkbox" id="a2" value="芒果乾">
    <label for="a2">芒果乾</label>
    <!-- <input name="a3" type="checkbox" id="a3" value="小吃"> -->
    <!-- <label for="a3">小吃</label> -->
  </p>
  <p>
    <label for="description">產品說明:</label>
    <textarea name="description" cols="40" rows="10" id="description"></textarea>
  </p>
  <p>
    <input type="submit" name="button" id="button" value="新增">
    <input name="button2" type="button" id="button2" onClick="MM_callJS('javascript:history.back();')" value="回上一頁">
  </p>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>