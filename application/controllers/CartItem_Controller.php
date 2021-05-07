<?php
class CartItem_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        $this->load->view('index');
    }

    //Giỏ hàng
    function shoppingCart()
    {
        if (!$this->Account_Model->userIsPresent()) {
            redirect('Account_Controller/login', 'refresh');
        } else {
            //Các sản phẩm đã mua
            $data['items']         = $this->CartItem_Model->getCartItemToCheckOut();
            //Tổng giá các sản phẩm đã mua
            $data['subTotal']      = $this->CartItem_Model->getSubTotalPrice();
            //Phí vận chuyển
            $data['shippingPrice'] = $this->CartItem_Model->getShippingPrice();
            //Tổng giá tiền cần thanh toán
            $data['totalPrice']    = $this->CartItem_Model->getTotalPrice();
            $this->load->view('shoppingCart', $data);
        }
    }

    //Thanh toán
    function checkout()
    {
        if (!$this->Account_Model->userIsPresent()) {
            redirect('Account_Controller/login', 'refresh');
        } else {
            $user     = $this->Account_Model->getAccountIsPresent();
            //Các thông tin về tài khoản thẻ và địa chỉ 
            $shipping = array(
                'card_owner' => $this->input->post('cardOwner'),
                'card_number' => $this->input->post('cardNumber'),
                'address' => $this->input->post('address'),
                'city' => $this->input->post('city'),
                'number_phone' => $this->input->post('numberPhone'),
                'account_id' => $user->id
            );
            //lưu trữ hóa đơn
            $this->Shipping_Model->insert($shipping);
            //thanh toán
            $this->CartItem_Model->checkoutCartItem();
            $this->load->view('thanks');
        }
    }

    //Mua sản phẩm
    function addToCart()
    {
        if (!$this->Account_Model->userIsPresent()) {
            redirect('Account_Controller/login', 'refresh');
        } else {
            //Tài khoản mua hàng
            $user     = $this->Account_Model->getAccountIsPresent();
            //id sản phẩm cần mua
            $uri3           = $this->uri->segment('3');
            $item = array(
                //Số lượng mua
                'quantity' => $this->input->post('quantity'),
                'book_id' => $uri3,
                'account_id' => $user->id,
                //Ngày đặt hàng tính từ lúc thêm vào giỏ hàng, trường hợp mua cùng 1 sản phẩm sẽ được gộp số lượng( gộp hóa đơn cần thanh toán)
                'order_date' => date("Y-m-d")
            );
            $this->CartItem_Model->save($item);
            redirect('Book_Controller/books', 'refresh');
        }
    }

    //xóa sản phẩm khỏi giỏ hàng
    function deleteCartItem()
    {
        if (!$this->Account_Model->userIsPresent()) {
            redirect('Account_Controller/login', 'refresh');
        } else {
            //id của sản phẩm cần xóa
            $uri3           = $this->uri->segment('3');
            //thực hiện xóa
            $this->CartItem_Model->delete($uri3);
            redirect('CartItem_Controller/shoppingCart', 'refresh');
        }
    }

    //Thông tin giao dịch
    function transaction()
    {
        if (!$this->Account_Model->userIsPresent()) {
            redirect('Account_Controller/login', 'refresh');
        } else {
            //Các sản phẩm đã thanh toán, đồng thời hiện thị tình trang sản phẩm đã giao hàng hay chưa
            $data['items']         = $this->CartItem_Model->getCartItemPurchased();
            $this->load->view('transaction', $data);
        }
    }
}
?>