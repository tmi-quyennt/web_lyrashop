<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrderController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('OrderModel');
	}
	public function checkLogin()
	{
		if (!$this->session->userdata('LoggedIn')) {
			redirect(base_url('/login'));
		}
	}

	public function index()
	{
		$this->checkLogin();
		$this->load->view('admin_template/header');
		$this->load->view('admin_template/navbar');

		$this->load->model('OrderModel');
		$data['order'] = $this->OrderModel->selectOrder();

		$this->load->view('order/list', $data);
		$this->load->view('admin_template/footer');
	}

	public function view($order_code)
	{
		$this->checkLogin();
		$this->load->view('admin_template/header');
		$this->load->view('admin_template/navbar');

		$this->load->model('OrderModel');
		$data['order_details'] = $this->OrderModel->selectOrderDetails($order_code);

		$this->load->view('order/view', $data);
		$this->load->view('admin_template/footer');
	}

	public function delete_order($order_code)
	{
		$this->checkLogin();

		$this->load->model('OrderModel');
		$delete_order_details = $this->OrderModel->deleteOrderDetails($order_code);
		$del = $this->OrderModel->deleteOrder($order_code);
		if ($del) {
			$this->session->set_flashdata('success', 'Xóa đơn hàng thành công');
			redirect(base_url('order/list'));
		} else {
			$this->session->set_flashdata('error', 'Xóa đơn hàng thất bại !!');
			redirect(base_url('order/list'));
		}
	}

	public function process()
	{
		echo $value = $this->input->post('value');
		$order_code = $this->input->post('order_code');
		$this->load->model('OrderModel');
		$data = array(
			'status' => $value,
		);
		$this->OrderModel->updateOrder($data, $order_code);
	}



	//



	// public function statistics()
	// {
	// 	$this->checkLogin();
	// 	$this->load->model('OrderModel');
	// 	$this->load->model('ProductModel');
	// 	$total_products_in_stock = $this->ProductModel->getTotalProductsInStock();

	// 	$data['total_orders'] = $this->OrderModel->countOrders();
	// 	$data['processed_orders'] = $this->OrderModel->countOrdersByStatus(2); // Đã được xử lý
	// 	$data['pending_orders'] = $this->OrderModel->countOrdersByStatus(1);   // Chưa được xử lý
	// 	$data['unprocessed_orders'] = $this->OrderModel->countOrdersByStatus(3); // Đang chờ xử lý
	// 	$data['total_revenue'] = $this->OrderModel->getTotalRevenue();

	// 	$data['total_products_in_stock'] = $total_products_in_stock;

	// 	$data['monthly_revenue'] = $this->OrderModel->getMonthlyRevenue();




	// 	$this->load->view('admin_template/header');
	// 	$this->load->view('admin_template/navbar');
	// 	$this->load->view('order/statistics', $data);
	// 	$this->load->view('admin_template/footer');
	// }

	public function statistics() {
		$this->checkLogin();
		$this->load->model('OrderModel');
		$this->load->model('ProductModel');
		
		$total_products_in_stock = $this->ProductModel->getTotalProductsInStock();
		
		$data['total_orders'] = $this->OrderModel->countOrders();
		$data['processed_orders'] = $this->OrderModel->countOrdersByStatus(2); // Đã được xử lý
		$data['pending_orders'] = $this->OrderModel->countOrdersByStatus(1);   // Chưa được xử lý
		$data['unprocessed_orders'] = $this->OrderModel->countOrdersByStatus(3); // Đang chờ xử lý
		$data['total_revenue'] = $this->OrderModel->getTotalRevenue();
		$data['total_products_in_stock'] = $total_products_in_stock;
	
		// Xử lý năm được chọn
		$selected_year = $this->input->get('year') ?? date('Y');
		$data['selected_year'] = $selected_year;
	
		// Lấy doanh thu theo tháng cho năm được chọn
		$data['monthly_revenue'] = $this->OrderModel->getMonthlyRevenue($selected_year);
		
		// Lấy danh sách các năm có dữ liệu
		$data['years'] = array_column($this->OrderModel->getAvailableYears(), 'year');
		
		$this->load->view('admin_template/header');
		$this->load->view('admin_template/navbar');
		$this->load->view('order/statistics', $data);
		$this->load->view('admin_template/footer');
	}
	
}
