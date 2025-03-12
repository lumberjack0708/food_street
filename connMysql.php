<?php
	//身分編號
	$role=array(0=>"停用帳號",1=>"學生",2=>"綠化股長",3=>"導師",4=>"學務處",5=>"合作社",9=>"管理者");
	//管理者身分編號
	$role_r=array(1=>"店家",2=>"管理者");
	//資料庫主機設定
	$db_host = "localhost";
	$db_username = "root";
	$db_password = "";
	$db_name = "food_street";
	//連線資料庫
	$db_link = @new mysqli($db_host, $db_username, $db_password, $db_name);
	//錯誤處理
	if ($db_link->connect_error != "") {
		echo "資料庫連結失敗！";
	}else{
		//設定字元集與編碼
		$db_link->query("SET NAMES 'utf8'");
	}

$pay_way=array(1=>"貨到付款",2=>"儲值卡");

if(isset($_SESSION['username'])){
	$menu_row=<<<'EOD'
	<!--link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all"-->
		<div class="wrapper row1">
		<header id="header" class="clear"> 
		<div id="logo" class="fl_left">
			<h1><a href=""><img src="%s"/></a></h1>
		</div>
		<nav id="mainav" class="fl_right">
			<ul class="clear">
			<li class="active"><a href="%s">首頁</a></li>
			<li><a class="drop" href="#">合作社</a>
				<ul>
				<li><a href="%s">預購餐點</a></li>
				<li><a href="%s">提供意見</a></li>
				</ul>
			</li>
			<li><a class="drop" href="#">外食</a>
				<ul>
				
				<li><a href="%s">訂購外食</a></li>
				<li><a href="%s">管理規定</a></li>
				<li><a href="%s">歷史訂單</a></li>
				</ul>
			</li>
			<li><a  href="%s">登出</a> 
			</li>
			<li>使用者:%s</li>
			<li><form class="d-flex" action="%s">
				<button class="btn btn-outline-dark" type="submit">
				<i class="bi-cart-fill me-1"></i>
				購物車
				<span class="badge bg-dark text-white ms-1 rounded-pill">%d</span>
				</button>
			</form></li>
			<li>%s</li>
			</ul>
		</nav>
		</header>
	</div>
	EOD;
}else{
	$menu_row=<<<'EOD'
	<div class="wrapper row1">
	<header id="header" class="clear"> 
		<div id="logo" class="fl_left">
		<h1><a href=""><img src="%s"/></a></h1>
		</div>
		<nav id="mainav" class="fl_right">
		<ul class="clear">
	
			<li class="active"><a href="%s">首頁</a></li>
			<li><a class="drop" href="">合作社</a>
				<ul>
				<li><a href="%s">預購餐點</a></li>
				<li><a href="%s">提供意見</a></li>
				
				</ul>
			</li>
			<li><a class="drop" href="#">外食</a>
				<ul>
				
				<li><a href="%s">訂購外食</a></li>
				<li><a href="%s">管理規定</a></li>
				<li><a href="%s">歷史訂單</a></li> 
				</ul>
			</li>
			<li><a href="%s">登入</a></li>
			<li>%s</li>
			</ul>
		</nav>
		</header>
	</div>

	EOD;
}


if(isset($_SESSION['host_code'])){
	$menu_row=<<<'EOD'
	<link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
	<div class="wrapper row1">
	<header id="header" class="clear"> 
	  <div id="logo" class="fl_left">
		<h1><a href=""><img src="%s"/></a></h1>
	  </div>
	  <nav id="mainav" class="fl_right">
		<ul class="clear">
		  <li class="active"><a href="%s">店家首頁</a></li>
		  <li><a  href="%s">訂單管理</a>
		  </li>
		  <li><a  href="%s">商品管理</a>

		  </li>
		  <li><a  href="%s">登出</a> 
		  </li>
		<li> 商號:%s</li>

		</ul>
	  </nav>
	</header>
	</div>
	EOD;
}
?>
