<?php
    $id=0;
    require_once('..\connMysql.php');
    session_start();
    if (isset($_GET['id']))
        $id=$_GET['id'];
    // echo $id;
    if(!empty($id)){
        $sql_query = "UPDATE `vote` SET votes=votes + 1  
        WHERE id = ".$id."";
        
        $result = $db_link->query($sql_query) or die($db_link->error);
    }
    if(isset($_POST['p_name']) and isset($_POST['p_price'])){
      $p_name=0;
      $p_price=0;
      
      $p_name=$_POST['p_name'];
      $p_price=$_POST['p_price'];
      $sql="INSERT INTO `vote`(`id`, `food_name`, `price`, `votes`) 
      VALUES ('','$p_name','$p_price','0')  ";
      $result = $db_link->query($sql) or die($db_link->error);

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
            .css_table {
                display:table;
            }
            .css_tr {
                display: table-row;
            }
            .css_th {
                display: table-cell;
                border: 1px dashed black;
                background-color:#eef;
                vertical-align: middle;
                width: 100px;
                font-weight:bold;
                background-color: white;
            }
            .css_td {
                display: table-cell;
                border: 1px solid gray;
                width: 100px;
                vertical-align: middle;
                height: 3em;
                background-color: white;
            }
        </style>

    </head>
    <body>
    <?php 
      $cart_amount=0;
      printf($menu_row,'../images/HFS2.jpg', '../index_login.php', '../eat_out/copp_storelist.php', 'vote.php','../eat_out/store_list.php','food_rule.php','his_order.php','../index.php?logout=1',$_SESSION['username'],'../eat_out/copp_cart.php',$cart_amount,'');
      ?>
    <div id="comments" style="margin-left: 3em;margin-right: 3em;">
        <h2>提供意見</h2>
        <form action="" method="post">
          <div class="one_half first">
            <label for="name">商品名稱 <span>*</span></label>
            <input type="text" name="p_name" id="p_name" value="" size="22">
          </div>
          <div class="one_half">
            <label for="email">品項價格 <span>*</span></label>
            <input type="text" name="p_price" id="p_price" value="" size="22">
          </div>
          <!-- <div class="one_third">
            <label for="url">Website</label>
            <input type="text" name="url" id="url" value="" size="22">
          </div> -->
          <!-- <div class="block clear">
            <label for="comment">Your Comment</label>
            <textarea name="comment" id="comment" cols="25" rows="10"></textarea>
          </div> -->
          <div>
            <input name="submit" type="submit" value="送出">
            &nbsp;
            <input name="reset" type="reset" value="重置">
          </div>
        </form>
      </div>


<?php
    $sql = "SELECT * FROM vote order by votes desc;";

    if(!$result = $db_link->query($sql)){
        echo "錯誤";
        exit;
    }
    echo'<div class="scrollable" style="margin-left: 3em;margin-right: 3em">
        <table>
          <thead>
            <tr>
              <th>品名</th>
              <th>價格</th>
              <th>票數</th>
              <th></th>
            </tr>
          </thead>';
    while($post = $result->fetch_assoc()){
      $id = $post['id'];
        echo"
            <tr>
              <td>{$post['food_name']}</td>
              <td>{$post['price']}</td>
              <td>{$post['votes']}</td>
              <td><button style='padding:0.1em 0.2em 0.1em 0.2em'  
              onclick='location.href=\"vote.php?id=".$post['id']."\"'>投票</button></td>
            </tr>";}
            ?>
          </tbody>
        </table>
      </div>
    
      
      </body>
</html>