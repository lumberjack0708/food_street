<?php
session_start(); 
require_once("../connMysql.php");
?>
<html>
    <head>
    <title>美食街系統</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <link rel="icon" type="image/x-icon" href="../images/FOOD.png" />
    <style>
        /*星星評分系統*/
        body,div,ul,li,p{margin:0;padding:0;}
        body{color:#666;font:12px/1.5 Arial;}
        ul{list-style-type:none;}
        #star{position:relative;width:600px;margin: auto;}
        #star ul,#star span{float:left;display:inline;height:19px;line-height:19px;}
        #star ul{margin:0 10px;}
        #star li{float:left;width:24px;cursor:pointer;text-indent:-9999px;background:url(../images/star.png) no-repeat;}
        #star strong{color:#f60;padding-left:10px;}
        #star li.on{background-position:0 -28px;}
        #star p{position:absolute;top:20px;width:159px;height:60px;display:none;background:url(images/icon.gif) no-repeat;padding:7px 10px 0;}
        #star p em{color:#f60;display:block;font-style:normal;}         	
    </style>
    <script type="text/javascript"> 
        window.onload = function ()
        {
            var oStar = document.getElementById("star");
            var aLi = oStar.getElementsByTagName("li");
            var oUl = oStar.getElementsByTagName("ul")[0];
            var oSpan = oStar.getElementsByTagName("span")[1];
            var oP = oStar.getElementsByTagName("p")[0];
            var i = iScore = iStar = 0;
            var aMsg = [
                "很不滿意|差得太離譜，與賣家描述的嚴重不符，非常不滿",
                "不滿意|部分有破損，與賣家描述的不符，不滿意",
                "一般|質量一般，沒有賣家描述的那麼好",
                "滿意|質量不錯，與賣家描述的基本一致，還是挺滿意的",
                "非常滿意|質量非常好，與賣家描述的完全一致，非常滿意"
                ]
            for (i = 1; i <= aLi.length; i++)
            {
            aLi[i - 1].index = i;
            //滑鼠移過顯示分數
            aLi[i - 1].onmouseover = function ()
            {
                fnPoint(this.index);
                //浮動層顯示
                oP.style.display = "block";
                //計算浮動層位置
                oP.style.left = oUl.offsetLeft + this.index * this.offsetWidth - 104 + "px";
                //匹配浮動層文字內容
                //oP.innerHTML = "<em><b>" + this.index + "</b> 分 " + aMsg[this.index - 1].match(/(.+)\|/)[1] + "</em>" + aMsg[this.index - 1].match(/\|(.+)/)[1]
            oP.innerHTML = "<em><b>" + this.index + "</b> 分 ";
            };
            //滑鼠離開后恢復上次評分
            aLi[i - 1].onmouseout = function ()
            {
                fnPoint();
                //關閉浮動層
                oP.style.display = "none"
            };
            //點選後進行評分處理
            aLi[i - 1].onclick = function ()
            {
                iStar = this.index;
                oP.style.display = "none";
                //oSpan.innerHTML = "<strong>" + (this.index) + " 分</strong> (" + aMsg[this.index - 1].match(/\|(.+)/)[1] + ")"
            document.getElementById("gg").value = this.index;
            }
            }
            //評分處理
            function fnPoint(iArg)
            {
            //分數賦值
            iScore = iArg || iStar;
            for (i = 0; i < aLi.length; i++) aLi[i].className = i < iScore ? "on" : "";
            }
        };
    </script>	
    </head>
    <body>
        <h1>用餐後評分</h1>
        <form method="POST">
            <li class="row">
            <div id="star">
                <span >打分</span>
                <ul>
                    <li><a href="javascript:;">1</a></li>
                    <li><a href="javascript:;">2</a></li>
                    <li><a href="javascript:;">3</a></li>
                    <li><a href="javascript:;">4</a></li>
                    <li><a href="javascript:;">5</a></li>
                </ul>
                <span></span>
                <p></p> 
                </div> 
        </li>
    <input type="text" value="0" id="gg" name="gg" max="5"/>
    </form>
    </body>
</html>