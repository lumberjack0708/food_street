<?php
    session_start();
    require_once("connMysql.php");
    // 連線資料庫
    $name = " ";
    if(isset($_SESSION['username'])){
      $name = $_SESSION['username'];
    }
      if (!empty( $_GET['logout']) && $_GET['logout']=="1" ){
        //session_destroy();
        session_destroy();
      }
?>
<!DOCTYPE html>
<html>
<head>
<title>美食街系統</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<link rel="icon" type="image/x-icon" href="images/FOOD.png" />

</head>
<body id="top">
<?php 
$cart_amount=0;
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
	printf($menu_row,'images/HFS2.jpg', 'index_login.php', 'eat_out/copp_storelist.php', 'pages/vote.php','eat_out/store_list.php','pages/food_rule.php','pages/his_order.php','index_login.php?logout=1',$name,'eat_out/cart.php',$cart_amount,'');
} else {
	printf($menu_row,'images/HFS2.jpg', 'index_login.php', 'eat_out/copp_storelist.php', 'pages/vote.php', 'eat_out/store_list.php', 'pages/food_rule.php','store/login.php','pages/login.php','');
}
?>
<div class="wrapper">
  <div id="slider" class="clear"> 
    <div class="flexslider basicslider">
      <ul class="slides">
        <li><img src="images/ksvcs-1.1.jpg" alt="福利社照片1" >
          <div class="txtoverlay">
            <div class="centralise">
              <div class="verticalwrap">
                <article>
                  <h1 class="heading uppercase" style="-webkit-text-stroke: 2px black; color:white; font-size:200px"></h1>
                </article>
              </div>
            </div>
          </div>
        </li>
        
        <li><img src="images/ksvcs-2.jpg" alt="福利社照片2">
          <div class="txtoverlay">
            <div class="centralise">
              <div class="verticalwrap">
              </div>
            </div>
          </div>
        </li>
        <li><img src="images/ksvcs3.jpg" alt="福利社照片3">
          <div class="txtoverlay">
            <div class="centralise">
              <div class="verticalwrap">
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="wrapper row2">
  <div id="services" class="clear"> 
    <div class="group">
      <div class="one_third first">
        <article class="service"><i class="icon red circle fa fa-bell-o"></i>
          <h2 class="heading" style="font-size:28px; line-height:25px">三好校園</h2>
          <p class="btmspace-10" style="font-size:20px; line-height:30px">升學證照品德好</p>
          <p><a href="#" style="font-size:16px; line-height:20px">獲取更多資訊 &raquo;</a></p>
        </article>
      </div>
      <div class="one_third">
        <article class="service"><i class="icon orange circle fa fa-bicycle"></i>
          <h2 class="heading" style="font-size:28px; line-height:25px">三好校園</h2>
          <p class="btmspace-10" style="font-size:20px; line-height:30px">福利社阿姨讓你吃到飽</p>
          <p><a href="#" style="font-size:16px; line-height:20px">獲取更多資訊 &raquo;</a></p>
        </article>
      </div>
      <div class="one_third">
        <article class="service"><i class="icon green circle fa fa-mortar-board"></i>
          <h2 class="heading" style="font-size:28px; line-height:25px">三好校園</h2>
          <p class="btmspace-10" style="font-size:20px; line-height:30px">阿伯滷味送幸福</p>
          <p><a href="#" style="font-size:16px; line-height:20px">獲取更多資訊 &raquo;</a></p>
        </article>
      </div>
  </div>
    <div class="clear"></div>
  </div>
</div>
<div class="wrapper row6">
  </section>
</div>
<div class="wrapper row3">
  <main class="container nospace clear"> 
    <div class="clear"></div>
  </main>
</div>
<div class="wrapper row4">
  <footer id="footer" class="clear"> 
    <!-- ################################################################################################ -->
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
        <!-- <time class="smallfont" datetime="2045-04-06">ksvcs</time> -->
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
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<script src="layout/scripts/jquery.flexslider-min.js"></script>
</body>
</html>

