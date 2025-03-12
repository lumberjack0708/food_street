<?php
    session_start();
    require_once("../connMysql.php");
    // 連線資料庫
    $store_id = 0;
    $food_id = 0;
    $price = 0;
    $amount = 0;
    if (isset($_POST['store_id']) && isset($_POST['food_id']) && isset($_POST['amount'])) {
          $store_id = $_POST['store_id'];
          $food_id = $_POST['food_id'];
          $amount = $_POST['amount']; 
        if (is_numeric($store_id) && is_numeric($food_id) && is_numeric($amount) ){
          $sql_query="select price from `delivery_menu` where food_code='".$food_id."'";
          $result = $db_link->query($sql_query) or die($db_link->error);
          $count=0;
          if ($row = $result->fetch_assoc())  {
          $price = $row["price"];  
          }
          // 查詢是否重複訂購 有的話用update 沒有用insert
          $sql_query="select count(*) as total from `cart` where product_id=".$food_id." && user_code='".$_SESSION['user_code']."'";
          $result = $db_link->query($sql_query) or die($db_link->error);
          if ($row = $result->fetch_assoc())  {
            $isexist = $row["total"];  
          }
          if($isexist > 0 ){
            $sql_query='UPDATE `cart`
            SET amount= '.$amount.' + amount
            WHERE user_code='.$_SESSION['user_code'].' and product_id='.$food_id.' ';
            $result = $db_link->query($sql_query) or die($db_link->error);
          
          }else{
        
          $sql_query='insert into  cart (product_id, user_code, price, amount)
          VALUES ('.$food_id.', '.$_SESSION['user_code'].', '.$price.','.$amount.');'; 
          $result = $db_link->query($sql_query) or die($db_link->error);
          
          }
         
        }
      
    }
    
    
     // 查詢cart
     $sql_query = 'SELECT count(*) as total FROM `cart` where user_code='.$_SESSION['user_code'].'; ';
     $result = $db_link->query($sql_query) or die($db_link->error);
     if ($row = $result->fetch_assoc())  {
       $cart_amount = $row["total"];  
     }
    $store_id = $_GET['store_id'];
    // 寫入留言內容
    if(!empty($_SESSION['username']) && !empty($_POST['comment']) ) {
      $comment = $_POST['comment'];
      $gg = $_POST["gg"];
      $sql_query = "INSERT INTO `comment`(`word`,`date`,`user_code`,`store_id`,`star`) VALUES ('".$comment."',now(),".$_SESSION['user_code'].",'".$store_id."', ".$gg.")";
      $result = $db_link->query($sql_query) or die($db_link->error);
  
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
            $store_id = $_GET['store_id'];
            $sql_query = "SELECT * FROM `store` where store_id='".$store_id."'";
            // $sql_query = "SELECT * FROM `delivery_menu` where store_id='{$store_id}'";
            $result = $db_link->query($sql_query) or die($db_link->error);
            $count=0;
            while ($row = $result->fetch_assoc())  {
            //   echo "<li class='one_quarter'><a href='food_list.php?store_id=".$row["store_id"]."'>".$row["store_name"]."</a></li>";

                // echo "'.$row["food_code"].'";
                
              $store_name=$row["store_name"];

              $count=$count+1;
            }
            if($count==0){
              echo "無店家";
            }
            // $db_link->close();  
            echo "<title> $store_name </title> ";

            ?>           

       
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />

        <link rel="stylesheet" href="../layout/styles/layout.css"/>
        <style>
        /*星星評分系統*/

        #star{position:relative;width:600px;margin: auto;list-style-type:none;}
        #star ul,#star span{float:left;display:inline;height:19px;line-height:19px;}
        #star ul{margin:0 10px;}
        #star li{float:left;width:24px;cursor:pointer;margin:0;padding:0;text-indent:-9999px;height:19px;background:url(../images/star.png) no-repeat;}
        #star strong{color:#f60;padding-left:10px;}
        #star li.on{background-position:0 -28px;}
        #star p{position:absolute;top:20px;width:159px;height:60px;display:none;background:url(images/icon.gif) no-repeat;padding:7px 10px 0;}
        #star p em{color:#f60;display:block;font-style:normal;}  
        
        .showstar {float:left;display:inline;height:19px;line-height:19px;}
        .showstar {margin:0 10px;}
        .showstar li{float:left;width:24px;cursor:pointer;margin:0;padding:0;text-indent:-9999px;height:19px;background:url(../images/star.png) no-repeat;background-position:0 -28px;}


    </style>
    <script type="text/javascript"> 
        window.onload = function ()
        {
            var oStar = document.getElementById("star");
            var aLi = oStar.getElementsByTagName("li");
            var oUl = oStar.getElementsByTagName("ul")[0];
            var oP = oStar.getElementsByTagName("p")[0];
            var i = iScore = iStar = 0;
            for (i = 1; i <= aLi.length; i++)
            {
            aLi[i - 1].index = i;
            //滑鼠移過顯示分數
            aLi[i - 1].onmouseover = function ()
            {
                fnPoint(this.index);
                //浮動層顯示
                oP.style.display = "block";
                //計算浮動層位置
                oP.style.left = oUl.offsetLeft + this.index * this.offsetWidth - 104 + "px";
                //匹配浮動層文字內容
            //oP.innerHTML = "<em><b>" + this.index + "</b> 分 ";
            };
            //滑鼠離開后恢復上次評分
            aLi[i - 1].onmouseout = function ()
            {
                fnPoint();
                //關閉浮動層
                oP.style.display = "none"
            };
            //點選後進行評分處理
            aLi[i - 1].onclick = function ()
            {
                iStar = this.index;
                oP.style.display = "none";
            document.getElementById("gg").value = this.index;
            }
            }
            //評分處理
            function fnPoint(iArg)
            {
            //分數賦值
            iScore = iArg || iStar;
            for (i = 0; i < aLi.length; i++) aLi[i].className = i < iScore ? "on" : "";
            }
        };
    </script>	
      </head>
    <body>
<?php 

printf($menu_row,'../images/HFS2.jpg', '../index_login.php', 'copp_storelist.php', '../pages/vote.php','store_list.php','../pages/food_rule.php','../pages/his_order.php','../index.php?logout=1',$_SESSION['username'],'cart.php',$cart_amount,'');
?>
<?php

$sql_query = "SELECT * FROM `delivery_menu` where store_id='".$store_id."'";
// $sql_query = "SELECT * FROM `delivery_menu` where store_id='{$store_id}'";
$result = $db_link->query($sql_query) or die($db_link->error);
$count=0;
if ($row = $result->fetch_assoc())  {

echo'<header style="background-image: url(../images/store/'   .  $row["store_id"]  .   '.jpg); ">
<div class="container px-4 px-lg-5 my-5">
    <div class="text-center text-white">

        <h1 class="display-4 fw-bolder" style="border-width: 3px ;  padding: 5px; text-align: center; background-color: rgb(255, 255, 255, 0.7);border-radius: 4px;color:#4F4F4F;">'.$store_name.'</h1>
        
    </div>
</div>
</header>';}
?>
        
        <!-- Section-->
        <section class="py-5">
                <form id="orderform" name="orderform" method="post" action="" style="display:inline;">
                  <input type="hidden" id="store_id" name="store_id" value="<?php echo $store_id;?>" />
                  <input type="hidden" id="food_id" name="food_id" value="0" />
                  <input type="hidden" id="amount" name="amount" value="0" />
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
            $store_id = $_GET['store_id'];
            $sql_query = "SELECT * FROM `delivery_menu` where store_id='".$store_id."' and is_launched = 1";
            // $sql_query = "SELECT * FROM `delivery_menu` where store_id='{$store_id}'";
            $result = $db_link->query($sql_query) or die($db_link->error);
            $count=0;
            while ($row = $result->fetch_assoc())  {
            //   echo "<li class='one_quarter'><a href='food_list.php?store_id=".$row["store_id"]."'>".$row["store_name"]."</a></li>";

                echo '<div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="../images/'.$row["food_code"].'.jpg" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder" style="color:#94B7C0">'.$row["name"].'</h5><br>
                                <p style="color:#94B7C0">可累積' .$row["points"]. '點積點</p>
                                <!-- Product price-->
                                <span style="color:#94B7C0; ">'."$".''.$row["price"].'
                                /數量
                                <input type="number" id="amt'.$row["food_code"].'" value="1" min="1" max="10" style="width:40px;display:inline;margin: left 20px;"></input> </span>
                            </div>

                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="javascript: add2cart(document.getElementById(\'amt'.$row["food_code"].'\').value,'.$row["food_code"].');">加入購物車</a></div>
                        </div>
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
    <?php 
     $sql_query="SELECT distinct *
      from `comment`
      join `user` on comment.user_code=user.user_code
      where store_id='".$store_id."'
      order by `id` desc";
      $result = $db_link->query($sql_query) or die($db_link->error);
     
      echo '<div class="content three_quarter"> 
        <div id="comments">
        <h2>留言區</h2>';
      $average_s=0;
      $total_s=0;
      //人數查詢
      $pcount=0;
      while ($row = $result->fetch_assoc())  {
        $total_s += $row["star"];
        $pcount += 1;
        echo'<ul>
          <li>
            <article>
              <header>
                <address>
                  <a href="#">'.$row['account'].'</a>
                </address>
                <time datetime="2045-04-06T08:15+00:00">'.$row['date'].'</time>
              </header>
              <div class="comcont">
                <p>'.$row['word'].' /'.$row['star'].'分</p>
                <ul class="showstar">';
              for ($i=1;$i<=$row['star'];$i++){
                echo'<li></li>';
              }
                


        echo' </ul>
              </div>
            </article>
          </li>
        </ul>';
        
      }
      //平均
      if($pcount>0){
      echo $total_s / $pcount;
      }else{echo"無評分";}


        //查詢留言人數
        // $sql_query123="SELECT count(*) as amount from `comment` 
        //              join `store` using(store_id)
        //              where comment.user_code = ".$_SESSION["user_code"]."";
        // $result123 = $db_link->query($sql_query123) or die($db_link->error);
        // if($row = $result123->fetch_assoc()){
        //    $average_s = $total_s / $row["amount"];
        //    echo " 平均: $average_s 分";
        // }             
       
        ?>
        <h2>留下你想說的話</h2>
        <form action="" method="post" onsubmit="alert(document.getElementById('id').value); return false;">
            <div id="star">
              <span >打分</span>
              <ul>
                  <li><a href="javascript:;">1</a></li>
                  <li><a href="javascript:;">2</a></li>
                  <li><a href="javascript:;">3</a></li>
                  <li><a href="javascript:;">4</a></li>
                  <li><a href="javascript:;">5</a></li>
              </ul><span></span><p></p>
            </div> 
        <div class="block clear">
          
            <label for="comment">Your Comment(less than 100 words)</label>
            <textarea name="comment" id="comment" cols="25" rows="10"></textarea>
        </div>
          <div>
            <input type="hidden" value="0" id="gg" name="gg" max="5"/>
            <input name="submit" type="submit" value="留言!!">
            &nbsp;
            <input name="reset" type="reset" value="重置">
          </div>
        </form>
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
        <!-- <time class="smallfont" datetime="2045-04-06">ksvcs<<sup>th</sup> 11月 2021</time> -->
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
      var ord_store_id = document.getElementById('store_id');
      var ord_food_id = document.getElementById('food_id');
      var ord_amount = document.getElementById('amount');
      if (ord_form && ord_food_id && ord_amount ) {
        ord_food_id.value=foodid;
        ord_amount.value=amount;
        // alert(ord_store_id.value +','+ ord_food_id.value +','+ ord_amount.value);
        ord_form.submit();
      }
      return false;
  }
  </script>
    </body>
</html>