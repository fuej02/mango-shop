<?php require_once('./0104-1/Connections/conn_sql.php'); 
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

$colname_Recordset1 = "-1";
if (isset($_GET['productid'])) {
  $colname_Recordset1 = $_GET['productid'];
}
$query_Recordset1 =  "SELECT * FROM product WHERE productid = ".$_GET['productid'];
$Recordset1 = mysqli_query($conn_sql,$query_Recordset1) or die("failed");
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="js/code.jquery.com_jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="vue.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/product1.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script type="text/javascript">
    function MM_callJS(jsStr) { //v2.0
    return eval(jsStr)
    }
</script>
  </head>
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
    <br><br><br><br>

    <!-- 內容 -->
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <img src="0104-1/productimages/<?php echo $row_Recordset1['productimages']; ?>" class="img-responsive">
            </div>
            <div class="col-md-6">
                <br><br>
                <h3><?php echo $row_Recordset1['productname']; ?></h3>
                <P><?php echo $row_Recordset1['description']; ?></P>
                <!-- <p>粒粒皆飽滿的愛文，籽薄果肉質細膩，每一口都是極品饗宴！口感香甜紮實而且擁有自己獨特的果香味。飽滿果肉， 厚實多汁，濃濃果香，保證您一試難忘。</p> -->
                <span class="label label-danger"><?php echo $row_Recordset1['a1']; ?></span>
                <h3><?php echo $row_Recordset1['productprice']; ?>元</h3><br>
                <form action="addtocart.php" method="get">                
                  <input type="hidden" name="A" value="Add">
                  <input type="hidden" name="pic" value="<?php echo $row_Recordset1['productimages'];?>">
                  <input type="hidden" name="prono" value="<?php echo $row_Recordset1['productid'];?>">
                  <input type="hidden" name="price" value="<?php echo $row_Recordset1['productprice'];?>">
                  <input type="hidden" name="name" value="<?php echo $row_Recordset1['productname'];?>">
                <!-- <input type="hidden" class="form-control" name="id" value="mango"> -->
                <input type="number" placeholder="請輸入數量" class="form-control" name="amount" style="width: 20%;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary buy">加入購物車</button>
            </form>
            </div>
              </div>
        </div>
    </div>
    <br><br><br>
    <div class="to-footer"></div>
  </div>   
  <!-- <hr>
  <div class="row">
    <div class="col-sm-6 col-md-3">
      <div class="thumbnail">
        <img src="images/mangogift2-1.png" alt="...">
        <div class="caption">
          <h3>愛文 - 15顆裝(15斤)</h3>
          <p><a href="#" class="btn btn-default" role="button">前往購買</a></p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="thumbnail">
        <img src="images/mangodry-1.png" >
        <div class="caption">
          <h3>無添加糖芒果乾(200克)</h3>
          <p><a href="#" class="btn btn-default" role="button">前往購買</a></p>
        </div>
      </div>
    </div>
  </div> -->
  
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

  <script>
    var body_h =$('body').outerHeight(true);
    var window_h = window.innerHeight;
    var ah = window_h - body_h;
    if(ah>0){
      $('.to-footer').css('height',ah+"px");
    }
  </script>
</body>
</html>
<?php
mysqli_free_result($Recordset1);
?>