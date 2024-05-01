<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/code.jquery.com_jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/things.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

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
    <div class="jumbotron text-center animate__animated animate__fadeIn">
        <h1 class="animate__animated animate__bounceIn text-center title-font">在地芒果乎你知</h1>
      </div>
      <br><br><br>

    <!-- 內容 -->
    <div class="container">
        <div class="row">
            <H2 class="text-center">芒果QA
            </H2>
        </div>
   
    
        <div class="row">
            <div class="col-md-12">
                <h3 style="color: red;">Q：你們的芒果真的有這麼好吃嗎</h3>
                <h3>A：本區農地多層山坡地白堊土地質，非常適合熱帶性水果(芒果)生長。<br>
                    其土質所種植生長的芒果果實肉質香甜，品質更勝於其他產地。<br>
                    而其芒果具有合格的生產履歷，就是為了讓消費者能夠吃的放心。
                </h3>
            </div>
        </div>
          
        <br>
        <div class="row">
            <div class="col-md-8 col-md-push-4">
                <img src="images/report.jpg" class="img-report img-responsive">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <h3 style="color: red;">Q：芒果有甚麼好處嗎</h3>
                <h3>A：是有的呦~<br>
                    芒果肉含有豐富的維生素A、維生素C、維生素D、醣類、<br>
                    膳食纖維、葉酸、鈣、磷、鐵、鉀、鎂等微量元素。<br>
                    多酚、磷等礦物質，能避免體內自由基過多，<br>
                    有養顏美容的效果，但還是提醒大家要適量食用呦。
                </h3>
            </div>   
        </div>
        <br><br><br>
        <div class="row">
            <div class="col-md-12">
                <h3 style="color: red;">Q：購買你們家芒果有甚麼注意事項嗎</h3>
                <h3>A：芒果約在八、九分熟採收，必須先放置幾天，<br>
                    待表皮油量後，就是最佳賞用期囉!<br>
                    軟化後的芒果若是一時吃不完，可放進冰箱冷藏，<br>
                    但是如果買回來的芒果還是很硬，就別馬上放進冰箱囉!
                </h3>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <h2 style="color:#EF4040 ;">鄭爸爸關心您 ～ ^O^</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-push-4">
                <img src="images/grandpa-1.jpg" class="img-responsive">
            </div>
        </div>
    </div>
    <br>
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