<?php
class CartItem_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function getAll()
    {
        $book = $this->db->get("cartitem")->result();
        return $book;
    }
    public function insert($data)
    {
        if ($this->db->insert("cartitem", $data)) {
            return true;
        }
    }

    //Lưu các sản phẩm đã mua
    public function save($data)
    {
        $cartitem=$this->getAll();
        foreach($cartitem as $item){
            //cập nhật số lượng nếu đã tồn tại 
            if($item->account_id==$data['account_id'] && $item->book_id==$data['book_id'] && $item->status==0){
                $item->quantity+=$data['quantity'];
                $item->order_date=$data['order_date'];
                $this->update($item,$item->id);
                return;
            }
        }
        //tạo mới nếu chưa tồn tại
        $this->insert($data);
    }

    //xóa dựa trên id
    public function delete($id)
    {
        if ($this->db->delete("cartitem", "id = " . $id)) {
            return true;
        }
    }

    //Truy xuất dựa trên id
    public function getById($id)
    {
        $result = $this->db->get_where("cartitem", array(
            "id" => $id
        ));
        return $result->row();
    }

    //Truy xuất dựa trên id
    public function getByBookId($id)
    {
        $result = $this->db->get_where("cartitem", array(
            "book_id" => $id
        ));
        return $result->row();
    }

    //Cập nhật
    public function update($data, $id)
    {
        $this->db->set($data);
        $this->db->where("id", $id);
        $this->db->update("cartitem", $data);
    }

    //trả về mảng các sản phẩm chưa thanh toán của tài khoản đang đăng nhập
    public function getCartItemToCheckOut()
    {
        $user      = $this->Account_Model->getAccountIsPresent();
        $condition = array(
            'C.status' => '0',
            'C.account_id' => $user->id
        );
        $this->db->select('*,
        C.id as c_id');
        $this->db->from('cartitem as C');
        $this->db->join('book as B', 'C.book_id = B.id', 'left');
        $this->db->join('category as G', 'B.category_id = G.id', 'left');
        $this->db->where($condition);
        return $this->db->get()->result();
    }

    //tính giá sản phẩm đã mua
    public function getSubTotalPrice()
    {
        $cartitem = $this->getCartItemToCheckOut();
        $sum      = 0;
        foreach ($cartitem as $item) {
            $sum += $item->price * $item->quantity;
        }
        return $sum;
    }

    //tính tổng giá cần thanh toán bao gồm chi phí vận chuyển
    public function getTotalPrice()
    {
        $totalPrice    = $this->getSubTotalPrice();
        $shippingPrice = $this->getShippingPrice();
        $sum           = $totalPrice + $shippingPrice;
        return $sum;
    }

    //chi phí vận chuyển bằng 5% chi phí đơn hàng
    public function getShippingPrice()
    {
        $totalPrice = $this->getSubTotalPrice();
        return $totalPrice * 0.05;
    }

    //thanh toán
    public function checkoutCartItem()
    {
        $cartitem = $this->db->get_where("cartitem", array(
            "status" => '0'
        ))->result();
        foreach ($cartitem as $item) {
            $item->status = 1;
            $this->update($item, $item->id);
        }
    }

    //trả về mảng các sản phẩm chưa thanh toán của tài khoản đang đăng nhập
    //sau khi join với bảng sách và thể loại, phục vụ cho mục đích hiển thị sản phẩm cần thanh toán
    public function getCartItemPurchased()
    {
        $user      = $this->Account_Model->getAccountIsPresent();
        $condition = array(
            'C.status >' => '0',
            'C.account_id' => $user->id
        );
        $this->db->select('*');
        $this->db->from('cartitem as C');
        $this->db->join('book as B', 'C.book_id = B.id', 'left');
        $this->db->join('category as G', 'B.category_id = G.id', 'left');
        $this->db->where($condition);
        return $this->db->get()->result();
    }

    //trả về mảng các sản phẩm chưa thanh toán
    public function getAllPurchasedItem()
    {
        $condition = array(
            'C.status >' => '0'
        );
        $this->db->select('*');
        $this->db->from('cartitem as C');
        $this->db->join('book as B', 'C.book_id = B.id', 'left');
        $this->db->join('category as G', 'B.category_id = G.id', 'left');
        $this->db->where($condition);
        return $this->db->get()->result();
    }

    //trả về mảng các sản phẩm đã thanh toán nhưng chưa giao hàng
    public function shipping($idUser)
    {
        $condition = array(
            'C.status =' => '1',
            'C.account_id' => $idUser
        );
        $this->db->select('*');
        $this->db->from('cartitem as C');
        $this->db->join('book as B', 'C.book_id = B.id', 'left');
        $this->db->join('category as G', 'B.category_id = G.id', 'left');
        $this->db->where($condition);
        return $this->db->get()->result();
    }

    //trả về mảng các sản phẩm đã thanh toán 
    public function cartShipping($idUser)
    {
        $result = $this->db->get_where("cartitem", array(
            "status" => '1',
            "account_id"=>$idUser
        ))->result();
        return $result;
    }
}
?>