<?php
class Category_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    //Trả về mảng các thể lại có trong CSDL
    public function getAll()
    {
        $result = $this->db->get("category")->result();
        return $result;
    }

    //Truy xuất thể loại dựa trên id
    public function getById($id)
    {
        $result = $this->db->get_where("category", array(
            "id" => $id
        ));
        return $result->row();
    }

    //Trả về mảng các thể loại với id là chỉ mục của mảng
    public function getAllCategoryIndexArray()
    {
        $categories = $this->getAll();
        $result=array();
        foreach($categories as $category){
            $result[$category->id]=$category;
        }
        return $result;
    }
}
?>