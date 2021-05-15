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
  <title>Chỉnh sửa sản phẩm</title>
</head>

<body>
  <div class="btn btn-outline-primary" style="margin-left:10px;margin-top:10px;border:1px solid blue">
    <a href="javascript:history.back()">Trở về</a>
  </div>
  <form class="container" action="<?php echo base_url() ?>index.php/Admin_Controller/saveEditBook/<?php echo "$book->id" ?>" method="post" enctype="multipart/form-data">
    <h1>
      <strong>Chỉnh thông tin sản phẩm</strong>
    </h1>
    <hr>
    <div class="row">
      <div class="col-md-3">
        <div class="text-center">
          <img src='<?php echo base_url(); ?>images/book/BOOK_<?php echo $book->id; ?>.jpg?t=<?php echo time(); ?>' onerror="this.src='<?php echo base_url(); ?>images/default/defaultUserImage.jpg'" style="width: 200px;height: 200px;" class="avatar img-circle" alt="Ảnh sản phẩm">
          <h6>Cập nhật ảnh sản phẩm</h6>

          <input type="file" accept=".jpg" class="form-control" name="image">
        </div>
      </div>

      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <div class="alert alert-danger" id="error" hidden></div>
        <div class="alert alert-info" id="success" hidden></div>
        <h3>Thông tin sản phẩm</h3>

        <div class="form-horizontal">
          <div class="form-group">
            <label class="col-lg-3 control-label">Tiêu đề sách:</label>
            <div class="col-lg-8">
              <input class="form-control" name='title' type="text" value="<?php echo $book->title ?>" placeholder="Hiện chưa có tên" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Tác giả: </label>
            <div class="col-lg-8" style="margin-top:7px">
              Hiện tại: <span><?php echo $authorCurrent->full_name; ?></span> |
              Chỉnh sửa:
              <select name="authorId">
                <?php
                foreach ($authors as $author) {
                  echo "<option value='" . $author->id . "'>" . $author->full_name . "</option>";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Giá: </label>
            <div class="col-lg-8">
              <input class="form-control" type="number" name='price' value="<?php echo $book->price ?>" required min="1">
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Thể loại: </label>
            <div class="col-lg-8" style="margin-top:7px">
              Hiện tại: <span><?php echo $categoryCurrent->name; ?></span> |
              Chỉnh sửa:
              <select name="categoryId">
                <?php
                foreach ($categories as $category) {
                  echo "<option value='" . $category->id . "'>" . $category->name . "</option>";
                }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Năm phát hành: </label>
            <div class="col-lg-8">
              <input class="form-control" type="number" name='publishYear' value="<?php echo $book->publish_year ?>" min="1000" required>
            </div>
          </div>
          <div class="form-group" style="text=align:center">
            <label>Trích dẫn:</label>
            <textarea class="form-control" name='description' style="resize: none;" rows="4" cols="30"><?php echo $book->description; ?>
                </textarea>
          </div>
        </div>
      </div>
    </div>
    <input type="submit" class="btn btn-primary" id="btnSubmit" value="Lưu">
  </form>
  <hr>
</body>

</html>