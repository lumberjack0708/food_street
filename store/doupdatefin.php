<?php 
require_once("../connMysql.php");
session_start(); 

if (!isset($_SESSION['account_rr']) || !isset($_SESSION['host_code'])) {
	header('Location: login.php');
}

if(isset($_POST['id']) && isset($_POST['finish'])) {
	$id=$_POST['id'];
    $id = str_replace("finish","",$id);
    list($orderid,$product_id) = explode("-",$id);
	$finish=$_POST['finish'];
	$statement = $db_link->prepare("UPDATE order_items SET is_finish= ? WHERE product_id= ? AND orderfrom_id= ?");
	$statement->bind_param('sss',$finish, $product_id, $orderid);
	//有沒有成功
	$rc=$statement->execute();
	if ( false===$rc ) {
		//die('資料庫執行錯誤: ' . htmlspecialchars($stmt->error));
		echo "fail";		
	} else {
		echo "ok"; 
	}
	exit();
}
		
	
	