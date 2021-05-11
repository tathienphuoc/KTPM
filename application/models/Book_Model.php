<?php
class Book_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function getAll()
    {
        $book = $this->db->get("book")->result();
        return $book;
    }

    //số lượng bảng ghi có trong bảng book
    public function getNumberRecord()
    {
        $query = $this->db->query('SELECT * FROM book');
        return $query->num_rows();
    }

    //sô lượng trang có thể chia 
    public function getNumberPage($limit)
    {
        $numberRecord = $this->getNumberRecord();
        return ceil($numberRecord / $limit);
    }

    //truy xuất sản phẩm được sắp xếp sau khi phân trang
    public function getLimit($sort, $offset, $limit)
    {
        if ($sort != null) {
            $this->db->order_by($sort, 'desc');
        } else {
            $this->db->order_by('id', 'desc');
        }
        $book = $this->db->get("book", $limit, $offset)->result();
        return $book;
    }

    //lấy sản phẩm dựa trên id
    public function getById($id)
    {
        $result = $this->db->get_where("book", array(
            "id" => $id
        ));
        return $result->row();
    }

    //thêm sản phẩm
    public function insert($data)
    {
        if ($this->db->insert("book", $data)) {
            return true;
        }
    }

    //cập nhật sản phẩm
    public function update($data, $id)
    {
        $this->db->set($data);
        $this->db->where("id", $id);
        $this->db->update("book", $data);
    }

    //xóa sản phẩm dựa trên id
    public function delete($id)
    {
        if ($this->db->delete("book", "id = " . $id)) {
            return true;
        }
    }

    //tìm kiếm sản phẩm theo từ khóa
    function search($keyword)
    {
        $this->db->like('title', $keyword);
        $query = $this->db->get('book');
        return $query->result();
    }

    //sắp xếp theo tiêu chí được yêu cầu
    function sortBy($attr)
    {
        $this->db->order_by($attr, "desc");
        $query = $this->db->get("book");
        return $query->result();
    }

    //trả về mảng tên các sản phẩm với chỉ mục là id của sản phẩm
    public function getAllBookTitleIndexArray()
    {
        $books = $this->getAll();
        $result=array();
        foreach($books as $book){
            $result[$book->id]=$book->title;
        }
        return $result;
    }

    //trả về mảng các sản phẩm với chỉ mục là id của sản phẩm
    public function getAllBookIndexArray()
    {
        $books = $this->getAll();
        $result=array();
        foreach($books as $book){
            $result[$book->id]=$book;
        }
        return $result;
    }


    //trả về mảng số lượng các sách đã được mua với chỉ mục là id của sản phẩm
    public function getBookQuantityPurchsedIndexArray()
    {
        $cartitem = $this->CartItem_Model->getAll();
        $result=array();
        foreach($cartitem as $item){
            if($item->status!=0){
                if(array_key_exists($item->book_id,$result)){
                    $result[$item->book_id]+=$item->quantity;
                }else {
                    $result[$item->book_id]=$item->quantity;
                }
            }
        }
        sort($result);
        return $result;
    }

    //trả về mảng các sách đã được mua, phục vụ mục đích thống kê
    public function getBookPurchsed()
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

    //thống kê số lượng sách bán chạy nhất
    public function statistic(){
        $condition = array(
            'status >' => '0'
        );
        $this->db->select('book_id, sum(quantity) as total');
        $this->db->where($condition);
        $this->db->group_by('book_id'); 
        $this->db->order_by('total', 'desc'); 
        return $this->db->get('cartitem')->result();
    }

    
}
?>