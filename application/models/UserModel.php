<?php

    class UserModel extends CI_Model{
        public function insertUser($data){
            return $this->db->insert('user',$data);
        }

        public function selectUser(){
            $query = $this->db->get('user');
            return $query->result();
        }

        public function selectUserById($id){
            $query = $this->db->get_where('user',['id'=>$id]);
            return $query->row();
        }
        public function updateUser($id,$data){
            return $this->db->update('user',$data,['id'=>$id]);
        }
        public function deleteUser($id){
            return $this->db->delete('user',['id'=>$id]);
        }
    }

?>