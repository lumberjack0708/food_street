<?php 
session_start();
require_once("../connMysql.php");
?>
<!DOCTYPE html>
<!--
Template Name: Colossus
Author: <a href="https://www.os-templates.com/">OS Templates</a>
Author URI: https://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: https://www.os-templates.com/template-terms
-->
<html>
<head>
<title>[外食訂購]管理規定</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<?php 
$cart_amount=0;
printf($menu_row,'../images/HFS2.jpg', '../index_login.php', '../eat_out/copp_storelist.php', 'vote.php','../eat_out/store_list.php','food_rule.php','his_order.php','../index.php?logout=1',$_SESSION['username'],'copp_cart.php',$cart_amount,'');
?>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- <div class="wrapper row2"> 
  <div id="breadcrumb" class="clear"> 
    ################################################################################################ 
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">Lorem</a></li>
      <li><a href="#">Ipsum</a></li>
      <li><a href="#">Dolor</a></li>
    </ul>
     ################################################################################################ 
  </div>
</div>-->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- <div class="wrapper row3"> -->
  <!-- <main class="container clear">  -->
    <!-- main body -->
    <!-- ################################################################################################ -->
    <!-- <div class="sidebar one_quarter first">  
      ################################################################################################ 
      <h6>Lorem ipsum dolor</h6>
      <nav class="sdb_holder">
        <ul>
          <li><a href="#">Navigation - Level 1</a></li>
          <li><a href="#">Navigation - Level 1</a>
            <ul>
              <li><a href="#">Navigation - Level 2</a></li>
              <li><a href="#">Navigation - Level 2</a></li>
            </ul>
          </li>
          <li><a href="#">Navigation - Level 1</a>
            <ul>
              <li><a href="#">Navigation - Level 2</a></li>
              <li><a href="#">Navigation - Level 2</a>
                <ul>
                  <li><a href="#">Navigation - Level 3</a></li>
                  <li><a href="#">Navigation - Level 3</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="#">Navigation - Level 1</a></li>
        </ul>
      </nav>-->
      <!-- <div class="sdb_holder"> 
        <h6>Lorem ipsum dolor</h6>
        <address>
        Full Name<br>
        Address Line 1<br>
        Address Line 2<br>
        Town/City<br>
        Postcode/Zip<br>
        <br>
        Tel: xxxx xxxx xxxxxx<br>
        Email: <a href="#">contact@domain.com</a>
        </address>
      </div>
      <div class="sdb_holder">
        <article>
          <h6>Lorem ipsum dolor</h6>
          <p>Nuncsed sed conseque a at quismodo tris mauristibus sed habiturpiscinia sed.</p>
          <ul>
            <li><a href="#">Lorem ipsum dolor sit</a></li>
            <li>Etiam vel sapien et</li>
            <li><a href="#">Etiam vel sapien et</a></li>
          </ul>
          <p>Nuncsed sed conseque a at quismodo tris mauristibus sed habiturpiscinia sed. Condimentumsantincidunt dui mattis magna intesque purus orci augue lor nibh.</p>
          <p class="more"><a href="#">Continue Reading &raquo;</a></p>
        </article>
      </div>-->
      <!-- ################################################################################################ -->
    
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <!--<div class="content three_quarter" style="margin-top: 20px;"> 
       ################################################################################################ 
      ## <h1>&lt;h1&gt; to &lt;h6&gt; - Headline Colour and Size Are All The Same</h1> ##
      <center><h1>外食管理規定</h1></center>
      <img class="imgr borderedbox inspace-5" src="../images/demo/imgr.gif" alt="">
      <p>Aliquatjusto quisque nam consequat doloreet vest orna partur scetur portortis nam. Metadipiscing eget facilis elit sagittis felisi eger id justo maurisus convallicitur.</p>
      <p>Dapiensociis <a href="#">temper donec auctortortis cumsan</a> et curabitur condis lorem loborttis leo. Ipsumcommodo libero nunc at in velis tincidunt pellentum tincidunt vel lorem.</p>
      <img class="imgl borderedbox inspace-5" src="../images/demo/imgl.gif" alt="">
      <p>This is a W3C compliant free website template from <a href="https://www.os-templates.com/" title="Free Website Templates">OS Templates</a>. For full terms of use of this template please read our <a href="https://www.os-templates.com/template-terms">website template licence</a>.</p>
      <p>You can use and modify the template for both personal and commercial use. You must keep all copyright information and credit links in the template and associated files. For more website templates visit our <a href="https://www.os-templates.com/">free website templates</a> section.</p>
      <p>Portortornec condimenterdum eget consectetuer condis consequam pretium pellus sed mauris enim. Puruselit mauris nulla hendimentesque elit semper nam a sapien urna sempus.</p>
      <h1>Table(s)</h1>
      <div class="scrollable">
        <table>
          <thead>
            <tr>
              <th>Header 1</th>
              <th>Header 2</th>
              <th>Header 3</th>
              <th>Header 4</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><a href="#">Value 1</a></td>
              <td>Value 2</td>
              <td>Value 3</td>
              <td>Value 4</td>
            </tr>
            <tr>
              <td>Value 5</td>
              <td>Value 6</td>
              <td>Value 7</td>
              <td><a href="#">Value 8</a></td>
            </tr>
            <tr>
              <td>Value 9</td>
              <td>Value 10</td>
              <td>Value 11</td>
              <td>Value 12</td>
            </tr>
            <tr>
              <td>Value 13</td>
              <td><a href="#">Value 14</a></td>
              <td>Value 15</td>
              <td>Value 16</td>
            </tr>
          </tbody>
        </table>
      </div>-->
      <div id="comments">
        <h2 style="margin-left: 15px; font-size:34px; margin-top:30px;">外食提領規定</h2>
        <ul>
          <li>
            <article>
              <header>
                <!-- <figure class="avatar"><img src="../images/demo/avatar.png" alt=""></figure> -->
               
                
              </header>
              <div class="comcont" style="font-size:28px; line-height:40px">
                <p>一 ､訂購外食班級須完成申請核定，訂購當日須派同學與廠商在約定時間攜帶外食訂購單第二聯備查，於大門警衛室旁領取，嚴禁於其他側門、圍牆邊或校外領取。</p>
              </div>
            </article>
          </li>
          <li>
            <article>
              <header>
                <!-- <figure class="avatar"><img src="../images/demo/avatar.png" alt=""></figure> -->
              
              </header>
              <div class="comcont" style="font-size:28px;">
                <p>二 ､不得於上課、午休、打掃時間領取外食。</p>
              </div>
            </article>
          </li>
    
        </ul>
        <!--<h2>Write A Comment</h2>
        <form action="#" method="post">
          <div class="one_third first">
            <label for="name">Name <span>*</span></label>
            <input type="text" name="name" id="name" value="" size="22">
          </div>
          <div class="one_third">
            <label for="email">Mail <span>*</span></label>
            <input type="text" name="email" id="email" value="" size="22">
          </div>
          <div class="one_third">
            <label for="url">Website</label>
            <input type="text" name="url" id="url" value="" size="22">
          </div>
          <div class="block clear">
            <label for="comment">Your Comment</label>
            <textarea name="comment" id="comment" cols="25" rows="10"></textarea>
          </div>
          <div>
            <input name="submit" type="submit" value="Submit Form">
            &nbsp;
            <input name="reset" type="reset" value="Reset Form">
          </div>
        </form>
      </div>-->
      <!-- ################################################################################################ -->
    </div>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
<div id="comments">
    <h2 style="margin-left: 15px;font-size:34px;">食品安全規範</h2>
    <ul>
      <li>
        <article>
          <header>
            <!-- <figure class="avatar"><img src="../images/demo/avatar.png" alt=""></figure> -->
          
          </header>
          <div class="comcont" style="font-size:28px;line-height:40px">
            <p>一、違反前述外食領取規定者，依學生獎懲規定第九條第廿三款「不遵守飲食生活規定情節輕微者」，領取者記警告。班級扣生活秩序競賽分數。</p>
          </div>
        </article>
      </li>
      <li>
        <article>
          <header>
            <!-- <figure class="avatar"><img src="../images/demo/avatar.png" alt=""></figure> -->
           
          </header>
          <div class="comcont" style="font-size:28px;">
            <p>二、未申請核定私自訂購外食者，依學生獎懲規定第九條第廿三款「不遵守飲食生活規定情節輕微者」，記警告</p>
          </div>
        </article>
      </li>
      <li>
        <article>
          <header>
            <!-- <figure class="avatar"><img src="../images/demo/avatar.png" alt=""></figure> -->
            
          </header>
          <div class="comcont"style="font-size:28px;">
            <p>三、家長或學生不得為他人或其他班級代購外食，違反規定之學生視為私自訂購外食處理。</p>
          </div>
        </article>
      </li>
      <li>
        <article>
          <header>
            <!-- <figure class="avatar"><img src="../images/demo/avatar.png" alt=""></figure> -->
           
          </header>
          <div class="comcont"style="font-size:28px;">
            <p>四、如被查獲違反前述一至三項規定，當期取消訂購外食申請資格。</p>
          </div>
        </article>
      </li>
      <li>
        <article>
          <header>
            <!-- <figure class="avatar"><img src="../images/demo/avatar.png" alt=""></figure> -->
           
          </header>
          <div class="comcont"style="font-size:28px;">
            <p>五、教官室不定期至門口及校園巡檢，如發現違規者，依校規處分。</p>
          </div>
        </article>
      </li>
      <li>
        <article>
          <header>
            <!-- <figure class="avatar"><img src="../images/demo/avatar.png" alt=""></figure> -->
           
          </header>
          <div class="comcont"style="font-size:28px;line-height:40px">
            <p>六、依高雄市政府教育局中華民國103年10月3日函文提醒教職員工生及家長，為維護及促進學生健康，盡量勿以含糖飲料獎勵或慰勞學生。</p>
          </div>
        </article>
      </li>
      <li>
        <article>
          <header>
            <!-- <figure class="avatar"><img src="../images/demo/avatar.png" alt=""></figure> -->
           
          </header>
          <div class="comcont"style="font-size:28px;">
            <p>八、吃完外食，需確實做好垃圾分類及班級環境整理復原。</p>
          </div>
        </article>
      </li>
      <li>
        <article>
          <header>
            <!-- <fig   ure class="avatar"><img src="../images/demo/avatar.png" alt=""></figure> -->
           
          </header>
          <div class="comcont"style="font-size:28px;">
            <p>九、食用後，如發生身體不適現象，應立即向健康中心反映，並保留檢體（物品）實施檢驗。</p>
          </div>
        </article>
      </li>
    </ul>
    <!--<h2>Write A Comment</h2>
    <form action="#" method="post">
      <div class="one_third first">
        <label for="name">Name <span>*</span></label>
        <input type="text" name="name" id="name" value="" size="22">
      </div>
      <div class="one_third">
        <label for="email">Mail <span>*</span></label>
        <input type="text" name="email" id="email" value="" size="22">
      </div>
      <div class="one_third">
        <label for="url">Website</label>
        <input type="text" name="url" id="url" value="" size="22">
      </div>
      <div class="block clear">
        <label for="comment">Your Comment</label>
        <textarea name="comment" id="comment" cols="25" rows="10"></textarea>
      </div>
      <div>
        <input name="submit" type="submit" value="Submit Form">
        &nbsp;
        <input name="reset" type="reset" value="Reset Form">
      </div>
    </form>
  </div>-->
  <!-- ################################################################################################ -->
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row4">
    <footer id="footer" class="clear"> 
      <!-- ################################################################################################ -->
      <div class="one_quarter first">
        <h6 class="title">聯絡創作者</h6>
        <address class="btmspace-15">
        0900-000-000<br>
        0900<!--&amp;-->-111-111<br>
        0900-222-222<br>
        0900-333-333  
        </address>
        <ul class="nospace">
          <li class="btmspace-10"><span class="fa fa-phone"></span> +886  000 0000</li>
          <li><span class="fa fa-envelope-o"></span> user@gmail.com</li>
        </ul>
      </div>
      <div class="one_quarter">
        <h6 class="title">關於創作者</h6>
        <ul class="nospace linklist">
          <li><a href="#">首頁</a></li>
          <li><a href="#">facebook</a></li>
          <li><a href="#">instagram</a></li>
          <li><a href="#">discord</a></li>
          <li><a href="#">twitter</a></li>
        </ul>
      </div>
      <div class="one_quarter"> 
        <h6 class="title">前往更多相關連結</h6>
        <article>
          <h2 class="nospace"><a href="#"></a></h2>
          <!-- <time class="smallfont" datetime="2045-04-06">ksvcs<sup>th</sup> 11月 2021</time> -->
          <!-- <p>指導老師:哈利波特</p> -->
        </article>
      </div>
      <div class="one_quarter">
        <h6 class="title">給我們更多建議</h6>
        <form class="btmspace-30" method="post" action="#">
          <fieldset>
            <legend>Newsletter:</legend>
            <input class="btmspace-15" type="text" value="" placeholder="Email">
            <button type="submit" value="submit">送出</button>
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
      <!-- ################################################################################################ -->
    </footer>
  </div>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- <div class="wrapper row5">
    <div id="copyright" class="clear"> 
      <!-- ################################################################################################ -->
      <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">food street</a></p>
      <p class="fl_right">Template by <a target="_blank" href="https://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
      <!-- ################################################################################################ -->
    </div>
  </div> -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a> 
<!-- JAVASCRIPTS -->
<script src="../layout/scripts/jquery.min.js"></script>
<script src="../layout/scripts/jquery.backtotop.js"></script>
<script src="../layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>