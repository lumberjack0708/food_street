  <?php
    session_start();
    require_once("../connMysql.php");
    // 連線資料庫
              // $username='';
              // if (isset($_SESSION['username'])){
              //   $username=$_SESSION['username'];
              // }
?>

<!DOCTYPE html>
<html>
<head>
  <title>亂講</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
  <link rel="icon" type="../image/x-icon" href="../images/FOOD.png" />
  <script type="text/javascript" >
    function dologin_r(){
      var email=$("#username").val();
      var pass=$("#passwd").val();

      if(email!="" && pass!=""){
        $("#loading_spinner").css({"display":"block"});
        $.ajax({
        type:'post',
        url:'dologin.php',
        data:{
        dologin_r:"dologin_r",
        email:email,
        password:pass
        },
        success:function(response) {
          if (response=="role_r1")  {
            window.location.href="index.php";
          } else if(response=="role_r2" ){
            window.location.href="index_rr.php";
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
		  <li class="active"><a href="../index_login.php"></a></li>
		  <li><a class="" href="../eat_out/copp_storelist.php"></a>
			<ul>
			  <li><a href="../eat_out/copp_storelist.php"></a></li>
			  <li><a href="votes.php"></a></li>
			  
			</ul>
		  </li>
		  <li><a class="" href="#"></a>
			<ul>
			  
			  <li><a href="../eat_out/store_list.php"></a></li>
			  <li><a href="food_rule.php"></a></li>
			  <li><a href="his_order.php"></a></li>
			</ul>
		  </li>
		  <li><a  href=""></a>  
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
          <center><h1><b>店家管理者身分登入</b></h1></center>
          <input type="text" placeholder="請輸入帳號" name="username" id="username" style="text-align: center;"/><br/>
          <input type="password" placeholder="請輸入密碼" name="passwd"  id="passwd" style="text-align: center;"/><br/>
          <center><input type="button" onclick="dologin_r();" value="登入" style='cursor: pointer;'/></center>
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