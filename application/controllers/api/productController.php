<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH.'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

 class productController extends RestController{

    public function __construct() {
        parent:: __construct();
        $this->load->model('APIproductModel');
    }
    public function index_get(){
        $APIproductModel = new APIproductModel;
        $result_product = $APIproductModel->get_product();
        $this->response($result_product,200);
     }

    //them
    public function addproduct_post(){
        $APIproductModel = new APIproductModel;
        $data = [
            'title'=>$this->input->post('title'),
            'description'=>$this->input->post('description'),
            'status'=>$this->input->post('status'),
            'category_id'=>$this->input->post('category_id'),
            'brand_id'=>$this->input->post('brand_id'),
            'slug'=>$this->input->post('slug'),
            'quantity'=>$this->input->post('quantity'),
            'price'=>$this->input->post('price'),

        ];
        $result = $APIproductModel->insertproducts($data);
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
//tim
    public function findproduct_get($id){
        $APIproductModel = new APIproductModel;
        $result =  $APIproductModel->findproducts($id);
        $this->response($result,200);
    }

    //sua
    public function updateproduct_put($id){
        $APIproductModel = new APIproductModel;
        $data = [
            'title'=>$this->put('title'),
            'description'=>$this->put('description'),
            'status'=>$this->put('status'),
            'category_id'=>$this->put('category_id'),
            'brand_id'=>$this->put('brand_id'),
            'slug'=>$this->put('slug'),
            'quantity'=>$this->put('quantity'),
            'price'=>$this->put('price'),
        ];
        $update_result = $APIproductModel->update_products($id,$data);
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
    //xoa
    public function deleteproduct_delete($id)
    {
        $APIproductModel = new APIproductModel;
        $delete_result = $APIproductModel->delete_products($id);
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