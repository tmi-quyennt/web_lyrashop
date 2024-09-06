<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	// public function __construct()
	// {
	// 	parent::__construct();
		
	// }


	public function __construct()
    {
        parent::__construct();
        // Load mô hình LoginModel trong hàm khởi tạo
        $this->load->model('LoginModel');
    }

    public function index()
    {
        $this->load->view('template/header');
        $this->load->view('login/index');
        $this->load->view('template/footer');
    }

    public function login()
    {
        // Đặt quy tắc xác thực cho email và password
        $this->form_validation->set_rules('email', 'Email', 'trim|required', ['required' => 'Bạn chưa điền %s']);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', ['required' => 'Bạn chưa điền %s']);

        if ($this->form_validation->run() == TRUE)
        {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            
            // Gọi mô hình để kiểm tra đăng nhập
            $result = $this->LoginModel->checkLogin($email, $password);

            if (count($result) > 0)
            {
                // Tạo mảng session với thông tin người dùng
                $session_array = array(
                    'id' => $result[0]->id,
                    'username' => $result[0]->username,
                    'email' => $result[0]->email,
                    'role' => $result[0]->role // Thêm role vào session
                );
                $this->session->set_userdata('LoggedIn', $session_array);

                $this->session->set_flashdata('success', 'Đăng nhập thành công');
                redirect(base_url('/order/statistics'));
            }
            else
            {
                $this->session->set_flashdata('error', 'Đăng nhập thất bại');
                redirect(base_url('login'));
            }
        }
        else
        {
            $this->index();
        }
    }


}
