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
    <link rel="stylesheet" href="css/contact.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>

    </style>
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
    <!-- 開頭 -->
    <!-- <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="animate__animated animate__zoomIn text-center title-font">歡迎光臨快樂芒果園</h1>
            </div>
         </div>
    </div>
    <br><br><br> -->
    <div class="jumbotron text-center animate__animated animate__fadeIn">
        <h1 class="animate__animated animate__zoomIn text-center title-font">歡迎光臨快樂芒果園</h1>
      </div>
      <br><br><br>
    
    <!-- 內容 -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <img src="images/beautymANGO.jpg" class="img-responsive img-beautymango">
            </div>
            <div class="col-md-6">
                <h1 class="congrate-font">!<font color="#0728DE">!</font><font color="#F29902">!</font>狂賀!<font color="#0728DE">!</font><font color="#F29902">!</font></h1>
                <h1 class="congrate-font" style="margin-top: 80px;">榮獲玉井芒果節選美比賽第三名</h1>
                <h1 class="congrate-font" style="margin-top: 80px;">外銷等級的快樂芒果園</h1>
            </div>
            <div class="col-md-3">
                <img src="images/beautymANGO.jpg" class="img-responsive img-beautymango">
            </div>
        </div>
    </div>
    <br><br><br>
    <hr>
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="images/grandparent-1.png" class="img-responsive">
            </div>
            <div class="col-md-6">
                <h4 class="font-margin h4-style">快樂果園位於台南南化北平里，您不可不知道，台南的南化是全市前3大芒果栽種區之一，遠近馳名，僅次於楠西、玉井。</h4>
                <h4 class="h4-style">其果園主人鄭爸爸畢生投入芒果栽培研究與改良，堅持品質不催熟，所生產之芒果顆顆飽滿Q甜可口，因此吃過的人無不讚不絕口，一吃成主顧。</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-push-6">
                <br><br><br>  
                <img src="images/grandparent2-1.png" class="img-responsive">
            </div>
            <div class="col-md-6 col-md-pull-6">
               <br><br><br>  
                <h4 class="font-margin h4-style">快樂芒果園為一群專業、用心、快樂的果農加上廣大快樂的消費群一起交織的天然果園！</h4>
                <h4 class="h4-style">看到顧客們因吃到美味的芒果臉上露出幸福的笑容，便是我們最大的動力，只要你們開心，我們就快樂，這便是我們所堅持、所追求的。</h4>
            </div>
        </div>    

        <div class="row">
            <div class="col-md-6">
                <br><br><br>
                <img src="images/grandma.png" class="img-responsive">
            </div>
            <div class="col-md-6">
                <br><br><br>
                <h4 class="font-margin-2 h4-style">其果園主人鄭媽媽正在為所收成的芒果進行篩選，裝箱，能看到每顆芒果皆非常飽滿，顏色十分漂亮，不是最上等的品質我們可是不賣的！</h4>
            </div>
        </div>

    </div>
    <br><br><br>
    <div class="container">
        <div class="row">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29365.59621648981!2d120.43817170343728!3d23.071474964896975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346e6694acd02baf%3A0xdbda27f456539a82!2zNzE25Y-w5Y2X5biC5Y2X5YyW5Y2A5YyX5bmz6YeM!5e0!3m2!1szh-TW!2stw!4v1700990192895!5m2!1szh-TW!2stw"></iframe>
        </div>
        </div>
    </div>
    <br><br><br>
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