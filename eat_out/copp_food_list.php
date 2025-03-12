<?php
    session_start();
    require_once("../connMysql.php");
    // 連線資料庫
    $type_id = 0;
    $food_id = 0;
    $price = 0;
    $amount = 0;
    if (isset($_POST['type_id']) && isset($_POST['food_id']) && isset($_POST['amount'])) {
          $type_id = $_POST['type_id'];
          $food_id = $_POST['food_id'];
          $amount = $_POST['amount']; 
        if (is_numeric($type_id) && is_numeric($food_id) && is_numeric($amount) ){
          $sql_query="select price from `heat` where number='".$food_id."'";
          $result = $db_link->query($sql_query) or die($db_link->error);
          $count=0;
          if ($row = $result->fetch_assoc())  {
          $price = $row["price"];  
          }
          // 查詢是否重複訂購 有的話用update 沒有用insert
          $sql_query="select count(*) as total from `copp_cart` where product_id=".$food_id." && user_code='".$_SESSION['user_code']."'";
          $result = $db_link->query($sql_query) or die($db_link->error);
          if ($row = $result->fetch_assoc())  {
            $isexist = $row["total"];  
          }
          if($isexist > 0 ){
            $sql_query='UPDATE `copp_cart`
            SET amount = amount + '.$amount.' WHERE user_code='.$_SESSION['user_code'].' and product_id='.$food_id.' ';
            $result = $db_link->query($sql_query) or die($db_link->error);
          
          }else{
        
          $sql_query='insert into copp_cart(product_id, user_code, price, amount)
          VALUES ('.$food_id.', '.$_SESSION['user_code'].', '.$price.','.$amount.');'; 
          $result = $db_link->query($sql_query) or die($db_link->error);
          
          }
         
        }
      
    }
    
    
     // 查詢cart
     $sql_query = 'SELECT count(*) as total FROM `copp_cart` where user_code='.$_SESSION['user_code'].'; ';
     $result = $db_link->query($sql_query) or die($db_link->error);
     if ($row = $result->fetch_assoc())  {
       $cart_amount = $row["total"];  
     }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <?php
            $type_id = $_GET['type_id'];
            $sql_query = "SELECT * FROM `copp_type` where type_id='".$type_id."'";
            // $sql_query = "SELECT * FROM `delivery_menu` where type_id='{$type_id}'";
            $result = $db_link->query($sql_query) or die($db_link->error);
            $count=0;
            while ($row = $result->fetch_assoc())  {
            //   echo "<li class='one_quarter'><a href='food_list.php?type_id=".$row["type_id"]."'>".$row["store_name"]."</a></li>";

                // echo "'.$row["W"].'";
                
              $type_name=$row["type_name"];

              $count=$count+1;
            }
            if($count==0){
              echo "無此類別";
            }
            // $db_link->close();  
            echo "<title> $type_name </title> ";

            ?>           

       
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />

        <link rel="stylesheet" href="../layout/styles/layout.css"/>
    </head>
    <body>
<?php 
printf($menu_row,'../images/HFS2.jpg', '../index_login.php', '../eat_out/copp_storelist.php', '../pages/vote.php', 'store_list.php', '../pages/food_rule.php','../pages/his_order.php','../index.php?logout=1', $_SESSION['username'], 'copp_cart.php', $cart_amount,'');
?>
<?php

$sql_query = "SELECT * FROM `heat` where heat.type_id='".$type_id."'";
// $sql_query = "SELECT * FROM `delivery_menu` where type_id='{$type_id}'";
$result = $db_link->query($sql_query) or die($db_link->error);
$count=0;
if ($row = $result->fetch_assoc())  {

echo'<header style="background-image: url(../images/store/'.$row["type_id"].'.jpg); ">
<div class="container px-4 px-lg-5 my-5">
    <div class="text-center text-white">

        <h1 class="display-4 fw-bolder" style="border-width: 3px ;  padding: 5px; text-align: center; background-color: rgb(255, 255, 255, 0.7);border-radius: 4px;color:#4F4F4F;">'.$type_name.'</h1>
        
    </div>
</div>
</header>';}
?>
        
        <!-- Section-->
        <section class="py-5">
                <form id="orderform" name="orderform" method="post" action="" style="display:inline;">
                  <input type="hidden" id="type_id" name="type_id" value="<?php echo $type_id;?>" />
                  <input type="hidden" id="food_id" name="food_id" value="0" />
                  <input type="hidden" id="amount" name="amount" value="0" />
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
            $type_id = $_GET['type_id'];
            $sql_query = "SELECT * FROM `heat` where type_id='".$type_id."'";
            // $sql_query = "SELECT * FROM `delivery_menu` where type_id='{$type_id}'";
            $result = $db_link->query($sql_query) or die($db_link->error);
            $count=0;
            while ($row = $result->fetch_assoc())  {
            //   echo "<li class='one_quarter'><a href='food_list.php?type_id=".$row["type_id"]."'>".$row["store_name"]."</a></li>";

                echo '<div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="../images/1.jpg" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder" style="color:#94B7C0">'.$row["food_name"].'</h5><br>
                                <p style="color:#94B7C0"></p>
                                <!-- Product price-->
                                <span style="color:#94B7C0; ">'."$".''.$row["price"].'
                                /數量
                                <input type="number" id="amt'.$row["number"].'" value="1" min="1" max="10" style="width:40px;display:inline;margin: left 20px;"></input> </span>
                            </div>

                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        </div>
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="javascript: add2cart(document.getElementById(\'amt'.$row["number"].'\').value,'.$row["number"].');">加入購物車</a></div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            
                        </div>
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
            
            </form>        
        </section>
        <div class="wrapper row3">
  <main class="container clear"> 
    <!-- main body -->
      </div>
      
    </div>
    
    <!-- / main body -->
    <div class="clear"></div>
  </main>
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
<script>
  function add2cart(amount, foodid) {
      // alert(amount +','+ foodid);orderform
      var ord_form = document.getElementById('orderform');
      var ord_type_id = document.getElementById('type_id');
      var ord_food_id = document.getElementById('food_id');
      var ord_amount = document.getElementById('amount');
      if (ord_form && ord_food_id && ord_amount ) {
        ord_food_id.value=foodid;
        ord_amount.value=amount;
        // alert(ord_type_id.value +','+ ord_food_id.value +','+ ord_amount.value);
        ord_form.submit();
      }
      return false;
  }
  </script>
    </body>
</html>