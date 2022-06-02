<?php
require_once ('controllers/base_controller.php');
require_once ('models/khohang.php');
require_once ('models/nhanvien.php');
require_once ('models/sanpham.php');
class BaocaoController extends BaseController
{
    function  __construct()
    {
        $this->folder = 'baocao';
    }
    public function index()
    {
        $khohang = KhoHang::all();
        $data = array('khohang'=> $khohang);
        $this->render('index',$data);
    }

}