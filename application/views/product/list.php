<div class="mt-4 mx-auto pb-4" style="width: 1440px;">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Danh sách sản phẩm</h4>
        </div>
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                <?php echo $this->session->flashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                <?php echo $this->session->flashdata('error') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <div class="card-body">
            <div class="mb-3">
                <a href="<?php echo base_url('product/create') ?>" class="btn btn-success">
                    <i class="fa fa-plus"></i> Thêm sản phẩm
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Giá tiền</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Bộ sưu tập</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($allproduct as $key => $pro): ?>
                        <tr>
                            <th scope="row"><?php echo $key ?></th>
                            <td><?php echo $pro->title ?></td>
                            <td><?php echo number_format((float)$pro->price, 0, ',', '.') ?> VND</td>
                            <td><?php echo $pro->quantity ?></td>
                            <td><?php echo $pro->tendanhmuc ?></td>
                            <td><?php echo $pro->tenthuonghieu ?></td>
                            <td>
                                <img src="<?php echo base_url("uploads/product/". $pro->image) ?>" class="img-thumbnail" width="100">
                            </td>
                            <td>
                                <span class="badge badge-<?php echo $pro->status == 1 ? 'success' : 'danger' ?>">
                                    <?php echo $pro->status == 1 ? 'Active' : 'Inactive' ?>
                                </span>
                            </td>
                            <td>
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="<?php echo base_url("product/delete/". $pro->product_id) ?>" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> Xóa
                                </a>
                                <a href="<?php echo base_url("product/edit/". $pro->product_id) ?>" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i> Sửa
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>