<?php
class Admin_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        $this->load->view('index');
    }

    //trang hiển thị thông tin của sinh viên
    function info()
    {
        $this->load->view('info');
    }

    //trang quản lý bán sách
    public function booksAdmin()
    {
        //kiểm tra đăng nhập
        //chưa đăng nhập
        if (!$this->Account_Model->userIsPresent()) {
            //chuyển hướng đến trang đăng nhập
            redirect('Account_controller/login', 'refresh');
        } else {
            $user = $this->Account_Model->getAccountIsPresent();
            //tài khoản không có quyền quản trị
            if ($user->role_id != 1) {
                //chuyển hướng đến trang từ chối truy cập
                redirect('Admin_controller/accessDenied', 'refresh');
            }
            //tham số thứ 3 của URL sẽ chỉ trang cần truy cập phục vụ mục đích phân trang
            $uri3          = $this->uri->segment('3');
            //mặc định là trang 1
            $current       = ($uri3 && $uri3 > 0) ? $uri3 : 1;
            //tổng số trang với kích thước trang là 4 sản phẩm
            $totalPage     = $this->Book_Model->getNumberPage(4);
            //truy vấn CSDL
            $data['books'] = $this->Book_Model->getLimit('', ($current - 1) * 4, 4);
            //số trang yêu cầu truy cập vượt quá tổng trang hiện có
            if ($current > $totalPage) {
                //điều chỉnh trang yêu cầu truy cập là trang cuối cùng
                $current       = $totalPage;
                //truy vấn CSDL
                $data['books'] = $this->Book_Model->getLimit('', ($current - 1) * 4, 4);
            }
            //nút trang sẽ bắt đầu từ 1 hoặc từ trang yêu cầu - 2
            $begin             = max(1, $current - 2);
            //nút trang kết thúc là trang cuối cùng hoặc từ trang yêu cầu + 3
            $end               = min($begin + 3, $totalPage);
            //đưa tất cả thông tin vào data 
            $data['begin']     = $begin;
            $data['end']       = $end;
            $data['current']   = $current;
            $data['totalPage'] = $totalPage;
            //hiện thị trang quản trị sách
            $this->load->view('booksAdmin', $data);
        }
    }


    //Tìm kiếm
    public function booksSearchAdmin()
    {
        $search = $this->input->post('search');
        //nếu để trống
        if (strcmp($search, '') == 0) {
            //chuyển đến trang admin
            $this->booksAdmin();
        } else {
            //nếu có yêu cầu tìm kiếm
            //truy xuất CSDL
            $data['books'] = $this->Book_Model->search($search);
            //hiện thị kết quả
            $this->load->view('booksSearchAdmin', $data);
        }
    }


    //Từ chối truy cập
    public function accessDenied()
    {
        //những tài khoản không có quyền quản trị sẽ bị chuyển hướng đến trang từ chối truy cập
        $this->load->view('accessDenied');
    }


    //Thêm sách
    public function addBook()
    {
        //yêu cầu đăng nhập
        if (!$this->Account_Model->userIsPresent()) {
            redirect('Account_controller/login', 'refresh');
        } else {
            $user = $this->Account_Model->getAccountIsPresent();
            //không có quyền quản trị
            if ($user->role_id != 1) {
                //từ chối truy cập
                redirect('Admin_controller/accessDenied', 'refresh');
            }
            //lưu những thông tin cần thiết vào data
            $data['categories'] = $this->Category_Model->getAll();
            $data['authors']    = $this->Author_Model->getAll();
            //hiển thị trang thêm sản phẩm
            $this->load->view('addBook', $data);
        }
    }

    //Lưu sau khi thêm thành công
    public function saveAddBook()
    {
        if (!$this->Account_Model->userIsPresent()) {
            redirect('Account_controller/login', 'refresh');
        } else {
            $user = $this->Account_Model->getAccountIsPresent();
            if ($user->role_id != 1) {
                redirect('Admin_controller/accessDenied', 'refresh');
            }
            //lấy những thông tin về sách được yêu cầu thêm mới
            $data = array(
                'title' => $this->input->post('title'),
                'author_id' => $this->input->post('authorId'),
                'price' => $this->input->post('price'),
                'category_id' => $this->input->post('categoryId'),
                'publish_year' => $this->input->post('publishYear'),
                'description' => $this->input->post('description')
            );
            //lưu vào CSDL
            $this->Book_Model->insert($data);
            //nếu có hình ảnh
            if (!$_FILES['image']['size'] == 0) {
                $id   = $this->db->insert_id();
                $book = $this->Book_Model->getById($id);
                //lưu vào local folder
                $this->Upload_Model->upload('BOOK_' . $book->id, 1);
                //chuyển đổi ảnh thành bytes 
                $book->image = $this->Upload_Model->convertFileToByte("BOOK_" . $book->id, 1);
                //cập nhập vào CSDL
                $this->Book_Model->update($book, $id);
            }
            //quay lại trang quản trị
            redirect('Admin_controller/booksAdmin', 'refresh');
        }
    }


    //Chỉnh sửa
    public function editBook()
    {
        //yêu cầu đăng nhập
        if (!$this->Account_Model->userIsPresent()) {
            redirect('Account_controller/login', 'refresh');
        } else {
            $user = $this->Account_Model->getAccountIsPresent();
            if ($user->role_id != 1) {
                redirect('Admin_controller/accessDenied', 'refresh');
            }
            //id của sách cần chỉnh sửa
            $uri3                    = $this->uri->segment('3');
            $book                    = $this->Book_Model->getById($uri3);
            //thông tin của sách
            $data['book']            = $book;
            $data['categories']      = $this->Category_Model->getAll();
            $data['authors']         = $this->Author_Model->getAll();
            $data['authorCurrent']   = $this->Author_Model->getById($book->author_id);
            $data['categoryCurrent'] = $this->Category_Model->getById($book->category_id);
            $this->load->view('editBook', $data);
        }
    }


    //Lưu sau khi chỉnh sửa
    public function saveEditBook()
    {
        if (!$this->Account_Model->userIsPresent()) {
            redirect('Account_controller/login', 'refresh');
        } else {
            $user = $this->Account_Model->getAccountIsPresent();
            if ($user->role_id != 1) {
                redirect('Admin_controller/accessDenied', 'refresh');
            }
            //id của sách 
            $uri3               = $this->uri->segment('3');
            //các thông ting đã được chỉnh sửa
            $book               = $this->Book_Model->getById($uri3);
            $book->title        = $this->input->post('title');
            $book->author_id    = $this->input->post('authorId');
            $book->price        = $this->input->post('price');
            $book->category_id  = $this->input->post('categoryId');
            $book->publish_year = $this->input->post('publishYear');
            $book->description  = $this->input->post('description');
            //bao gồm cả ảnh nếu có
            if (!$_FILES['image']['size'] == 0) {
                $this->Upload_Model->upload('BOOK_' . $book->id, 1);
                $book->image = $this->Upload_Model->convertFileToByte("BOOK_" . $book->id, 1);
            }
            //cập nhật vào CSDL
            $this->Book_Model->update($book, $uri3);
            redirect('Admin_controller/booksAdmin', 'refresh');
        }
    }

    //xóa sách
    public function deleteBook()
    {
        if (!$this->Account_Model->userIsPresent()) {
            redirect('Account_controller/login', 'refresh');
        } else {
            $user = $this->Account_Model->getAccountIsPresent();
            if ($user->role_id != 1) {
                redirect('Admin_controller/accessDenied', 'refresh');
            }
            //id của sách cần xóa
            $uri3 = $this->uri->segment('3');
            //thực hiện xóa
            $this->Book_Model->delete($uri3);
            redirect('Admin_controller/booksAdmin', 'refresh');
        }
    }

    //Hiện thị trang giao hàng
    public function shipping()
    {
        if (!$this->Account_Model->userIsPresent()) {
            redirect('Account_controller/login', 'refresh');
        } else {
            $user = $this->Account_Model->getAccountIsPresent();
            if ($user->role_id != 1) {
                redirect('Admin_controller/accessDenied', 'refresh');
            }
            //các thông tin về đơn hàng
            $data['shippings']=$this->Shipping_Model->getShippings();
            $data['cartitem']=$this->Shipping_Model->getCartsToShipping();
            $data['book']=$this->Book_Model->getAllBookTitleIndexArray();
            $data['username']=$this->Account_Model->getAllUsernameIndexArray();
            $this->load->view('shipping',$data);
        }
    }


    //giao hàng
    public function saveShipping()
    {
        if (!$this->Account_Model->userIsPresent()) {
            redirect('Account_controller/login', 'refresh');
        } else {
            $user = $this->Account_Model->getAccountIsPresent();
            if ($user->role_id != 1) {
                redirect('Admin_controller/accessDenied', 'refresh');
            }
        //lấy id của đơn hàng cần giao
        $uri3 = $this->uri->segment('3');
        //thực hiện giao hàng
        $this->Shipping_Model->shipping($uri3);
        redirect('Admin_controller/shipping', 'refresh');
        }
    }


    //thống kê số sách bán được nhiều nhất
    public function statistic()
    {
        if (!$this->Account_Model->userIsPresent()) {
            redirect('Account_controller/login', 'refresh');
        } else {
            $user = $this->Account_Model->getAccountIsPresent();
            if ($user->role_id != 1) {
                redirect('Admin_controller/accessDenied', 'refresh');
            }
            //lấy các thông tin phục vụ việc thống kế
            $data['popular']=$this->Book_Model->statistic();
            $data['category']=$this->Category_Model->getAllCategoryIndexArray();
            $data['book']=$this->Book_Model->getAllBookIndexArray();

            
            $data['purchased']=$this->Account_Model->statistic();
            $data['user']=$this->Account_Model->getAllAccountIndexArray();
            //hiển thị trang thống kê
            $this->load->view('statistic',$data);
        }
    }
    
}
?>