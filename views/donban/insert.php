<form method="post" name="add">
    <div class="form-group">
        <FIELDSET style="border-collapse: collapse;border: 1px solid red" class="ml-5 mr-5">
            <legend class="ml-2">Đơn hàng</legend>
            <div class="form-group ml-5 row">
                <div class="col-md-4">
                    <label for="validationDefault01">Khách Hàng</label>
                    <select class="form-control" name="khachhang" required>
                        <optgroup style="color: #1cc6a4" label="Chọn Khách Hàng">
                            <?php
                foreach ($khachhang as $item){
                    echo  "<option value='$item->Id'>".$item->TenKH."</option>";
                }
                ?>
                        </optgroup>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="validationDefault02">Ngày bán</label>
                    <input type="datetime-local" class="form-control" name="ngayban" id="ngayban" required>
                </div>
                <div class="col-md-4">
                <label for="validationDefault02">Trạng thái</label>
                <select class="form-control" name="trangthai" required>
                <optgroup style="color: #1cc6a4" label="Chọn Khách Hàng">
                    <option value="1">Đã thanh toán</option>
                    <option value="0">Chưa thanh toán</option>
            </optgroup>
                </select>
            </div>
            </div>
        </FIELDSET>
        <!--   end //-->
        <FIELDSET style="border-collapse: collapse;border: 1px solid red" class="mt-5 ml-5 mr-5">
            <legend class="ml-2">Chi tiết đơn</legend>
            <div class="form-row ml-4">

                <div class="col-md-4 form-group mb-3">
                    <label class="" for="validationDefault01">Sản Phẩm</label>
                    <select class="form-control" id="sp_ma" name="sp_ma">
                        <optgroup label="chọn sản phẩm">
                            <?php
                   foreach ($sanpham as $item){
                       echo "<option value='$item->Id' data-sp_sl='$item->SoLuong' data-sp_gia='$item->GiaBan' >".$item->TenSP."</option>";
                   }
                   ?>
                        </optgroup>
                    </select>
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label for="validationDefault01">Số lượng</label>
                    <input type="number" class="form-control" value="1" id="soluong" name="soluong"
                        placeholder="Số lượng">
                </div>
                <div class="col-md-1 form-group mb-3">
                    <label for="validationDefault01">Action</label>

                    <input class="form-control btn btn-outline-primary" type="button" id="btnThemSanPham" value="thêm">
                </div>

            </div>

            <table id="tblChiTietDonHang" class="table table-bordered">
                <thead>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                    <th>Hành động</th>
                </thead>
                <tbody>
                </tbody>

                <tfoot>
                <th >Tổng tiền:</th>
                    <th ><span id="total">0</span> VND</th>
                </tfoot>
            </table>
        </FIELDSET>
        <button type="submit" name="add" class=" mt-2 ml-5 btn-danger btn">Tạo </button>
    </div>

</form>
<script>
// window.addEventListener('load', () => {
//     const now = new Date();
//     now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
//     document.getElementById('ngayban').value = now.toISOString().slice(0, -1);
// });
</script>
<?php


// mảng array do đặt tên name="sp_dh_dongia[]"
if (isset($_POST['add'])){
    $arr_sp_ma = $_POST['sp_ma'];                   // mảng array do đặt tên name="sp_ma[]"
    $arr_sp_dh_soluong = $_POST['sp_dh_soluong'];   // mảng array do đặt tên name="sp_dh_soluong[]"
    $arr_sp_dh_dongia = $_POST['sp_dh_dongia'];// mảng array do đặt tên name="sp_dh_dongia[]"
    $arr_sp = $_POST['sp_dh_sl'];
    $arr_sp_dh_tong=[];
    $tongdon=0;
    $date = date('m/d/Y h:i:s a', time());
  for ($i = 0;$i< count($arr_sp_ma);$i++){
    $arr_sp_dh_tong[$i] = $arr_sp_dh_soluong[$i]*$arr_sp_dh_dongia[$i];
      $tongdon+=$arr_sp_dh_tong[$i];
  }
//    echo print_r($arr_sp_dh_tong);
//    echo  number_format($tongdon,0,".",",");


    //khach hàng đơn
    $khachhang = $_POST['khachhang']; //id khach hang
    $nhanvien = $_SESSION['userId'];     //id nhan vien
    $ngayban = $_POST['ngayban'];   //trang thai don
    $ThanhToan = 0;
    $trangthai = $_POST['trangthai'];
    // if($ThanhToan >= $tongdon) {
    //     $trangthai = 1;
    // }
    DonBan::add($ngayban,$nhanvien,$khachhang,$tongdon,$trangthai, $ThanhToan);
    $donban = [];
    $db_db =DB::getInstance();
    $reg_db = $db_db->query('SELECT * FROM DonBan ORDER BY Id DESC');
    foreach ($reg_db->fetchAll() as $item){
        $donban[] =new DonBan($item['Id'],$item['NgayBan'],$item['IdNV'],$item['IdKH'],$item['Tong'],$item['TrangThai'], $item['ThanhToan']);;
    }
    $IdDon = $donban[0]->Id;
    for($i = 0; $i < count($arr_sp_ma); $i++) {

        $sp_ma = $arr_sp_ma[$i];
        $sp_dh_soluong = $arr_sp_dh_soluong[$i];
        $sp_dh_dongia = $arr_sp_dh_dongia[$i];
        $thanhtien =$arr_sp_dh_tong[$i];
        $soluongcu = $arr_sp[$i];
    ChiTietBan::add($IdDon,$sp_ma,0,$sp_dh_dongia,$sp_dh_soluong,$thanhtien, $soluongcu);
    SanPham::updatesl($sp_ma,$soluongcu-$sp_dh_soluong);
    }
        header('location:index.php?controller=donban');
}
?>