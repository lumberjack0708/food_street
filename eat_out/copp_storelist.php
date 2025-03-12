<?php
    session_start();
    require_once("../connMysql.php");
    // 連線資料庫
    if (!empty( $_SESSION['user_code'])){
      // 查詢cart
      $sql_query = 'SELECT count(*) as total FROM `copp_cart` where user_code='.$_SESSION['user_code'].'; ';
      $result = $db_link->query($sql_query) or die($db_link->error);
      if ($row = $result->fetch_assoc())  {
        $cart_amount = $row["total"];  
      } }
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="<?=$_SESSION['user_code']?>" />
        <title>[福利社預購]類別選擇</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../images/FOOD.png" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />

        <link rel="stylesheet" href="../layout/styles/layout.css">
    </head>
    <body>
<!--#################################################################################################################-->
<body id="top">
  
<?php 
//$cart_amount=0;
$username='';
if (!empty($_SESSION['username']))  $username=$_SESSION['username'];
printf($menu_row,'../images/HFS2.jpg', '../index_login.php', 'copp_storelist.php', '../pages/vote.php','store_list.php','../pages/food_rule.php','../pages/his_order.php','../index.php?logout=1',$username,'copp_cart.php',$cart_amount,'');
?>
<!--#################################################################################################################-->
<header style="background-image: url(../images/back.jpg); ">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">

                <h1 class="display-4 fw-bolder" style="border-width: 3px ;  padding: 5px; text-align: center; background-color: rgb(255, 255, 255, 0.7);border-radius: 4px;color:#4F4F4F;">合作社商品區</h1>
                
            </div>
        </div>
</header>     
        <div class="container px-4 px-lg-5">
            <div >
                <div class="col-lg-5">
                </div>
            </div>
            <div class="card text-white bg-secondary my-5 py-4 text-center">
                <div class="card-body" ><p class="text-white m-0" style="font-size: 32px;">預購後請準時取餐</p></div>
            </div>
            <div class="row gx-4 gx-lg-5">
            <?php
            $sql_query = "SELECT * FROM `copp_type`";
            $result = $db_link->query($sql_query) or die($db_link->error);
            $count=0;
            while ($row = $result->fetch_assoc())  {
              echo '  <div class="col-md-4 mb-5">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="card-title">'.$row["type_name"]. '</h2>
                            <p class="card-text"></p>
                        </div>
                        <div class="card-footer"><a class="btn btn-primary btn-sm" href="copp_food_list.php?type_id='.$row["type_id"].'">預購</a></div>
                    </div>
                </div>';


              $count=$count+1;
            }
            if($count==0){
              echo "無店家";
            }
            // $db_link->close();      
            ?>                


                
            </div>
        </div>
        <!-- Footer-->
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
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<script src="layout/scripts/jquery.flexslider-min.js"></script>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
    </body>
</html>
