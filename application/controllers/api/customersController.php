<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH.'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

 class customersController extends RestController{

    public function __construct() {
        parent:: __construct();
        $this->load->model('APICustomersModel');
    }
    public function index_get(){
        $APICustomersModel = new APICustomersModel;
        $result_cus= $APICustomersModel->get_Customers();
        $this->response($result_cus,200);
     }

     public function addcustomers_post(){
        $APICustomersModel = new APICustomersModel;
        $data = [
            'name'=>$this->input->post('name'),
            'email'=>$this->input->post('email'),
            'password'=>$this->input->post('password'),
            'phone'=>$this->input->post('phone'),
            'address'=>$this->input->post('address'),

        ];
        $result = $APICustomersModel->insertCustomers($data);
        // $this->response($data,200);
        if ($result>0) {
            $this->response([
                'status' => true,
                'message' => 'them thanh cong'
            ],RestController::HTTP_OK
        );
        } else {
            $this->response([
                'status' => false,
                'message' => 'them that bai'
            ],RestController::HTTP_BAD_REQUEST
        );
        }
        
    }

    public function findcustomers_get($id){
        $APICustomersModel = new APICustomersModel;
        $result =  $APICustomersModel->findcustomers($id);
        $this->response($result,200);
    }

    public function updatecustomers_put($id){
        $APICustomersModel = new APICustomersModel;
        $data = [
            'name'=>$this->put('name'),
            'email'=>$this->put('email'),
            'password'=>$this->put('password'),
            'phone'=>$this->put('phone'),
            'address'=>$this->put('address'),

        ];
        $update_result = $APICustomersModel->update_customers($id,$data);
        // $this->response($data,200);
        if ($update_result>0) {
            $this->response([
                'status' => true,
                'message' => 'sua thanh cong'
            ],RestController::HTTP_OK
        );
        } else {
            $this->response([
                'status' => false,
                'message' => 'sua that bai'
            ],RestController::HTTP_BAD_REQUEST
        );
        }
    }

    public function deletecustomers_delete($id)
    {
        $APICustomersModel = new APICustomersModel;
        $delete_result = $APICustomersModel->delete_customers($id);
        if ($delete_result>0) {
            $this->response([
                'status' => true,
                'message' => 'xoa thanh cong'
            ],RestController::HTTP_OK
        );
        } else {
            $this->response([
                'status' => false,
                'message' => 'xoa that bai'
            ],RestController::HTTP_BAD_REQUEST
        );
        }
    }

 }
 ?>