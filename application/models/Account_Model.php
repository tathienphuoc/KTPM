<?php
class Account_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    //truy xuất tất cả tài khoản trong CSDL
    public function getAll()
    {
        $account = $this->db->get("account")->result();
        return $account;
    }


    //truy xuất tất cả tên tài khoản trong CSDL
    public function getAllUsername()
    {
        $result = $this->db->get("account")->result();
        $names  = array();
        foreach ($result as $name) {
            array_push($names, $name->user_name);
        }
        return $names;
    }

    //truy xuất tài khoản dựa trên tên đăng nhập
    public function getByUsername($username)
    {
        $result = $this->db->get_where("account", array(
            "user_name" => $username
        ));
        return $result->row();
    }

    //truy xuất tài khoản dựa trên id
    public function getById($id)
    {
        $result = $this->db->get_where("account", array(
            "id" => $id
        ));
        return $result->row();
    }

    //lưu tài khoản vào CSDL
    public function insert($data)
    {
        if ($this->db->insert("account", $data)) {
            return true;
        }
    }

    //kiểm tra tài khoản đã có trong CSDL hay chưa
    public function confirmAccount($data)
    {
        $account = $this->getByUsername($data['user_name']);
        if (count(array(
            $account
        )) == 0) {
            return false;
        }
        if (password_verify($data['pwd'], $account->pwd)) {
            return true;
        }
        return false;
    }

    //tên đăng nhập đã tồn tại
    public function isExist($username)
    {
        $isExist = $this->db->get_where("account", array(
            "user_name" => $username
        ))->num_rows();
        if ($isExist) {
            return true;
        }
        return false;
    }

    //Tạo 2 tài khoản mặc định nếu chưa tồn tại
    public function createDefaultAccount()
    {
        //tạo 2 quyền mặc định để gán cho tài khoản
        $this->Role_Model->createDefaultRole();
        //tài khoản dành cho người quản trị
        $admin      = array(
            'full_name' => 'ADMIN',
            'user_name' => 'admin',
            'pwd' => password_hash('admin', PASSWORD_DEFAULT),
            'role_id' => $this->Role_Model->getIDbyRoleName('ADMIN')
        );
        //tài khoản dành cho người dùng
        $user       = array(
            'full_name' => 'USER',
            'user_name' => 'user',
            'pwd' => password_hash('user', PASSWORD_DEFAULT),
            'role_id' => $this->Role_Model->getIDbyRoleName('USER')
        );
        $adminExist = count(array(
            $this->getByUsername('admin')
        ));

        $userExist  = count(array(
            $this->getByUsername('user')
        ));

        if (!$this->isExist('admin')) {
            $this->insert($admin);
        }
        
        if (!$this->isExist('user')) {
            $this->insert($user);
        }
    }

    //xóa tài khoản
    public function delete($id)
    {
        if ($this->db->delete("account", "id = " . $id)) {
            return true;
        }
    }

    //cập nhật tài khoản
    public function update($data, $id)
    {
        $this->db->set($data);
        $this->db->where("id", $id);
        $this->db->update("account", $data);
    }

    //kiểm tra có tài khoản nào đang đăng nhập hay không?
    public function userIsPresent()
    {
        //kiểm tra trong session có lưu thông tin hay không?
        $user_data = $this->session->userdata('user');
        if (!$user_data) {
            return false;
        }
        return true;
    }

    //lấy thông tin tài khoản đang đăng nhập
    public function getAccountIsPresent()
    {
        //lấy thông tin tài khoản đang đăng nhập thông qua session
        return $this->session->userdata('user');
    }

    //lấy các sản phẩm tài khoản đang đăng nhập đã mua
    public function getUserPurchsed()
    {
        $cartitem = $this->CartItem_Model->getAll();
        $result=array();
        foreach($cartitem as $item){
            if(!array_key_exists($item->book_id,$result)){
                $result[$item->book_id]=$this->getById($item->book_id);
            }
        }
        return $result;
    }

    //mảng các tài khoản truy có thể truy xuất có id là index của mảng
    public function getAllAccountIndexArray()
    {
        $accounts = $this->getAll();
        $result=array();
        foreach($accounts as $account){
            $result[$account->id]=$account;
        }
        return $result;
    }

    //mảng các tên tài khoản truy có thể truy xuất có id là index của mảng
    public function getAllUsernameIndexArray()
    {
        $accounts = $this->getAll();
        $result=array();
        foreach($accounts as $account){
            $result[$account->id]=$account->user_name;
        }
        return $result;
    }


    //thông kê khách hàng đã mua nhiều sản phẩm nhất
    public function statistic(){
        $condition = array(
            'status >' => '0'
        );
        $this->db->select('account_id, sum(quantity) as total');
        $this->db->where($condition);
        $this->db->group_by('account_id','book_id'); 
        $this->db->order_by('total', 'desc'); 
        return $this->db->get('cartitem')->result();
    }
}
?>