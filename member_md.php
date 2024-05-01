<?php
require_once('Connections/conn_sql.php'); ?>
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
if (isset($_GET['a_id'])) {
    $a_id = $_GET['a_id'];

    // 根據 OrderID 從資料庫中檢索訂單資料
    $query_order = "SELECT * FROM member WHERE a_id = " . $a_id;
    $order_result = mysqli_query($conn_sql, $query_order);
    $order_data = mysqli_fetch_assoc($order_result);

    if (!$order_data) {
        die("找不到該會員");
    }
} else {
    die("缺少會員編號");
}

// 當表單提交時，處理更新訂單的邏輯
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 接收表單提交的資料，這裡假設您有欄位如 CustomerName、CustomerAddress、CustomerPhone 等
    $newname = $_POST['newname'];
    $newtel = $_POST['newtel'];
    $newe_mail = $_POST['newe_mail'];
    $newaddress = $_POST['newaddress'];


    // 在這裡執行更新訂單的 SQL 查詢
    $update_query = "UPDATE member SET 
                `name` = '$newname',
                tel = '$newtel',
                e_mail = '$newe_mail',
                `address` = '$newaddress'
                WHERE a_id = '$a_id'";

if (mysqli_query($conn_sql, $update_query)) {
    // 更新成功後轉址回到訂單管理
    header("Location: member_main.php");
    exit();
} else {
    echo "更新失敗：" . mysqli_error($conn_sql);
}
}
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
    <h1>訂單修改</h1>
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
          <label for="newname">會員名稱：</label>
          <input type="text" name="newname" value="<?php echo $order_data['name']; ?>" required><br>
          <br>
          <label for="newtel">會員電話：</label>
          <input type="text" name="newtel" value="<?php echo $order_data['tel']; ?>" required><br>
          <br>
          <label for="newe_mail">會員信箱：</label>
          <input type="email" name="newe_mail" value="<?php echo $order_data['e_mail']; ?>" required><br>
          <br>
          <label for="newaddress">會員地址：</label>
          <input type="text" name="newaddress" value="<?php echo $order_data['address']; ?>" required><br>
 
          <br><br>
          <input type="submit" value="更新訂單">
          <a href="list_main.php"><input name="button2" type="button" id="button2" value="回上一頁"></a>
        </p>
        <p>
          <input type="hidden" name="MM_insert" value="form1">
        </p>
    </form>
</body>
</html>
