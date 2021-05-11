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
      <div class="row">
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
          <!-- Shopping cart table -->
          <div class="table-responsive">
            <table class="table">
              <thead>
              <tr>
                <th scope="col" class="border-0 bg-light">
                  <div class="p-2 px-3 text-uppercase">Sản phẩm</div>
                </th>
                <th scope="col" class="border-0 bg-light">
                  <div class="py-2 text-uppercase">Số lượng</div>
                </th>
                <th scope="col" class="border-0 bg-light">
                  <div class="py-2 text-uppercase">Ngày đặt hàng</div>
                </th>
              </tr>
              </thead>
              <tbody>
              <tr>
              <?php
               foreach($items as $item){
                echo "<tr>";
                echo "<th scope='row' class='border-0'>";
              echo "<div class='p-2'>";
              echo "<img  src='".base_url()."images/book/BOOK_".$item->book_id.".jpg?t=".time()."' onerror=\"this.src='".base_url()."images/default/defaultProductImage.jpg'\" alt='' width='70' class='img-fluid rounded shadow-sm'>";
                echo "<div class='ml-3 d-inline-block align-middle'>";
                echo "<h5 class='mb-0'> <a href='".base_url()."index.php/Book_Controller/viewBook/".$item->book_id."' class='text-dark d-inline-block align-middle'>".$item->title."</a></h5><span class='text-muted font-weight-normal font-italic d-block'>Thể loại: <span>".$item->name."</span></span>";
                echo "</div>";
              echo "</div>";
            echo "</th>";
            echo "<td class='border-0 align-middle'><strong>".$item->quantity."</strong></td>";
            echo "<td class='border-0 align-middle'><strong>".$item->order_date."</strong></td>";
            echo "<td class='border-0 align-middle' style='text-align:center'>&ensp;&ensp;";
            }
              ?>
              </tr>
              </tbody>
            </table>
            <a href="javascript:history.back()" type="button" style="float:right;" class="btn btn-outline-primary rounded-pill py-2">Trở về</a>
          </div>
          <!-- End -->
        </div>
      </div>

    </div>
  </div>
</div>
</body>
</html>