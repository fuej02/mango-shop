<?php require_once('Connections/conn_sql.php'); ?>
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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['passwd'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "m_main.php";
  $MM_redirectLoginFailed = "m_login.php";
  $MM_redirecttoReferrer = false;
  //mysql_select_db($database_conn_sql, $conn_sql);
  
  //$LoginRS__query=sprintf("SELECT username, passwd FROM newsadmin WHERE username=%s AND passwd=%s",
    //GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   $LoginRS__query="SELECT username, passwd FROM newsadmin WHERE username='$loginUsername' AND passwd='$password'";
  //$LoginRS = mysql_query($LoginRS__query, $conn_sql) or die(mysql_error());
  $LoginRS = mysqli_query($conn_sql, $LoginRS__query) or die("failed");
  //$loginFoundUser = mysql_num_rows($LoginRS);
  $loginFoundUser = mysqli_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script type="text/javascript">
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
</script>
<style>
  body{
    background-color: #F8E9AD;
}
</style>
</head>

<body>
<form name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
  <table width="403" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="403" height="50" align="center" valign="middle"><h1>芒果園後台登入</h1>
</td>
    </tr>
    <tr>
      <td height="50" align="center"><label for="username">帳號：</label>
      <input type="text" name="username" id="username"></td>
    </tr>
    <tr>
      <td height="50" align="center"><label for="passwd">密碼：</label>
      <input type="text" name="passwd" id="passwd"></td>
    </tr>
    <tr>
      <td height="50" align="center"><input type="submit" name="button" id="button" value="帳號登入">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="../index.php"><input type="button" name="button" value="回首頁" id="button"></a></td>
    </tr>
  </table>
</form>
</body>
</html>