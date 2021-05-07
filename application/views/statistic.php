<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Link Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <style>
         body {
         background: #eecda3;
         background: -webkit-linear-gradient(to right, #4cbfec, #ecb1e7);
         background: linear-gradient(to right,  #4cbfec, #ecb1e7);
         min-height: 100vh;
         }
      </style>
</head>
<body>
<div class="px-4 px-lg-0">
    <!-- End -->
    <div style="margin-top:50px;"></div>
    <div class="pb-5"  style="text-align: center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                    <!-- Shopping cart table -->
                    <div class="table-responsive">
                        <div class="container">
                            <h1>Sản phẩm bán chạy</h1>
                        </div >
                        <table class="table" >
                            <thead >
                            <tr>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="p-2 px-3 text-uppercase">Sản phẩm</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Giá</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Số lượng đã bán</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($popular as $pop){
                                    echo "<tr>";
                                        echo " <th scope='row' class='border-0' style='text-align: left;'>";
                                            echo "<div class='p-2'>";
                                            echo "<img  src='".base_url()."images/book/BOOK_".$pop->book_id.".jpg?t=".time()."' onerror=\"this.src='".base_url()."images/default/defaultProductImage.jpg'\" alt='' width='70' class='img-fluid rounded shadow-sm'>";
                                                echo "<div class='ml-3 d-inline-block align-middle'>";
                                                    echo "<h5 class='mb-0'> <a href='".base_url()."index.php/Book_Controller/viewBook/".$pop->book_id."' class='text-dark d-inline-block align-middle'>".$book[$pop->book_id]->title."</a>";
                                                    echo "</h5><span class='text-muted font-weight-normal font-italic d-block'>Thể loại: <span>".$category[$book[$pop->book_id]->category_id]->name."</span></span>";
                                                echo "</div>";
                                            echo "</div>";
                                        echo "</th>";
                                        echo "<td class='border-0 align-middle'><strong>".$book[$pop->book_id]->price."</strong></td>";
                                        echo "<td class='border-0 align-middle'><strong>".$pop->total."</strong></td>";
                                    echo "</tr>";
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!---->

    <!-- End -->
    <div style="margin-top:50px;"></div>
    <div class="pb-5"  style="text-align: center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                    <!-- Shopping cart table -->
                    <div class="table-responsive">
                        <div class="container">
                            <h1>Top khách hàng</h1>
                        </div >
                        <table class="table" >
                            <thead >
                            <tr>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="p-2 px-3 text-uppercase">Hình ảnh</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="p-2 px-3 text-uppercase">Tên đầy đủ</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Tên người dùng</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Số lượng đã mua</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($purchased as $pur){
                                    echo "<tr>";
                                        echo "<td class='border-0 align-middle'><img  src='".base_url()."images/user/USER_".$pur->account_id.".jpg?t=".time()."' onerror=\"this.src='".base_url()."images/default/defaultProductImage.jpg'\" alt='' width='70' class='img-fluid rounded shadow-sm'></td>";
                                        echo "<td class='border-0 align-middle'><h5 class='mb-0'> <a class='text-dark d-inline-block align-middle''>".$user[$pur->account_id]->full_name."</a></h5></td>";
                                        echo "<td class='border-0 align-middle'><strong>".$user[$pur->account_id]->user_name."</strong></td>";
                                        echo "<td class='border-0 align-middle'><strong>".$pur->total."</strong></td>";
                                    echo "</tr>";
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <a href="<?php echo base_url();?>index.php/Admin_Controller/booksAdmin" type="button" style="float:right;" class="btn btn-outline-primary rounded-pill py-2">Trở về</a>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>