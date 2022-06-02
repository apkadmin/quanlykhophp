
<?php
require_once ('controllers/base_controller.php');
require_once ('models/donban.php');
require_once ('models/nhacungcap.php');
require_once ('models/nhanvien.php');
require_once ('models/donvitinh.php');
require_once ('models/khohang.php');
require_once ('models/sanpham.php');
require_once ('models/khachhang.php');
require_once ('models/nhanvien.php');
require_once ('models/chitietban.php');

class DonBanController extends BaseController
{
    function  __construct()
    {
        $this->folder = 'donban';
    }
    public function  index()
    {
        $donban = DonBan::all();
        $data =array('donban'=> $donban);
        $this->render('index',$data);
    }
    public function  insert()
    {
        $donvi = DonViTinh::all();
        $khohang = KhoHang::all();
        $sanpham = SanPham::all();
        $nhanvien = NhanVien::all();
        $khachhang = KhachHang::all();
        $data =array('sanpham'=> $sanpham, 'khohang' => $khohang, 'donvi' => $donvi, 'nhanvien' => $nhanvien, 'khachhang' => $khachhang);
        $this->render('insert',$data );
    }
    public function  detail()
    {
        $donban = DonBan::find($_GET['id']);
        $data = array('donban' => $donban);
        $this->render('detail', $data);
    }
    public function  print()
    {
        $donban = DonBan::find($_GET['id']);
        $data = array('donban' => $donban);
        $this->render('print', $data);
    }

}
