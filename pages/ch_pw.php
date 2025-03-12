<?php
session_start();
?>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<link rel="icon" type="image/x-icon" href="../images/FOOD.png" />
</head>
<body>

<div class="wrap">
  <a class="btn popup-btn" href="#letmeopen">打開popup視窗</a>
</div>
<div class="popup-wrap" id="letmeopen">
  <div class="popup-box transform-out">
    <h2>標題請下在這裡</h2>
    <h3>內容可以打很多在這裡</h3>
    <a class="close-btn popup-close" href="#">x</a>
  </div>
</div>
</body>
