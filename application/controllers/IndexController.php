<?php
defined('BASEPATH') or exit('No direct script access allowed');

class IndexController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('IndexModel');
		$this->load->library('cart');
		$this->data['category'] = $this->IndexModel->getCategoryHome();
		$this->data['brand'] = $this->IndexModel->getBrandHome();
		$this->load->model('ProductModel');
		$this->load->model('OrderModel');
	}

	public function index()
	{
		$this->data['allproduct'] = $this->IndexModel->getAllProduct();

		$this->load->view('pages/template/header', $this->data);
		$this->load->view('pages/template/slider');
		$this->load->view('pages/home', $this->data);
		$this->load->view('pages/template/footer');
	}

	public function category($id)
	{
		$this->data['category_product'] = $this->IndexModel->getCategoryProduct($id);
		$this->data['title'] = $this->IndexModel->getCategoryTitle($id);
		$this->config->config["pageTitle"] = $this->data['title'];


		$this->load->view('pages/template/header', $this->data);
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/category', $this->data);
		$this->load->view('pages/template/footer');
	}

	public function brand($id)
	{
		$this->data['brand_product'] = $this->IndexModel->getBrandProduct($id);
		$this->data['title'] = $this->IndexModel->getBrandTitle($id);
		$this->config->config["pageTitle"] = $this->data['title'];

		$this->load->view('pages/template/header', $this->data);
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/brand');
		$this->load->view('pages/template/footer');
	}

	public function product($id)
	{
		$this->data['product_details'] = $this->IndexModel->getProductDetails($id);
		$this->data['title'] = $this->IndexModel->getProductTitle($id);
		$this->config->config["pageTitle"] = $this->data['title'];

		$this->load->view('pages/template/header', $this->data);
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/product_details', $this->data);
		$this->load->view('pages/template/footer');
	}

	public function thanks()
	{
		$this->config->config["pageTitle"] = 'Cảm ơn đã đặt hàng';
		$this->load->view('pages/template/header', $this->data);

		// $this->load->view('pages/template/slider');
		$this->load->view('pages/thanks');
		$this->load->view('pages/template/footer');
	}

	public function cart()
	{
		$this->config->config["pageTitle"] = 'Giỏ hàng';
		$this->load->view('pages/template/header', $this->data);

		// $this->load->view('pages/template/slider');
		$this->load->view('pages/cart');
		$this->load->view('pages/template/footer');
	}

	public function checkout()
	{
		if (!$this->session->userdata('LoggedInCustomer')) {
			// Nếu chưa đăng nhập, thiết lập thông báo và chuyển hướng đến trang đăng nhập
			$this->session->set_flashdata('error', 'Bạn cần đăng nhập để mua hàng!');
			redirect(base_url('gio-hang')); // Điều chỉnh URL trang đăng nhập nếu cần
		}

		if ($this->session->userdata('LoggedInCustomer') && $this->cart->contents()) {
			$this->config->config["pageTitle"] = 'Thanh toán đơn hàng';
			$this->load->view('pages/template/header', $this->data);

			// $this->load->view('pages/template/slider');
			$this->load->view('pages/checkout');
			$this->load->view('pages/template/footer');
		} else {
			redirect(base_url() . 'gio-hang');
		}
	}

	public function add_to_cart()
	{
		$product_id = $this->input->post('product_id');
		$quantity = $this->input->post('quantity');
		$this->data['product_details'] = $this->IndexModel->getProductDetails($product_id);

		// Lấy chi tiết sản phẩm từ cơ sở dữ liệu
		if (!empty($this->data['product_details'])) {
			$product = $this->data['product_details'][0]; // Giả sử getProductDetails trả về một mảng với chi tiết sản phẩm

			// Kiểm tra nếu sản phẩm đã có trong giỏ hàng
			$product_in_cart = false;
			if ($this->cart->contents()) {
				foreach ($this->cart->contents() as $items) {
					if ($items['id'] == $product_id) {
						$this->session->set_flashdata('error', 'Sản phẩm đã có trong giỏ, Vui lòng cập nhật số lượng');
						redirect(base_url() . 'gio-hang', 'refresh');
						$product_in_cart = true;
						break;
					}
				}
			}

			// Nếu sản phẩm chưa có trong giỏ hàng, kiểm tra số lượng và thêm vào giỏ
			if (!$product_in_cart) {
				if ($product->quantity >= $quantity) {
					$cart = array(
						'id'      => $product->product_id,
						'qty'     => $quantity,
						'price'   => $product->price,
						'name'    => $product->title,
						'options' => array('image' => $product->image, 'in_stock' => $product->quantity)
					);
					$this->cart->insert($cart);
					$this->session->set_flashdata('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
					redirect(base_url() . 'gio-hang', 'refresh');
				} else {
					$this->session->set_flashdata('error', 'Số lượng đặt vượt quá số lượng tồn. Vui lòng đặt ít hơn.');
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		} else {
			$this->session->set_flashdata('error', 'Sản phẩm không tồn tại.');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	public function update_cart_item()
	{
		$rowid = $this->input->post('rowid');
		$quantity = $this->input->post('quantity');
		foreach ($this->cart->contents() as $items) {
			if ($rowid == $items['rowid']) {
				if ($quantity < $items['options']['in_stock']) {
					$cart = array(
						'rowid'   => $rowid,
						'qty'     => $quantity,
					);
				} else {
					$cart = array(
						'rowid'   => $rowid,
						'qty'     => $items['options']['in_stock'],
					);
				}
			}
		}
		$this->cart->update($cart);
		redirect(base_url() . 'gio-hang', 'refresh');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function delete_all_cart()
	{
		$this->cart->destroy();
		redirect(base_url() . 'gio-hang', 'refresh');
	}

	public function delete_item($rowid)
	{
		$this->cart->remove($rowid);
		redirect(base_url() . 'gio-hang', 'refresh');
	}

	public function login()
	{
		$this->config->config["pageTitle"] = 'Đăng nhập | Đăng Ký';
		$this->load->view('pages/template/header');

		// $this->load->view('pages/template/slider');
		$this->load->view('pages/login');
		$this->load->view('pages/template/footer');
	}

	public function login_customer()
	{

		if ($this->input->post('form_type') === 'login') {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[255]', [
				'required' => 'Bạn chưa điền %s',
				'max_length' => 'Email phải nhập dưới 255 ký tự'
			]);
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]', [
				'required' => 'Bạn chưa điền %s',
				'min_length' => 'Password phải lớn hơn 8 ký tự'
			]);

			if ($this->form_validation->run() == TRUE) {
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$this->load->model('LoginModel');
				$result = $this->LoginModel->checkLoginCustomer($email, $password);

				if (count($result) > 0) {
					$session_array = array(
						'id' => $result[0]->id,
						'username' => $result[0]->name,
						'email' => $result[0]->email,
					);
					$this->session->set_userdata('LoggedInCustomer', $session_array);
					$this->session->set_flashdata('success', 'Đăng nhập thành công');
					redirect(base_url('/'));
				} else {
					$this->session->set_flashdata('error', 'Đăng nhập thất bại !!!');
					redirect(base_url('/dang-nhap'));
				}
			} else {
				$this->login();
			}
		}
	}

	public function dang_ky()
	{

		if ($this->input->post('form_type') === 'signup') {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[255]|regex_match[/^[^@]+@[^@]+$/]', [
				'required' => 'Bạn chưa điền %s',
				'valid_email' => 'Địa chỉ email không hợp lệ',
				'max_length' => '%s không được vượt quá 255 ký tự',
				'regex_match' => 'Email phải có duy nhất 1 ký tự @'
			]);
			$this->form_validation->set_rules('password', 'Password', [
				'trim',
				'required',
				'min_length[6]',
				'regex_match[/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/]'
			], [
				'required' => 'Bạn chưa điền %s',
				'min_length' => 'Mật khẩu phải dài hơn 5 ký tự',
				'regex_match' => 'Mật khẩu phải có ít nhất 1 ký tự in hoa, 1 ký tự số và 1 ký tự đặc biệt'
			]);
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric|exact_length[10]', [
				'required' => 'Bạn chưa điền %s',
				'numeric' => '%s phải là số',
				'exact_length' => '%s phải có đúng 10 ký tự số'
			]);
			$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[255]', [
				'required' => 'Bạn chưa điền %s',
				'max_length' => '%s không được vượt quá 255 ký tự'
			]);
			$this->form_validation->set_rules('address', 'Address', 'trim|required|max_length[255]', [
				'required' => 'Bạn chưa điền %s',
				'max_length' => '%s không được vượt quá 255 ký tự'
			]);

			if ($this->form_validation->run() == TRUE) {
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$phone = $this->input->post('phone');
				$name = $this->input->post('name');
				$address = $this->input->post('address');
				$data = [
					'name' => $name,
					'email' => $email,
					'password' => $password,
					'address' => $address,
					'phone' => $phone,

				];

				$this->load->model('LoginModel');
				$result = $this->LoginModel->NewCustomer($data);

				if ($result) {
					$session_array = array(

						'username' => $name,
						'email' => $email
					);
					$this->session->set_userdata('LoggedInCustomer', $session_array);
					$this->session->set_flashdata('success', 'Đăng nhập thành công');
					redirect(base_url('/'));
				} else {
					$this->session->set_flashdata('error', 'Login FAIL !!!');
					redirect(base_url('/dang-nhap'));
				}
			} else {
				$this->login();
			}
		}
	}


	public function confirm_checkout()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required', ['required' => 'Bạn chưa điền %s']);
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required', ['required' => 'Bạn chưa điền %s']);
		$this->form_validation->set_rules('name', 'Name', 'trim|required', ['required' => 'Bạn chưa điền %s']);
		$this->form_validation->set_rules('address', 'Address', 'trim|required', ['required' => 'Bạn chưa điền %s']);

		if ($this->form_validation->run() == TRUE) {
			$email = $this->input->post('email');
			$shipping_method = $this->input->post('shipping_method');
			$phone = $this->input->post('phone');
			$name = $this->input->post('name');
			$address = $this->input->post('address');
			$data = [
				'name' => $name,
				'email' => $email,
				'method' => $shipping_method,
				'address' => $address,
				'phone' => $phone,
			];

			$this->load->model('LoginModel');
			$this->load->model('ProductModel'); // Load thêm model Sản phẩm

			$result = $this->LoginModel->NewShipping($data);

			if ($result) {
				// order
				$order_code = rand(00, 9999);
				$data_order = [
					'order_code' => $order_code,
					'ship_id' => $result,
					'status' => 1,
				];
				$insert_order = $this->LoginModel->insert_order($data_order);

				// order details & giảm số lượng sản phẩm
				foreach ($this->cart->contents() as $items) {
					$data_order_details = [
						'order_code' => $order_code,
						'product_id' => $items['id'],
						'quantity' => $items['qty'],
					];
					$insert_order_details = $this->LoginModel->insert_order_details($data_order_details);

					// Gọi hàm trừ số lượng sản phẩm
					$this->ProductModel->giamSoLuongSanPham($items['id'], $items['qty']);
				}

				$this->session->set_flashdata('success', 'Xác nhận đặt hàng thành công');
				$this->cart->destroy();
				redirect(base_url('/thanks'));
			} else {
				$this->session->set_flashdata('error', 'Xác nhận thanh toán nhận hàng thất bại');
				redirect(base_url('/checkout'));
			}
		} else {
			$this->checkout();
		}
	}

	public function dang_xuat()
	{
		$this->session->unset_userdata('LoggedInCustomer');
		$this->session->set_flashdata('success', 'Đăng xuất thành công');
		redirect(base_url('/dang-nhap'));
	}

	public function tim_kiem()
	{
		$keyword = '';
		if (isset($_GET['keyword']) && $_GET['keyword'] != '') {
			$keyword = $_GET['keyword'];
		}
		if ($keyword != '') {
			$this->data['product'] = $this->IndexModel->getProductByKeyword($keyword);
			$this->data['title'] = $keyword;
			$this->config->config["pageTitle"] = 'Tìm kiếm từ khóa: ' . $keyword;
		} else {
			// Khi không có từ khóa tìm kiếm, có thể giữ nguyên giao diện hiện tại
			$this->data['product'] = $this->ProductModel->selectAllProduct(); // Ví dụ: lấy tất cả sản phẩm
			$this->data['title'] = 'Danh sách sản phẩm'; // Tiêu đề mặc định
			$this->config->config["pageTitle"] = 'Danh sách sản phẩm'; // Tiêu đề mặc định
		}


		$this->load->view('pages/template/header', $this->data);
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/timkiem', $this->data);
		$this->load->view('pages/template/footer');
	}
}
