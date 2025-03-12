<?php
  session_start();
  // 連線到資料庫
  require_once("../connMysql.php");

  // $username = NULL;
  if(!empty($_SESSION['username']) && !empty($_POST['comment']) ) {
    // $username = $_SESSION['username'];
    $comment = $_POST['comment'];
    // $comment_sub = $_POST['submit'];
    $sql_query = "INSERT INTO `comment`(`word`,`date`,`user_code`) VALUES ('".$comment."',now(),".$_SESSION['user_code'].")";
    $result = $db_link->query($sql_query) or die($db_link->error);

    }
  
 
?>
<!DOCTYPE html>
<html>
<head>
<title>留言板</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">

<div class="wrapper row1">
  <header id="header" class="clear"> 
    
    <div id="logo" class="fl_left">
      <h1><a href="../index.html">Colossus</a></h1>
    </div>
    
    <nav id="mainav" class="fl_right">
      <ul class="clear">
        <li><a href="../index.html">Home</a></li>
        <li class="active"><a class="drop" href="#">Pages</a>
          <ul>
            <li><a href="gallery.html">Gallery</a></li>
            <li><a href="full-width.html">Full Width</a></li>
            <li class="active"><a href="sidebar-left.html">Sidebar Left</a></li>
            <li><a href="sidebar-right.html">Sidebar Right</a></li>
            <li><a href="basic-grid.html">Basic Grid</a></li>
          </ul>
        </li>
        <li><a class="drop" href="#">Dropdown</a>
          <ul>
            <li><a href="#">Level 2</a></li>
            <li><a class="drop" href="#">Level 2 + Drop</a>
              <ul>
                <li><a href="#">Level 3</a></li>
                <li><a href="#">Level 3</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="#">Link Text</a></li>
        <li><a href="#">Link Text</a></li>
      </ul>
    </nav>
    
  </header>
</div>


<div class="wrapper row2">
  <div id="breadcrumb" class="clear"> 
    
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">Lorem</a></li>
      <li><a href="#">Ipsum</a></li>
      <li><a href="#">Dolor</a></li>
    </ul>
    
  </div>
</div>

<!--  -->
<div class="wrapper row3">
  <main class="container clear"> 
    <!-- main body -->
    <?php 
     $sql_query="SELECT *
      from `comment`
      join `user` on comment.user_code=user.user_code";
     $result = $db_link->query($sql_query) or die($db_link->error);
     
      echo '<div class="content three_quarter"> 
        <div id="comments">
        <h2>留言區</h2>';
      while ($row = $result->fetch_assoc())  {
        echo'<ul>
          <li>
            <article>
              <header>
                <address>
                  <a href="#">'.$row['account'].'</a>
                </address>
                <time datetime="2045-04-06T08:15+00:00">'.$row['date'].'</time>
              </header>
              <div class="comcont">
                <p>'.$row['word'].'</p>
              </div>
            </article>
          </li>
        </ul>';
      }
        ?>
        <h2>留下你想說的話</h2>
        <form action="" method="post">
          <div class="block clear">
            <label for="comment">Your Comment(less than 100 words)</label>
            <textarea name="comment" id="comment" cols="25" rows="10"></textarea>
          </div>
          <div>
            <input name="submit" type="submit" value="留言!!">
            &nbsp;
            <input name="reset" type="reset" value="重置">
          </div>
        </form>
      </div>
      
    </div>
    
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
<!--  -->

<div class="wrapper row4">
  <footer id="footer" class="clear"> 
    
    <div class="one_quarter first">
      <h6 class="title">Company Details</h6>
      <address class="btmspace-15">
      Company Name<br>
      Street Name &amp; Number<br>
      Town<br>
      Postcode/Zip
      </address>
      <ul class="nospace">
        <li class="btmspace-10"><span class="fa fa-phone"></span> +00 (123) 456 7890</li>
        <li><span class="fa fa-envelope-o"></span> info@domain.com</li>
      </ul>
    </div>
    <div class="one_quarter">
      <h6 class="title">Quick Links</h6>
      <ul class="nospace linklist">
        <li><a href="#">Home Page</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Gallery</a></li>
        <li><a href="#">Portfolio</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </div>
    <div class="one_quarter">
      <h6 class="title">From The Blog</h6>
      <article>
        <h2 class="nospace"><a href="#">Lorem ipsum dolor</a></h2>
        <time class="smallfont" datetime="2045-04-06">Friday, 6<sup>th</sup> April 2045</time>
        <p>Vestibulumaccumsan egestibulum eu justo convallis augue estas aenean elit intesque sed.</p>
      </article>
    </div>
    <div class="one_quarter">
      <h6 class="title">Keep In Touch</h6>
      <form class="btmspace-30" method="post" action="#">
        <fieldset>
          <legend>Newsletter:</legend>
          <input class="btmspace-15" type="text" value="" placeholder="Email">
          <button type="submit" value="submit">Submit</button>
        </fieldset>
      </form>
      <ul class="faico clear">
        <li><a class="faicon-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a class="faicon-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a class="faicon-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
        <li><a class="faicon-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
        <li><a class="faicon-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
        <li><a class="faicon-tumblr" href="#"><i class="fa fa-tumblr"></i></a></li>
      </ul>
    </div>
    
  </footer>
</div>

<div class="wrapper row5">
  <div id="copyright" class="clear"> 
    
    <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">Domain Name</a></p>
    <p class="fl_right">Template by <a target="_blank" href="https://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
    
  </div>
</div>

<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a> 
<!-- JAVASCRIPTS -->
<script src="../layout/scripts/jquery.min.js"></script>
<script src="../layout/scripts/jquery.backtotop.js"></script>
<script src="../layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>