<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH.'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

 class categoryController extends RestController{

    public function __construct() {
        parent:: __construct();
        $this->load->model('APIcategoryModel');
    }
    public function index_get(){
       $APIcategoryModel = new APIcategoryModel;
       $result_category = $APIcategoryModel->get_category();
       $this->response($result_category,200);
    }

    //themAPIcategoryModel
    public function addcategory_post(){
        $APIcategoryModel = new APIcategoryModel;
        $data = [
            'title'=>$this->input->post('title'),
            'description'=>$this->input->post('description'),
            'status'=>$this->input->post('status'),
            'image'=>$this->input->post('image'),
            'slug'=>$this->input->post('slug'),

        ];
        $result = $APIcategoryModel->insertcategory($data);
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
    public function findcategory_get($id){
        $APIcategoryModel = new APIcategoryModel;
        $result =  $APIcategoryModel->findcategory($id);
        $this->response($result,200);
    }

    //sua
    public function updatecategory_put($id){
        $APIcategoryModel = new APIcategoryModel;
        $data = [
            'title'=>$this->put('title'),
            'description'=>$this->put('description'),
            'status'=>$this->put('status'),
            'image'=>$this->put('image'),
            'slug'=>$this->put('slug'),
        ];
        $update_result = $APIcategoryModel->update_category($id,$data);
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
    public function deletecategory_delete($id)
    {
        $APIcategoryModel = new APIcategoryModel;
        $delete_result = $APIcategoryModel->delete_category($id);
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