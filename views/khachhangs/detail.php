<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="ml-3 row" style="justify-content: space-between;">
            <h4><a href="index.php?controller=khachhangs">Khách hàng</a> > Chi tiết</h4>
            <a href="index.php?controller=khachhangs&action=edit&id=<?=$khachhangs->Id?>" class="btn btn-primary mr-3">Edit</a>
        </div>
    </div>
</div>
<div class="card-body">
    <form method="post" name="create-kh">
        <div class="form-group row ml-5">
            <div class="col-md-4 mb-3">
                <label for="validationDefault01">Tên Khách Hàng</label>
                <input type="text" class="form-control" id="validationDefault01" name="tenkh" value="<?=$khachhangs->TenKH?>" placeholder="Tên"
                    disabled>
            </div>
            <div class="col-md-4 mb-3">
                <label for="sdt">Điện Thoại</label>
                <input type="phone" class="form-control" id="sdt" name="sdt" placeholder="Số điện thoại"  value="<?=$khachhangs->DienThoai?>"
                    disabled>
            </div>

            <div class="col-md-4 mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập Email"  value="<?=$khachhangs->Email?>"
                    disabled>
            </div>
            <div class="col-md-4 mb-3">
                <label for="diachi">Địa Chỉ</label>
                <input type="text" class="form-control" id="diachi" name="diachi"  value="<?=$khachhangs->DiaChi?>"
                    placeholder="Nhập Địa Chỉ.." disabled>
            </div>
            <div class="col-md-4 mb-3">
                <label for="shd">Số hợp đồng</label>
                <input type="text" class="form-control" id="shd" name="shd"  value="<?=$khachhangs->SHD?>"
                    placeholder="Nhập số hợp đồng..." disabled>
            </div>
            <div class="col-md-4 mb-3">
                <label for="shd">Ngày ký</label>
                <input type="date" class="form-control" id="ngayky" name="ngayky"  value="<?=$khachhangs->NgayKy?>"
                    placeholder="Ngày ký..." disabled>
            </div>
            <div class="col-md-4 mb-3">
                <label for="daidien">Người đại diện</label>
                <input type="text" class="form-control" id="daidien" name="daidien"  value="<?=$khachhangs->DaiDien?>"
                    placeholder="Đại diện..." disabled>
                    
            </div>
            <div class="col-md-4 mb-3">
                <label for="cmnd">Chứng minh thư</label>
                <input type="text" class="form-control" id="cmnd" name="cmnd"  value="<?=$khachhangs->CMND?>"
                    placeholder="Nhập số chứng minh thư.." disabled>
                    
            </div>
        </div>
    </form>
</div>