<!-- 訂單管理 -->
<?php
    session_start();
    require_once("../connMysql.php");
    $store_name = 0;
    $sql_query5 = "SELECT store.store_name,store_id FROM store WHERE store_id = ".$_SESSION['host_code'].";";
    $result5 = $db_link->query($sql_query5) or die($db_link->error);
    if ($row2 = $result5->fetch_assoc()) {
    $store_name = $row2["store_name"];
    }
?>
<html>
    <head>
    <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <link rel="icon" type="image/x-icon" href="../images/FOOD.png" />
    <style type="text/css">
    /* DEMO ONLY */
    .container .demo{text-align:center;}
    .container .demo div{padding:8px 0;}
    .container .demo div:nth-child(odd){color:#000; background:#D0D0D0;}
    .container .demo div:nth-child(even){color:#000; background:#94B7C0;}
    @media screen and (min-width:180px) and (max-width:900px){.container .demo div{margin-bottom:0;}}
    /* DEMO ONLY */
    </style>
    <title>[<?php echo $store_name?>]管理訂單</title>
    </head>
    <body>
    <?php 
    $cart_amount = 0;
    printf($menu_row,'../images/HFS2.jpg', 'index.php','','index.php','index.php?logout=1',$_SESSION['host_code'],'');
    ?>      
<div class="wrapper row3">
  <main class="container clear" > 
    <div class="content"> 
      <h1 style="font-size:50px;"><b>[<?php echo $store_name ;?>]管理訂單</b></h1>
      <div class="group btmspace-50 demo" >
        <div class="one_sixth" style="background:#000;color:#FFFFFF;font-size: 30px">編號</div>
        <div class="one_sixth " style="background:#000;color:#FFFFFF;font-size: 30px">訂購人</div>
        <div class="one_quarter" style="background:#000;color:#FFFFFF;font-size: 30px">品項</div>
        <div class="one_sixth" style="background:#000;color:#FFFFFF;font-size: 30px">金額</div>
        <div class="one_sixth " style="background:#000;color:#FFFFFF;font-size: 30px">日期</div>
      </div>
<?php
      $host_code = 0;
      $host_code = $_SESSION['host_code'];
      $ttp = 0;
      $product_id = 0; 
      $orderfrom_id = 0;
      $amount = 0; 
      $order_id = 0;
      $price = 0; 
      $class_id = 0;
      $order_date = 0; 
      $store_id = 0;
      $idd = 0;
      $food_name = 0;
      $is_finish = 0;

      $sql_query = "SELECT product_id,amount,order_items.price,usercode,orderfrom_id,
      order_id,class_id,order_date,`name`,order_items.store_id,delivery_menu.price,is_finish
      FROM `order_items` 
      JOIN `order_form` ON order_id = orderfrom_id
      JOIN `user` ON user_code = usercode
      JOIN `delivery_menu` ON delivery_menu.`food_code` = product_id
      WHERE order_items.`store_id` = ".$host_code." 
      ORDER BY order_date DESC;";
      $result = $db_link->query($sql_query) or die($db_link->error);
      

      while ($row = $result->fetch_assoc()) {
        $is_finish = $row["is_finish"] ;
        if($is_finish==1){$is_finish='checked="checked"'; }else{$is_finish = "";}

        $product_id = $row["product_id"]; 
        $orderfrom_id = $row["orderfrom_id"];
        $amount = $row["amount"]; 
        $order_id = $row["order_id"];
        $usercode = $row["usercode"]; 
        $class_id = $row["class_id"];

        $order_date = strtotime($row["order_date"]); 
        $order_date = date("m-d",$order_date);

        $food_name = $row["name"];
        
        $price = $row["price"]; 

        if($idd != $row["orderfrom_id"] ){
        if($idd>0){
          echo"訂單金額: 小結 <hr>";
        }
        $order_pr=0;
        echo"訂購日期:".$order_date." 
            
        <hr>";
        
        }
      //   $total_p=$row["points"] * $row["amount"];
        echo '<div class="group btmspace-50 demo" >
        
        <div class="one_sixth" style="font-size: 28px;"><input type="checkbox" id="finish'.$order_id.'-'.$product_id.' " name="finish" value="'.$order_id.'-'.$product_id.'" '.$is_finish.' style="display:inline;border:0;background-color:transparent;"><b>'.$order_id.'</b></div>
        <div class="one_sixth " style="font-size: 28px;">'.$usercode.'</div>
        <div class="one_quarter" style="font-size: 28px;">'.$food_name.'</div>
        <div class="one_sixth" style="font-size: 28px;">'.$price.'</div>
        <div class="one_sixth " style="font-size: 28px;">'.$order_date.'</div>
        
      </div> ';
      $ttp += $price;
      }
      // echo"訂單金額: 小結 ";
      echo'
      <br>
      <hr>
      <div class="group btmspace-50 demo" >
      <div class="one_sixth" style="font-size: 28px;">各項總和:</div>
      <div class="one_sixth " style="font-size: 28px;">-</div>
      <div class="one_quarter" style="font-size: 28px;">-</div>
      <div class="one_sixth" style="font-size: 28px; "><b>'.$ttp.'元</b></div>
      <div class="one_sixth " style="font-size: 28px;">-</div>
    </div>';
      
?>

<script src="../layout/scripts/jquery.min.js"></script>
<script type="text/javascript">
    $('input[name=finish]').click(function(){
		//if a checkbox with name 'launch' is clicked, do the following.
		//grab the id from the clicked box
		var id=$(this).val();
		
		var finish=$(this).is(":checked")
		if(finish) {
			finish = 1;
		} else {
			finish = 0;
		}

		//setup the ajax call
		$.ajax({
				type:'POST',
				url:'doupdatefin.php',
				data:{
					id:id,
					finish:finish
				},
				success:function(response) {
					if (response=="ok")  {
						alert("訂單項目狀態設定完成");
					}  else{
						alert("訂單項目狀態設定錯誤，請重新設定。");
					}
				}

			});
    });
</script>

</body>
</html>