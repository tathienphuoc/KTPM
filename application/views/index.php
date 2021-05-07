<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TSNN</title>
    <!--Icons-->
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>images/defualt/favicon.ico"/>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/navBar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bgVideo.css">
    <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>




    <!--Source video
    Youtube User: Ohkamp
    Youtube Link: https://www.youtube.com/watch?v=SKVcQnyEIT8 -->
    <video autoplay loop id="video-background" muted plays-inline>
        <source src="<?php echo base_url(); ?>The_Joy_of_Books.mp4" type="video/mp4">
    </video>
</head>
<body>
<nav class="nav">
    <div class="container">
        <div class="logo">
            <a href="#">TSNN</a> &ensp;
            <a class="nav-link" href="<?php echo base_url()?>index.php/Admin_Controller/info">Thông tin</a>
        </div>
        <div id="mainListDiv" class="main_list">
            <ul class="navlinks">
            </ul>
        </div>
    </div>
</nav>
</div>
<div class="center">
    <div class="container">
        <h1 class="logo" style="color:white;font-size:40px">Tiệm sách nho nhỏ</h1>
        <div class="button">
            <a href="<?php echo base_url(); ?>index.php/Book_Controller/books" >Ghé cửa hàng</a>
        </div>&ensp;
        <div class="button">
            <a href="<?php echo base_url(); ?>index.php/Account_Controller/login" >Đăng nhập</a>
        </div>
    </div>
    <br><br><br><br>
</div>


</body>
</html>
