<?php
    session_start();
    require_once("../connMysql.php");
    if (empty($_SESSION['user_code'])) {
        echo "請先登入";
        exit();
    }
    // 搜尋訂購人帳號 得到班級
    $sql_query = "SELECT DISTINCT account 
    FROM `cart` Join user on cart.user_code = user.user_code
    where cart.user_code='".$_SESSION['user_code']."' and userstatus=1; ";
    $result = $db_link->query($sql_query) or die("5--".$db_link->error);
    $total_price=0;
    $count=0;
    $class_id=0;
    while ($row = $result->fetch_assoc())  {
        $useraccount=$row["account"];
        $class_id=floor($useraccount / 100);
    }
    

    // 商品名稱、訂購數量、商家名稱
    $sql_query = 'insert into  order_form ( usercode, class_id, order_date,freight)
    VALUES ('.$_SESSION['user_code'].' , '.$class_id.' ,now(),'.$_SESSION['ttf'].')';
    $result = $db_link->query($sql_query) or die("0--".$db_link->error);
    $orderfrom_id=$db_link->insert_id;

    $count=0;
    $total_price=0;
    $sql_newitems="insert into order_items(orderfrom_id,store_id,product_id,amount,price,spec) values ";  
    // 取得訂單細項
    $sql_query1 = "select DISTINCT delivery_menu.store_id, store_name, delivery_fee 
    FROM cart Join delivery_menu on cart.product_id =delivery_menu.food_code join store on delivery_menu.store_id=store.store_id
    where cart.user_code='".$_SESSION['user_code']."'";
    $result2 = $db_link->query($sql_query1) or die("1--".$db_link->error);
    while ($raw = $result2->fetch_assoc())  {
        $gg_storeid=$raw["store_id"];
        $gg_storename=$raw["store_name"];
        $sql_query = "SELECT cart.*,delivery_menu.name FROM `cart` join `delivery_menu` on cart.product_id=delivery_menu.food_code 
            where user_code='".$_SESSION['user_code']."' and delivery_menu.store_id=$gg_storeid  ";
        // $sql_query = "SELECT * FROM `delivery_menu` where store_id='{$store_id}'";
        $result = $db_link->query($sql_query) or die("2--".$db_link->error);
        //echo "<li><span>$gg_storename</span></li>";
        while ($row = $result->fetch_assoc())  {
           $sql_newitems .= "(".$orderfrom_id.",".$gg_storeid.",".$row["product_id"].",".$row["amount"].",".$row["price"].",'".$row["spec"]."'),";
           $total_price=$total_price+$row["amount"]*$row["price"];
            $count=$count+1; 
        }
    }
    // 轉成訂單
    if ($count>0) {
        $sql_newitems = substr($sql_newitems,0,-1) . ";";
        $result2 = $db_link->query($sql_newitems) or die("3--".$db_link->error."<br>".$sql_newitems);
        $sql_query = "delete  FROM `cart` where user_code='".$_SESSION['user_code']."' ";
        $result2 = $db_link->query($sql_query) or die("4--".$db_link->error);
    }
?>
<script>
    alert("你的心意我收到了，非常謝謝您的光臨，本次的訂單金額為" + <?php echo $total_price; ?>);
    location.href='store_list.php';
</script>


