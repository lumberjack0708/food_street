<?php 
require_once("../connMysql.php");
session_start(); 

if(isset($_POST['dologin_r'])) {
	$email=$_POST['email'];
	$pass=$_POST['password'];
	$statement = $db_link->prepare("select * from store_host where account= ? and password= ?");
	$statement->bind_param('ss', $email, $pass);
	//有沒有成功
	$rc=$statement->execute();
	if ( false===$rc ) {
		die('查詢錯誤: ' . htmlspecialchars($stmt->error)); 
	} else {
		//$statement->bind_result($userid, $useremail, $password, $userpoint, $disabled, $isadmin);
		$result = $statement->get_result();
		if($row = $result->fetch_assoc()){
            $_SESSION['account_rr'] = $row["account"];
			$_SESSION['role'] = $row["status"];
			$_SESSION['host_code'] = $row["host_code"];
            if($row["status"] == 1){
				echo "role_r1";			
			} elseif ($row["status"] == 2){
				echo "role_r2";
			}
		} else {
			echo "fail"; 
		} 
	}
	exit(); 
} 
?>