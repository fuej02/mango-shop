<?php
session_start();
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
    <link rel="stylesheet" href="css/index.css">


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
                  <!--  <li><a href="./videos/index.html" class="font-size">影片展示</a></li> -->
                </ul>
            </li> 
            <li><a href="./0104-1/m_login.php"  class="font-size">後臺管理</a></li>  
        </div>
        </div>
    </nav>  
    <br>
    <!-- 首圖 -->
    <div class="container-fluid">
      <img src="images/mango-1-2.jpg" class="img-index img-responsive"></img>
    </div>
    <br><br><br><br>
    <!-- Jumbotron -->
    <div class="container">
        <div class="row">
          <div class="col-md-5 col-lg-offset-1">
            <img src="images/mangoooo.jpg" class="jumbotron-img img-responsive">
          </div>
          <div class="col-md-6">
            <div class="jumbotron text-center jumbotron-color jumbotron-text-color img-responsive">
                <h2>芒果，您值得喜歡...</h2><br><br>
                <p>位於台南南化的尖山快樂芒果園</p>
                <p>夏季消暑水果沒有之一</p>
                <p>這裡只有100分的芒果</p>
                <p>讓您吃在嘴裡甜在心裡</p>
                <br><br><br>
                <p><a class="btn btn-lg btn-color btn-default font-style" href="contact.php" role="button">前往果園>></a></p>
                <!-- <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p> -->
              </div>
            </div>  
        </div>
    </div>
    <br><br><br>
    <!-- Custom content -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <div class="thumbnail">
            <!-- <a href="#" class="btn"> -->
            <img src="images/mangophoto2-1.png" alt="...">
            <div class="caption" style="text-align: center;">
              <h2>芒果二三事</h2><br>
              <h4>您喜歡芒果嗎，身為熱愛芒果份子</h4>
              <h4>這裡有您不能不知道關於芒果的那些事...</h4><br>
              <p><a href="https://www.youtube.com/embed/SHBWDWHoL2Q?si=PISK7BvtaF4Ldkih" class="btn btn-primary btn-lg" role="button"><font color="white">點即觀賞</font></a></p>
            </div>
           <!-- </a> -->
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="thumbnail">
            <img src="images/mangogift-1.png" alt="...">
            <div class="caption" style="text-align: center;">
              <h2>商品專區</h2><br>
              <h4>炎炎夏日，消暑聖品，芒果閃亮登場!!!</h4>
              <h4>只給您最好的品質，送人、自吃都非常合適</h4><br>
              <p><a href="product.php" class="btn btn-primary btn-lg" role="button"><font color="white">點即前往</font></a></p>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="thumbnail">
            <img src="images/grandparent-1.png" alt="...">
            <div class="caption" style="text-align: center;">
              <h2>關於我們</h2><br>
              <h4>想第一時間獲得最新消息嗎</h4>
              <h4>歡迎關注我們^0^</h4><br>
              <p><a href="https://www.facebook.com/HappyMangoFarm/?locale=zh_TW" class="btn btn-primary btn-lg" role="button"><font color="white">點即前往</font></a></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <br><br>
    <!-- 結尾 -->
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