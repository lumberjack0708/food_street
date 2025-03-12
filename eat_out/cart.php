<?php 
session_start();
require_once("../connMysql.php");
//連線資料庫

if (!empty( $_GET['pid'])  && !empty( $_GET['uid']) ){
	$product_id = $_GET['pid'];
	$user_code = $_GET['uid'];
	$sql_query = "delete  FROM `cart` where user_code='".$user_code."' and product_id='".$product_id."'";
    $result = $db_link->query($sql_query) or die($db_link->error);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>購物車</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="assets/css/custom.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
		<link rel="stylesheet" href="../layout/styles/jquery-labelauty.css">
		<link rel="icon" type="image/x-icon" href="../images/FOOD.png" />	
		<style>
            input.labelauty + label { font: 12px "Microsoft Yahei";}
			.dowebok li { display: inline-block; margin: 10px 0; }
			.labelauty-unchecked {color:black;}
			.labelauty-checked {color:black;}	

			/* 下拉式選單 */
			.menu select {
			background: transparent;
			width: 140px;
			font-size: 14px;
			border: 1px solid #eee;
			height: 35px; 
			} 
			.menu{
			margin: 40px;
			width: 125px;
			height: 34px;
			border: 1px solid black;
			overflow: hidden;
			background: 100% / 15% no-repeat #ccc;
			}	
        </style>
				
	</head>

	<body>
<?php 
$cart_amount=0;
// printf($menu_row,'../images/LOGO.png', '../index_login.php', '../program/index.php', '../pages/food_rule.php','../pages/his_order.php','store_list.php','../index.php?logout=1',$_SESSION['username'],'cart.php',$cart_amount);
printf($menu_row,'../images/HFS2.jpg', '../index_login.php', '../eat_out/copp_storelist.php', '../pages/vote.php', 'store_list.php', '../pages/food_rule.php','../pages/his_order.php','../index.php?logout=1',$_SESSION['username'],'cart.php',$cart_amount,'');
?>
<div style="margin:40px"></div>
<div class="container text-center">

			<div class="col-md-3 col-sm-12">
				<div class="bigcart"></div>
				<h1>你的購物清單</h1>
				<p>
					訂購時請注意飲食均衡 (可用資料庫顯示)
				</p>
			</div>
			
			<div class="col-md-9 col-sm-12 text-left">
			<form class="btmspace-30" id="cartdetail" name="cartdetail" method="post" action="">
				<ul>
					<li class="row list-inline columnCaptions" style="border: 1px solid #ccc;">
						<span class="itemName">商品名稱</span>
                        <span class="delbtn">刪除</span>
                        <span class="editbtn">修改</span>
						<span class="quantity" style="padding-right:0;">數量</span>
						<span class="price" style="padding-right:0;">單價</span>
					</li>
					<?php 
					$total_fee=0;
					$total_price=0;
					$count=0;
					$sql_query = "SELECT DISTINCT delivery_menu.store_id, store_name, delivery_fee
					FROM cart 
					Join delivery_menu on cart.product_id =delivery_menu.food_code 
					join store on delivery_menu.store_id=store.store_id
					where cart.user_code='".$_SESSION['user_code']."'";
					$result2 = $db_link->query($sql_query) or die($db_link->error);
					while ($raw = $result2->fetch_assoc())  {
						$gg_storeid=$raw["store_id"];
						$gg_storename=$raw["store_name"];
						$total_fee += $raw["delivery_fee"];
						$_SESSION['ttf'] = $total_fee;
						$sql_query = "SELECT cart.*,delivery_menu.name,delivery_menu.points
						FROM `cart` 
						join `delivery_menu` on cart.product_id=delivery_menu.food_code 
						where user_code='".$_SESSION['user_code']."' and delivery_menu.store_id=$gg_storeid  ";
						$result = $db_link->query($sql_query) or die($db_link->error);
						echo "<li><span>$gg_storename</span></li>";
						$points = 0;
						$points2 = 0;
						while ($row = $result->fetch_assoc())  {
							$points += $row["points"];
							$points2 += $row["points"];
							$word='<li class="row">
							<span class="itemName">%s</span>
							<span class="delbtn"><a href="cart.php?pid=%d&uid=%d"><span class="glyphicon glyphicon-remove"></span></a></span>
							<span class="editbtn"><a href="javascript: changeamount(%d);"><span class="glyphicon glyphicon-pencil"></span></a></span>
							<span class="quantity"><input type="number" id="amount%d" name="amount%d" min="1" max="30" value="%d" style="width:60px;" /></span>
							<span class="price">$<input type="text" id="price%d" name="price%d" value="%.2f" style="border:0;width:80px;background-color:transparent;display:inline;"/></span>
							</li>';
							printf($word,$row["name"],$row["product_id"],$_SESSION['user_code'],$row["product_id"],$row["product_id"],$row["product_id"],$row["amount"],$row["product_id"],$row["product_id"],$row["price"]);
							$total_price=$total_price+$row["amount"]*$row["price"];
							
						}
                        $count=$count+1; 
						
					}
					
						if($count==0){
							echo "<li><span>尚未選購任何商品</span></li>";
						} 
						               
                    ?>
					
					<li class="row"><ul class="dowebok">
					<?php
					foreach ($pay_way as $key => $val) {
						echo '<li><input type="radio" name="pay_way" value="' .$key. '" data-labelauty="' .$val. '"></li>';
					} 
					
					?></ul>								
					</li>
					<li class="row"><ul class="dowebok">
					<!-- 下拉式選單 -->
					<?php 
					$TTP=0;
					$sql_query="SELECT points,amount
					from `order_items` 
					left join `order_form` on 
					order_items.orderfrom_id=order_form.order_id      
					left join `delivery_menu` on 
					delivery_menu.food_code = order_items.product_id
					where order_form.usercode='".$_SESSION['user_code']."' " ;
					$result = $db_link->query($sql_query) or die($db_link->error);
					while($row = $result->fetch_assoc()){
						$total_p=$row["points"] * $row["amount"];
						$TTP=$TTP+$total_p;
					}

					echo  '<form method="POST" action="">
					<div class="menu" style="padding: 0%;margin: 0 auto;margin-left:0%">';
					if($TTP >= 1 && isset($TTP)){
						echo'<select>
						<option selected>可抵用點數: '.$TTP.' </option>
						</select>';
					}else{
						echo'<select>
						<option selected>紅利點數不足</option>
						</select>';
					}
					echo'</div>
					<span class="price" style="margin-top: -8.5%;"><input type="button" value="抵用"></span>
					</ul>								
					</li>
					</form>  ';
					?>
					<li class="row totals">
						<span class="itemName">總金額:</span>
						<span class="price">$<input type="text" id="total_price" name="total_price" value="<?php echo $total_price;?>"  style="border:0;width:70px;background-color:transparent;display:inline;"/></span>
						<span class="itemName">運費:</span>
						<span class="price"><input type="text" id="freight" name="freight" value="-"  style="border:0;width:70px;background-color:transparent;display:inline;"/></span>
						<span class="itemName">累積紅利:</span>
						<span class="price"><input type="text" id="points" name="points" value="<?php if(isset($points)){echo $points;}else{echo '-';}?>"  style="border:0;width:70px;background-color:transparent;display:inline;"/></span>
						<span class="order"> <a class="text-center" href="javascript:document.getElementById('cartdetail').action='Checkout.php'; document.getElementById('cartdetail').submit();">送出訂單</a></span>
						<br>
						
					</li>
					
				</ul>
				</form>
			</div>

</div>
<div class="wrapper row4">
  <footer id="footer" class="clear"> 
    <div class="one_quarter first">
      <h6 class="title">聯絡創作者</h6>
      <address class="btmspace-15">
      0900-000-000<br>
      0900<!--&amp;-->-111-111<br>
      0900-222-222<br>
      0900-333-333  
      </address>
      <ul class="nospace">
        <li class="btmspace-10"><span class="fa fa-phone"></span> +886  000 0000</li>
        <li><span class="fa fa-envelope-o"></span> user@gmail.com</li>
      </ul>
    </div>
    <div class="one_quarter">
      <h6 class="title">關於創作者</h6>
      <ul class="nospace linklist">
        <li><a href="#">首頁</a></li>
        <li><a href="#">facebook</a></li>
        <li><a href="#">instagram</a></li>
        <li><a href="#">discord</a></li>
        <li><a href="#">twitter</a></li>
      </ul>
    </div>
    <div class="one_quarter"> 
      <h6 class="title">前往更多相關連結</h6>
      <article>
        <h2 class="nospace"><a href="#"></a></h2>
        <!-- <time class="smallfont" datetime="2045-04-06">ksvcs<sup>th</sup> 11月 2021</time> -->
        <!-- <p>指導老師:哈利波特</p> -->
      </article>
    </div>
    <div class="one_quarter">
      <h6 class="title">給我們更多建議</h6>
      <form class="btmspace-30" method="post" action="#">
        <fieldset>
          <legend>Newsletter:</legend>
          <input class="btmspace-15" type="text" value="" placeholder="Email">
          <button type="submit" value="submit">送出</button>
        </fieldset>
      </form>
      <ul class="faico clear">
        <li><a class="faicon-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a class="faicon-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a class="faicon-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
        <li><a class="faicon-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
        <li><a class="faicon-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
        <li><a class="faicon-tumblr" href="#"><i class="fa fa-tumblr"></i></a></li>
      </ul>
    </div>
  </footer>
</div>
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a> 
<!-- JAVASCRIPTS -->
<script src="../layout/scripts/jquery.min.js"></script>
<script src="../layout/scripts/jquery.backtotop.js"></script>
<script src="../layout/scripts/jquery.mobilemenu.js"></script>
<script src="../layout/scripts/jquery.flexslider-min.js"></script>

		<!-- The popover content -->

		<div id="popover" style="display: none">
			<a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
			<a href="#"><span class="glyphicon glyphicon-remove"></span></a>
		</div>
		
		<!-- JavaScript includes -->

		<script src="../layout/scripts/jquery-labelauty.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/customjs.js"></script>
		<script>
		$(function(){
			$(':input').labelauty();
		});
		</script>		
		<script>
			function changeamount(foodid){
				var thisamount=document.getElementById('amount'+foodid);
				var thisprice=document.getElementById('price'+foodid);
				var thistotal=document.getElementById('total_price');
				//if (thisamount) {
				//	alert(foodid+'|'+ thisamount.value*thisprice.value);
				//}
				var allele=document.querySelectorAll('input');
				//allele.length
					var thisprice=0;
					var thisamount=0;
					var totalprice=0;
					
					for (i=0; i<allele.length; i++) {
						if (allele[i].id.substr(0,5)=='price'){
							thisprice=parseInt(allele[i].value);
							//alert(thisprice);
						}
						if (allele[i].id.substr(0,6)=='amount'){
							thisamount=parseInt(allele[i].value);
							//alert(thisamount);
						}
						
						if (thisamount>0 && thisprice>0) {
							//alert( thisprice + '|' + (parseInt(thisprice) * parseInt(thisamount)) );
							totalprice = totalprice + (parseInt(thisprice) * parseInt(thisamount));
							thisprice=0;
							thisamount=0;
							
						}
					}
				//alert(totalprice);
				thistotal.value=totalprice;
				alert('修改成功，新的訂單金額為'+thistotal.value + '元');
			}
		</script>
	</body>
</html>