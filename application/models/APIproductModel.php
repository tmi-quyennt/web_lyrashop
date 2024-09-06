<?php
defined('BASEPATH') or exit('No direct script access allowed');

 class APIproductModel extends CI_Model{

    public function get_product(){
        $query = $this->db->get('products');
        return $query->result();
    }
    public function insertproducts($data){
        return $this->db->insert('products',$data);
    }
    public function findproducts($id){
        $this->db->where('id',$id);
      $query =  $this->db->get('products');
      return $query->row();
    }

    public function update_products($id,$data){
       $this->db->where('id',$id);
        return $this->db->update('products',$data);
    }
    
    public function delete_products($id){
        return $this->db->delete('products',['id' => $id]);
    }
 }
 ?>