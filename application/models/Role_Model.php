<?php
class Role_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    //Truy xuất mảng các quyền được lưu trong CSDL
    public function getAll()
    {
        $role = $this->db->get("role")->result();
        return $role;
    }

    //trả về id của quyền dựa trên tên
    public function getIDByRoleName($roleName)
    {
        $result = $this->db->get_where("role", array(
            "name" => $roleName
        ));
        return $result->row()->id;
    }

    //lưu vào CSDL
    public function insert($data)
    {
        if ($this->db->insert("role", $data)) {
            return true;
        }
    }

    //truy xuất quyền dựa trên tên quyền
    public function getByRoleName($roleName)
    {
        $result = $this->db->get_where("role", array(
            "name" => $roleName
        ));
        return $result->row();
    }

    //kiểm tra đã tồn tại hay chưa
    public function isExist($roleName)
    {
        $isExist = $this->db->get_where("role", array(
            "name" => $roleName
        ))->num_rows();
        if ($isExist) {
            return true;
        }
        return false;
    }

    //tạo 2 quyền mặc định nếu chưa tồn tại
    public function createDefaultRole()
    {
        //quyền có tên ADMIN
        $admin = array(
            'name' => 'ADMIN'
        );
        //quyền có tên USER
        $user  = array(
            'name' => 'USER'
        );
        if (!$this->isExist('ADMIN')) {
            $this->insert($admin);
        }
        if (!$this->isExist('USER')) {
            $this->insert($user);
        }
    }
}
?>