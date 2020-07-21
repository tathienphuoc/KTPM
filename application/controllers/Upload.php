<?php
class Upload extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $data['errors'] = '';
        $this->load->view("upload_view", $data);
    }
    
    
    public function doupload()
    {
        if ($this->input->post("ok")) {
            $config['upload_path']   = 'images/';
            $config['file_name']     = "tenfilemoi";
            $config['allowed_types'] = 'gif|jpg|png';
            $config['overwrite']     = TRUE;
            $config['max_size']      = '1000';
            $config['max_width']     = '6000';
            $config['max_height']    = '6000';
            $this->load->library("upload", $config);
            if ($this->upload->do_upload("img")) {
                echo 'Upload Ok';
                $check = $this->upload->data();
                echo "<pre>";
                print_r($check);
                echo "</pre>";
            } else {
                $data['errors'] = $this->upload->display_errors();
                $this->load->view("upload_view", $data);
            }
        }
    }
}