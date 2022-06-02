<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="ml-3 row" style="justify-content: space-between;">
            <h4><a href="index.php?controller=sanpham">Sản phẩm</a> > Chi tiết</h4>
            <div>
                <a href="index.php?controller=sanpham&action=edit&id='<?=$sanpham->Id?>'" class="btn btn-primary mr-3">Edit</a>
            </div>
        </div>
        </div>
    </div>
    <div class="card-body">
    <div class="form-group row ml-5">
       
       <div class="col-md-4 mb-3">
           <label for="validationDefault01">Tên Sản Phẩm</label>
           <input type="text" disabled class="form-control" id="validationDefault01" value="<?= $sanpham->TenSP ?>" name="tensp" placeholder="Tên Sản Phẩm" required>
       </div>
     
      
       <div class="col-md-4 mb-3">
           <label for="validationDefault02">Giá Mua</label>
           <input type="number" disabled class="form-control" value="<?= $sanpham->GiaMua ?>" id="validationDefault02" name="giamua" placeholder="Nhập giá" required>
       </div>
       <div class="col-md-4 mb-3">
           <label for="validationDefault02">Giá bán</label>
           <input type="number" disabled class="form-control" id="validationDefault02" value="<?= $sanpham->GiaBan ?>" name="giaban" placeholder="Nhập giá.." required>
       </div>
       <div class="col-md-4 mb-3">
           <label for="validationDefault02">Số lượng</label>
           <input type="number" disabled class="form-control" id="validationDefault02" value="<?= $sanpham->SoLuong ?>" name="soluong" placeholder="Nhập số lượng" required>
       </div>
  
       <div class="col-md-4 mb-3">
           <label for="validationDefault02">Số lượng tối đa</label>
           <input type="number" disabled class="form-control" id="validationDefault02" value="<?= $sanpham->Max ?>" name="max" placeholder="Nhập số lượng">
       </div>
       <div class="col-md-4 mb-3">
           <label for="validationDefault02">Số lượng tối thiểu</label>
           <input type="number" disabled class="form-control" id="validationDefault02" value="<?= $sanpham->Min ?>" name="min" placeholder="Nhập số lượng">
       </div>
       <div class="col-md-4 mb-3">
           <label for="validationDefault02">Đơn Vị tính</label>
           <select class="form-control" id="lsp_ma"  name="dvt" disabled>
               <?php foreach ($donvi as $item) {
       if      ($sanpham->IdDVT ==$item->Id){
           echo "<option value=".$item->Id." selected>".$item->DonVi ."</option>";
       }
    
               } ?>
           </select>
       </div>   
       <div class="col-md-4 mb-3">
           <label for="validationDefault02">Nhà cung cấp</label>
           <select class="form-control" id="lsp_ma"  name="ncc" disabled>
               <?php foreach ($nhacc as $item) {
                   if      ($sanpham->IdNCC == $item->Id){
                       echo "<option value=".$item->Id." selected>".$item->TenNCC ."</option>";
                   }
               } ?>
           </select>
       </div>
       <div class="col-md-4 mb-3">
           <label for="validationDefault02">Kho lưu trữ</label>
           <select class="form-control" id="khoId"  name="khoId" disabled>
           <?php foreach ($khohang as $item) {
                   if      ($sanpham->khoId == $item->id){
                       echo "<option value=".$item->id." selected>".$item->ten ."</option>";
                   }
               } ?>
              
           </select>
           </div>
   </div>


<div>

  