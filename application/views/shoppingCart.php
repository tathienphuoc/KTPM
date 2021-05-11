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
      background: linear-gradient(to right, #4cbfec, #ecb1e7);
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
                      <div class="py-2 text-uppercase">Giá</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Ngày đặt hàng</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Xóa</div>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($items as $item) {
                    echo "<tr>";
                    echo "<th scope='row' class='border-0'>";
                    echo "<div class='p-2'>";
                    echo "<img  src='" . base_url() . "images/book/BOOK_" . $item->book_id . ".jpg?t=" . time() . "' onerror=\"this.src='" . base_url() . "images/default/defaultProductImage.jpg'\" alt='' width='70' class='img-fluid rounded shadow-sm'>";
                    echo "<div class='ml-3 d-inline-block align-middle'>";
                    echo "<h5 class='mb-0'> <a href='" . base_url() . "index.php/Book_Controller/viewBook/" . $item->book_id . "' class='text-dark d-inline-block align-middle'>" . $item->title . "</a></h5><span class='text-muted font-weight-normal font-italic d-block'>Thể loại: <span>" . $item->name . "</span></span>";
                    echo "</div>";
                    echo "</div>";
                    echo "</th>";
                    echo "<td class='border-0 align-middle'><strong>" . $item->quantity . "</strong></td>";
                    echo "<td class='border-0 align-middle'><strong>" . number_format($item->price) . "₫</strong></td>";
                    echo "<td class='border-0 align-middle'><strong>" . $item->order_date . "</strong></td>";
                    echo "<td class='border-0 align-middle'>&ensp;&ensp;&ensp;<a href='" . base_url() . "index.php/CartItem_Controller/deleteCartItem/" . $item->c_id . "' class='text-dark'><i class='far fa-trash-alt'></i><i class='fa fa-trash'></i></a></td>";
                    echo "</tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- End -->
          </div>
        </div>
        <form action="<?php echo base_url() ?>index.php/CartItem_Controller/checkout" method="post">
          <div class="row py-5 p-4 bg-white rounded shadow-sm">
            <div class="col-lg-6">
              <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Phương thức thanh toán</div>
              <div class="p-4">
                <div class="container">
                  <div class="row">
                    <div class="inlineimage">
                      <img style="width:20%;margin-left: 10%;" class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Mastercard-Curved.png">
                      <img style="width:20%;" class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Discover-Curved.png">
                      <img style="width:20%;" class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Paypal-Curved.png">
                      <img style="width:20%;" class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/American-Express-Curved.png">
                    </div>
                  </div>
                </div>

                <div class="container">

                  <div class="form-group">
                    <span style="font-size: 125%;"><label><i class="fa fa-user"></i> Tên chủ tài khoản</label></span>
                    <input type="text" class="form-control" placeholder="Đại học Sài Gòn" id="cardOwner" name='cardOwner'>
                    <span id="errCardOwner" style="color:red"></span>
                  </div>
                  <div class="form-group">
                    <span style="font-size: 125%;"><label><i class="fa fa-credit-card"></i> Số tài khoản</label></span>
                    <input type="text" class="form-control" placeholder="1606201036100" id="cardNumber" name='cardNumber'>
                    <span id="errCardNumber" style="color:red"></span>
                  </div>
                  <div class="form-group">
                    <span style="font-size: 125%;"><label><i class="fa fa-address-card-o"></i> Địa chỉ giao hàng</label></span>
                    <input type="text" class="form-control" placeholder="273 An Dương Vương, Phường 3, Quận 5" id="address" name='address'>
                    <span id="errAddress" style="color:red"></span>
                  </div>
                  <div class="form-group">
                    <span style="font-size: 125%;"><label><i class="fa fa-institution"></i> Thành phố</label></span>
                    <input type="text" class="form-control" placeholder="Thành phố Hồ Chí Minh" id="city" name='city'>
                    <span id="errCity" style="color:red"></span>
                  </div>
                  <div class="form-group">
                    <span style="font-size: 125%;"><label><i class="fa fa-phone"></i> Số điện thoại liên lạc</label></span>
                    <input type="text" class="form-control" placeholder="(028) 38382 664" id="phoneNumber" name='numberPhone'>
                    <span id="errPhone" style="color:red"></span>
                  </div>

                </div>

              </div>
            </div>
            <div class="col-lg-6">
              <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Hóa đơn</div>
              <div class="p-4">
                <p class="font-italic mb-4">Chi phí vận chuyển sẽ bằng 5% chi phí đơn hàng</p>
                <ul class="list-unstyled mb-4">
                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Giá tiền sản phẩm </strong><strong><span><?php echo number_format($subTotal); ?></span>₫</strong></li>
                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Phí vận chuyển</strong><strong><span><?php echo number_format($shippingPrice); ?></span>₫</strong></li>
                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Tổng cộng</strong>
                    <h5 class="font-weight-bold"><strong><span><?php echo number_format($totalPrice); ?></span>₫</strong></h5>
                  </li>
                </ul>
                <div class="container">
                  <a href="<?php echo base_url(); ?>index.php/Book_Controller/books" type="button" style="float:right;" class="btn btn-outline-primary rounded-pill py-2">Tiếp tục mua sắm</a>

                  <button type="submit" style="float:right; margin-right:10px;" class="btn btn-dark rounded-pill py-2" id="btnSubmit">Thanh toán</button>
                </div>
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
  <!--Check form using Jquery-->
  <script>
    $("#btnSubmit").on("click", function(event) {
      var city = $("#city").val();
      var phoneNumber = $("#phoneNumber").val();
      var cardOwner = $("#cardOwner").val();
      var address = $("#address").val();
      var cardNumber = $("#cardNumber").val();
      var error = 0;

      if (city.length <= 0) {
        $("#errCity").html("Vui lòng nhập tên thành phố.");
        error++;
      } else {
        $("#errCity").html("");
      }
      if (cardOwner.length <= 0) {
        $("#errCardOwner").html("Vui lòng nhập tên chủ thẻ.");
        error++;
      } else if (containNumber(cardOwner)) {
        $("#errCardOwner").html("Vui lòng nhập tên không chứa số.");
        error++;
      } else if (cardOwner !== toTitleCase(cardOwner)) {
        $("#errCardOwner").html("Vui lòng viết hoa chữ cái đầu của mỗi từ.");
        error++;
      } else {
        $("#errCardOwner").html("");
      }
      if (address.length <= 0) {
        $("#errAddress").html("Vui lòng nhập địa chỉ giao hàng.");
        error++;
      } else {
        $("#errAddress").html("");
      }
      if (cardNumber.length <= 0) {
        $("#errCardNumber").html("Vui lòng nhập số tài khoản.");
        error++;
      } else if (!onlyNumber(cardNumber)) {
        $("#errCardNumber").html("Vui lòng chỉ nhập số.");
        error++;
      } else if (cardNumber.length < 10) {
        $("#errCardNumber").html("Số tài khoản ít nhất 10 số.");
        error++;
      } else {
        $("#errCardNumber").html("");
      }
      if (!isPhoneNumber(phoneNumber)) {
        $("#errPhone").html("Vui lòng nhập số điện thoại gồm ít nhất 10 số.");
        error++;
      } else {
        $("#errPhone").html("");
      }
      if (error === 0) {
        $("#btnSubmit").submit();
      } else {
        event.preventDefault();
      }
    });

    function isPhoneNumber(phoneNumber) {
      intRegex = /[0-9 -()+]+$/;
      if (phoneNumber.length < 10 || !intRegex.test(phoneNumber)) {
        return false;
      }
      return true;
    }

    function toTitleCase(str) {
      return str.replace(/(?:^|\s)\w/g, function(match) {
        return match.toUpperCase();
      });
    }

    function onlyNumber(val) {
      var numbers = /^[0-9]+$/;
      return val.match(numbers);
    }

    function containNumber(myString) {
      return /\d/.test(myString);
    }
  </script>
</body>

</html>