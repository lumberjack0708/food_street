<?php 
session_start();
require_once("../connMysql.php");
//連線資料庫

if (!empty( $_GET['pid'])  && !empty( $_GET['uid']) ){
	$product_id = $_GET['pid'];
	$user_code = $_GET['uid'];
	$sql_query = "delete  FROM `copp_cart` where user_code='".$user_code."' and product_id='".$product_id."'";
    $result = $db_link->query($sql_query) or die($db_link->error);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>購物車[福利社]</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="assets/css/custom.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
		<link rel="icon" type="image/x-icon" href="../images/FOOD.png" />		
	</head>

	<body>
	<?php 
$cart_amount=0;
// $ary = array('../images/LOGO_LOMG02.png', 'store_list.php', '../program/index.php', '../pages/food_rule.php','store_list.php','index.php?logout=1',$_SESSION['username'],$cart_amount);
printf($menu_row,'../images/HFS2.jpg', '../index_login.php', '../eat_out/copp_storelist.php', '../pages/vote.php', 'store_list.php', '../pages/food_rule.php','../pages/his_order.php','../index.php?logout=1',$_SESSION['username'],'copp_cart.php',$cart_amount,'');
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
			<form class="btmspace-30" id="copp_cartdetail" name="copp_cartdetail" method="post" action="#">
				<ul>
					<li class="row list-inline columnCaptions">
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
						$points=0;
					$sql_query = "SELECT DISTINCT heat.type_id, type_name
					FROM copp_cart 
					Join heat on copp_cart.product_id =heat.number
					join copp_type on heat.type_id=copp_type.type_id
					where copp_cart.user_code='".$_SESSION['user_code']."'";
					$result2 = $db_link->query($sql_query) or die($db_link->error);
					while ($raw = $result2->fetch_assoc())  {
						$type_id=$raw["type_id"];
						$gg_storename=$raw["type_name"];
						// $total_fee += $raw["delivery_fee"];
						// $_SESSION['ttf'] = $total_fee;
						// $points=$raw["points"];
						$sql_query = "SELECT copp_cart.*,heat.* 
						FROM `copp_cart` 
						join `heat` on copp_cart.product_id=heat.number
						where user_code='".$_SESSION['user_code']."' and heat.type_id=$type_id  ";
						$result = $db_link->query($sql_query) or die($db_link->error);
						echo "<li><span>$gg_storename</span></li>";

						while ($row = $result->fetch_assoc())  {
							$word='<li class="row">
							<span class="itemName">%s</span>
							<span class="delbtn"><a href="copp_cart.php?pid=%d&uid=%d"><span class="glyphicon glyphicon-remove"></span></a></span>
							<span class="editbtn"><a href="javascript: changeamount(%d);"><span class="glyphicon glyphicon-pencil"></span></a></span>
							<span class="quantity"><input type="number" id="amount%d" name="amount%d" min="1" max="10" value="%d" style="width:60px;" /></span>
							<span class="price">$<input type="text" id="price%d" name="price%d" value="%.2f" style="border:0;width:80px;background-color:transparent;display:inline;"/></span>
							</li>';
							printf($word,$row["food_name"],$row["number"],$_SESSION['user_code'],$row["number"],$row["number"],$row["number"],$row["amount"],$row["number"],$row["number"],$row["price"]);
							$total_price=$total_price+$row["amount"]*$row["price"];
							
							

						}
                        $count=$count+1; 

				}
						if($count==0){
							echo "<li><span>尚未選購任何商品</span></li>";
						}                
                    ?>			
					
					<li class="row totals">
						<span class="itemName">總金額:</span>
						<span class="price">$<input type="text" id="total_price" name="total_price" value="<?php echo $total_price;?>"  style="border:0;width:70px;background-color:transparent;display:inline;"/></span>
						<span class="itemName">運費:</span>
						<span class="price"><input type="text" id="freight" name="freight" value="<?php echo "無運費";?>"  style="border:0;width:70px;background-color:transparent;display:inline;"/></span>
						<span class="itemName">紅利:</span>
						<span class="price"><input type="text" id="points" name="points" value="<?php echo "無紅利";?>"  style="border:0;width:70px;background-color:transparent;display:inline;"/></span>
						<span class="order"> <a class="text-center" href="javascript:document.getElementById('copp_cartdetail').action='copp_Checkout.php'; document.getElementById('copp_cartdetail').submit();">送出訂單</a></span>
						
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

		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> 
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/customjs.js"></script>
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