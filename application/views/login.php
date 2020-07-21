<!DOCTYPE html>
<html lang="en">
<head>
  <title>Đăng nhập</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container ">
    <div class="row justify-content-lg-center">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 ">
            <?php
              echo form_open("Account_Controller/confirmAccount");
              echo '<h1>Đăng nhập</h1>';

              echo '<div class="alert alert-danger" id="error" hidden></div>';
              echo '<div class="alert alert-info" id="success" hidden></div>';

              echo '<div class="form-group">';
              echo form_input(array(
                  'name'=>'username',
                  'placeholder'=>"Tên người dùng",
                  'autofocus'=>"true",
                  'class'=>"form-control input-lg"
              ));
              echo '</div>';

              echo '<div class="form-group">';
              echo form_input(array(
                  'name'=>'password',
                  'type'=>"password",
                  'placeholder'=>"Nhập mật khẩu",
                  'required'=>"true",
                  'class'=>"form-control input-lg"
              ));
              echo '</div>';

              echo '<div class="row">';
              echo '<div class="col-xs-6 col-sm-6 col-md-6">';
              echo form_submit(array(
                'type'=>"submit" ,
                'class'=>"btn btn-lg btn-primary btn-block" ,
                'value'=>"Đăng nhập" 
              ));
              echo '</div>';
              echo "<a href='" . base_url() . "index.php/Account_controller/forgotpwd' style='margin-top:2%;'>Quên mật khẩu</a>";
              echo "<a href='" . base_url() . "index.php/Account_controller/register' style='margin-left:10%;margin-top:2%;'>Đăng ký</a>";
              echo '</div>';

              echo form_close();
            ?>
        </div>
    </div>
</div>
</body>
</html>
