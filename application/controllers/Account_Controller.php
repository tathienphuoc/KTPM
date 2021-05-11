<?php
class Account_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->Account_Model->createDefaultAccount();
    }
    function index()
    {
        $this->load->view('index');
    }


    //Khi người dùng truy cập vào trang thông tin cá nhân
    function profile()
    {
        //kiểm tra xem người dùng đã đăng nhập hay chưa thông qua phương thức userIsPresent() 
        if (!$this->Account_Model->userIsPresent()) {
            //chưa đăng nhập sẽ được chuyển hướng đến trang đăng nhập
            redirect('Account_Controller/login', 'refresh');
        } else {//nếu đã đăng nhập
            //lấy thông tin cá nhân, đưa vào data 
            $data['user'] = $this->Account_Model->getAccountIsPresent();
            //hiển thị thông tin cá
            $this->load->view('profile', $data);
        }
    }

    //Đăng ký
    public function register()
    {
        //lấy mảng các tên đăng nhập đã tồn tài
        $usernames         = $this->Account_Model->getAllUsername();
        //đưa mảng vào data
        $data['usernames'] = $usernames;
        //hiển thị trang để đăng ký
        $this->load->view('register', $data);
    }

    //Lưu tài khoản vừa đăng ký vào CSDL
    public function saveAccount()
    {
            //dùng mảng có tên data để lưu thông tin được submit
            $data = array(
                //lấy giá trị của ô input có tên username lưu vào biến user_name
                'user_name' => $this->input->post('username'),
                'full_name' => $this->input->post('fullname'),
                //lấy giá trị của ô input có tên confirm_password lưu vào biến pwd sau khi đã mã hóa 
                'pwd' => password_hash($this->input->post('confirm_password'), PASSWORD_DEFAULT),
                //gán role_id với quyền mặc định là user
                'role_id' => $this->Role_Model->getIDbyRoleName('USER')
            );
        if ($this->Account_Model->getByUsername($data['user_name'])) {
            redirect('/Account_Controller/register/tryagain');
        }
        if (strcmp($this->input->post('confirm_password'), $this->input->post('password'))) {
            redirect('/Account_Controller/register/nomatch');
        }
        if ($this->passwordValid($this->input->post('password'))==1) {
            redirect('/Account_Controller/register/invalid');
        }
            //save biến data vào CSDL
            $this->Account_Model->insert($data);

            $id   = $this->db->insert_id();
        //ảnh đại diện mới
        if (!$_FILES['image']['size'] == 0) {
            //đường dẫn
            $config['upload_path']   = 'images/user/';
            //tên ảnh
            $config['file_name']     = "USER_" . $id;
            //phần mở rộng
            $config['allowed_types'] = 'jpg';
            //thay thế nếu đã tồn tại 
            $config['overwrite']     = TRUE;
            //kích thước tối đa
            $config['max_size']      = '100000';
            //độ rộng tối đa
            $config['max_width']     = '600000';
            //độ cao tối đa
            $config['max_height']    = '600000';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $error = array('error' => $this->upload->display_errors());

                $this->load->view('imageupload_form', $error);
            } else {
                $data = array('image_metadata' => $this->upload->data());

                $this->load->view('imageupload_success', $data);
            }
            //lưu vào file local với tên USER_id với id là id của tài khoản, tham số 0 là đường dẫn vào thư mục lưu trữ hình ảnh dành cho người dùng
            // $this->Upload_Model->upload('USER_' . $user->id, 0);
            //chuyển ảnh thành byte để lưu vào CSDL
        }
            //chuyển hướng đến trang đăng nhập sau khi đăng ký thành công
            redirect('/Account_Controller/login', 'refresh');
    }


    //Đăng nhập
    public function login()
    {
        //hiển thị trang đăng nhập
        $this->load->view('login');
    }


    //Đăng xuất
    public function logout()
    {
        //lưu thông tin đăng nhập trong session
        $this->session->sess_destroy();
        //đăng xuất thành công sẽ hiện thị trang chủ
        $this->load->view('index');
        redirect('/Account_Controller', 'refresh');
    }


    //Kiểm tra đăng nhập
    public function confirmAccount()
    {
        //lưu thông tin đăng nhập vào biến data
        $data    = array(
            'user_name' => $this->input->post('username'),
            'pwd' => $this->input->post('password')
        );
        $isExist = $this->Account_Model->confirmAccount($data);
        //nếu thông tin đăng nhập có tồn tại trong CSDL
        if ($isExist) {
            //lưu thông tin đăng nhập vào session và đặt tên là user
            $this->session->set_userdata('user', $this->Account_Model->getByUsername($data['user_name']));
            $user = $this->Account_Model->getAccountIsPresent();
            //nếu tài khoản vừa đăng nhập có quyền quản trị
            if ($user->role_id == $this->Role_Model->getIDByRoleName('ADMIN')) {
                //chuyển hướng đến trang quản trị
                redirect('/Admin_Controller/booksAdmin');
            } else {
                //chuyển hướng đến trang người dùng
                redirect('/Book_Controller/books');
            }
        } else {
            //thông tin đăng nhập sai sẽ hiển thị lại trang đăng nhập
            redirect('/Account_Controller/login/tryagain');
        }
    }


    //Quên mật khẩu
    public function forgotpwd()
    {
        //lấy các tên đăng nhập đã tồn tại, tránh trường hợp tên đăng nhập chưa tồn tại mà người dùng lại yêu cầu lấy lại mật khẩu
        // $usernames         = $this->Account_Model->getAllUsername();
        //lưu mảng các tên đăng nhập vào data
        // $data['usernames'] = $usernames;
        //hiện thị trang quên mật khẩu
        // $this->load->view('forgotpwd', $data);
        $this->load->view('forgotpwd');
    }


    //Thay đổi mật khẩu
    public function changepwd()
    {
        //sử dụng tên đăng nhập để truy xuất CSDL
        $user      = $this->Account_Model->getByUsername($this->input->post('username'));
        if (!$user) {
            redirect('/Account_Controller/forgotpwd/tryagain');
        }
        if (strcmp($this->input->post('confirm_password'),
            $this->input->post('password')
        )) {
            redirect('/Account_Controller/forgotpwd/nomatch');
        }
        if ($this->passwordValid($this->input->post('password'))) {
            redirect('/Account_Controller/forgotpwd/invalid');
        }
        //mã hóa mật khẩu
        $user->pwd = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        //cập nhật mậu khẩu mới sau khi đã mã hóa
        $this->Account_Model->update($user, $user->id);
        //chuyển hướng đến trang đăng nhập sau khi đổi mật khẩu
        redirect('/Account_Controller/login');
    }
    
    public function passwordValid($password){
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);

        if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
            //Ít nhất 8 ký tự bao gồm cả in hoa, in thường và số
            return true;
        }
        return false;
    }

    //Lưu thay đổi trong trang thông tin cá nhân
    public function saveProfile()
    {
        //kiểm tra đã đăng nhập hay chưa
        if (!$this->Account_Model->userIsPresent()) {
            redirect('Account_Controller/login', 'refresh');
        } else {
            //lấy thông tin tài khoản đăng nhập
            $user            = $this->Account_Model->getAccountIsPresent();
            //mật khẩu mới
            $user->pwd       = password_hash($this->input->post('confirm_password'), PASSWORD_DEFAULT);
            //mật khẩu mới
            $user->full_name = $this->input->post('fullName');
            //ảnh đại diện mới
            if (!$_FILES['image']['size'] == 0) {
                //đường dẫn
                $config['upload_path']   = 'images/user/';
                //tên ảnh
                $config['file_name']     = "USER_". $user->id;
                //phần mở rộng
                $config['allowed_types'] = 'jpg';
                //thay thế nếu đã tồn tại 
                $config['overwrite']     = TRUE;
                //kích thước tối đa
                $config['max_size']      = '10000000';
                //độ rộng tối đa
                $config['max_width']     = '60000000';
                //độ cao tối đa
                $config['max_height']    = '60000000';

                $this->load->library('upload', $config);
                $this->upload->do_upload('image');
                // if (!$this->upload->do_upload('image')) {
                //     $error = array('error' => $this->upload->display_errors());

                //     $this->load->view('imageupload_form', $error);
                // } 
                // else {
                //     $data = array('image_metadata' => $this->upload->data());

                //     $this->load->view('imageupload_success', $data);
                // }
                //lưu vào file local với tên USER_id với id là id của tài khoản, tham số 0 là đường dẫn vào thư mục lưu trữ hình ảnh dành cho người dùng
                // $this->Upload_Model->upload('USER_' . $user->id, 0);
                //chuyển ảnh thành byte để lưu vào CSDL
            }
            // $user->image = $this->Upload_Model->convertFileToByte("USER_" . $user->id, 0);
            //cập nhật thay đổi
            $this->Account_Model->update($user, $user->id);
            redirect('Account_Controller/profile', 'refresh');
        }
        
    }
    
}
