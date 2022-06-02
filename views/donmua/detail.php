<?php
require_once ('models/chitietmua.php');
$list =[];
$db =DB::getInstance();
$reg = $db->query('SELECT chitietmua.Id,sanpham.TenSP, khohang.ten, chitietmua.GiaMua, chitietmua.ThanhTien, donvitinh.DonVi, chitietmua.SoLuong  FROM chitietmua JOIN sanpham JOIN donvitinh JOIN khohang ON chitietmua.TenSP = sanpham.Id AND donvitinh.Id = chitietmua.IdDVT AND khohang.id = sanpham.khoId WHERE chitietmua.IdDonMua='.$donmua->Id);


?>
    <h1 class="h3 mb-2 text-center text-gray-800 ">Chi tiết đơn</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông tin đơn</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ngày Bán</th>
                        <th>Nhân Viên</th>
                        <th>Nhà Cung Cấp</th>
                        <th>Tổng tiền</th>
                        <th>Trạng Thái</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td><?=$donmua->Id ?></td>
                        <td><?=  date('d/m/Y', strtotime($donmua->NgayMua))?></td>
                        <td><?=$donmua->IdNV ?></td>
                        <td><?=$donmua->IdNCC ?></td>
                        <td><?=number_format($donmua->ThanhTien,0,",",".") ?> VNĐ</td>
                        <td><?php
                            if ($donmua->TrangThai=="1")
                                echo "Đã Thanh Toán";
                            else echo "Chưa thanh toán";

                            ?></td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chi Tiết Đơn</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Sản Phẩm</th>
                        <th>Kho</th>
                        <th>Số Lượng</th>
                        <th>Đơn Giá</th>
                        <th>Thành Tiền</th>

                    </tr>
                    </thead>

                    <tbody>

                    <?php
                    $dem=1;
                    foreach ($reg->fetchAll() as $item){
                        echo  "<tr><td>$dem</td>";
                        echo  "<td>".$item['TenSP']."</td>";
                        echo "<td>".$item['ten']."</td>";
                        echo  "<td>".$item['SoLuong']." (".$item['DonVi'].")</td>";
                        echo  "<td>". number_format($item['GiaMua'],0,",",".")." VNĐ</td>";                       
                        echo  "<td>". number_format($item['ThanhTien'],0,",",".")." VNĐ</td>";
                        $dem++;
                    }
                    ?>

                    </tbody>
                </table>

            </div>
        </div>
        <form method="post" name="dc">
            <?php

            if ($donmua->TrangThai=="1"){ ?>
                <button type="submit" class="btn-outline-primary btn"  disabled >Đã Thanh Toán</button>
                <button type="submit"  class="btn-outline-primary btn" name="chua" >Chưa Thanh Toán</button>
                <?php

            }
            else {
                ?>
                <button type="submit"  class="btn-outline-primary btn" name="thanhtoan" >Đã Thanh Toán</button>
                <button type="submit"  class="btn-outline-primary btn" disabled>Chưa Thanh Toán</button>
            <?php } ?>
        </form>
    </div>
<?php

if (isset($_POST['chua'])) {
    donmua::chuathanhtoan($donmua->Id);
}
if (isset($_POST['thanhtoan'])) {
    donmua::thanhtoan($donmua->Id);
}

?>