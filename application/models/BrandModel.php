<?php

    class BrandModel extends CI_Model{
        public function insertBrand($data){
            return $this->db->insert('brands',$data);
        }

        public function selectBrand(){
            $query = $this->db->get('brands');
            return $query->result();
        }

        public function selectBrandById($id){
            $query = $this->db->get_where('brands',['brand_id'=>$id]);
            return $query->row();
        }
        public function updateBrand($id,$data){
            return $this->db->update('brands',$data,['brand_id'=>$id]);
        }
        public function deleteBrand($id){
            return $this->db->delete('brands',['brand_id'=>$id]);
        }
    }

?>