<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH.'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

 class ApiController extends RestController{

    public function index_get(){
        // $this->load->view('template/header');
		// $this->load->view('login/index');
		// $this->load->view('template/footer');
        // redirect(base_url('/dashboard'));
        echo'hi am nbt';
    }
 }
 ?>