<div>
<div class="ml-5 row" style="justify-content: space-between;">
    <h4><a href="index.php?controller=sanpham">Sản phẩm</a> > Thêm mới</h4>
</div>
<form method="post" name="create-sp">
    <div class="form-group row ml-5">
        <div class="col-md-4 mb-3">
            <label for="validationDefault01">Tên Sản Phẩm</label>
            <input type="text" class="form-control" id="validationDefault01"  name="tensp" placeholder="Tên Sản Phẩm" required>
        </div>
      
       
        <div class="col-md-4 mb-3">
            <label for="validationDefault02">Giá Mua</label>
            <input type="number" class="form-control" id="validationDefault02" name="giamua" placeholder="Nhập giá" required min="0">
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationDefault02">Giá bán</label>
            <input type="number" class="form-control" id="validationDefault02"  name="giaban" placeholder="Nhập giá.."  min="0" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationDefault02">Số lượng</label>
            <input type="number" class="form-control" id="validationDefault02" name="soluong" placeholder="Nhập số lượng"  min="0" required>
        </div>
   
        <div class="col-md-4 mb-3">
            <label for="validationDefault02">Số lượng tối đa</label>
            <input type="number" class="form-control" id="validationDefault02"  name="max" placeholder="Nhập số lượng"  min="0" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationDefault02">Số lượng tối thiểu</label>
            <input type="number" class="form-control" id="validationDefault02"  name="min" placeholder="Nhập số lượng"  min="0" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationDefault02">Đơn Vị tính</label>
            <select class="form-control" id="lsp_ma"  name="dvt" required>
                <option selected="true" value=""  disabled>Đơn vị tính</option>
                <?php foreach ($donvi as $item) {
     
                    echo "<option value=".$item->Id.">".$item->DonVi ."</option>";
        
                } ?>
            </select>
        </div>   
        <div class="col-md-4 mb-3">
            <label for="validationDefault02">Nhà cung cấp</label>
            <select class="form-control" id="lsp_ma"  name="ncc" required>
            <option  selected="true" value="" disabled="disabled">Chọn nhà cung cấp</option>;
                <?php foreach ($nhacc as $item) {
                    echo "<option value=".$item->Id.">".$item->TenNCC ."</option>";
                } ?>
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationDefault02">Kho lưu trữ</label>
            <select class="form-control" id="khoId"  name="khoId" required>
            <option  selected="true" value="" disabled="disabled">Chọn kho</option>;
            <?php foreach ($khohang as $item) {
                    echo "<option value=".$item->id.">".$item->ten ."</option>";
                } ?>
               
            </select>
            </div>
        <div class="col-md-4 mb-3">
          <button type="submit" name="create-sp" class=" mt-2 btn-danger btn">Thêm mới</button>
        </div>
    </div>
</form>
<?php
if(isset($_POST['create-sp'])){
    $ten= $_POST["tensp"];
    $dvt= $_POST["dvt"];
    $ncc= $_POST["ncc"];
    $giamua= $_POST["giamua"];
    $giaban= $_POST["giaban"];
    $soluong= $_POST["soluong"];
    $khoId= $_POST["khoId"];
    $max= $_POST["max"];
    $min= $_POST["min"];
    SanPham::add($ten,$dvt,$ncc,$giamua,$giaban,$soluong, $max, $min, $khoId);
}
?>

