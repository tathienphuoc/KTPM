<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem sách</title>
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link href="http://cdn.shopify.com/s/files/1/0067/5617/1846/t/2/assets/timber.scss.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css" rel="stylesheet" type="text/css" media="all" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/elevatezoom/3.0.8/jquery.elevatezoom.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/productPage.css">
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
    <a class="navbar-brand" href="/">TSNN</a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="#">Thông tin</a>
            </li>
        </ul>
        <div class="dropdown">
            <button class="form-control mr-sm-2">Sắp xếp</button>
            <div class="dropdown-content">
                <?php 
                    echo "<a class='page-link ' href='" . base_url() . "index.php/Book_Controller/sortByName' >Tên</a>";
                ?>
                <?php 
                    echo "<a class='page-link ' href='" . base_url() . "index.php/Book_Controller/sortByPrice' >Giá</a>";
                ?>
            </div>
        </div>
            <?php
            echo form_open("Book_Controller/booksSearch",array(
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
    </div>
</nav>
<div class="wrapper">
    <main>
        <div id="shopify-section-product-template" class="shopify-section">
            <div class="single-product-area mt-80 mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="product-details-large" id="ProductPhoto">
                            <img id="ProductPhotoImg" class="product-zoom" data-image-id="" alt="Hình ảnh sách" src='<?php echo base_url();?>images/book/BOOK_<?php echo $book->id; ?>.jpg?t=<?php echo time();?>' onerror="this.src='<?php echo base_url();?>images/default/defaultProductImage.jpg'" style="width: 450px;height: 500px;">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="single-product-content">
                                    <div class="product-details">
                                        <h1 class="single-product-name"><?php echo $book->title ?></h1>
                                        <div class="single-product-reviews">
                                            <span class="shopify-product-reviews-badge" data-id="1912078270534"></span>
                                        </div>
                                        <div class="product-sku">Tác giả: <span class="variant-sku"><?php echo $author->full_name ?></span></div>
                                        <div class="single-product-price">
                                            <div class="product-discount"><span  class="price" id="ProductPrice"><span class=money ><?php echo $book->price ?></span><span>₫</span></span></div>
                                        </div>
                                        <div class="product-info"><?php echo $book->description ?></div>

                                        <div class="single-product-action">
                                            <div class="product-variant-option">
                                                <script>
                                                        jQuery(function() {
                                                          jQuery('.swatch :radio').change(function() {
                                                            var optionIndex = jQuery(this).closest('.swatch').attr('data-option-index');
                                                            var optionValue = jQuery(this).val();
                                                            jQuery(this)
                                                            .closest('form')
                                                            .find('.single-option-selector')
                                                            .eq(optionIndex)
                                                            .val(optionValue)
                                                            .trigger('change');
                                                          });
                                                        });
                                                    </script>
                                            </div>
                                            <br>
                                            <style>.product-variant-option .selector-wrapper{display: none;}</style>
                                            <div class="product-add-to-cart">
                                                <div class="add">
                                                    <form action="<?php echo base_url()?>index.php/CartItem_Controller/addToCart/<?php echo $book->id;?>" method="post">
                                                        <span class="control-label">Số lượng</span>
                                                        <input class="cart-plus-minus" style="width: 100px;" type="number" value="1" min="1" name="quantity">

                                                        <button type="submit" class="btn btn-outline-primary" >Thêm vào giỏ hàng</button>
                                                        <a class="btn btn-outline-primary"  href="<?php echo base_url()?>index.php/Book_Controller/books" >Tiếp tục mua sắm</a>
                                                    </form>
                                                    <script>
                                                            jQuery('#AddToCart').click(function(e) {
                                                            e.preventDefault();
                                                            Shopify.addItemFromFormStart('AddToCartForm', 1912078270534);
                                                             });
                                                        </script>
                                                </div>
                                            </div><br><hr>
                                        </div>
                                    </div>
                                    <a href="<?php echo base_url()?>index.php/CartItem_Controller/shoppingCart" class="btn btn-outline-primary" style="float: right;margin-top: 10px;">Thanh toán</a>
                                <!--</form>-->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <style type="text/css">.product-details .countdown-timer-wrapper{display: none !important;}</style>

            <script>$(document).ready(function() {$('.fancybox').fancybox();});</script>
            <script>function productZoom(){
                        $(".product-zoom").elevateZoom({
                          gallery: 'ProductThumbs',
                          galleryActiveClass: "active",
                          zoomType: "inner",
                          cursor: "crosshair"
                        });$(".product-zoom").on("click", function(e) {
                          var ez = $('.product-zoom').data('elevateZoom');
                          $.fancybox(ez.getGalleryList());
                          return false;
                        });
                        
                        };
                      function productZoomDisable(){
                        if( $(window).width() < 767 ) {
                          $('.zoomContainer').remove();
                          $(".product-zoom").removeData('elevateZoom');
                          $(".product-zoom").removeData('zoomImage');
                        } else {
                          productZoom();
                        }
                      };

                      productZoomDisable();

                      $(window).resize(function() {
                        productZoomDisable();
                      });
                </script>
            <script>
                    $('.product-thumbnail').owlCarousel({
                        loop: true,
                        center: true,
                        nav: true,dots:false,
                        margin:10,
                        autoplay: false,
                        autoplayTimeout: 5000,
                        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                        item: 3,
                        responsive: {
                            0: {
                                items: 2
                            },
                            480: {
                                items: 3
                            },
                            992: {
                                items: 3,
                            },
                            1170: {
                                items: 3,
                            },
                            1200: {
                                items: 3
                            }
                        }
                    });
                </script>
        </div>
    </main>
</div>

</body>
</html>