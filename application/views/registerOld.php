<!DOCTYPE html>
<html lang="en">
<head>
  <title>Đăng ký</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php
  foreach($usernames as $username){
    echo '<input value="'.$username.'" type="hidden" name="usernameExist"></input>';
  }
?>
<div class="container ">
    <div class="row justify-content-lg-center">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 ">
            <?php
              echo form_open("Account_Controller/saveAccount");
              echo '<h1>Thông tin đăng ký</h1>';

              echo '<div class="alert alert-danger" id="error" hidden></div>';
              echo '<div class="alert alert-info" id="success" hidden></div>';

              echo '<div class="form-group">';
              echo form_input(array(
                  'id'=>'username',
                  'name'=>'username',
                  'placeholder'=>"Tên người dùng",
                  'autofocus'=>"true",
                  'class'=>"form-control input-lg"
              ));
              echo '</div>';

              echo '<div class="form-group">';
              echo form_input(array(
                  'id'=>'password',
                  'name'=>'password',
                  'type'=>"password",
                  'placeholder'=>"Nhập mật khẩu",
                  'required'=>"true",
                  'class'=>"form-control input-lg"
              ));
              echo '</div>';

              echo '<div class="form-group">';
              echo form_input(array(
                  'id'=>'confirm_password',
                  'name'=>'confirm_password',
                  'type'=>"password",
                  'placeholder'=>"Nhập lại mật khẩu",
                  'required'=>"true",
                  'class'=>"form-control input-lg"
              ));
              echo '</div>';

              echo '<div class="row">';
              echo '<div class="col-xs-6 col-sm-6 col-md-6">';
              echo form_submit(array(
                'type'=>"submit" ,
                'class'=>"btn btn-lg btn-primary btn-block" ,
                'value'=>"Đăng ký" ,
                'id'=>"btnSubmit" ,
                'disabled'=>"true" 
              ));
              echo '</div>';
              echo '</div>';
              echo form_close();
            ?>
        </div>
    </div>

</div>
<!--Check form using Jquery-->
<script>
    $('#username,#password,#confirm_password').on('keyup',function(){
      $("#btnSubmit").attr("disabled", true);
      var username=$('#username').val();
      var pwd=$('#password').val();
      var cpwd=$('#confirm_password').val();
      if(checkUsername(username)&&checkPwd(pwd,cpwd)){
        $("#btnSubmit").attr("disabled", false);
      }

    });
    function checkUsername(username){
    var names = $("input[name='usernameExist']")
    .map(function(){return $(this).val();}).get();
      if (username.indexOf(' ')>=0) {
         $('#error').html('Tên người dùng không chứa khoảng trắng').css('color', 'red').attr("hidden", false);
         $('#success').attr("hidden", true);
       } else if (username.length<3) {
         $('#error').html('Tên người dùng phải từ 3 ký tự trở lên').css('color', 'red').attr("hidden", false);
         $('#success').attr("hidden", true);
       }else if (names.includes(username)) {
         $('#error').html('Tên người dùng đã được sử dụng').css('color', 'red').attr("hidden", false);
         $('#success').attr("hidden", true);
       }else{
         $('#error').html('').attr("hidden", true);
         return true;
       }
       return false;
    }

    function checkPwd(pwd,cpwd){
      if (pwd.trim()=='') {
       $('#error').html('Vui lòng nhập mật khẩu').css('color', 'red').attr("hidden", false);
       $('#success').attr("hidden", true);
     }
      else if (pwd==cpwd) {
       $('#success').html('Mật khẩu trùng khớp').css('color', 'green').attr("hidden", false);
       return true;
     } else{
       $('#error').html('Mật khẩu không trùng khớp').css('color', 'red').attr("hidden", false);
       $('#success').attr("hidden", true);
      }
      return false;
    }


 </script>
</body>
</html>
