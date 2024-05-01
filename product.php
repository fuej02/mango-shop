<?php
session_start();
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
$query_Recordset1 = "SELECT * FROM product ORDER BY productid DESC";
$Recordset1 = mysqli_query($conn_sql,$query_Recordset1) or die("failed");
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="js/code.jquery.com_jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/product.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


<script type="text/javascript">
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
</script>

</head>
<?php
function cutword($cutstring,$cutno){
 if(strlen($cutstring) > $cutno) { 
  for($i=0;$i<$cutno;$i++) { 
   $ch=substr($cutstring,$i,1); 
   if(ord($ch)>127) $i++; 
  } 
 $cutstring= substr($cutstring,0,$i)."...詳全文"; 
 } 
return $cutstring; 
}
?>
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
            </li>  
        </div>
    </div>
</nav>  

<!-- 首圖 -->
<!-- <div class="container-fluid">
    <div class="row">
        <img src="images/mangodryy1.png" class="first-img img-responsive animate__animated animate__fadeIn">
        <h1 class="animate__animated animate__slideInDown" style="margin-top: -50px;">商品專區</h1>
    </div>
</div> -->
<div class="jumbotron text-center animate__animated animate__fadeIn">
  <h1 class="animate__animated animate__slideInDown">商品專區</h1>
</div>
<br><br><br>
<!-- 商品圖 -->
<div class="container">
    <div class="row">
        <h2 class="text-center">－愛文芒果－</h2><br>
    </div>
</div>
<div class="container">
<div class="row">
<?php do { ?>
    <div class="col-sm-6 col-md-6">
      <div class="thumbnail">
         <?php /*start db_input script*/ if ($row_Recordset1['productimages'] != ""){ ?>
          <img src="0104-1/productimages/<?php echo $row_Recordset1['productimages']; ?>" class="card-img-top" title="<?php echo $row_Recordset1['productname']; ?>" alt="<?php echo $row_Recordset1['productname']; ?>"><?php }else{  ?><br>
        <img src="images/mangogift-1.png" alt="..." >
        <?php } /*end db_input script*/ ?>
        </a>
        <div class="caption">
          <h3 class="h3-font"><?php echo $row_Recordset1['productname']; ?></h3>
          <!-- <p>粒粒皆飽滿的愛文，籽薄果肉質細膩，每一口都是極品饗宴！口感香甜紮實而且擁有自己獨特的果香味。飽滿果肉， 厚實多汁，濃濃果香，保證您一試難忘。</p> -->
          <p class="p-font"><?php echo $row_Recordset1['productprice']; ?>元</p>
          <p class="text-center"><a href="product_detail.php?productid=<?php echo $row_Recordset1['productid']; ?>" class="btn btn-lg btn-color btn-default font-style" role="button">前往購買</a></p>
        </div>
    </div>
          </div>
    <?php } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>
  </div>
  <!-- <div class="col-sm-6 col-md-6">
    <div class="thumbnail">
      <img src="images/mangogift2-1.png" alt="...">
      <div class="caption">
        <h3 class="h3-font">愛文 - 15顆裝(15斤)</h3>
        <p >粒粒皆飽滿的愛文，籽薄果肉質細膩，每一口都是極品饗宴！口感香甜紮實而且擁有自己獨特的果香味。飽滿果肉， 厚實多汁，濃濃果香，保證您一試難忘。</p>
        <p class="p-font">$650/箱</p>
        <p class="text-center"><a href="product2.php" class="btn btn-lg btn-color btn-default font-style" role="button">前往購物車</a></p>
    </div>
  </div>
</div> 
   <br><br><br> 
  </div>
  <div class="row">
      <h2 class="text-center h2-font">－芒果乾－</h2><br>
  </div>
  <div class="row">
  <div class="col-sm-6 col-md-6 col-md-offset-3">
    <div class="thumbnail">
      <img src="images/mangodry-1.png" alt="...">
      <div class="caption">
        <h3 class="h3-font"><font color="#F62915">熱賣款!!!</font> &nbsp;無添加糖芒果乾(200克)</h3>
        <p >大朋友、小朋友都愛吃，不添加任何糖就可以讓您吃得過癮，吃過的都說讚!採用低溫烘焙，持續烘乾12小時，不添加任何添加物，保留水果最自然風味，讓您吃得健康、安心。</p>
        <p class="p-font">$200/包</p>
        <p class="text-center"><a href="product3.php" class="btn btn-lg btn-color btn-default font-style" role="button">前往購物車</a></p>
    </div>
    </div> 
  </div> -->
</div> 
</div>

<!-- footer -->
<div class="container-fluid">
    <div class="row text-center padding">
      <a href="https://www.facebook.com/HappyMangoFarm/?locale=zh_TW"><img src="images/facebook-2.png"></a> &nbsp;&nbsp;
      <a href="https://www.instagram.com/happy_mango_foryou/"><img src="images/instagram-1.png"></a>
      <br><br>
      <p>地址：台南市南化區北平里24號</p>
      <p>聯絡人：鄭小姐</p>
      <p>電話：0988-231-898</p>
      <p>© Copyright 2023 快樂芒果園</p>
    </div>
  </div>
</body>
</html>
<?php
mysqli_free_result($Recordset1);
?>