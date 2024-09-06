<?php
defined('BASEPATH') or exit('No direct script access allowed');

 class APIbrandsModel extends CI_Model{

    public function get_brands(){
        $query = $this->db->get('brands');
        return $query->result();
    }

    public function insertbrands($data){
        return $this->db->insert('brands',$data);
    }
    public function findbrands($id){
        $this->db->where('id',$id);
      $query =  $this->db->get('brands');
      return $query->row();
    }

    public function updatebrands($id,$data){
       $this->db->where('id',$id);
        return $this->db->update('brands',$data);
    }
    
    public function deletebrands($id){
        return $this->db->delete('brands',['id' => $id]);
    }
 }
 ?>