<?php

class OrderModel extends CI_Model
{


    public function selectOrder()
    {
        $query = $this->db->select('orders.*,shipping.*')
            ->from('orders')
            ->join('shipping', 'orders.ship_id=shipping.ship_id')
            ->get();
        return $query->result();
    }

    public function selectOrderDetails($order_code)
    {
        $query = $this->db->select('orders.order_code,orders.status as order_status,order_details.quantity as qty,order_details.order_code,order_details.product_id,products.*')
            ->from('order_details')
            ->join('products', 'order_details.product_id=products.product_id')
            ->join('orders', 'orders.order_code=order_details.order_code')
            ->where('order_details.order_code', $order_code)
            ->get();
        return $query->result();
    }

    public function deleteOrder($order_code)
    {
        return $this->db->delete('orders', ['order_code' => $order_code]);
    }

    public function deleteOrderDetails($order_code)
    {
        $this->db->where_in('order_code', $order_code);
        return $this->db->delete('order_details');
    }

    public function updateOrder($data, $order_code)
    {
        return $this->db->update('orders', $data, ['order_code' => $order_code]);
    }

    public function insertOrder($orderData)
    {
        $this->db->insert('orders', $orderData);
        return $this->db->insert_id();
    }

    // Lưu thông tin chi tiết đơn hàng
    public function insert_order_details($data)
    {
        return $this->db->insert('order_details', $data);
    }


    //



    public function countOrders()
    {
        return $this->db->count_all('orders');
    }

    public function countOrdersByStatus($status)
    {
        $this->db->where('status', $status);
        return $this->db->count_all_results('orders');
    }

    public function getTotalRevenue()
    {
        $this->db->select('SUM(order_details.quantity * products.price) as total_revenue');
        $this->db->from('order_details');
        $this->db->join('products', 'order_details.product_id = products.product_id');
        $this->db->join('orders', 'order_details.order_code = orders.order_code');
        $this->db->where('orders.status', 2);
        $query = $this->db->get();
        return $query->row()->total_revenue;
    }


    // public function getMonthlyRevenue() {
    //     $query = $this->db->select('MONTH(order_date) as month, SUM(order_details.quantity * products.price) as total_revenue')
    //         ->from('orders')
    //         ->join('order_details', 'orders.order_code = order_details.order_code')
    //         ->join('products', 'order_details.product_id = products.product_id')
    //         ->where('orders.status', 2) // Chỉ tính các đơn hàng đã được xử lý
    //         ->group_by('MONTH(order_date)')
    //         ->order_by('MONTH(order_date)', 'ASC')
    //         ->get();
    //     return $query->result();
    // }


    public function insert_order($data_order) {
        $data_order['order_date'] = date('Y-m-d H:i:s'); // Lưu thời gian hiện tại khi đơn hàng được tạo
        $this->db->insert('orders', $data_order);
        return $this->db->insert_id();
    }

    public function getMonthlyRevenue($year) {
        $query = $this->db->select('MONTH(order_date) as month, SUM(order_details.quantity * products.price) as total_revenue')
            ->from('orders')
            ->join('order_details', 'orders.order_code = order_details.order_code')
            ->join('products', 'order_details.product_id = products.product_id')
            ->where('YEAR(order_date)', $year)
            ->group_by('MONTH(order_date)')
            ->get();
        return $query->result();
    }
    

    public function getAvailableYears() {
        $query = $this->db->select('YEAR(order_date) as year')
            ->from('orders')
            ->group_by('YEAR(order_date)')
            ->order_by('year', 'DESC')
            ->get();
        return $query->result();
    }


    
}
