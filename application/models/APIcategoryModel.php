<?php
defined('BASEPATH') or exit('No direct script access allowed');

 class APIcategoryModel extends CI_Model{

    public function get_category(){
        $query = $this->db->get('categories');
        return $query->result();
    }
    public function insertcategory($data){
        return $this->db->insert('categories',$data);
    }
    public function findcategory($id){
        $this->db->where('id',$id);
      $query =  $this->db->get('categories');
      return $query->row();
    }

    public function update_category($id,$data){
       $this->db->where('id',$id);
        return $this->db->update('categories',$data);
    }
    
    public function delete_category($id){
        return $this->db->delete('categories',['id' => $id]);
    }
 }
 ?>