﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" 
    version="XHTML+RDFa 1.0"
    xmlns:og="http://ogp.me/ns#"
    xml:lang="en">
    <script src="js/code.jquery.com_jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/member.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<!-- 
    Smart developers always View Source. 
    
    This application was built using Adobe Flex, an open source framework
    for building rich Internet applications that get delivered via the
    Flash Player or to desktops via Adobe AIR. 
    
    Learn more about Flex at http://flex.org 
    // -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="Keywords" content="" />
<meta name="Description" content="empty" />
<meta name="Generator" content="Flip PDF Corporate Edition 2.4.9.19 at http://www.flipbuilder.com" />
<meta name="medium" content="video"/> 

<meta property="og:image" content="files/shot.png"/>
<meta property="og:title" content=""/> 
<meta property="og:description" content="empty" />
<meta property="og:video" content="book.swf"/> 
<meta property="og:video:height" content="300"/> 
<meta property="og:video:width" content="420"/> 
<meta property="og:video:type" content="application/x-shockwave-flash"/> 

<meta name="video_height" content="300"/> 
<meta name="video_width" content="420"/> 
<meta name="video_type" content="application/x-shockwave-flash"/> 
<meta name="og:image" content="files/shot.png"/>

<link rel="image_src" href="files/shot.png"/>
 <link rel="apple-touch-icon" href="files/thumb/1.jpg" />
<!-- Include CSS to eliminate any default margins/padding and set the height of the html element and 
       the body element to 100%, because Firefox, or any Gecko based browser, interprets percentage as 
    the percentage of the height of its parent container, which has to be set explicitly.  Initially, 
    don't display flashContent div so it won't show if JavaScript disabled.
  -->

<style type="text/css" media="screen">
/*<![CDATA[*/
html,
body
{
 height:100%;
 margin: 0px;
 overflow:hidden;
}

body
{
 margin:0;
 padding:0;
 overflow:auto;
 text-align:center;
 background-color: #ffffff;
}

#flashContent
{
 display:none;
}
/*]]>*/
</style>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript" src="js/fbscript.js"></script>

</head>
<body>
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
<!-- SWFObject's dynamic embed method replaces this alternative HTML content with Flash content when enough 
    JavaScript and Flash plug-in support is available. The div is initially hidden so that it doesn't show
    when JavaScript is disabled.
  -->
  
<div id="flashContent">
<p>To view this page ensure that Adobe Flash Player version 10.0.0
or greater is installed.</p>
 Besides, it's possible to <a href='./files/basic-html/index.html'>view a simplified version of the flippdf book on any device</a>,
or you can view flippdf <a href='mobile/index.html'>mobile version</a>
 <script>
 	function showUserAgent(){
		var str = navigator.userAgent;
		var p = document.createElement("p");
		p.innerHTML = str;
		p.className = "gray";
		document.getElementById("flashContent").appendChild(p);
	}
	
	window.setTimeout(showUserAgent, 200);
</script>
</div>
<noscript><div><object classid=
"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height=
"100%" id="FlipBookBuilder"><param name="movie" value="book.swf" />
<param name="quality" value="high" />
<param name="bgcolor" value="#ffffff" />
<param name="allowScriptAccess" value="always" />
<param name="allowFullScreen" value="true" />
<param name="allowFullScreenInteractive" value="true" />
<!--[if !IE]>-->
<object type="application/x-shockwave-flash" data="book.swf" width=
"100%" height="100%"><param name="quality" value="high" />
<param name="bgcolor" value="#ffffff" />
<param name="allowScriptAccess" value="always" />
<param name="allowFullScreen" value="true" />
<param name="allowFullScreenInteractive" value="true" />
<param name="wmode" value="transparent" />
<!--<![endif]--><!--[if gte IE 6]>-->
<p>Either scripts and active content are not permitted to run or
Adobe Flash Player version 10.0.0 or greater is not installed.</p>
<!--<![endif]--> 
<a href="http://www.adobe.com/go/getflashplayer">Get Adobe Flash Player</a> <br/> <br/>
Besides, it's possible to <a href='./files/basic-html/index.html'>view a simplified version of the flippdf book on any device</a>,
or you can view flippdf <a href='mobile/index.html'>mobile version</a>
<!--[if !IE]>--></object> <!--<![endif]--></object></div></noscript>
<script type="text/javascript" src="js/ActionHtmlWindow.js"></script>
<script type="text/javascript" src="js/fbendscript.js"></script>

<noscript><div><hr/><ul><li><a href="files/basic-html/index.html">Pages</a></li></ul><hr style="width:80%"/></div></noscript>
</body>
</html>