<?php
session_start();
require_once("../connMysql.php");
// 連線資料庫
if(!empty( $_GET['logout']) && $_GET['logout']=="1" ){
  session_destroy();
}

if(isset($_SESSION["ttpoint"])){
    $ttpoint = $_SESSION["ttpoint"];
}else{
    $ttpoint = 0;
}

if(isset($_SESSION["ttc"]) ){
    $ttc=$_SESSION["ttc"];
}else{
    $ttc=0;
}

if (!empty( $_POST['username'])  && !empty( $_POST['passwd']) && !empty( $_POST['passwd1']) &&!empty( $_POST['passwd2'])){
	$useracc = $_POST['username'];
	$passwd = $_POST['passwd'];
    $passwd1 = $_POST['passwd1'];
    $passwd2 = $_POST['passwd2'];
	$sql_query = "SELECT account,'password',user_code
                  FROM user 
                  WHERE user.user_code='".$_SESSION['user_code']."' and user.password='".$passwd."'";
                    // echo"$sql_query";
                    // exit();
    $result = $db_link->query($sql_query) or die($db_link->error);
    $num=mysqli_num_rows($result);
    if($num == 1 && $passwd1 == $passwd2){
        $sql_query="UPDATE `user`
                    SET `password`= '".$passwd2."'
                    WHERE user_code=".$_SESSION['user_code']." and password='".$passwd."' ";
                    $result = $db_link->query($sql_query) or die($db_link->error);   
                    echo '<script>alert("修改成功");</script>';   
        
    }else{
        echo '<script>alert("帳號密碼輸入錯誤");</script>';
    }
}
?>
<html>
    <head>
    <title>美食街系統</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
        <link rel="icon" type="image/x-icon" href="../images/FOOD.png" />
        <style>
            .us_pg{
                margin-left: 5%;
                margin-top: 1%;
            }
            .ch_pw{
                margin-left: 5%;
            }
            .wrap {
                text-align: center;
                padding-top: 20%;
                }
                .btn {
                background-color: #FFB80C;
                text-decoration: none;
                color: #1e1e1e;
                padding: 16px;
                border-radius: 5px;
                }

                .popup-wrap {
                width: 100%;
                height: 100%;
                display: none;
                position: fixed;
                top: 0px;
                left: 0px;
                content: '';
                background: rgba(0, 0, 0, 0.85);
                }

                .popup-box {
                width: 50%;
                padding: 50px 75px;
                transform: translate(-50%, -50%) scale(0.5);
                position: absolute;
                top: 50%;
                left: 50%;
                box-shadow: 0px 2px 16px rgba(0, 0, 0, 0.5);
                border-radius: 3px;
                background: #fff;
                text-align: center;
                }
                h2 {
                font-size: 32px;
                color: #1a1a1a;
                }

                h3 {
                font-size: 24px;
                color: #888;
                }

                .close-btn {
                width: 50px;
                height: 50px;
                display: inline-block;
                position: absolute;
                top: 10px;
                right: 10px;
                border-radius: 100%;
                background: #d75f70;
                font-weight: bold;
                text-decoration: none;
                color: #fff;
                line-height: 40px;
                font-size: 32px;
                }

                .transform-in, .transform-out {
                display: block;
                -webkit-transition: all ease 0.5s;
                transition: all ease 0.5s;
                }

                .transform-in {
                -webkit-transform: translate(-50%, -50%) scale(1);
                transform: translate(-50%, -50%) scale(1);
                }

                .transform-out {
                -webkit-transform: translate(-50%, -50%) scale(0.5);
                transform: translate(-50%, -50%) scale(0.5);
                }

        </style>
    </head>
    <body>
    <?php 
    $cart_amount = 0;
    printf($menu_row,'../images/HFS2.jpg', 'index_login.php', 'eat_out/copp_storelist.php', 'pages/vote.php','eat_out/store_list.php','pages/food_rule.php','pages/his_order.php','index.php?logout=1',$_SESSION['username'],'eat_out/cart.php',$cart_amount);
    ?>
    <?php
    // $sql_query="SELECT * 
    //             FROM cart
    //             WHERE ";
    // $result = $db_link->query($sql_query) or die($db_link->error);
    $total_fee=0;
    $total_price=0;
    $count=0;
    $TTP=0;
    $sql_query = "SELECT *
    FROM `order_form`,`order_items`,`delivery_menu` 
    where order_form.usercode='".$_SESSION['user_code']."' 
      and order_items.orderfrom_id=order_form.order_id 
      and delivery_menu.food_code = order_items.product_id";
    $result2 = $db_link->query($sql_query) or die($db_link->error);
    $ttc=0;
    $ttpr=0;  
    $tta=0;
    while ($row = $result2->fetch_assoc())  {
      $total_p=$row["points"] * $row["amount"];
      $ttc=$ttc+$row["ca"];
      $count=$count+1;
      $TTP=$TTP+$total_p; 
    }
    //   $ttpr=$ttpr+$row["price"];
      
    //   $tta=$tta+$row["amount"];
       

    echo'<div class="us_pg">
    使用者帳號:'.$_SESSION["username"].'<br/>
    已累計紅利點數:'.$TTP.'<br/>
    本周已攝入的熱量:'.$ttc.'</div>
    <br/><hr/>
    <!--  -->
    <div class="wrap">
    <a class="btn popup-btn" href="#letmeopen">修改密碼</a>
    </div>
    <div class="popup-wrap" id="letmeopen">
    <div class="popup-box transform-out" >
        <h2>輸入你的帳號密碼</h2>
        <form method="post" action="profile.php">
        &nbsp;<input type="text" placeholder="請輸入帳號" name="username" id="username" style="text-align: center;"/><br/>
        &nbsp;<input type="password" placeholder="請輸入舊密碼" name="passwd"  id="passwd" style="text-align: center;"/><br/>
        
        &nbsp;<input type="password" placeholder="請輸入新密碼" name="passwd1"  id="passwd1" style="text-align: center;"/><br/>
        &nbsp;<input type="password" placeholder="再輸入一次新密碼" name="passwd2"  id="passwd2" style="text-align: center;" style="padding:100%;"/><br/>
        &nbsp;<input type="submit" value="確認修改" />
        </form>
        <h3></h3>
        <a class="close-btn popup-close" href="#">x</a>
    </div>
    </div>';
?>
    <!--  -->
    <a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a> 
    <script src="../layout/scripts/jquery.min.js"></script>
    <script src="../layout/scripts/jquery.backtotop.js"></script>
    <script src="../layout/scripts/jquery.mobilemenu.js"></script>
    <script src="../layout/scripts/jquery.flexslider-min.js"></script>
    <script src="../layout/scripts/ch_pw.js"></script>
    </body>
</html>