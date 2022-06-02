<?php
require_once ('controllers/base_controller.php');
require_once ('models/sanpham.php');
require_once ('models/donvitinh.php');
require_once ('models/nhacungcap.php');
require_once ('models/khohang.php');
class SanPhamController extends BaseController
{
    function __construct()
    {
        $this->folder='sanpham';
    }
    public function index()
    {
        $sanpham = SanPham::all();
        $data =array('sanpham'=>$sanpham);
        $this->render('index',$data);
    }
    public function insert()
    {
        $donvis = DonViTinh::all();
        $nhacc = NhaCungCap::all();
        $khohang = KhoHang::all();
        $data =array('donvi'=> $donvis,'nhacc'=> $nhacc, 'khohang' => $khohang);
        $this->render('insert', $data);
    }
    public function edit()
    {
        $sanpham = SanPham::find($_GET['id']);
        $donvis = DonViTinh::all();
        $nhacc = NhaCungCap::all();
        $khohang = KhoHang::all();
        $data =array('donvi'=> $donvis,'nhacc'=> $nhacc, 'khohang' => $khohang, 'sanpham'=>$sanpham);
        $this->render('edit', $data);
    }

    public function detail()
    {
        $sanpham = SanPham::find($_GET['id']);
        $donvis = DonViTinh::all();
        $nhacc = NhaCungCap::all();
        $khohang = KhoHang::all();
        $data =array('donvi'=> $donvis,'nhacc'=> $nhacc, 'khohang' => $khohang, 'sanpham'=>$sanpham);
        $this->render('detail', $data);
    }

   
}