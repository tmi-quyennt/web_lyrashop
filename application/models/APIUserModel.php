<?php
defined('BASEPATH') or exit('No direct script access allowed');

 class APIUserModel extends CI_Model{

    public function get_users(){
        $query = $this->db->get('user');
        return $query->result();
    }
    public function insertUser($data){
        return $this->db->insert('user',$data);
    }
    public function findUser($id){
        $this->db->where('id',$id);
      $query =  $this->db->get('user');
      return $query->row();
    }

    public function update_User($id,$data){
       $this->db->where('id',$id);
        return $this->db->update('user',$data);
    }
    
    public function delete_User($id){
        return $this->db->delete('user',['id' => $id]);
    }
 }
 ?>