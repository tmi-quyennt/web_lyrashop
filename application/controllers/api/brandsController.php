<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH.'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

 class brandsController extends RestController{

    public function __construct() {
        parent:: __construct();
        $this->load->model('APIbrandsModel');
    }
    public function index_get(){
        $APIbrandsModel = new APIbrandsModel;
        $result_brands = $APIbrandsModel->get_brands();
        $this->response($result_brands,200);
     }
     public function addbrands_post(){
        $APIbrandsModel = new APIbrandsModel;
        $data = [
            'title'=>$this->input->post('title'),
            'description'=>$this->input->post('description'),
            'image'=>$this->input->post('image'),
            'status'=>$this->input->post('status'),
            'slug'=>$this->input->post('slug'),

        ];
        $result = $APIbrandsModel->insertbrands($data);
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
    public function findbrands_get($id){
        $APIbrandsModel = new APIbrandsModel;
        $result =  $APIbrandsModel->findbrands($id);
        $this->response($result,200);
    }
    public function updatebrands_put($id){
        $APIbrandsModel = new APIbrandsModel;
        $data = [
            'title'=>$this->put('title'),
            'description'=>$this->put('description'),
            'image'=>$this->put('image'),
            'status'=>$this->put('status'),
            'slug'=>$this->put('slug'),

        ];
        $update_result = $APIbrandsModel->updatebrands($id,$data);
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
    public function deletebrands_delete($id)
    {
        $APIbrandsModel = new APIbrandsModel;
        $delete_result = $APIbrandsModel->deletebrands($id);
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