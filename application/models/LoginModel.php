<?php

    class LoginModel extends CI_Model{

        // public function checkLogin($email,$password){
        //     $query = $this->db->where('email',$email)->where('password',$password)->get('user');
        //     return $query->result();
        // }
        
        public function checkLogin($email, $password)
        {
            // Mã hóa mật khẩu (ví dụ sử dụng MD5, nhưng nên xem xét phương pháp mã hóa an toàn hơn)
            $encrypted_password = ($password);
            
            // Thực hiện truy vấn với điều kiện email và mật khẩu
            $this->db->select('id, username, email, role');
            $this->db->from('user');
            $this->db->where('email', $email);
            $this->db->where('password', $encrypted_password);
            $query = $this->db->get();
            
            // Trả về kết quả truy vấn
            return $query->result();
        }

        public function checkLoginCustomer($email,$password){
            $query = $this->db->where('email',$email)->where('password',$password)->get('customers');
            return $query->result();
        }

        public function NewCustomer($data){
            return $query = $this->db->insert('customers',$data);
           
        }

        public function NewShipping($data){
            $query = $this->db->insert('shipping',$data); 
            return $ship_id = $this->db->insert_id();
        }

        public function insert_order($data_order){
            return $query = $this->db->insert('orders',$data_order);
        }

        public function insert_order_details($data_order_details) {
            return $this->db->insert('order_details', $data_order_details); // Trả về true nếu thành công
        }
        

    }

?>