

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="ml-3 row" style="justify-content: space-between;">
            <h4><a href="index.php?controller=khohang">Kho hàng</a> > Chỉnh sửa</h4>
        </div>
    </div>
</div>
<div class="card-body">
<form method="post" name="edit-kh">
<div class="form-group ml-5">
    <div class="col-md-4 mb-3">
        <label for="validationDefault01">Tên kho</label>
        <input type="text" class="form-control" id="validationDefault01" value="<?= $khohang->ten ?> " name="tenkho" placeholder="Tên kho" required>
    </div>
    <div class="col-md-4 mb-3">
        <label for="validationDefault02">Địa chỉ</label>
        <input type="text" class="form-control" id="validationDefault02" value="<?= $khohang->diachi ?> " name="diachi" placeholder="Địa chỉ" required>
    </div>

    <div class="col-md-4 mb-3">
        <label for="validationDefault02">Người quản lý</label>
        <!-- <input type="text" class="form-control" id="validationDefault02" value="<?= $khohang->thukho ?> " name="email" placeholder="Nhập Email" required> -->
        <select class="form-control" name="nhanvien">
       <?php 
       foreach($nhanvien as $item){
           if ($item->Id === $khohang->thukho) {

            echo "<option value='$item->Id' selected>$item->TenNV</option>";
           } else {

            echo "<option value='$item->Id'>$item->TenNV</option>";
           }
        }
        ?>
    </select>
    <button type="submit" name="edit-kh"  class=" mt-2 btn-danger btn">Cập nhật</button>
    </div>
</div>
</form>
    </div>
<?php
if(isset($_POST['edit-kh'])){
    $id = $khohang->id;
    $ten= $_POST['tenkho'] ;
    $diachi= $_POST['diachi'];
    $nhanvien= $_POST['nhanvien'];
    KhoHang::update($id,$ten,$diachi,$nhanvien);
}
?>
