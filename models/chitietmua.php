<?php
class ChiTietMua{


    public $Id;
    public $IdDonMua;
    public $TenSP;
    public $IdDVT;
    public $GiaMua;
    public $SoLuong;
    public $ThanhTien;
    public $SLHienTai;


    function __construct($Id,$IdDonMua,$TenSP,$IdDVT,$GiaMua,$SoLuong,$ThanhTien, $SLHienTai)
    {
        $this->Id = $Id;
        $this->IdDonMua = $IdDonMua;
        $this->TenSP=  $TenSP;
        $this->IdDVT=  $IdDVT;
        $this->GiaMua = $GiaMua;
        $this->SoLuong = $SoLuong;
        $this->ThanhTien= $ThanhTien;
        $this->SLHienTai = $SLHienTai;
    }
    static function all()
    {
        $list =[];
        $db =DB::getInstance();
        $reg = $db->query('SELECT ct.Id ,db.Id As "Don",ct.TenSP ,dvt.DonVi ,ct.GiaMua,ct.SoLuong ,ct.ThanhTien,ct.SLHienTai FROM ChiTietMua ct JOIN DonViTinh dvt JOIN DonMua db ON ct.IdDonMua = db.Id AND dvt.Id = ct.IdDVT');
        foreach ($reg->fetchAll() as $item){
            $list[] =new ChiTietMua($item['Id'],$item['Don'],$item['TenSP'],$item['DonVi'],$item['GiaMua'],$item['SoLuong'],$item['ThanhTien'], $item['SLHienTai']);
        }
        return $list;
    }
    static function find($id)
    {
        $list =[];
        $db =DB::getInstance();
        $reg = $db->query('SELECT ct.Id ,db.Id As "Don",ct.TenSP ,dvt.DonVi ,ct.GiaMua,ct.SoLuong ,ct.ThanhTien, ct.SLHienTai FROM ChiTietMua ct JOIN DonViTinh dvt JOIN DonMua db ON ct.IdDonMua = db.Id AND dvt.Id = ct.IdDVT WHERE ct.IdDonMua='.$id);
        foreach ($reg->fetchAll() as $item){
            $list[] =new ChiTietMua($item['Id'],$item['Don'],$item['TenSP'],$item['DonVi'],$item['GiaMua'],$item['SoLuong'],$item['ThanhTien'],$item['SLHienTai']);
        }
        return $list;
    }
    static function add($IdDonHang,$IdSP,$IdDVT,$GiaMua,$SoLuong,$ThanhTien, $SLHienTai)
    {
        $db =DB::getInstance();
        $reg =$db->query('INSERT INTO ChiTietMua(IdDonMua,TenSP,IdDVT,GiaMua,SoLuong,ThanhTien,SLHienTai) VALUES ('.$IdDonHang.',"'.$IdSP.'",'.$IdDVT.','.$GiaMua.','.$SoLuong.','.$ThanhTien.','.(int)$SLHienTai.')');

    }

}
