<?php 
require_once("../connMysql.php");
session_start(); 

if (!isset($_SESSION['account_rr']) || !isset($_SESSION['host_code'])) {
	header('Location: login.php');
}

if(isset($_POST['id']) && isset($_POST['launch'])) {
	$id=$_POST['id'];
	$launch=$_POST['launch'];
	$statement = $db_link->prepare("UPDATE delivery_menu SET is_launched= ? WHERE food_code= ?");
	$statement->bind_param('ss', $launch, $id);
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
		
	
	