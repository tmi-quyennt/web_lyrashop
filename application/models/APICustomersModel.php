<?php
defined('BASEPATH') or exit('No direct script access allowed');

 class APICustomersModel extends CI_Model{
    public function get_Customers(){
        $query = $this->db->get('customers');
        return $query->result();
    }
    public function insertCustomers($data){
        return $this->db->insert('customers',$data);
    }
    public function findcustomers($id){
        $this->db->where('id',$id);
      $query =  $this->db->get('customers');
      return $query->row();
    }
    public function update_customers($id,$data){
        $this->db->where('id',$id);
         return $this->db->update('customers',$data);
     }

     public function delete_customers($id){
        return $this->db->delete('customers',['id' => $id]);
    }
 }
 ?>