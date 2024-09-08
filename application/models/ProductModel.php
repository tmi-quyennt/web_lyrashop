<?php

    class ProductModel extends CI_Model{
        public function insertProduct($data){
            $this->db->insert('products', $data);
            return $this->db->insert_id(); // Trả về ID của sản phẩm vừa chèn        
        }

        public function getAllProducts() {
            $this->db->select('categories.title as tendanhmuc, products.*, brands.title as tenthuonghieu');
            $this->db->from('products');
            $this->db->join('categories', 'categories.category_id = products.category_id');
            $this->db->join('brands', 'brands.brand_id = products.brand_id');
            $query = $this->db->get();
            return $query->result(); // Trả về danh sách sản phẩm
        }

        public function selectAllProduct(){
            $query = $this->db->select('categories.title as tendanhmuc,products.*,brands.title as tenthuonghieu')
            ->from('categories')
            ->join('products','products.category_id=categories.category_id')
            ->join('brands','brands.brand_id=products.brand_id')
            ->get();
            return $query->result();
        }

        public function selectProductById($id){
            $query = $this->db->get_where('products',['product_id'=>$id]);
            return $query->row();
        }

        public function getProductColors($product_id)
        {
            $this->db->select('product_colors.id as color_id, product_colors.color_name');
            $this->db->from('product_colors');
            $this->db->where('product_colors.product_id', $product_id);
            return $this->db->get()->result();
        }

        public function getProductSizes($product_id) {
            $this->db->select('product_sizes.id as size_id, product_sizes.size_name');
            $this->db->from('product_sizes');
            $this->db->where('product_sizes.product_id', $product_id);
            return $this->db->get()->result();
        }

        public function updateProduct($id,$data){
            return $this->db->update('products',$data,['product_id'=>$id]);
        }
        public function deleteProduct($id){
            return $this->db->delete('products',['product_id'=>$id]);
        }

        public function giamSoLuongSanPham($id, $soLuong) {
            $this->db->set('quantity', 'quantity - ' . (int)$soLuong, FALSE);
            $this->db->where('product_id', $id);
            return $this->db->update('products');
        }
    
        // Hàm lấy thông tin sản phẩm
        public function laySanPhamTheoMa($id) {
            return $this->db->get_where('products', ['product_id' => $id])->row_array();
        }

        public function getTotalProductsInStock()
        {
            $query = $this->db->select_sum('quantity')->get('products'); // Hoặc 'product_variations'
            return $query->row()->quantity;
        }

        public function insertProductSize($product_id, $size_name) { 
            $data = [
                'product_id' => $product_id,
                'size_name' => $size_name,
            ];
            $this->db->insert('product_sizes', $data);
        }
    
        public function insertProductColor($product_id, $color_name) {
            $data = [
                'product_id' => $product_id,
                'color_name' => $color_name,
            ];
            $this->db->insert('product_colors', $data);
        }
    }

?>