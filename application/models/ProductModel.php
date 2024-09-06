<?php

    class ProductModel extends CI_Model{
        public function insertProduct($data){
            return $this->db->insert('products',$data);
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
    }

?>