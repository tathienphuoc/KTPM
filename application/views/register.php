<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/register.css">
    <title>Đăng ký tài khoản</title>
</head>

<body>
    <a href="<?php echo site_url('Account_Controller/') ?>" class="btn btn-outline-primary back-btn"><em class="fas fa-arrow-left"></em>Trang chủ</a>
    <div class="container-fluid d-flex">
        <form method="POST" action="<?php echo site_url('Account_Controller/saveAccount'); ?>" class="row g-3 needs-validation d-flex flex-column align-items-center m-auto" novalidate enctype="multipart/form-data">
            <h1>Đăng ký tài khoản</h1>
            <div class="col-md-12">
                <label for="validationCustom01" class="form-label">Tên đầy đủ</label>
                <input name="fullname" type="text" class="form-control" id="validationCustom01" required>
                <div class="invalid-feedback">
                    Vui lòng nhập tên đầy đủ.
                </div>
            </div>
            <div class="col-md-12">
                <label for="validationCustomUsername" class="form-label">Tên tài khoản</label>
                <div class="input-group has-validation">
                    <input name="username" type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <span class="input-group-text" id="inputGroupPrepend">@gmail.com</span>
                    <div class="invalid-feedback">
                        Vui lòng nhập tên tài khoản.
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <label for="validationCustom03" class="form-label">Mật khẩu</label>
                <input name="password" type="password" class="form-control" id="validationCustom03" required>
                <div class="invalid-feedback">
                    Vui lòng nhập mật khẩu.
                </div>
            </div>
            <div class="col-md-12">
                <label for="validationCustom03" class="form-label">Nhập lại mật khẩu</label>
                <input name="confirm_password" type="password" class="form-control" id="validationCustom03" required>
                <div class="invalid-feedback">
                    Vui lòng nhập lại mật khẩu.
                </div>
            </div>
            <div class="col-md-12">
                <label for=" exampleFormControlFile1">Chọn ảnh đại diện</label>
                <input name="image" type="file" accept="image/*" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <?php
            if ($this->uri->segment('3')=="tryagain") {
                echo "<div class='col-md-12 text-danger h5'>Tài khoản đã tồn tại.</div>";
            } elseif ($this->uri->segment('3') == "nomatch") {
                echo "<div class='col-md-12 text-danger h5'>Mật khẩu nhập lại không khớp.</div>";
            } elseif ($this->uri->segment('3') == "invalid") {
                echo "<div class='col-md-12 text-danger h5'>Độ dài mật khẩu phải lớn hơn 8 ký tự bao gồm chữ hoa, chữ thường và số.</div>";
            }
            ?>
            <div class="col-md-12">
                <a href="<?php echo site_url('Account_Controller/login') ?>">Đã có tài khoản?</a>
            </div>
            <div class="col-12 d-flex justify-content-center" style='margin-top: -10px;'>
                <button class="btn btn-lg btn-primary" id="submitBtn" type="submit">Đăng ký</button>
            </div>
        </form>
    </div>
    <script src="<?php echo base_url(); ?>assets/js/validation.js"></script>
</body>

</html>