<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="ml-3 row" style="justify-content: space-between;">
            <h4><a href="index.php?controller=khohang">Kho hàng</a> > Thêm mới</h4>
        </div>
    </div>
</div>
<div class="card-body">
    <form method="post" name="edit-kh">
        <div class="form-group ml-5">
            <div class="col-md-4 mb-3">
                <label for="validationDefault01">Tên kho</label>
                <input type="text" class="form-control" id="validationDefault01" name="tenkho" placeholder="Tên kho"
                    required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationDefault02">Địa chỉ</label>
                <input type="text" class="form-control" id="validationDefault02" name="diachi" placeholder="Địa chỉ"
                    required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="validationDefault02">Người quản lý</label>
                <select class="form-control" name="nhanvien" required="required">
                    <?php 
       foreach($nhanvien as $item){
            echo "<option value='$item->Id'>$item->TenNV</option>";
        }
        ?>
                </select>
                <button type="submit" name="edit-kh" class=" mt-2 btn-danger btn">Thêm mới</button>
            </div>
        </div>
    </form>
</div>
<?php
if(isset($_POST['edit-kh'])){
    $ten= $_POST['tenkho'] ;
    $diachi= $_POST['diachi'];
    $nhanvien= $_POST['nhanvien'];
    KhoHang::add($ten,$diachi,$nhanvien);
}
?>