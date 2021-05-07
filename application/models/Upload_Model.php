<?php
class Upload_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    //chuyển file thành bytes
    public function convertFileToByte($pathName, $isBook)
    {
        //ảnh của sách
        if ($isBook == 1) {
            //đường dẫn lưu trữ cục bộ dành cho sách
            $pathName = base_url()."images/book/" . $pathName . ".jpg";
        } else {
            //đường dẫn lưu trữ cục bộ dành cho tài khoản
            $pathName = base_url()."images/user/" . $pathName . ".jpg";
        }
        // if(file_exists($pathName)){
            $file     = fopen($pathName, "rb");
            $contents = fread($file, filesize($pathName));
            fclose($file);
            //trả về mảng bytes 
            return $contents;
        // }
        //chuyển đổi file thành bytes
    }

    //Lưu ảnh vào cục bộ
    public function upload($name, $isBook)
    {
        // $upload_path;
        if ($isBook == 1) {
            $upload_path = base_url().'images/book/';
        } else {
            $upload_path = base_url().'images/user/';
        }
        //đường dẫn
        $config['upload_path']   = $upload_path;
        //tên ảnh
        $config['file_name']     = $name;
        //phần mở rộng
        $config['allowed_types'] = 'jpg';
        //thay thế nếu đã tồn tại 
        $config['overwrite']     = TRUE;
        //kích thước tối đa
        $config['max_size']      = '10000';
        //độ rộng tối đa
        $config['max_width']     = '60000';
        //độ cao tối đa
        $config['max_height']    = '60000';
        //sư dụng thư viện của framework
        $this->load->library("upload", $config);
        //nếu lưu thành công sẽ trả về các thông sô của ảnh(tên, đường dẫn, kích thước,....)
        if ($this->upload->do_upload("image")) {
            return $this->upload->data();
        } else {
            //thấy bại sẽ thông báo lỗi(phần mở rộng không họp lệ, kích thước vượt qua kích thước cho phép)
            return $this->upload->display_errors();
        }
    }
}
?>