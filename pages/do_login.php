<?php 
require_once("../connMysql.php");
session_start(); 

if(isset($_POST['do_login'])) {
	$email=$_POST['email'];
	$pass=$_POST['password'];
	$statement = $db_link->prepare("select * from user where account= ? and password= ?");
	$statement->bind_param('ss', $email, $pass);
	//有沒有成功
	$rc=$statement->execute();
	if ( false===$rc ) {
		die('查詢錯誤: ' . htmlspecialchars($stmt->error)); 
	} else {
		//$statement->bind_result($userid, $useremail, $password, $userpoint, $disabled, $isadmin);
		$result = $statement->get_result();
		if($row = $result->fetch_assoc()){
			if($row["userstatus"] == 0){
				echo "disabled";			
			} else {
				$_SESSION['username']=$row["account"];
				$_SESSION['userrole']=$row["userstatus"];
				$_SESSION['user_code']=$row["user_code"];
				if($row["userstatus"] == 1){
					echo "role1";
				} else if($row["userstatus"] == 2){
					echo "role2";
				} else if($row["userstatus"] == 3){
					echo "role3";
				} else if($row["userstatus"] == 4){
					echo "role4";
				} else if($row["userstatus"] == 5){
					echo "role5";
				} else if($row["userstatus"] == 9){
					echo "role9";
				}
			}
		} else {
			echo "fail"; 
		} 
	}
	exit(); 
} 
?>