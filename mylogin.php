<?php
session_start();
//如果沒有登入Session值或是Session值為空則執行登入動作
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
	if(isset($_POST["username"]) && isset($_POST["passwd"])){
		require_once("connMysql.php");		
		//選取儲存帳號密碼的資料表
		$sql_query = "SELECT * FROM user where account='".$_POST["username"]."' and password='".$_POST["passwd"]."' ";
		$result = $db_link->query($sql_query) or die($db_link->error);		
		//取出帳號密碼的值
		$row_result=$result->fetch_assoc();
		//比對帳號密碼，若登入成功則進往管理界面，否則就退回主畫面。
		if (count($row_result)>0) {
            $_SESSION["loginMember"]=$_POST["username"];
			header("Location: index_login.php");
		}else{
            $_SESSION["loginMember"]="";
			header("Location: index.php?err=pwd");
		}
		$db_link->close();
	}
}else{
	//若已經有登入Session值則前往管理界面
	header("Location: index_login.php");
}
?>