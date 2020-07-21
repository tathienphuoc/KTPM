<?php
class Shipping_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    //truy xuất mảng các đơn hàng
    public function getAll()
    {
        $shippings = $this->db->get("shipping")->result();
        return $shippings;
    }

    //thêm đơn hàng vào CSDL
    public function insert($data)
    {
        if ($this->db->insert("shipping", $data)) {
            return true;
        }
    }

    //xóa đơn hàng khỏi CSDL
    public function delete($id)
    {
        if ($this->db->delete("shipping", "id = " . $id)) {
            return true;
        }
    }

    //Lấy đơn hàng dựa trên id
    public function getById($id)
    {
        $result = $this->db->get_where("shipping", array(
            "id" => $id
        ));
        //row() trả về 1 dòng
        return $result->row();
    }

    //cập nhật đơn hàng
    public function update($data, $id)
    {
        $this->db->set($data);
        $this->db->where("id", $id);
        $this->db->update("shipping", $data);
    }

    //trả về mảng các sản phẩm của đơn hàng chưa giao
    public function getCartsToShipping()
    {
        $shippings= $this->getAll();
        $result=array();
        foreach($shippings as $shipping){
            $cartitem=$this->CartItem_Model->cartShipping($shipping->account_id);
            $result[$shipping->id]=$cartitem;
        }
        return $result;
    }

    //trả về các đơn hàng chưa giao
    public function getShippings()
    {
        $result = $this->db->get_where("shipping", array(
            'status'=>0
        ))->result();
        return $result;
    }

    //Giao hàng
    public function shipping($id){
        $shipping=$this->getById($id);
        $shipping->status=1;
        $this->update($shipping,$shipping->id);
        $cartitem=$this->CartItem_Model->cartShipping($shipping->account_id);
        foreach($cartitem as $item){
            $item->status=2;
            $this->CartItem_Model->update($item,$item->id);
        }
    }
}
?>