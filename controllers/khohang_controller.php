<?php
require_once ('controllers/base_controller.php');
require_once ('models/khohang.php');
require_once ('models/nhanvien.php');
require_once ('models/sanpham.php');
class KhoHangController extends BaseController
{
    function  __construct()
    {
        $this->folder = 'khohang';
    }
    public function index()
    {
        $khohang = KhoHang::owner();
        $data = array('khohang'=> $khohang);
        if(count($khohang) == 0) {

            $this->render('empty',$data);
        } else {

            $this->render('index',$data);
        }
    }
    public function insert()
    {
        $nhanvien = NhanVien::getManager();
        $data = array('nhanvien' => $nhanvien);
        $this->render('insert',  $data);
    }
    public function detail()
    {
        $kho = KhoHang::find($_GET['id']);
        $nhanvien = NhanVien::all();
        $sanpham = SanPham::findByKho($_GET['id']);
        $data = array('khohang' => $kho, 'nhanvien' => $nhanvien, 'sanpham' => $sanpham);
        $this->render('detail', $data);
    }

    public function edit()
    {
        $kho = KhoHang::find($_GET['id']);
        $nhanvien = NhanVien::all();
        $data = array('khohang' => $kho, 'nhanvien' => $nhanvien);
        $this->render('edit', $data);
    }

    public function thekho(){
        $sanpham = SanPham::findByKho($_GET['id']);
        $data = array('sanpham' => $sanpham);
        $this->render('thekho', $data);
    }

}