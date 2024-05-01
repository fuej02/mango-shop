<?php
If (isset($_GET['upload']) && $_GET['upload'] == "true") {
	$limit_types=array('image/jpg','image/jpeg','image/png','image/pjpeg','image/gif','image/bmp','image/x-png');
	$limit_size=$_POST["imgS"];
	$limit_width=$_POST["imgW"];
	$limit_height=$_POST["imgH"];
	
	if($_POST['upUrl']==""){
		define("DESTINATION_FOLDER", ".");
	}else{
		define("DESTINATION_FOLDER", $_POST['upUrl']);		
	}
	$newfile = $_FILES['file']['name'];
	if(is_file(DESTINATION_FOLDER . "/" . $_FILES['file']['name'])) { 
		$spildname = explode(".", $_FILES['file']['name']);	
		for ($i=1;$i<100;$i++) {
			if ($i<10) {
				$newname = $spildname[0].'0'.$i;
			}else{
				$newname = $spildname[0].$i;
			}
			$newfile = $newname.".".$spildname[1];
			if(!is_file(DESTINATION_FOLDER . "/" . $newfile)) {
				$i = 100;
			}		
		}
	}
	copy($_FILES['file']['tmp_name'],DESTINATION_FOLDER . "/" . $newfile);
	
	$imgArray=getimagesize(DESTINATION_FOLDER . "/" . $newfile);
	$imgW=$imgArray[0];
	$imgH=$imgArray[1];	
	$imgType=$_FILES['file']['type'];
	$imgSize=$_FILES['file']['size']/1024;
	$errMsg="";
	if($limit_size !="" && $limit_size < $imgSize){ 
		$errMsg .= "���Ӥj�A�W�L ".$limit_size." KB!";
	}
	if(!in_array($imgType,$limit_types)){
		$errMsg .= "�����������!";
	}
	if($limit_width!="" && $limit_height<>"") {
		if($imgW > $limit_width || $imgH > $limit_height){
			$errMsg .= "�Ϥ����e�W�L����!";		
		}	
	}
	if($errMsg==""){	
?>
<script language = "JavaScript">
window.opener.<?php echo $_POST['useForm']; ?>.<?php echo $_POST['prevImg']; ?>.src = '<?php echo DESTINATION_FOLDER; ?>'+'/'+'<?php echo $newfile; ?>';
window.opener.<?php echo $_POST['useForm']; ?>.rePic.value = '<?php echo $newfile; ?>';
window.opener.<?php echo $_POST['useForm']; ?>.rePicW.value = '<?php echo $imgW; ?>';
window.opener.<?php echo $_POST['useForm']; ?>.rePicH.value = '<?php echo $imgH; ?>';
window.close();
</Script>
<?php 
	}else{	
	unlink(DESTINATION_FOLDER . "/" . $newfile);
?>
<script language = "JavaScript">
alert('<?php echo $errMsg;?>');
window.close();
</Script>
<?php
	}
}else{
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�Ϥ��W�Ǩt��</title>
<style type="text/css">
<!--
form {
	margin: 0px;
}
.formword {
	font-family: "Georgia", "Times New Roman", "Times", "serif";
	font-size: 8pt;
}
-->
</style>
<style type="text/css">
<!--
.box {
	border: 1px dotted #333333;
}
-->
</style>
</head>
<body bgcolor="#EEEEEE" text="#333333" leftmargin="2" topmargin="2" marginwidth="2" marginheight="2">
<script language="JavaScript" type="text/JavaScript">
var windowW = 400;
var windowH = 180;
windowX = Math.ceil( (window.screen.width  - windowW) / 2 );
windowY = Math.ceil( (window.screen.height - windowH) / 2 );
window.resizeTo( Math.ceil( windowW ) , Math.ceil( windowH ) );
window.moveTo( Math.ceil( windowX ) , Math.ceil( windowY ) );

function checkNull(){
	if (form1.file.value== ""){
	 alert("�п���W���ɮסI");
	 return false;
	}	
}
</script>
<form ACTION="fupload.php?upload=true" METHOD="POST" name="form1" enctype="multipart/form-data" onsubmit="return checkNull();">
  <table width="100%" height="100%" border="0" cellpadding="4" cellspacing="0">
    <tr> 
      <td height="20"><table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#999999">
          <tr valign="baseline" class="formword"> 
            <td width="40" align="right"><font color="#FFFFFF">�`�N�G</font></td>
            <td><font color="#FFFFFF"> �п���Ϥ��W�ǡA���\������GIF�BJPG�BJPEG�BPNG<?php if (isset($_GET['ImgS'])){ 
			echo ',�ɮפj�p���i�W�L'.$_GET['ImgS'].'KB'	;
			}?>
			�C</font></td>
          </tr>
        </table>
        
      </td>
    </tr>
    <tr> 
      <td height="20" align="center"> 
        <table border="0" cellpadding="4" cellspacing="0">
          <tr> 
            <td><input name="file" type="file" class="formword" id="file" size="40"></td>
          </tr>
        </table>
        <input name="Submit" type="submit" class="formword" value="�}�l�W��"> <input name="close" type="button" class="formword" onClick="window.close();" value="��������">
        <input name="useForm" type="hidden" id="useForm" value="<?php echo $_GET['useForm']; ?>">
        <input name="upUrl" type="hidden" id="upUrl" value="<?php echo $_GET['upUrl']; ?>"> 
        <input name="prevImg" type="hidden" id="prevImg" value="<?php echo $_GET['prevImg']; ?>">
        <input name="reItem" type="hidden" id="reItem" value="<?php echo $_GET['reItem']; ?>">
        <input name="imgS" type="hidden" id="imgS" value="<?php echo $_GET['ImgS']; ?>">
        <input name="imgW" type="hidden" id="imgW" value="<?php echo $_GET['ImgW']; ?>">
      <input name="imgH" type="hidden" id="imgH" value="<?php echo $_GET['ImgH']; ?>"></td>
    </tr>
    <tr> 
      <td height="20" align="center"> 
        <table width="100%" border="0" cellpadding="4" cellspacing="0"bgcolor="#FFF8E3" class="box">
          <tr valign="baseline" class="formword"> 
            <td align="center"> Copyright &copy; 2003 <a href="http://www.e-dreamer.idv.tw" target="_blank">eDreamer</a> 
              Inc. All rights reserved.</td>
          </tr>
        </table> </td>
    </tr>
  </table>
</form>
</body>
</html>
<?php }?>