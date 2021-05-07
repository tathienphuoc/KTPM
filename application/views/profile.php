<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://code.jquery.com/jquery-3.3.1.min.js">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--Link Jquery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <title>Thông tin cá nhân</title>
</head>

<body>
  <hr>
  <a href="<?php echo base_url() ?>index.php/Book_Controller/books" type="button" class="btn btn-outline-primary" style="margin-left:10px;margin-top:10px; border:1px solid blue;">Trở về</a>
  <form class="container" action="<?php echo base_url() ?>index.php/Account_Controller/saveProfile" method="post" enctype="multipart/form-data">
    <?php echo form_open_multipart('Account_Controller/saveProfile'); ?>
    <h1>Chỉnh sửa thông tin</h1>
    <hr>
    <div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img src='<?php echo base_url(); ?>images/user/USER_<?php echo $user->id; ?>.jpg?t=<?php echo time(); ?>' onerror="this.src='<?php echo base_url(); ?>images/default/defaultUserImage.jpg'" style="width: 200px;height: 200px;" class="avatar img-circle" alt="Ảnh đại diện">
          <h6>Cập nhật ảnh đại diện</h6>
          <input type="file" accept=".jpg" class="form-control" name="image">
        </div>
      </div>

      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <div class="alert alert-danger" id="error" hidden></div>
        <div class="alert alert-info" id="success" hidden></div>
        <h3>Thông tin cá nhân</h3>

        <div class="form-horizontal">
          <div class="form-group">
            <label class="col-lg-3 control-label">Tên đăng nhập:</label>
            <div class="col-lg-8">
              <span class="form-control"><?php echo $user->user_name ?></span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Họ và tên:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name='fullName' value="<?php echo $user->full_name ?>" placeholder="Hiện chưa có tên">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Mật khẩu mới:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" id="password">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Nhập lại mật khẩu:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" id="confirm_password" name='confirm_password'>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input type="submit" class="btn btn-primary" id="btnSubmit" value="Lưu thay đổi" disabled>
              <span></span>
              <a class="btn btn-default" href="<?php echo base_url() ?>index.php/Account_Controller/logout">Đăng xuất</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  <hr>
  <!--Check form using Jquery-->
  <script>
    $('#error').html('Vui lòng nhập mật khẩu để xác nhận các thay đổi').css('color', 'red').attr("hidden", false);
    $('#password,#confirm_password').on('keyup', function() {
      $("#btnSubmit").attr("disabled", true);
      var pwd = $('#password').val();
      var cpwd = $('#confirm_password').val();
      if (checkPwd(pwd, cpwd)) {
        $("#btnSubmit").attr("disabled", false);
      }

    });

    function checkPwd(pwd, cpwd) {
      if (pwd.trim() == '') {
        $('#error').html('Vui lòng nhập mật khẩu').css('color', 'red').attr("hidden", false);
      } else if (pwd == cpwd) {
        $('#success').html('Mật khẩu trùng khớp').css('color', 'green').attr("hidden", false);
        $('#error').attr("hidden", true);
        return true;
      } else {
        $('#error').html('Mật khẩu không trùng khớp').css('color', 'red').attr("hidden", false);
        $('#success').attr("hidden", true);
      }
      return false;
    }
  </script>
</body>

</html>