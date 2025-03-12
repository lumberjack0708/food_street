<?php
    session_start();
    require_once("../connMysql.php");
    $username='';
    if (isset($_SESSION['username'])){
      $username=$_SESSION['username'];
      echo "<script>alert('已登入');
      window.location.href='../index_login.php';
      </script>";
    }
    session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
  <title>我來登入啦</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
  <link rel="icon" type="image/x-icon" href="../images/FOOD.png" />
  <script type="text/javascript" >
    function do_login(){
      var email=$("#username").val();
      var pass=$("#passwd").val();

      if(email!="" && pass!=""){
        $("#loading_spinner").css({"display":"block"});
        $.ajax({
        type:'post',
        url:'do_login.php',
        data:{
        do_login:"do_login",
        email:email,
        password:pass
        },
        success:function(response) {
          if (response=="role1" || response=="role2" )  {
            window.location.href="../index_login.php";
          } else if(response=="role3" ){
            window.location.href="../teacher/index.html";
          } else if(response=="role4" ){
            window.location.href="../teacher/index.html";
          } else if(response=="role5" ){
            window.location.href="../index.html";
          } else if(response=="role9" ){
            window.location.href="../teacher/index.html";
          } else{
            alert("驗證錯誤，請確認輸入資料正確。");
          }
        }
      });
      }
      else{
        alert("帳號密碼不可空白！");
      }
      return false;
    }
</script>
</head>
<body id="top">
<div class="wrapper row1">
	<header id="header" class="clear"> 
	  <div id="logo" class="fl_left">
		<h1><a href=""><img src="../images/HFS2.jpg"/></a></h1>
	  </div>
	  <nav id="mainav" class="fl_right">
		<ul class="clear">
		  <li class="active"><a href="../index_login.php">首頁</a></li>
		  <li><a class="drop" href="../eat_out/copp_storelist.php">合作社</a>
			<ul>
			  <li><a href="../eat_out/copp_storelist.php">預購餐點</a></li>
			  <li><a href="votes.php">提供意見</a></li>
			  
			</ul>
		  </li>
		  <li><a class="drop" href="#">外食</a>
			<ul>
			  
			  <li><a href="../eat_out/store_list.php">外食訂購</a></li>
			  <li><a href="food_rule.php">管理規定</a></li>
			  <li><a href="his_order.php">歷史訂單</a></li>
			</ul>
		  </li>
		  <li><a  href="">登入</a>  
		  </li>
		<!-- <li>使用者:<?= $username ?></li> -->
		</ul>
	  </nav>
	</header>
</div>
<div class="wrapper row3">
  <main class="container clear"> 
    <div class="content"> 
      <div class="scrollable">
      </div>
      <div id="comments">
        <form method="post" action="" class="login">
          <center><h1>學生身分登入</h1></center>
          <input type="text" placeholder="請輸入帳號" name="username" id="username" style="text-align: center;"/><br/>
          <input type="password" placeholder="請輸入密碼" name="passwd"  id="passwd" style="text-align: center;"/><br/>
          <center><input type="button" onclick="do_login();" value="登入" style='cursor: pointer;'/></center>
      </form>
      </div>
    </div>
    <div class="clear"></div>
  </main>
</div>
<div class="wrapper row4">
</div>
<!-- <div class="wrapper row5">
  <div id="copyright" class="clear"> 
    <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">Domain Name</a></p>
    <p class="fl_right">Template by <a target="_blank" href="https://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
  </div>
</div> -->
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a> 
<!-- JAVASCRIPTS -->
<script src="../layout/scripts/jquery.min.js"></script>
<script src="../layout/scripts/jquery.backtotop.js"></script>
<script src="../layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>