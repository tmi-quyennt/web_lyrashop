<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OnlineCheckOutController extends CI_Controller
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

    public function execPostRequest($url, $data)
    {

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    // public function online_checkout()
    // {
    //     $this->load->library('cart');
    //     $subtotal = 0;
    //     $total = 0;
    //     foreach ($this->cart->contents() as $items) {
    //         $subtotal = $items['qty'] * $items['price'];
    //         $total += $subtotal;
    //     }
    //     if (isset($_POST['cod'])) {
    //         $this->form_validation->set_rules('email', 'Email', 'trim|required', ['required' => 'Bạn chưa điền %s']);
    //         $this->form_validation->set_rules('phone', 'Phone', 'trim|required', ['required' => 'Bạn chưa điền %s']);
    //         $this->form_validation->set_rules('name', 'Name', 'trim|required', ['required' => 'Bạn chưa điền %s']);
    //         $this->form_validation->set_rules('address', 'Address', 'trim|required', ['required' => 'Bạn chưa điền %s']);

    //         if ($this->form_validation->run() == TRUE) {
    //             $email = $this->input->post('email');
    //             // $shipping_method = $this->input->post('shipping_method');
    //             $phone = $this->input->post('phone');
    //             $name = $this->input->post('name');
    //             $address = $this->input->post('address');
    //             $data = [
    //                 'name' => $name,
    //                 'email' => $email,
    //                 'method' => 'cod',
    //                 'address' => $address,
    //                 'phone' => $phone,
    //             ];

    //             $this->load->model('LoginModel');
    //             $this->load->model('ProductModel'); // Load thêm model Sản phẩm

    //             $result = $this->LoginModel->NewShipping($data);

    //             if ($result) {
    //                 // order
    //                 $order_code = rand(00, 9999);
    //                 $data_order = [
    //                     'order_code' => $order_code,
    //                     'ship_id' => $result,
    //                     'status' => 1,
    //                 ];
    //                 $insert_order = $this->LoginModel->insert_order($data_order);

    //                 $order_id = $this->db->insert_id();

    //                 // order details & giảm số lượng sản phẩm
    //                 foreach ($this->cart->contents() as $items) {
    //                     $data_order_details = [
    //                         'order_code' => $order_code,
    //                         'product_id' => $items['id'],
    //                         'quantity' => $items['qty'],
    //                         'order_id' => $order_id,
    //                     ];
    //                     $this->LoginModel->insert_order_details($data_order_details);

    //                     // Gọi hàm trừ số lượng sản phẩm
    //                     $this->ProductModel->giamSoLuongSanPham($items['id'], $items['qty']);
    //                 }

    //                 $this->session->set_flashdata('success', 'Xác nhận đặt hàng thành công');
    //                 $this->cart->destroy();
    //                 redirect(base_url('/thanks'));
    //             } else {
    //                 $this->session->set_flashdata('error', 'Xác nhận thanh toán nhận hàng thất bại');
    //                 redirect(base_url('/checkout'));
    //             }
    //         } else {
    //             $this->checkout();
    //         }
    //     } elseif (isset($_POST['payUrl'])) {
    //         $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
    //         $partnerCode = 'MOMOBKUN20180529';
    //         $accessKey = 'klm05TvNBzhg7h7j';
    //         $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

    //         $orderInfo = "Thanh toán qua MoMo";
    //         $amount = $total;
    //         $orderId = rand(00, 9999);
    //         $redirectUrl = "http://localhost:7000/thanks";
    //         $ipnUrl = "http://localhost:7000/thanks";
    //         $extraData = "";



    //         $partnerCode = $partnerCode;
    //         $accessKey = $accessKey;
    //         $serectkey = $secretKey;
    //         $orderId = $orderId; // Mã đơn hàng
    //         $orderInfo = $orderInfo;
    //         $amount = $amount;
    //         $ipnUrl = $ipnUrl;
    //         $redirectUrl = $redirectUrl;
    //         $extraData = $extraData;

    //         $requestId = time() . "";
    //         $requestType = "payWithATM";
    //         // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
    //         //before sign HMAC SHA256 signature
    //         $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
    //         $signature = hash_hmac("sha256", $rawHash, $serectkey);
    //         $data = array(
    //             'partnerCode' => $partnerCode,
    //             'partnerName' => "Test",
    //             "storeId" => "MomoTestStore",
    //             'requestId' => $requestId,
    //             'amount' => $amount,
    //             'orderId' => $orderId,
    //             'orderInfo' => $orderInfo,
    //             'redirectUrl' => $redirectUrl,
    //             'ipnUrl' => $ipnUrl,
    //             'lang' => 'vi',
    //             'extraData' => $extraData,
    //             'requestType' => $requestType,
    //             'signature' => $signature
    //         );
    //         $result = $this->execPostRequest($endpoint, json_encode($data));
    //         $jsonResult = json_decode($result, true);  // decode json

    //         //Just a example, please check more in there

    //         header('Location: ' . $jsonResult['payUrl']);
    //     } 
    // }

    public function online_checkout()
{
    $this->load->library('cart');
    $subtotal = 0;
    $total = 0;
    foreach ($this->cart->contents() as $items) {
        $subtotal = $items['qty'] * $items['price'];
        $total += $subtotal;
    }

    if (isset($_POST['cod'])) {
        $this->form_validation->set_rules('email', 'Email', 'trim|required', ['required' => 'Bạn chưa điền %s']);
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required', ['required' => 'Bạn chưa điền %s']);
        $this->form_validation->set_rules('name', 'Name', 'trim|required', ['required' => 'Bạn chưa điền %s']);
        $this->form_validation->set_rules('address', 'Address', 'trim|required', ['required' => 'Bạn chưa điền %s']);

        if ($this->form_validation->run() == TRUE) {
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $name = $this->input->post('name');
            $address = $this->input->post('address');
            $data = [
                'name' => $name,
                'email' => $email,
                'method' => 'cod',
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

                $order_id = $this->db->insert_id();

                // order details & giảm số lượng sản phẩm
                foreach ($this->cart->contents() as $items) {
                    $data_order_details = [
                        'order_code' => $order_code,
                        'product_id' => $items['id'],
                        'quantity' => $items['qty'],
                        'order_id' => $order_id,
                    ];
                    $this->LoginModel->insert_order_details($data_order_details);

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
    } elseif (isset($_POST['payUrl'])) {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        $orderInfo = "Thanh toán qua MoMo";
        $amount = $total;
        $orderId = rand(00, 9999);
        $redirectUrl = "http://localhost:7000/thanks";
        $ipnUrl = "http://localhost:7000/thanks";
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        // Kiểm tra nếu phản hồi từ MoMo chứa 'payUrl'
        if (is_array($jsonResult) && isset($jsonResult['payUrl'])) {
            header('Location: ' . $jsonResult['payUrl']);
            exit(); // Thêm exit để dừng việc thực hiện script sau khi chuyển hướng
        } else {
            // Ghi log chi tiết lỗi
            error_log('MoMo Error: ' . print_r($jsonResult, true));
            $this->session->set_flashdata('error', 'Có lỗi xảy ra trong quá trình thanh toán MoMo.');
            redirect(base_url('/checkout'));
        }
    }
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
}
