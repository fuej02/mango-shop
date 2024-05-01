<?php require_once('cart/EDcart.php');
session_start();
$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 
 ?>
 <?php
 if ($cart->itemcount == 0){
    echo "<script>
    alert('未添加商品至購物車');
    this.location='product.php';
    </script>";
 }
 ?>
 <?php
$cart->deliverfee = 150; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="js/bootstrap.js"></script>

  <style>
        body{
    background-color: #F8E9AD;
}
.item_header{
    display: flex;
    width: 1000px;
    margin: 0 auto;
    height: 30px;
    background-color: #FFF8E3;
    border-radius: 3px;
    padding-left: 10px;
}
.item_header div{
    width: 200px;
    color: #888;
    line-height: 30px;
}
.item_header .item_detail{
    width: 50%;
}
.item_body{
    margin-top: 20px;
    height: 100px;
    align-items: center;    
}
.item_detail img{
    width: 80px;
    height: 80px;
    border-radius: 3px;
    /* margin-top: 10px; */
    float: left;
}
.item_detail .name{
    margin-left: 100px;
    margin-top: 20px;
} 
.btn-style{
    font-size: 17px;
    color: rgb(63, 63, 63);
    background-color: #FFF8E3;
    width: 15%; 
    height: 40px;
    letter-spacing: 3px;
    border-radius: 5px;
  }
 .btn-style:hover{
  color: black;
  background-color: white;
 }
  .btn-style2{
    height: 30px;
    border-radius: 5px;
    border-color: gray;
  }

  .btn-style2:hover{
    border-color: gray;
  }
  .total {
    margin-top: 20px;
    margin-left:45%;
    font-size: 23px;
    }

  .total-label {
    margin-right: 10px;
    }

  .total-amount {
    color: #EE7214;
     font-weight: bold;
     font-size: 23px;
     margin-left:10px;
    }

  .box{
    width:40%;
    color: #888;
    line-height: 80px;
    background-color: #FFF8E3;
    border-radius: 3px;
    margin: 0 auto;
    text-align: center;
    margin-top:20px;
    font-size:20px;
    }
    </style>
</head>
<body>
<div id="app">
        <div class="container">
            <div class="item_header">
                <div class="item_detail">商品</div>
                <div class="price">單價</div>
                <div class="count">數量</div> 
                <div class="amount">總計</div>
                <div class="operate">操作</div>
            </div>
            <?php if($cart->itemcount > 0) {
                foreach($cart->get_contents() as $item) {
            ?>    
            <div class="item_container" v-for="(item, index) in itemList" :key="item.id" >
                    <div class="item_header item_body">
                            <div class="item_detail">
                                <img src="0104-1/productimages/<?php echo $item['pic']; ?>">
                                <div class="name"><input name="itemid[]" type="hidden" id="itemid[]" value="<?php echo $item['id'];?>"><?php echo $item['info'];?></div>
                            </div>
                            
                            <div class="price"><span>$</span><?php echo $item['price'];?></div>
                            <div class="count">
                            <form method="GET" action="addtocart.php">
                            <?php echo $item['qty'];?>
                            </form>
                            </div> 
                            <div class="amount"><?php echo $item['subtotal'];?></div>
                            <div class="operate">
                            <form method="GET" action="addtocart.php">
                                <input type="hidden" name="prono" value="<?php echo $item['id'];?>">
                                <input type="submit" value="刪除">
                                <input type="hidden" name="A" value="Remove">
                            </form>
                        </div>
                    </div>
            </div><?php
        }
}
?>
        </div>
        <div class="container">
            <div class="box">
                <p><font color="black">運費：<?php echo $cart->deliverfee;?>元</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="black">總金額：<?php echo $cart->grandtotal;?>元</font></p>
            </div>
        </div>
</div>

    <div class="container">
        <div class="col-md-6">
        <div class="row">
            <form method="GET" action="addtocart.php">
            <p href="#" style="margin-left:34%;">
                <input name="button" type="button" id="submit" title="button" value="繼續購物" class="btn btn-style img-responsive"  onclick="window.location='product.php'">&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="button" type="submit" id="submit" title="button" value="清空購物車" class="btn btn-style img-responsive" onclick="window.location='addtocart.php?A=Empty'">&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="button" type="button" id="submit" title="button" value="前往結帳" class="btn btn-style img-responsive" onclick="window.location='cartCustomers.php'">
            </p>
           </form>
        </div>
        </div>
    </div>
</body>
</html>