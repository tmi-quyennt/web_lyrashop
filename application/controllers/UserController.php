<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	public function checkLogin(){
		if(!$this->session->userdata('LoggedIn')){
			redirect(base_url('/login'));
		}
	}

	public function index()
	{
		$this->checkLogin();
		$this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
		
		$this->load->model('UserModel');
		$data['user'] = $this->UserModel->selectUser();

		$this->load->view('user/list',$data);
		$this->load->view('admin_template/footer');
	}

	public function create()
	{
		$this->checkLogin();
		$this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
		$this->load->view('user/create');
		$this->load->view('admin_template/footer');
	}
	
	public function store(){
		$this->form_validation->set_rules('username', 'UserName', 'trim|required',['required' => 'Bạn chưa điền %s']);
		$this->form_validation->set_rules('email', 'Email', 'trim|required',['required' => 'Bạn chưa điền %s']);
		$this->form_validation->set_rules('password', 'PassWord', 'trim|required',['required' => 'Bạn chưa điền %s']);
		
		if ($this->form_validation->run() == TRUE)
        {
			// upload image
			$ori_filename = $_FILES['image']['name'];
			$new_name = time()."".str_replace(' ','-',$ori_filename);
			$config = [
				'upload_path' => './uploads/user',
				'allowed_types' => 'gif|jpg|png|jpeg',
				'file_name' => $new_name,
			];
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('image'))
                {
                        $error = array('error' => $this->upload->display_errors());
						$this->load->view('admin_template/header');
						$this->load->view('admin_template/navbar');
						$this->load->view('user/create',$error);
						$this->load->view('admin_template/footer');
                }
				else{
					$user_filename = $this->upload->data('file_name');
					$data = [
						'username' => $this->input->post('username'),
						'email' => $this->input->post('email'),
						'password' => $this->input->post('password'),
						'status' => $this->input->post('status'),
						'image' => $user_filename,
						];
					$this->load->model('UserModel');
					$this->UserModel->insertUser($data);
					$this->session->set_flashdata('success','Thêm nhân viên thành công');
					redirect(base_url('user/list'));
				}

			

		}
		else
		{
			$this->create();	
		}
	}

	public function edit($id){
		$this->checkLogin();
		$this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');

		$this->load->model('UserModel');
		$data['user'] = $this->UserModel->selectUserById($id);

		$this->load->view('user/edit',$data);
		$this->load->view('admin_template/footer');
	}

	public function update($id){
		$this->form_validation->set_rules('username', 'UserName', 'trim|required',['required' => 'Bạn chưa điền %s']);
		$this->form_validation->set_rules('email', 'Email', 'trim|required',['required' => 'Bạn chưa điền %s']);
		$this->form_validation->set_rules('password', 'PassWord', 'trim|required',['required' => 'Bạn chưa điền %s']);
		
		
		if ($this->form_validation->run() == TRUE)
		{
			if(!empty($_FILES['image']['name'])){
			// upload image
			$ori_filename = $_FILES['image']['name'];
			$new_name = time()."".str_replace(' ','-',$ori_filename);
			$config = [
				'upload_path' => './uploads/user',
				'allowed_types' => 'gif|jpg|png|jpeg',
				'file_name' => $new_name,
			];
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('image'))
				{
						$error = array('error' => $this->upload->display_errors());
						$this->load->view('admin_template/header');
						$this->load->view('admin_template/navbar');
						$this->load->view('user/edit'.$id,$error);
						$this->load->view('admin_template/footer');
				}
				else{
					$user_filename = $this->upload->data('file_name');
					$data = [
						'username' => $this->input->post('username'),
						'email' => $this->input->post('email'),
						'password' => $this->input->post('password'),
						'status' => $this->input->post('status'),
						'image' => $user_filename,
						];
					
				}
			}
			else{
				$data = [
					'username' => $this->input->post('username'),
					'email' => $this->input->post('email'),
					'password' => $this->input->post('password'),
					'status' => $this->input->post('status'),
					];
			}

			$this->load->model('UserModel');
			$this->UserModel->updateUser($id,$data);
			$this->session->set_flashdata('success','Cập nhật nhân viên thành công');
			redirect(base_url('user/list'));

			}
			else
			{
				$this->edit($id);	
			}
		
		}
		public function delete($id){
			$this->load->model('UserModel');
			$this->UserModel->deleteUser($id);
			$this->session->set_flashdata('success','Xóa nhân viên thành công');
			redirect(base_url('user/list'));
		}
	
}
