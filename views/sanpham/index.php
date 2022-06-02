
<?php
require_once ('models/sanpham.php');
?>

<h1 class="h3 mb-2 text-center text-gray-800 ">Sản Phẩm</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách Sản Phẩm</h6>
    </div>

    <div class="card-body">
        <a href="index.php?controller=sanpham&action=insert" class="btn btn-primary mb-3">Thêm</a>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá mua</th>
                    <th>Giá bán</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($sanpham as $item){

                    ?>

                        <tr>
                            <td  onclick="showDetail('sanpham','<?=$item->Id?>')"><?= $item->Id   ?></td>
                            <td  onclick="showDetail('sanpham','<?=$item->Id?>')"><?= $item->TenSP?></td>

                            <td  onclick="showDetail('sanpham','<?=$item->Id?>')"><?= $item->SoLuong." ".$item->IdDVT?>
                            <br>
                            <span style="color: red;"><?php
                                if (($item->SoLuong) > ($item->Max)) {
                                    echo "Sản phẩm trong kho đang nhiều";
                                }
                                if (($item->SoLuong) < ($item->Min)) {
                                    echo "Sản phẩm trong kho đang sắp hết";
                                }
                            ?></span>
                            </td>
                            <td  onclick="showDetail('sanpham','<?=$item->Id?>')"><?=number_format($item->GiaMua, 0,"." , ",") ?></td>
                            <td  onclick="showDetail('sanpham','<?=$item->Id?>')"><?= number_format($item->GiaBan, 0,"." , ",")?></td>
                            <td>
                             <a  href="index.php?controller=sanpham&action=edit&id=<?= $item->Id?>"  class='btn btn-primary mr-3'>Edit</a>
                             <button type="button" data-toggle="modal" data-target="#delete<?=$item->Id?>"   class='btn btn-danger'>Delete</button>
                            
                             <div class="modal" id="delete<?=$item->Id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Thông báo</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Bạn có muốn xóa sản phẩm khỏi danh sách</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="post">
                                        <button type="submit" name="delete" value=<?=$item->Id?> class="btn btn-primary">Đồng ý</button>
                                            </form>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                    </td>

                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php
if(isset($_POST['delete'])){
    $id =$_POST['delete'];
    SanPham::delete($id);
}
?>


