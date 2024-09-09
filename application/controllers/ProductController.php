<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	public function checkLogin(){
		if(!$this->session->userdata('LoggedIn')){
			redirect(base_url('/login'));
		}
	}
	public function get_colors($product_id) {
		$this->load->model('ProductModel');
		$colors = $this->ProductModel->getProductColors($product_id);
		echo json_encode($colors);
	}
	public function index()
	{
		$this->checkLogin();
		$this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
		
		$this->load->model('ProductModel');
		$data['allproduct'] = $this->ProductModel->getAllProducts();

		foreach ($data['allproduct'] as $product) {
			// var_dump($product->product_id);
			$product->sizes = $this->ProductModel->getProductSizes($product->product_id);
		}

		$this->load->view('product/list',$data);
		$this->load->view('admin_template/footer');
	}

	public function create()
	{
		$this->checkLogin();
		$this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');
        // gọi Brand
        $this->load->model('BrandModel');
		$data['brand'] = $this->BrandModel->selectBrand();
        //gọi category
        $this->load->model('CategoryModel');
		$data['category'] = $this->CategoryModel->selectCategory();
		$this->load->view('product/create',$data);
		$this->load->view('admin_template/footer');
	}
	
	public function store(){
		$this->form_validation->set_rules('title', 'Title', 'trim|required',['required' => 'Bạn chưa điền %s']);
		$this->form_validation->set_rules('price', 'Price', 'trim|required',['requi	red' => 'Bạn chưa điền %s']);
		$this->form_validation->set_rules('slug', 'Slug', 'trim|required',['required' => 'Bạn chưa điền %s']);
		$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required',['required' => 'Bạn chưa điền %s']);
        $this->form_validation->set_rules('description', 'Description', 'trim|required',['required' => 'Bạn chưa điền %s']);
		
		if ($this->form_validation->run() == TRUE)
        {
			// upload image
			$ori_filename = $_FILES['image']['name'];
			$new_name = time()."".str_replace(' ','-',$ori_filename);
			$config = [
				'upload_path' => './uploads/product',
				'allowed_types' => 'gif|jpg|png|jpeg',
				'file_name' => $new_name,
			];
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('image'))
                {
                        $error = array('error' => $this->upload->display_errors());
						$this->load->view('admin_template/header');
						$this->load->view('admin_template/navbar');
						$this->load->view('product/create',$error);
						$this->load->view('admin_template/footer');
                }
				else{
					$pro_filename = $this->upload->data('file_name');
					$data = [
						'title' => $this->input->post('title'),
						'price' => $this->input->post('price'),
						'description' => $this->input->post('description'),
						'slug' => $this->input->post('slug'),
                        'quantity' => $this->input->post('quantity'),
						'category_id' => $this->input->post('category_id'),
						'brand_id' => $this->input->post('brand_id'),
						'status' => $this->input->post('status'),
						'image' => $pro_filename,
						];
						$this->load->model('ProductModel');
						$product_id = $this->ProductModel->insertProduct($data); // Lưu sản phẩm và lấy ID
						
						$sizes = $this->input->post('sizes');
						if (!empty($sizes)) {
							foreach ($sizes as $size_id) {
								$this->ProductModel->insertProductSize($product_id, $size_id);
							}
						}

						// Lưu màu sắc
						$colors = $this->input->post('colors');
						if (!empty($colors)) {
							foreach ($colors as $color_id) {
								$this->ProductModel->insertProductColor($product_id, $color_id);
							}
						}
					$this->load->model('ProductModel');
					$this->ProductModel->insertProduct($data);
					$this->session->set_flashdata('success','Thêm sản phẩm thành công');
					redirect(base_url('product/list'));
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
		// gọi Brand
        $this->load->model('BrandModel');
		$data['brand'] = $this->BrandModel->selectBrand();
        // gọi category
        $this->load->model('CategoryModel');
		$data['category'] = $this->CategoryModel->selectCategory();
		// gọi product by id
		$this->load->model('ProductModel');
		$data['product'] = $this->ProductModel->selectProductById($id);

		$data['sizes'] = $this->ProductModel->getProductSizes($id);
		$data['colors'] = $this->ProductModel->getProductColors($id);

		
		$this->load->view('product/edit',$data);
		$this->load->view('admin_template/footer');
	}

	public function update($id){
		$this->form_validation->set_rules('title', 'Title', 'trim|required',['required' => 'Bạn chưa điền %s']);
		$this->form_validation->set_rules('price', 'Price', 'trim|required',['required' => 'Bạn chưa điền %s']);
		$this->form_validation->set_rules('slug', 'Slug', 'trim|required',['required' => 'Bạn chưa điền %s']);
		$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required',['required' => 'Bạn chưa điền %s']);
        $this->form_validation->set_rules('description', 'Description', 'trim|required',['required' => 'Bạn chưa điền %s']);
		
		if ($this->form_validation->run() == TRUE)
		{
			if(!empty($_FILES['image']['name'])){
			// upload image
			$ori_filename = $_FILES['image']['name'];
			$new_name = time()."".str_replace(' ','-',$ori_filename);
			$config = [
				'upload_path' => './uploads/product',
				'allowed_types' => 'gif|jpg|png|jpeg',
				'file_name' => $new_name,
			];
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('image'))
				{
						$error = array('error' => $this->upload->display_errors());
						$this->load->view('admin_template/header');
						$this->load->view('admin_template/navbar');
						$this->load->view('product/edit'.$id,$error);
						$this->load->view('admin_template/footer');
				}
				else{
					$pro_filename = $this->upload->data('file_name');
					$data = [
						'title' => $this->input->post('title'),
						'price' => $this->input->post('price'),
						'description' => $this->input->post('description'),
						'slug' => $this->input->post('slug'),
                        'quantity' => $this->input->post('quantity'),
						'category_id' => $this->input->post('category_id'),
						'brand_id' => $this->input->post('brand_id'),
						'status' => $this->input->post('status'),
						'image' => $pro_filename,
						];
					
				}
			}
			else{
				$data = [
						'title' => $this->input->post('title'),
						'price' => $this->input->post('price'),
						'description' => $this->input->post('description'),
						'slug' => $this->input->post('slug'),
                        'quantity' => $this->input->post('quantity'),
						'category_id' => $this->input->post('category_id'),
						'brand_id' => $this->input->post('brand_id'),
						'status' => $this->input->post('status'),
					];
			}

			$this->load->model('ProductModel');
			$this->ProductModel->updateProduct($id,$data);

			// Cập nhật sản phẩm
			$this->load->model('ProductModel');
			$this->ProductModel->updateProduct($id, $data);
	
			// Xóa tất cả kích thước và màu sắc cũ
			$this->db->delete('product_sizes', ['product_id' => $id]);
			$this->db->delete('product_colors', ['product_id' => $id]);
	
			// Lưu kích thước mới
			$sizes = $this->input->post('sizes');
			if (!empty($sizes)) {
				foreach ($sizes as $size_name) {
					$this->ProductModel->insertProductSize($id, $size_name);
				}
			}
	
			// Lưu màu sắc mới
			$colors = $this->input->post('colors');
			if (!empty($colors)) {
				foreach ($colors as $color_name) {
					$this->ProductModel->insertProductColor($id, $color_name);
				}
			}
			
			$this->session->set_flashdata('success','Cập nhật sản phẩm thành công');
			redirect(base_url('product/list'));

			}
			else
			{
				$this->edit($id);	
			}
		
		}
		public function delete($id){
			$this->load->model('ProductModel');
			$this->ProductModel->deleteProduct($id);
			$this->session->set_flashdata('success','Xóa sản phẩm thành công');
			redirect(base_url('product/list'));
		}
		
		public function details($product_id) {
			$this->load->model('ProductModel');
			$data['product_details'] = $this->ProductModel->getProductDetails($product_id);
			$data['sizes'] = $this->ProductModel->getProductSizes($product_id);
			$data['colors'] = $this->ProductModel->getProductColors($product_id);
			
			// Lấy thông tin giỏ hàng
			$cart = $this->cart->contents();
			$data['cart_item'] = null;

			foreach ($cart as $item) {
				if ($item['id'] == $product_id) {
					$data['cart_item'] = $item; // Lưu thông tin sản phẩm trong giỏ hàng
					break;
				}
			}

			$this->load->view('pages/product_details', $data);
		}
		
	
}
