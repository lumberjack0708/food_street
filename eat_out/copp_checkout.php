<?php
    session_start();
    require_once("../connMysql.php");
    if (empty($_SESSION['user_code'])) {
        echo "請先登入";
        exit();
    }
    // 搜尋訂購人帳號 得到班級
    $sql_query = "SELECT DISTINCT account 
    FROM `copp_cart` Join user on  copp_cart.user_code = user.user_code 
    where copp_cart.user_code='".$_SESSION['user_code']."' and userstatus=1; ";
    $result = $db_link->query($sql_query) or die("5--".$db_link->error);
    $total_price=0;
    $count=0;
    $class_id=0;
    while ($row = $result->fetch_assoc())  {
        $useraccount=$row["account"];
        $class_id=floor($useraccount / 100);
    }
    

    // 商品名稱、訂購數量、商家名稱
    $sql_query = 'insert into  copp_form ( usercode, class_id, order_date,freight)
    VALUES ('.$_SESSION['user_code'].' , '.$class_id.' ,now(),0)';
    $result = $db_link->query($sql_query) or die("0--".$db_link->error);
    $orderfrom_id=$db_link->insert_id;
    // on heat.type_id=copp_type.type_id
    $count=0;
    $total_price=0;
    $sql_newitems="insert into copp_items(orderfrom_id,store_id,product_id,amount,price,spec) values ";  
    // 取得訂單細項
    $sql_query1 = "SELECT DISTINCT heat.type_id,type_name
    FROM copp_cart
    Join heat on copp_cart.product_id =heat.number
    join copp_type  using(type_id)
    where copp_cart.user_code='".$_SESSION['user_code']."'";
    $result2 = $db_link->query($sql_query1) or die("1--".$db_link->error);
    while ($raw = $result2->fetch_assoc())  {
        $gg_typeid=$raw["type_id"];
        $gg_typename=$raw["type_name"];
        $sql_query = "SELECT copp_cart.*,heat.food_name 
        FROM `copp_cart` 
        join `heat` on copp_cart.product_id=heat.number
        where user_code='".$_SESSION['user_code']."' and heat.type_id=$gg_typeid  ";
        // $sql_query = "SELECT * FROM `delivery_menu` where store_id='{$store_id}'";
        $result = $db_link->query($sql_query) or die("2--".$db_link->error);
        //echo "<li><span>$gg_storename</span></li>";
        while ($row = $result->fetch_assoc())  {
           $sql_newitems .= "(".$orderfrom_id.",".$gg_typeid.",".$row["product_id"].",".$row["amount"].",".$row["price"].",'".$row["spec"]."'),";
           $total_price=$total_price+$row["amount"]*$row["price"];
            $count=$count+1; 
        }
    }
    // 轉成訂單
    if ($count>0) {
        $sql_newitems = substr($sql_newitems,0,-1) . ";";
        $result2 = $db_link->query($sql_newitems) or die("3--".$db_link->error."<br>".$sql_newitems);
        $sql_query = "delete  FROM `copp_cart` where user_code='".$_SESSION['user_code']."' ";
        $result2 = $db_link->query($sql_query) or die("4--".$db_link->error);
    }
?>
<script>
    alert("你的心意我收到了，非常謝謝您的光臨，本次的訂單金額為" + <?php echo $total_price; ?>);
    location.href='copp_storelist.php';
</script>