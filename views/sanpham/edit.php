<div class="card shadow mb-4">
    <div class="card-header py-3">
    <div class="ml-5 row" style="justify-content: space-between;">
        <h4><a href="index.php?controller=sanpham">Sản phẩm</a> > Chỉnh sửa</h4>
    </div>
    </div>

    <div class="card-body">

    <form method="post" name="create-sp">
    <div class="form-group row ml-5">
        <div class="col-md-4 mb-3">
            <label for="validationDefault01">Tên Sản Phẩm</label>
            <input type="text" class="form-control" id="validationDefault01" value="<?= $sanpham->TenSP ?>" name="tensp" placeholder="Tên Sản Phẩm" required>
        </div>
      
       
        <div class="col-md-4 mb-3">
            <label for="validationDefault02">Giá Mua</label>
            <input type="number" class="form-control" value="<?= $sanpham->GiaMua ?>" id="validationDefault02" name="giamua" placeholder="Nhập giá" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationDefault02">Giá bán</label>
            <input type="number" class="form-control" id="validationDefault02" value="<?= $sanpham->GiaBan ?>" name="giaban" placeholder="Nhập giá.." required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationDefault02">Số lượng</label>
            <input type="number" class="form-control" id="validationDefault02" value="<?= $sanpham->SoLuong ?>" name="soluong" placeholder="Nhập số lượng" required>
        </div>
   
        <div class="col-md-4 mb-3">
            <label for="validationDefault02">Số lượng tối đa</label>
            <input type="number" class="form-control" id="validationDefault02" value="<?= $sanpham->Max ?>" name="max" placeholder="Nhập số lượng">
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationDefault02">Số lượng tối thiểu</label>
            <input type="number" class="form-control" id="validationDefault02" value="<?= $sanpham->Min ?>" name="min" placeholder="Nhập số lượng">
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationDefault02">Đơn Vị tính</label>
            <select class="form-control" id="lsp_ma"  name="dvt">
                <?php foreach ($donvi as $item) {
        if      ($sanpham->IdDVT ==$item->Id){
            echo "<option value=".$item->Id." selected>".$item->DonVi ."</option>";
        }
        else {
            echo "<option value=".$item->Id.">".$item->DonVi ."</option>";
        }
                } ?>
            </select>
        </div>   
        <div class="col-md-4 mb-3">
            <label for="validationDefault02">Nhà cung cấp</label>
            <select class="form-control" id="lsp_ma"  name="ncc">
                <?php foreach ($nhacc as $item) {
                    if      ($sanpham->IdNCC == $item->Id){
                        echo "<option value=".$item->Id." selected>".$item->TenNCC ."</option>";
                    }
                    else {
                    echo "<option value=".$item->Id.">".$item->TenNCC ."</option>";
                    }
                } ?>
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationDefault02">Kho lưu trữ</label>
            <select class="form-control" id="khoId"  name="khoId" required="required">
            <option  selected="true" disabled="disabled">Chọn kho</option>;
            <?php foreach ($khohang as $item) {
                    if      ($sanpham->khoId == $item->id){
                        echo "<option value=".$item->id." selected>".$item->ten ."</option>";
                    }
                    else {
                    echo "<option value=".$item->id.">".$item->ten ."</option>";
                    }
                } ?>
               
            </select>
            </div>
        <div class="col-md-4 mb-3">
          <button type="submit" name="create-sp" class=" mt-2 btn-danger btn">Update</button>
        </div>
    </div>
</form>
<div>


<?php
if(isset($_POST['create-sp'])){
    $ten= $_POST["tensp"];
    $id = $sanpham->Id;
    $dvt= $_POST["dvt"];
    $ncc= $_POST["ncc"];
    $giamua= $_POST["giamua"];
    $giaban= $_POST["giaban"];
    $soluong= $_POST["soluong"];
    $khoId= $_POST["khoId"];
    $max= $_POST["max"];
    $min= $_POST["min"];
    SanPham::update($id,$ten,$dvt,$ncc,$giamua,$giaban,$soluong, $max, $min, $khoId);
}
?>

