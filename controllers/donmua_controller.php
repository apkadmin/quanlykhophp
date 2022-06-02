
<?php
require_once ('controllers/base_controller.php');
require_once ('models/donmua.php');
require_once ('models/nhacungcap.php');
require_once ('models/nhanvien.php');
require_once ('models/donvitinh.php');
require_once ('models/chitietmua.php');
require_once ('models/khohang.php');
require_once ('models/sanpham.php');
class DonMuaController extends BaseController
{
    function  __construct()
    {
        $this->folder = 'donmua';
    }
    public function  index()
    {
        $donmua = DonMua::all();
        $data =array('donmua'=> $donmua);
        
        $this->render('index',$data);
    }
    public function  insert()
    {
        $nhanvien = NhanVien::all();
        $nhacc = NhaCungCap::all();
        $donvi = DonViTinh::all();
        $khohang = KhoHang::owner();
        $data = array('nhanvien' => $nhanvien, 'nhacc' => $nhacc, 'donvi' => $donvi, 'khohang' => $khohang);
        if(count($khohang) == 0) {
            $this->render('empty', $data);
        } else {

            $this->render('insert', $data);
        }
    }
    public function detail()
    {
        $donmua = DonMua::find($_GET['id']);
        $data = array('donmua' => $donmua);
        $this->render('detail', $data);
    }
    public function  print()
    {
        $donmua = DonMua::find($_GET['id']);
        $data = array('donmua' => $donmua);
        $this->render('print', $data);
    }

}
