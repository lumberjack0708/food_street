<?php
    session_start();
    require_once("../connMysql.php");
    
?>
<!DOCTYPE html>
<html>
<head>
<title>歷史訂單</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
</head>
<body id="top">
<?php 
    $cart_amount = 0;
    // printf($menu_row,'../images/HFS2.jpg', 'index.php', 'eat_out/copp_storelist.php', 'pages/vote.php','additem.php','manageitems.php','pages/his_order.php','index.php?logout=1',$_SESSION['user_code'],'');
    printf($menu_row,'../images/HFS2.jpg', '../index_login.php', '../eat_out/copp_storelist.php', 'vote.php','../eat_out/store_list.php','food_rule.php','his_order.php','../index.php?logout=1',$_SESSION['username'],'copp_cart.php',$cart_amount,'');
    ?>
<div class="wrapper row3">
  <main class="container clear" > 
    <div class="content"> 
      <h1 style="font-size:50px;"><b>歷史訂單</b></h1>
      <div class="group btmspace-50 demo" >
        <div class="one_quarter" style="background:#000;color:#FFFFFF;font-size: 30px">商品品項</div>
        <div class="one_sixth " style="background:#000;color:#FFFFFF;font-size: 30px">數量</div>
        <div class="one_sixth" style="background:#000;color:#FFFFFF;font-size: 30px">金額</div>
        <div class="one_sixth" style="background:#000;color:#FFFFFF;font-size: 30px">熱量</div>
        <div class="one_sixth " style="background:#000;color:#FFFFFF;font-size: 30px">紅利</div>
      </div>
<?php
    $total_fee=0;
    $total_price=0;
    $count=0;
    $TTP=0;
    $sql_query = "SELECT name,amount,ca,points,order_items.price,orderfrom_id,order_date
    FROM `order_items` 
    left join `order_form` on 
    order_items.orderfrom_id=order_form.order_id      
    left join `delivery_menu` on 
    delivery_menu.food_code = order_items.product_id
    where order_form.usercode='".$_SESSION['user_code']."' 
    order by orderfrom_id desc";
    $result2 = $db_link->query($sql_query) or die($db_link->error);
    $ttc=0;
    $ttpr=0;  
    $tta=0;
    $idd=0;
    $order_pr=0;
    $TTPU = 0;

    while ($row = $result2->fetch_assoc()) {
      if($idd != $row["orderfrom_id"] ){
      if($idd>0){
        echo"訂單金額: $order_pr <hr>";
      }
      $order_pr=0;
      echo"訂購日期:".$row['order_date']." 
           
      <hr>";
      
      }
      $total_p=$row["points"] * $row["amount"];
      echo '<div class="group btmspace-50 demo" >
      <div class="one_quarter" style="font-size: 28px;"><b>'.$row["name"].'</b></div>
      <div class="one_sixth " style="font-size: 28px;">'.$row["amount"].'</div>
      <div class="one_sixth" style="font-size: 28px;">'.$row["price"].'</div>
      <div class="one_sixth" style="font-size: 28px;">'.$row["ca"].'大卡</div>
      <div class="one_sixth " style="font-size: 28px;">'.$total_p.'點</div>
      
    </div> ';
    $order_pr  += $row["price"];
    $idd =  $row["orderfrom_id"];
      $ttpr=$ttpr+$row["price"];
      $TTP=$TTP+$total_p;
      $ttc=$ttc+$row["ca"];
      $tta=$tta+$row["amount"];
      $count=$count+1; 
    }
    echo"訂單金額: $order_pr ";
    echo'
    <hr/>
    <div class="group btmspace-50 demo" >
    <div class="one_quarter" style="font-size: 28px;">各項總和:</div>
    <div class="one_sixth " style="font-size: 28px;">-</div>
    <div class="one_sixth" style="font-size: 28px;">'.$ttpr.' 元</div>
    <div class="one_sixth" style="font-size: 28px; ">'.$ttc.'大卡</div>
    <div class="one_sixth " style="font-size: 28px;"><b>'.$TTP.' 點</b></div>
  </div>';
    
?>
    </div>
    <div class="clear"></div>
  </main>
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
<!-- <div class="wrapper row5">
  <div id="copyright" class="clear"> 
    <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">food street</a></p>
    <p class="fl_right">Template by <a target="_blank" href="https://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
  </div>
</div> -->
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a> 
<!-- JAVASCRIPTS -->
<script src="../layout/scripts/jquery.min.js"></script>
<script src="../layout/scripts/jquery.backtotop.js"></script>
<script src="../layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>