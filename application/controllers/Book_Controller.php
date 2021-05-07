<?php
class Book_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        $this->load->view('index');
    }

    //Xem sản phẩm
    public function books()
    {
        $uri3          = $this->uri->segment('3');
        $current       = ($uri3 && $uri3 > 0) ? $uri3 : 1;
        $totalPage     = $this->Book_Model->getNumberPage(4);
        $data['books'] = $this->Book_Model->getLimit('', ($current - 1) * 4, 4);
        if ($current > $totalPage) {
            $current       = $totalPage;
            $data['books'] = $this->Book_Model->getLimit('', ($current - 1) * 4, 4);
        }
        $begin             = max(1, $current - 2);
        $end               = min($begin + 3, $totalPage);
        $data['begin']     = $begin;
        $data['end']       = $end;
        $data['current']   = $current;
        $data['totalPage'] = $totalPage;
        $this->load->view('books', $data);
    }

    //Sắp xếp theo giá từ cao đến thấp
    public function sortByPrice()
    {
        $uri3          = $this->uri->segment('3');
        $current       = ($uri3 && $uri3 > 0) ? $uri3 : 1;
        $totalPage     = $this->Book_Model->getNumberPage(4);
        $data['books'] = $this->Book_Model->getLimit('price', ($current - 1) * 4, 4);
        if ($current > $totalPage) {
            $current       = $totalPage;
            $data['books'] = $this->Book_Model->getLimit('price', ($current - 1) * 4, 4);
        }
        $begin             = max(1, $current - 2);
        $end               = min($begin + 3, $totalPage);
        $data['begin']     = $begin;
        $data['end']       = $end;
        $data['current']   = $current;
        $data['totalPage'] = $totalPage;
        $this->load->view('booksPrice', $data);
    }

    //Sắp xếp theo giá từ A-Z
    public function sortByName()
    {
        $uri3          = $this->uri->segment('3');
        $current       = ($uri3 && $uri3 > 0) ? $uri3 : 1;
        $totalPage     = $this->Book_Model->getNumberPage(4);
        $data['books'] = $this->Book_Model->getLimit('title', ($current - 1) * 4, 4);
        if ($current > $totalPage) {
            $current       = $totalPage;
            $data['books'] = $this->Book_Model->getLimit('title', ($current - 1) * 4, 4);
        }
        $begin             = max(1, $current - 2);
        $end               = min($begin + 3, $totalPage);
        $data['begin']     = $begin;
        $data['end']       = $end;
        $data['current']   = $current;
        $data['totalPage'] = $totalPage;
        $this->load->view('booksName', $data);
    }

    //Tìm kiếm sách
    public function booksSearch()
    {
        $search = $this->input->post('search');
        if (strcmp($search, '') == 0) {
            $this->books();
        } else {
            $data['books'] = $this->Book_Model->search($search);
            $this->load->view('booksSearch', $data);
        }
    }

    //Xem thông tin chi tiết về sách
    public function viewBook()
    {
        if (!$this->Account_Model->userIsPresent()) {
            redirect('Account_Controller/login', 'refresh');
        } else {
            //Lấy id sách cần xem
            $uri3           = $this->uri->segment('3');
            $book           = $this->Book_Model->getById($uri3);
            $data['author'] = $this->Author_Model->getById($book->author_id);
            $data['book']   = $book;
            //hiện thị kết quả
            $this->load->view('viewBook', $data);
        }
    }
}
?>