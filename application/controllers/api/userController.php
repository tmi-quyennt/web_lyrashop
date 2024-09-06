<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH.'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

 class userController extends RestController{

    public function __construct() {
        parent:: __construct();
        $this->load->model('APIUserModel');
    }
    public function index_get(){
       $APIUserModel = new APIUserModel;
       $result_user = $APIUserModel->get_users();
       $this->response($result_user,200);
    }

    //them
    public function addUser_post(){
        $APIUserModel = new APIUserModel;
        $data = [
            'username'=>$this->input->post('username'),
            'email'=>$this->input->post('email'),
            'password'=>$this->input->post('password'),
            'status'=>$this->input->post('status'),

        ];
        $result = $APIUserModel->insertUser($data);
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
    public function findUser_get($id){
        $APIUserModel = new APIUserModel;
        $result =  $APIUserModel->findUser($id);
        $this->response($result,200);
    }

    //sua
    public function updateUser_put($id){
        $APIUserModel = new APIUserModel;
        $data = [
            'username'=>$this->put('username'),
            'email'=>$this->put('email'),
            'password'=>$this->put('password'),
            'status'=>$this->put('status'),

        ];
        $update_result = $APIUserModel->update_User($id,$data);
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
    public function deleteUser_delete($id)
    {
        $APIUserModel = new APIUserModel;
        $delete_result = $APIUserModel->delete_User($id);
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