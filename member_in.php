
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
    <link rel="stylesheet" href="css/member.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body class="bg-img">
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
    </div>
 </nav>
    <div class="container bg img-responsive">
        <div class="row">
          <form method="post" action="member_insert.php">
            <h1 class="text-center title-font">會員註冊</h1>
            <div class="text-center member">
            <label for="text" class="font-margin">姓名</label><br>
            <input name="text" type="text" id="text" placeholder="請輸入您的姓名" title="text" class="btn-style2">
            <br>
            <label for="phone" class="font-margin">手機</label><br>
            <input name="phone" type="tel" id="phone" placeholder="請輸入您的電話" title="phone"  class="btn-style2">
            <br>
            <label for="email" class="font-margin">信箱</label><br>
            <input name="email" type="email" id="email" placeholder="請輸入您的信箱" title="email"  class="btn-style2">
            <br>
            <label for="address" class="font-margin">地址</label><br>
            <input name="url" type="address" id="address" placeholder="請輸入地址" title="url"  class="btn-style2">
            <br>
            <label for="password" class="font-margin">密碼</label><br>
            <input name="password" type="password" id="password" placeholder="請輸入您的密碼" title="password" class="btn-style2">  
            <br>
            <label for="password2" class="font-margin2">請在輸入一次密碼</label><br>
            <input name="password2" type="password" id="password2" placeholder="請在一次輸入您的密碼"  class="btn-style2">  
            <br><br>
            <a href="#"><input name="button" type="submit" id="submit" title="button" value="註冊帳號" class="btn btn-style img-responsive"></a>
            </div> 
          </form>        
        </div>
    </div>
 <!-- <br><br><br><br><br> -->
 <div class="to-footer"></div>
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

<script>
  var body_h =$('body').outerHeight(true);
  var window_h = window.innerHeight;
  var ah = window_h - body_h;
  if(ah>0){
    $('.to-footer').css('height',ah+"px");
  }
</script>
<script>
 $(document).ready(function() {
  $("#submit").on('click', function(){
    if($('#text').val() == ''){
			window.alert('需輸入使用者名稱');
			return false;
		}
    if($('#phone').val() == ''){
			window.alert('需輸入電話');
			return false;
		}
    if($('#email').val() == ''){
			window.alert('需輸入信箱');
			return false;
      }
      if($('#address').val() == ''){
			window.alert('需輸入地址');
			return false;
		}
    if($('#password').val() =='' || $('#password2').val() =='' ||
      $('#password').val() != $('#password2').val()){
			window.alert('兩次輸入的密碼不符合');
			return false;
		}})
  })

 	// $('#text').on('blur', function(e){
 	// 	if($('#text').val() == ''){
	// 		window.alert('需輸入使用者名稱');
	// 		return false;
	// 		}
  //   	})
	// $('#password2').on('blur', function(e){
	// 	if($('#password').val() != $('#password2').val()){
	// 		window.alert('兩次輸入的密碼不符合');
	// 		return false;
	// 	}
	// 	}); // End of submit
	// });//End of ready
  </script>

  
</body>
</html>