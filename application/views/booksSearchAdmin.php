<html lang="en" >
<head>
<title>Cửa hàng</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
         #account {
         text-shadow: 0 2px 4px rgba(50, 58, 58, 0.19), 0 1px 2px rgba(50, 58, 58, 0.22);
         }
         #account ul {
         background: none;
         height: 40px;
         list-style: none;
         }
         #account {
         display: inline-table;
         width: auto;
         text-align: left;
         position: relative;
         }
         #account li:hover {
         color: #333;
         }
         #account a {
         font-weight: normal;
         text-decoration: none;
         display: block;
         }
         #account:hover {
         color: #333;
         }
         .submenu {
         display: none;
         position: absolute;
         right: 0;
         z-index: 20;
         width: auto;
         min-width: 200px;
         height: auto;
         }
         .submenu li {
         padding: 5px 10px;
         background-color: #636e7233;
         text-decoration: none;
         text-align: right;
         min-width: 120px;
         }
         .submenu li:hover {
         background-color: #636e72;
         }
         .submenu a {
         color: #333;
         text-indent: -50px;
         display: block;
         }
         #account:hover .submenu {
         transition: .6s ease-in-out;
         -webkit-transition: .6s ease-in-out;
         display: block;
         }
         .dropdown-icon {
         position: relative;
         top: 1.25px;
         right: 0;
         }
         #account:hover .dropdown-icon {
         text-shadow: none;
         transition: .45s ease-in-out;
         -webkit-transition: .45s ease-in-out;
         transform: rotate(180deg);
         -webkit-transform: rotate(180deg);
         }
         .pagination {
         display: inline-block;
         }
         .pagination a {
         color: black;
         float: left;
         padding: 8px 16px;
         text-decoration: none;
         }
         .pagination a.active {
         background-color: blue;
         color: white;
         }
         .pagination a:hover:not(.active) {background-color: #ddd;}
         .dropbtn {
         background-color: #4CAF50;
         color: white;
         padding: 16px;
         font-size: 16px;
         border: none;
         }
         .dropdown {
         position: relative;
         display: inline-block;
         }
         .dropdown-content {
         display: none;
         position: absolute;
         background-color: #f1f1f1;
         min-width: 160px;
         box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
         z-index: 1;
         }
         .dropdown-content a {
         color: black;
         padding: 12px 16px;
         text-decoration: none;
         display: block;
         }
         .dropdown-content a:hover {background-color: #ddd;}
         .dropdown:hover .dropdown-content {display: block;}
         .dropdown:hover .dropbtn {background-color: #3e8e41;}
      </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="<?php echo base_url()?>index.php/Admin_controller">TSNN</a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url()?>index.php/Admin_controller/addBook">Thêm sản phẩm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url()?>index.php/Admin_controller/shipping">Giao hàng</a>
            </li>
        </ul>
            <?php
            echo form_open("Admin_Controller/booksSearchAdmin",array(
                'class'=>"form-inline mr-1 my-lg-0"
            ));
            echo form_input(array(
                'class'=>"form-control mr-sm-2" ,
                'name'=>"search",
                'placeholder'=>"Tìm kiếm",
            ));
            echo form_button(array(
                'type' => 'submit', 
                'class' => 'btn btn-outline-success my-2 my-sm-0', 
                'content' => '<i class="fa fa-search fa-fw" style="font-size: 150%;"></i>'
            ));
            echo form_close();
          ?>
        <div id="account" class="nav-item mr-0">
            <i class="fas fa-user-circle" style="font-size: 200%;"></i>
            <ul class="row submenu mr-0">
                <li>
                    <a href="<?php echo base_url()?>index.php/Account_controller/profile">
                        Thông tin tài khoản
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url()?>index.php/Account_controller/logout">Đăng xuất</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php
        foreach($books as $book){
            echo "<div class='card' style='width: 19rem;display:inline-block; margin-top:2%; margin-left:4%;'>";
                echo "<img class='card-img-top' style='width:100%;height:400px' src='".base_url()."images/book/BOOK_".$book->id.".jpg?t=".time()."' onerror=\"this.src='".base_url()."images/default/defaultProductImage.jpg'\">";
                echo "<h5>".$book->id."</h5>";
                echo "<h5 style='height:50px'>".$book->title."</h5>";
                echo "<strong></strong>".$book->price."<strong>₫</strong>";
                echo "<div class='card-body'>";
                    echo "<span style='display:block;text-overflow: ellipsis;width: 250px;overflow: hidden; white-space: nowrap;margin-left:5px;'>";
                    echo "<span>".$book->description."</span>...";
                    echo "</span>";
                echo "</div >";
                echo "<div class='container'>";
                echo "<a href='" . base_url() . "index.php/Admin_controller/editBook/".$book->id."' class='btn btn-outline-primary' style='width:49%'>Chỉnh sửa</a>";
                echo "<a href='" . base_url() . "index.php/Admin_controller/deleteBook/".$book->id."' class='btn btn-outline-primary' style='width:49%'>Xóa</a>";
                echo "</div>";
            echo "</div>";
        }
    ?>
</body>
</html>