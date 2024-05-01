<?php
//加入購物車Class的宣告
require_once('cart/EDcart.php');
session_start();
$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 
?>

<?php
//執行購物車動作
$DoSomeThing = (isset($_GET['A']) ? $_GET['A'] : "");
switch($DoSomeThing){
case "Add":
	$cart->add_item($_GET['prono'],$_GET['amount'],$_GET['price'],$_GET['name'],isset($_GET['pic'])?$_GET['pic']:'');
	break;
case "Remove":
	$cart->del_item($_GET['prono']);
	break;
case "Empty":
	$cart->empty_cart();
	break;
case "Update":
	for($startNO=0;$startNO < $_GET['itemcount'];$startNO++){
		$cart->edit_item($_GET['itemid'][$startNO],$_GET['qty'][$startNO]);
	}
	break;			
}

?>
<?php header("Location:shopcar.php");
?>