<?php
class Author_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    //trả về mảng các tác giả
    public function getAll()
    {
        $author = $this->db->get("author")->result();
        return $author;
    }

    //trả về mảng tên các tác giả
    public function getByName($Name)
    {
        $result = $this->db->get_where("author", array(
            "full_name" => "%" . $Name . "%"
        ));
        return $result;
    }

    //truy xuất tác giả thông qua id
    public function getById($id)
    {
        $result = $this->db->get_where("author", array(
            "id" => $id
        ));
        return $result->row();
    }

    //thêm tác giả vào CSDL
    public function insert($data)
    {
        if ($this->db->insert("author", $data)) {
            return true;
        }
    }

    //xóa tác giả
    public function delete($id)
    {
        if ($this->db->delete("author", "id = " . $id)) {
            return true;
        }
    }
}
?>