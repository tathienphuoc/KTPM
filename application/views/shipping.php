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
  <div class="pb-5">
    <div class="container">
      <div class="row" th:each="shipping:${shippings}">
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
          <!-- Shopping cart table -->
          <!--<div class="table-responsive">-->
            <?php
               foreach($shippings as $shipping){
               echo "<div style='border:1px solid black'>";
                  echo "<table class='table' style='text-align:center'>";
                     echo "<thead>";
                     echo "<tr>";
                     echo "<th scope='col' class='border-0 bg-light'>";
                        echo "<div class='py-2 text-uppercase'>Tên chủ thẻ</div>";
                     echo "</th>";
                     echo "<th scope='col' class='border-0 bg-light'>";
                        echo "<div class='py-2 text-uppercase'>Số điện thoại</div>";
                     echo "</th>";
                     echo "<th scope='col' class='border-0 bg-light'>";
                        echo "<div class='py-2 text-uppercase'>Địa chỉ</div>";
                     echo "</th>";
                     echo "<th scope='col' class='border-0 bg-light'>";
                        echo "<div class='py-2 text-uppercase'>Thành phố</div>";
                     echo "</th>";
                     echo "</tr>";
                     echo "</thead>";


                     echo "<tbody>";
                     echo "<tr>";
                     echo "<td class='border-0 align-middle'><strong>".$shipping->card_owner."</strong></td>";
                     echo "<td class='border-0 align-middle'><strong>".$shipping->number_phone."</strong></td>";
                     echo "<td class='border-0 align-middle'><strong>".$shipping->address."</strong></td>";
                     echo "<td class='border-0 align-middle'><strong>".$shipping->city."</strong></td>";
                     echo "</tr>";
                     echo "</tbody>";



                     echo "<thead>";
                     echo "<tr>";
                     echo "<th scope='col' class='border-0 bg-light'>";
                        echo "<div class='py-2 text-uppercase'>Tên người dùng</div>";
                     echo "</th>";
                     echo "<th scope='col' class='border-0 bg-light'>";
                        echo "<div class='py-2 text-uppercase'>Tên sản phẩm</div>";
                     echo "</th>";
                     echo "<th scope='col' class='border-0 bg-light'>";
                        echo "<div class='py-2 text-uppercase'>Số lượng</div>";
                     echo "</th>";
                     echo "<th scope='col' class='border-0 bg-light'>";
                        echo "<div class='py-2 text-uppercase'>Ngày đặt hàng</div>";
                     echo "</th>";
                     echo "</tr>";
                     echo "</thead>";

                     foreach($cartitem[$shipping->id] as $item){
                        echo "<tbody>";
                        echo "<td class='border-0 align-middle'><strong >".$username[$item->account_id]."</strong></td>";
                        echo "<td class='border-0 align-middle'><strong >".$book[$item->book_id]."</strong></td>";
                        echo "<td class='border-0 align-middle'><strong >".$item->quantity."</strong></td>";
                        echo "<td class='border-0 align-middle'><strong >".$item->order_date."</strong></td>";
                        echo "</tbody>";
                     }
                     echo "<td colspan='4'><a href='".base_url()."index.php/Admin_Controller/saveShipping/".$shipping->id."' style='float:right;'type='button' class='btn btn-outline-primary rounded-pill py-2'>Giao hàng</a></td>";
                  echo "</table>";
               echo "</div>";
                  echo "<div style='display:block;height:50px'></div>";
               }
            ?>
          </div>
          <!-- End -->
        </div>
      </div>
      <a href="<?php echo base_url();?>index.php/Admin_Controller/booksAdmin" type="button" style="float:right;" class="btn btn-outline-primary rounded-pill py-2">Trở về</a>
    </div>
  </div>
</div>
</body>
</html>