<form  method="post" name="add">
    <div class="form-group">
        <FIELDSET style="border-collapse: collapse;border: 1px solid red" class="ml-5 mr-5">
            <legend class="ml-2">Đơn hàng</legend>
            <div class="row ml-3 mr-3">
                <div class="col-md-4 mb-3">
                    <label for="validationDefault01">Nhà Cung Cấp</label>
                    <select class="form-control" name="nhacungcap" id="nhacc" onChange = "selectNCC(this)" required="required">
                        <option style="color: #1cc6a4" disabled value="" selected> Chọn Nhà cung cấp</option>
                            <?php
                            foreach ($nhacc as $item){
                                echo  "<option value='$item->Id'>".$item->TenNCC."</option>";
                            }
                            ?>
                    </select>
                </div>
                <div class="form-group col-md-4 ">
                    <label for="validationDefault02">Ngày Nhập</label>
                    <input type="datetime-local" class="form-control" name="ngaynhap" required="required">
                </div>
                <div class="form-group col-md-4">
                    <label for="validationDefault02">Trạng thái</label>
                    <select class="form-control" name="trangthai" required="required" >
                        <option value="">Chọn trạng thái</option>
                        <option value="1">Đã thanh toán</option>
                        <option value="0">Chưa thanh toán</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="validationDefault02">Nhân viên giao hàng</label>
                    <select class="form-control " name="nhanvien" required="required">
                        <?php
                        foreach ($nhanvien as $item){
                            if ($item->TaiKhoan == $_SESSION['username'])
                                echo "<option value='$item->Id'>".$item->TenNV."</option>";
                        }
                        ?>

                    </select>
                </div>

            </div>
        </FIELDSET>
        <!--   end //-->
        <FIELDSET style="border-collapse: collapse;border: 1px solid red" class="mt-5 ml-5 mr-5">
            <legend class="ml-2">Chi tiết đơn</legend>
            <div class="form-row ml-4">

                <div class="col-md-3 form-group mb-3 mr-3">
                    <label class="" for="validationDefault01">Sản Phẩm</label>
                    <input  class="form-control" list="product" onChange="selectProduct(this)"  id="tensp" name="tensp"  placeholder="Tên" autocomplete="off" />
                    <datalist id="product">

                    </datalist>

                </div>
                <div class="col-md-3 form-group mb-3 mr-3">
                    <label for="validationDefault01">Giá</label>
                    <input type="number" class="form-control"  id="gia" name="gia"  placeholder="Giá" >
                </div>
                <div class="col-md-3 form-group mb-3 mr-3">
                    <label for="validationDefault01">Số lượng</label>
                    <input type="number" class="form-control" value="1" min="0" id="soluong" name="soluong"  placeholder="Số lượng" >
                </div>
                <div class="col-md-3 form-group mb-3 mr-3">
                    <label for="validationDefault01">Đơn vị</label>
                    <input type="text" class="form-control" onChange="onSelectDVT(this)" id="donvi" name="donvi" list="donvimua"  placeholder="Đơn vị" >
                    <datalist id="donvimua">
                        <?php
                    foreach ($donvi as $item){
                         echo "<option value='$item->DonVi'></option>";
                    }
                        ?>
                    </datalist>
                </div>

                <div class="col-md-3 form-group mb-3 mr-3">
                    <label for="validationDefault01">Kho</label>
                    <select class="form-control" id="kho" name="kho" placeholder="Kho" >
                        <?php
                        foreach ($khohang as $item){
                            echo "<option value='$item->id'>$item->ten</option>";
                        }
                        ?>
                        </select>
                </div>
                <div class="col-md-1 form-group mb-3">
                    <label for="validationDefault01">Action</label>
                    <input type="button" class="form-control btn btn-outline-primary" id="btnThemSanPhammua" value="thêm">
                </div>
                <input type="hidden" name="productId" value="-1" id="productId"/>
                <input type="hidden" name="dvtId" id="dvtId" value="-1"/>
                <input type="hidden" name="soluongOld" id="soluongOld"/>
                <input type="hidden" name="khoId" id="khoId"/>
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
                <th colspan="3">Tổng tiền</th>
                <th colspan="2"><span  id="total">0</span><span>VNĐ</span></th>
                </tfoot>
            </table>
        </FIELDSET>
        <button type="submit" name="add" class=" mt-2 ml-5 btn-danger btn">Tạo </button>
    </div>

</form>
<script>
    var listProduct = [];
    var listKho = [];
    var listDonvi = [];

    //su kien chon ncc
    function selectNCC(thiz){
        $('#tblChiTietDonHang tbody').html("");
        $('#total').html("0");
        fetch("api/product.php?nccId="+thiz.value).then(res => res.json()).then(result=> {
          console.log(result['data'].length);
          let select = document.getElementById('product');
            if(result['data'].length > 0) {
            
                if (select != null) {
                    select.innerHTML = "";
                    listProduct = result['data'];
                    listProduct.forEach(item => {
                        let opt = document.createElement("option");
                        opt.value = item.TenSP
                       
                        select.append(opt)
                    })
                    if (listProduct.length > 0) {
                    document.getElementById("tensp").value =  listProduct[0].TenSP;
                    document.getElementById("gia").value = listProduct[0].GiaMua
                    document.getElementById("productId").value = listProduct[0].Id;
                    var dv = listDonvi.filter(item=> item.Id == listProduct[0].IdDVT);
                    document.getElementById("donvi").value = dv[0].DonVi;
                    document.getElementById("donvi").disabled  = true;
                    document.getElementById("dvtId").value= dv[0].Id;
                    document.getElementById("soluongOld").value = listProduct[0].SoLuong;
                    document.getElementById("kho").disabled  = true;
                    document.getElementById("kho").value=  listProduct[0].khoId;
                    }

                }
            } else {
                select.innerHTML = "";
                document.getElementById("tensp").value =  "";
                document.getElementById("gia").value = "0";
                document.getElementById("productId").value = "-1";           
                document.getElementById("donvi").value = "";
                document.getElementById("donvi").disabled  = false;
                document.getElementById("dvtId").value= "";
                document.getElementById("soluongOld").value = "0";
                document.getElementById("kho").disabled  = false;
            }
        })
    }
    //sukien chon san pham
    function selectProduct(thiz){
        let nccEl = document.getElementById("nhacc");
        if (nccEl.value == "") {
            thiz.value = "";
            alert("Bạn cần chọn nhà cung cấp trước");
        
        } else {
            var listItem = listProduct.filter(item => item.TenSP == thiz.value);
        if(listItem.length > 0) {
            document.getElementById("gia").value = listItem[0].GiaMua;
            document.getElementById("productId").value = listItem[0].Id;
            var dv = listDonvi.filter(item=> item.Id == listItem[0].IdDVT);
            document.getElementById("donvi").value = dv[0].DonVi;
            document.getElementById("donvi").disabled  = true;
            document.getElementById("dvtId").value= dv[0].Id;
            document.getElementById("kho").disabled  = true;
            document.getElementById("soluongOld").value = listItem[0].SoLuong;
            document.getElementById("kho").value= listItem[0].khoId;
        } else {
            document.getElementById("gia").value = ""
            document.getElementById("productId").value = "-1"
            document.getElementById("donvi").disabled  = false
            document.getElementById("kho").disabled  = false;
            document.getElementById("soluongOld").value = "0";
        }
        }
       
    }
    //su kien chon don vi tinh
    function onSelectDVT(thiz){
        var dv = listDonvi.filter(item=> item.DonVi == thiz.value);
        if(dv.length > 0) {
            document.getElementById("donvi").value = dv[0].DonVi;
            document.getElementById("dvtId").value= dv[0].Id;
        } else {
            document.getElementById("dvtId").value= "-1";
        }
          
    }
//lay danh sach kho va don vi tinh
    (function(){
        fetch("api/kho.php").then(res => res.json()).then(result=> {
            if(result['data'].length > 0) {
                listKho = result['data'];
            }
        })
        fetch("api/donvi.php").then(res => res.json()).then(result=> {
            if(result['data'].length > 0) {
                listDonvi = result['data'];
            }
        })
    })()

</script>
<?php


// mảng array do đặt tên name="sp_dh_dongia[]"
if (isset($_POST['add'])){
    $arr_sp_ma = $_POST['sp_ma'];    
    $arr_sp_ten = $_POST['sp_dh_spten'];               // mảng array do đặt tên name="sp_ma[]"
    $arr_sp_dh_soluong = $_POST['sp_dh_soluong'];   // mảng array do đặt tên name="sp_dh_soluong[]"
    $arr_sp_dh_dongia = $_POST['sp_dh_dongia'];     // mảng array do đặt tên name="sp_dh_dongia[]"
    $arr_sp_dh_dvt = $_POST['sp_dh_dvt'];     // mảng array do đặt tên name="sp_dh_dongia[]"
    $arr_sp_dh_dvt_name = $_POST['sp_dh_dvt_name'];
    $arr_sp_dh_kho = $_POST['sp_dh_kho'];  //mảng array do đặt tên name="sp_dh_kho[]"
    $arr_sp_dh_soluongold = $_POST['sp_dh_soluongold'];
    $arr_sp_dh_tong=[];
   
    $tongdon=0;
    $date = date('m/d/Y h:i:s a', time());
    for ($i = 0;$i< count($arr_sp_ma);$i++){
        $arr_sp_dh_tong[$i] = $arr_sp_dh_soluong[$i]*$arr_sp_dh_dongia[$i];
        $tongdon+=$arr_sp_dh_tong[$i];
    }

    //khach hàng đơn
    $nhacungcap = $_POST['nhacungcap']; //id khach hang
    $nhanvien = $_POST['nhanvien'];     //id nhan vien
    $trangthai = $_POST['trangthai'];   //trang thai don
    $ngaynhap = $_POST['ngaynhap'];   //trang thai don
     DonMua::add($ngaynhap,$nhanvien,$nhacungcap,$tongdon,$trangthai);

    $donban = [];
    $db_db =DB::getInstance();
    $reg_db = $db_db->query('SELECT * FROM DonMua ORDER BY Id DESC');
    foreach ($reg_db->fetchAll() as $item){
        $donban[] =new DonMua($item['Id'],$item['NgayMua'],$item['IdNV'],$item['IdNCC'],$item['ThanhTien'],$item['TrangThai']);;
    }
    $IdDon = $donban[0]->Id;
    for($i = 0; $i < count($arr_sp_dh_dvt); $i++){
        if ($arr_sp_dh_dvt[$i] == -1) {
           $idDvt =  DonViTinh::addNew($arr_sp_dh_dvt_name[$i]);
            $arr_sp_dh_dvt[$i] = $idDvt;
        }
    }

    for($i = 0; $i < count($arr_sp_ma); $i++){
        if ($arr_sp_ma[$i] == -1) {
            var_dump($arr_sp_dh_dvt[$i]);
           $spNewId = SanPham::addNew($arr_sp_ten[$i], $arr_sp_dh_dvt[$i], $nhacungcap, $arr_sp_dh_dongia[$i], $arr_sp_dh_dongia[$i],$arr_sp_dh_soluong[$i], $arr_sp_dh_soluong[$i], 0,$arr_sp_dh_kho[$i] );
           $arr_sp_ma[$i] = $spNewId;
        } else {
           SanPham::updatesl($arr_sp_ma[$i], $arr_sp_dh_soluongold[$i] + $arr_sp_dh_soluong[$i] );

        }
    }
    
   

    for($i = 0; $i < count($arr_sp_ma); $i++) {
        $sp_ma = $arr_sp_ma[$i];
        $sp_dh_soluong = $arr_sp_dh_soluong[$i];
        $sp_dh_dvt =$arr_sp_dh_dvt[$i];
        $sp_dh_dongia = $arr_sp_dh_dongia[$i];
        $thanhtien =$arr_sp_dh_tong[$i];
        $slHientai = $arr_sp_dh_soluongold[$i];
         ChiTietMua::add($IdDon,$sp_ma,$sp_dh_dvt,$sp_dh_dongia,$sp_dh_soluong,$thanhtien,$slHientai);
    }
        header('location:index.php?controller=donmua');
}
?>
