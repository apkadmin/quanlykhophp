<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="ml-3 row" style="justify-content: space-between;">
            <h4><a href="index.php?controller=khohang">Kho hàng</a> > Chi tiết</h4>
        </div>
    </div>
</div>
<div class="card-body">
    <fieldset style="border-collapse: collapse;border: 1px solid red" class="ml-5 mr-5">
        <legend class="ml-2">Kho hàng</legend>
        <div>
            <div class="row ml-5">
                <div class="col-md-4 mb-3">
                    <label for="validationDefault01">Tên kho</label>
                    <input type="text" class="form-control" id="validationDefault01" value="<?= $khohang->ten ?> "
                        disabled name="tenkho" placeholder="Tên kho" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationDefault02">Địa chỉ</label>
                    <input type="text" class="form-control" id="validationDefault02" value="<?= $khohang->diachi ?> "
                        disabled name="diachi" placeholder="Địa chỉ" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="validationDefault02">Người quản lý</label>
                    <!-- <input type="text" class="form-control" id="validationDefault02" value="<?= $khohang->thukho ?> " name="email" placeholder="Nhập Email" required> -->
                    <select class="form-control" name="nhanvien" disabled>
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
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset style="border-collapse: collapse;border: 1px solid red" class="ml-5 mr-5">
        <legend class="ml-2">Sản phẩm</legend>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Số tối đa</th>
                        <th>Số tối thiểu</th>
                        <th>Giá mua</th>
                        <th>Giá bán</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                
  $dem = 1;
                foreach ($sanpham as $item){
                    ?>

                    <tr onclick="showDetail('sanpham','<?=$item->Id?>')">
                        <td><?=$dem  ?></td>
                        <td><?=$item->TenSP?></td>

                        <td><?=$item->SoLuong?>
                            <br>
                            <span style="color: red;"><?php
                                if (($item->SoLuong) > ($item->SLMax)) {
                                    echo "Sản phẩm trong kho đang nhiều";
                                }
                                if (($item->SoLuong) < ($item->SLMin)) {
                                    echo "Sản phẩm trong kho đang sắp hết";
                                }
                            ?></span>
                        </td>
                        <td><?=$item->SLMax?>
                        <td><?=$item->SLMin?>
                        <td>
                            <?=number_format($item->GiaMua, 0,"." , ",") ?></td>
                        <td>
                            <?= number_format($item->GiaBan, 0,"." , ",")?></td>

                        </td>

                    </tr>
                    <?php
                    $dem += 1;
                }
                ?>
                </tbody>
            </table>
        </div>
    </fieldset>
</div>