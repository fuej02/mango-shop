<?php
session_start();
?>
<?php
    if(isset($_SESSION['level'])){
      
    }else{
      echo "<script>alert('先登入會員');
      this.location='member.php';
      </script>";
      exit;
    }
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
  
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["CustomerName"])) {
    $CustomerName = $_POST["CustomerName"];
    $CustomerPhone = $_POST["CustomerPhone"];
    $CustomerEmail = $_POST["CustomerEmail"];
    $paytype = $_POST["paytype"];
    $CustomerAddress = $_POST["CustomerAddress"];

    $sql = "INSERT INTO orders (CustomerName, CustomerPhone, CustomerEmail, CustomerAddress, paytype)
            VALUES ('$CustomerName', '$CustomerPhone', '$CustomerEmail', '$CustomerAddress', '$paytype')";

    $Result1 = mysqli_query($conn_sql, $sql) or die('failed');

    $id = mysqli_insert_id($conn_sql);

    $insertGoTo = "cartCheckout.php?OrderID=".$id;
    if (isset($_SERVER['QUERY_STRING'])) {
        $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
        $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<script src="js/code.jquery.com_jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/member.css">
    <script type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function YY_checkform() { //v4.65
//copyright (c)1998,2002 Yaromat.com
  var args = YY_checkform.arguments; var myDot=true; var myV=''; var myErr='';var addErr=false;var myReq;
  for (var i=1; i<args.length;i=i+4){
    if (args[i+1].charAt(0)=='#'){myReq=true; args[i+1]=args[i+1].substring(1);}else{myReq=false}
    var myObj = MM_findObj(args[i].replace(/\[\d+\]/ig,""));
    myV=myObj.value;
    if (myObj.type=='text'||myObj.type=='password'||myObj.type=='hidden'){
      if (myReq&&myObj.value.length==0){addErr=true}
      if ((myV.length>0)&&(args[i+2]==1)){ //fromto
        var myMa=args[i+1].split('_');if(isNaN(parseInt(myV))||myV<myMa[0]/1||myV > myMa[1]/1){addErr=true}
      } else if ((myV.length>0)&&(args[i+2]==2)){
          var rx=new RegExp("^[\\w\.=-]+@[\\w\\.-]+\\.[a-z]{2,4}$");if(!rx.test(myV))addErr=true;
      } else if ((myV.length>0)&&(args[i+2]==3)){ // date
        var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);
        if(myAt){
          var myD=(myAt[myMa[1]])?myAt[myMa[1]]:1; var myM=myAt[myMa[2]]-1; var myY=myAt[myMa[3]];
          var myDate=new Date(myY,myM,myD);
          if(myDate.getFullYear()!=myY||myDate.getDate()!=myD||myDate.getMonth()!=myM){addErr=true};
        }else{addErr=true}
      } else if ((myV.length>0)&&(args[i+2]==4)){ // time
        var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);if(!myAt){addErr=true}
      } else if (myV.length>0&&args[i+2]==5){ // check this 2
            var myObj1 = MM_findObj(args[i+1].replace(/\[\d+\]/ig,""));
            if(myObj1.length)myObj1=myObj1[args[i+1].replace(/(.*\[)|(\].*)/ig,"")];
            if(!myObj1.checked){addErr=true}
      } else if (myV.length>0&&args[i+2]==6){ // the same
            var myObj1 = MM_findObj(args[i+1]);
            if(myV!=myObj1.value){addErr=true}
      }
    } else
    if (!myObj.type&&myObj.length>0&&myObj[0].type=='radio'){
          var myTest = args[i].match(/(.*)\[(\d+)\].*/i);
          var myObj1=(myObj.length>1)?myObj[myTest[2]]:myObj;
      if (args[i+2]==1&&myObj1&&myObj1.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
      if (args[i+2]==2){
        var myDot=false;
        for(var j=0;j<myObj.length;j++){myDot=myDot||myObj[j].checked}
        if(!myDot){myErr+='* ' +args[i+3]+'\n'}
      }
    } else if (myObj.type=='checkbox'){
      if(args[i+2]==1&&myObj.checked==false){addErr=true}
      if(args[i+2]==2&&myObj.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
    } else if (myObj.type=='select-one'||myObj.type=='select-multiple'){
      if(args[i+2]==1&&myObj.selectedIndex/1==0){addErr=true}
    }else if (myObj.type=='textarea'){
      if(myV.length<args[i+1]){addErr=true}
    }
    if (addErr){myErr+='* '+args[i+3]+'\n'; addErr=false}
  }
  if (myErr!=''){alert('The required information is incomplete or contains errors:\t\t\t\t\t\n\n'+myErr)}
  document.MM_returnValue = (myErr=='');
}
//-->
</script>
<style>
    /* body{
        background-color: #F8E9AD;
    } */
    .inside{
        background-color: #FFF8E3;
    }
    .frame{
        margin-top: 6%;
    }
    h3{
        font-weight: bolder;
        color: #CE5A67;
    }
    .btn{
        background-color: #CE5A67;
        color: white;
        letter-spacing: 3px;
    }
    .bg-img{
      background-image: url(./images/pinkbackground.jpg);
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
      background-size: cover;
    }
    .bg{
      background-color:#FFF6F6;
    }
    .title-font{
      color: #CE5A67;
    }
</style>
<body class="bg-img">
    <div class="container bg img-responsive frame">
        <div class="row">
          <form method="POST" action="" name="form1" id="test">
            <h1 class="text-center title-font">芒果園線上購物</h1>
            <h3 class="text-center">填寫購物資訊</h3><br>
            <div class="text-center member">
            <label for="CustomerName" class="font-margin">姓名</label><br>
            <input name="CustomerName" type="text" class="btn-style2" id="CustomerName" title="text">
            <br>
            <label for="CustomerPhone" class="font-margin">手機</label><br>
            <input name="CustomerPhone" type="tel"  class="btn-style2" id="CustomerPhone" title="phone">
            <br>
            <label for="CustomerEmail" class="font-margin">信箱</label><br>
            <input name="CustomerEmail" type="email"  class="btn-style2" id="CustomerEmail" title="email">
            <br>
            <label for="CustomerAddress" class="font-margin">地址</label><br>
            <input name="CustomerAddress" type="address"  class="btn-style2" id="CustomerAddress" title="url">
            <br><br>
            <tr>
              <td align="center" bgcolor="#FFF8E3"><strong>付款方式</strong></td>
              <td bgcolor="#FFF8E3"><input name="paytype" type="radio"value="ATM轉帳" id="radio1">
   <label for="paytype"> ATM 轉帳</label></td>
    <td><input name="paytype" type="radio" value="信用卡支付" id="radio2">
  </tr>
    <label for="paytype">信用卡支付</label></td>
            </div> 
            <input type="hidden" name="MM_insert" value="form1">
          </form>        
      </table>
      <p>&nbsp;</p>
      <table border="0" align="center" cellpadding="4" cellspacing="0">
        <tr>
          <td><a href="product.php"><input type="button" name="Submit4" value="繼續購物" class="btn img-responsive"></a>&nbsp;&nbsp;&nbsp;</td>
          <td><input type="button" name="Submit" value="回上一頁" class="btn img-responsive" onclick="window.history.back();">&nbsp;&nbsp;&nbsp;</td>
          <form>
            <!-- <td><input type="submit" name="Submit2" value="下一步" class="btn img-responsive" onclick="window.loation='cartCheckout.php'">&nbsp;&nbsp;&nbsp;</td> -->
            <td><input type="button" name="Submit2" id="test2" value="下一步" class="btn img-responsive" >&nbsp;&nbsp;&nbsp;</td>
            
          </form>
        </tr>
      </table>
    </form>
</div>
</div>
    <script>
      $(function(){
        $("#test2").on("click",function(){
          $("#test").submit();
        })
      })
    </script>
</body>
</html>
