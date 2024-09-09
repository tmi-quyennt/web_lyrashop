<?php

    class IndexModel extends CI_Model{

        public function getCategoryHome(){
            $query = $this->db->get_where('categories',['status'=>1]);
            return $query->result();
        }
    
        public function getBrandHome(){
            $query = $this->db->get_where('brands',['status'=>1]);
            return $query->result();
        }

        public function getAllProduct(){
            $this->db->select('products.*, 
            GROUP_CONCAT(DISTINCT product_sizes.size_name) as sizes, 
            GROUP_CONCAT(DISTINCT product_colors.color_name) as colors');
            $this->db->from('products');
            $this->db->join('product_sizes', 'product_sizes.product_id = products.product_id', 'left');
            $this->db->join('product_colors', 'product_colors.product_id = products.product_id', 'left');
            $this->db->where('products.status', 1);
            $this->db->group_by('products.product_id'); // Nhóm theo product_id để tránh trùng lặp
            $query = $this->db->get();
            return $query->result();
        }

        public function getCategoryProduct($id){
            $query = $this->db->select('categories.title as tendanhmuc,products.*,brands.title as tenthuonghieu')
            ->from('categories')
            ->join('products','products.category_id=categories.category_id')
            ->join('brands','brands.brand_id=products.brand_id')
            ->where('products.category_id',$id)
            ->get();
            return $query->result();
        }

        public function getBrandProduct($id){
            $query = $this->db->select('categories.title as tendanhmuc,products.*,brands.title as tenthuonghieu')
            ->from('categories')
            ->join('products','products.category_id=categories.category_id')
            ->join('brands','brands.brand_id=products.brand_id')
            ->where('products.brand_id',$id)
            ->get();
            return $query->result();
        }

        public function getColorIdByNameAndProductId($color_name, $product_id) {
            $this->db->select('id');
            $this->db->from('product_colors');
            $this->db->where('color_name', $color_name);
            $this->db->where('product_id', $product_id);
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
                return $query->row()->id; // Trả về id của màu sắc
            }
            return null; // Trả về null nếu không tìm thấy
        }
        
        public function getSizeIdByNameAndProductId($size_name, $product_id) {
            $this->db->select('id');
            $this->db->from('product_sizes');
            $this->db->where('size_name', $size_name);
            $this->db->where('product_id', $product_id);
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
                return $query->row()->id; // Trả về id của kích thước
            }
            return null; // Trả về null nếu không tìm thấy
        }

        public function getProductDetails($id){
            $query = $this->db->select('categories.title as tendanhmuc, products.*, brands.title as tenthuonghieu, 
                GROUP_CONCAT(DISTINCT product_colors.color_name) as colors, 
                GROUP_CONCAT(DISTINCT product_sizes.size_name) as sizes')
            ->from('categories')
            ->join('products', 'products.category_id = categories.category_id')
            ->join('product_colors', 'product_colors.product_id = products.product_id', 'left') // Kết nối với bảng product_colors
            ->join('product_sizes', 'product_sizes.product_id = products.product_id', 'left') // Kết nối với bảng product_sizes
            ->join('brands', 'brands.brand_id = products.brand_id')
            ->where('products.product_id', $id)
            ->group_by('products.product_id') // Nhóm theo product_id để tránh trùng lặp
            ->get();
            
            return $query->result();
        }

        public function getCategoryTitle($id){
            $this->db->select('categories.*');
            $this->db->from('categories');
            $this->db->limit(1);
            $this->db->where('categories.category_id',$id);
            $query = $this->db->get();
            $result = $query->row();
            return $title = $result->title;

        }


        public function getBrandTitle($id){
            $this->db->select('brands.*');
            $this->db->from('brands');
            $this->db->limit(1);
            $this->db->where('brands.brand_id',$id);
            $query = $this->db->get();
            $result = $query->row();
            return $title = $result->title;

        }

        public function getProductTitle($id){
            $this->db->select('products.*');
            $this->db->from('products');
            $this->db->limit(1);
            $this->db->where('products.product_id',$id);
            $query = $this->db->get();
            $result = $query->row();
            return $title = $result->title;

        }

        public function getProductByKeyword($keyword){
            $query = $this->db->select('categories.title as tendanhmuc,products.*,brands.title as tenthuonghieu')
            ->from('categories')
            ->join('products','products.category_id=categories.category_id')
            ->join('brands','brands.brand_id=products.brand_id')
            ->like('products.title',$keyword)
            ->get();
            return $query->result();
        }
        public function getProductSizes($product_id) {
            // Lấy kích thước sản phẩm từ bảng product_sizes
            $this->db->select('size_name');
            $this->db->from('product_sizes');
            $this->db->where('product_id', $product_id);
            $query = $this->db->get();
            return $query->result(); // Trả về danh sách kích thước
        }
    
        public function getProductColors($product_id) {
            // Lấy màu sắc sản phẩm từ bảng product_colors
            $this->db->select('color_name');
            $this->db->from('product_colors');
            $this->db->where('product_id', $product_id);
            $query = $this->db->get();
            return $query->result(); // Trả về danh sách màu sắc
        }
        

    }

?>