<?php 
session_start();
require_once("../connMysql.php");
if (!isset($_SESSION['account_rr']) || !isset($_SESSION['host_code'])) {
	header('Location: login.php');
}
    if (!empty( $_GET['logout']) && $_GET['logout']=="1" ){
      //session_destroy();
      session_unset();
	  header('Location: login.php');
    }

?>
<html>
  <head>
  <meta charset="utf-8" />
        <title>[店家管理]首頁</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../images/FOOD.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="description" content="" />
        <meta name="author" content="" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="../layout/styles/layout.css">

        <!-- 購物車css -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="../eat_out/assets/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../eat_out/assets/css/custom.css"/>
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
    printf($menu_row,'../images/HFS2.jpg', 'index.php','order_list.php','index.php','index.php?logout=1',$_SESSION['host_code'],'');
    ?>

<div style="margin:40px"></div>
<div class="container text-center">
<?php
$sql_query="SELECT * from  store
  where store_id='".$_SESSION['host_code']."'";
$result = $db_link->query($sql_query) or die($db_link->error);
while ($row = $result->fetch_assoc())  {
    echo " <h1 style='font-size:40px;'><b>".$row['store_name']."</b></h1>
    <div style='font-size:16px;'>".$row['address']."</div>
    <div style='font-size:18px;'>".$row['store_intro']."<div>";

}
?>
    <!-- <div class="col-md-3 col-sm-12">
      <div class="bigcart"></div>
      <h1>你的購物清單</h1>
      <p>
        訂購時請注意飲食均衡 (可用資料庫顯示)
      </p>
    </div> -->
    <!-- class="col-md-12 col-sm-12 text-left" -->
    <div >
    <form class="btmspace" id="cartdetail" name="cartdetail" method="post" action="">

      <ul>
        <!-- row list-inline columnCaptions -->
        <li class=" row list-inline columnCaptions" >
          <span class="itemName">上架確認</span>
          <span class="itemName">商品名稱</span>
          
          <span class="editbtn">修改</span>
          <span class="quantity" style="padding-right:0;">新單價</span>
        </li>           
        
        <li class="row">
        <ul class="dowebok"></ul>								
        </li>
        <?php
//搜尋該店家的商品細項
$sql_query="SELECT * from  delivery_menu
            where delivery_menu.store_id='".$_SESSION['host_code']."'";
$result = $db_link->query($sql_query) or die($db_link->error);
$total_fee=0;
$total_price=0;
$count=0;
$islauch = 0 ;
while ($row = $result->fetch_assoc())  {
    $islaunch = $row["is_launched"] ;
    if($islaunch==1){ $islaunch='checked="checked"'; }else{$islaunch = "";}
    $price = $row["price"];
    if(isset($price)){ $price='priced="priced"'; }else{$price = "";}
    $word='<li class="row">
    <span class="itemName"><input type="checkbox" id="launch%d" name="launch" value="%d" %s style="border:0;width:80px;background-color:transparent;display:inline;"/></span>
    <span class="itemName">%s</span>
    <span class="editbtn"><a href="javascript: changeprice(%d);"><span class="glyphicon glyphicon-pencil" id="editbtn%d" name="editbtn"></span></a></span>
    <span class="price">$<input type="number" id="newpr%d" name="newpr" value="%.2f" style="width:80px;background-color:transparent;display:inline;" /></span>
    
    </li>';
    printf($word,$row["food_code"],$row["food_code"],$islaunch,$row["name"]
    ,$row["food_code"],$row["food_code"],$row["food_code"],$row["price"]);
    
}
$count=$count+1; 
  

  if($count==0){
    echo "<li><span>尚未有任何商品</span></li>";
  }       
?>
        
      </ul>
      </form>
    </div>

  </div>  



<!-- JAVASCRIPTS -->
<script src="../layout/scripts/jquery.min.js"></script>
<script type="text/javascript">
    $('input[name=launch]').click(function(){
		//if a checkbox with name 'launch' is clicked, do the following.
		//grab the id from the clicked box
		var id=$(this).val();
		
		var launch=$(this).is(":checked")
		if(launch) {
			launch = 1;
		} else {
			launch = 0;
		}

		//setup the ajax call
		$.ajax({
				type:'POST',
				url:'doupdate.php',
				data:{
					id:id,
					launch:launch
				},
				success:function(response) {
					if (response=="ok")  {
						alert("上下架設定成功！");
					}  else{
						alert("上下架錯誤，請確認商品項目資料正確。");
					}
				}

			});
    });

    //調整價格
	/*
function changeprice(foodcode){
  var newprice = document.getElementById('newpr'+foodcode);
  if (newprice) {
    var price=newprice.value;
    alert(foodcode + '|' + price);
    $.ajax({
				type:'POST',
				url:'doupdateprice.php',
				data:{
					id:foodcode,
					price:newprice
				},
				success:function(response) {
					if (response=="ok")  {
						alert("修改價格成功！");
					}  else{
						alert("修改價格錯誤。");
					}
				}

			});
  }

}
*/

    $('span[name=editbtn]').click(function(){
		var id=$(this).attr('id');
		id = id.replaceAll('editbtn','');
		var price=$('#newpr'+id).val();
		
		//alert(id + '|' + price);
		$.ajax({
			type:'POST',
			url:'doupdateprice.php',
			data:{
				id:id,
				price:price
			},
			success:function(response) {
				if (response=="ok")  {
					alert("修改價格成功！");
				}  else{
					alert("修改價格錯誤。");
				}
			}

		});		
     });  

</script>
  </body>
</html>