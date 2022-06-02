<?php
class DonBan{

    public $Id;
    public $NgayBan;
    public $IdNV;
    public $IdKH;
    public $ThanhTien;
    public $TrangThai;
    public $ThanhToan;
    public $MAHD;


    function __construct($Id,$NgayBan,$IdNV,$IdKH,$ThanhTien,$TrangThai, $ThanhToan, $MAHD = "")
    {
        $this->Id = $Id;
        $this->NgayBan = $NgayBan;
        $this->IdNV =  $IdNV;
        $this->IdKH = $IdKH;
        $this->ThanhTien= $ThanhTien;
        $this->TrangThai= $TrangThai;
        $this->ThanhToan = $ThanhToan;
        $this->MAHD = $MAHD;
    }
    static function all()
    {
        $list =[];
        $db =DB::getInstance();
        $reg = $db->query('SELECT db.Id ,db.NgayBan , nv.TaiKhoan ,kh.TenKH ,db.Tong,db.TrangThai, db.ThanhToan FROM DonBan db JOIN NhanVien nv JOIN KhachHang kh ON nv.Id =db.IdNV AND kh.Id = db.IdKH');
        foreach ($reg->fetchAll() as $item){
            $list[] =new DonBan($item['Id'],$item['NgayBan'],$item['TaiKhoan'],$item['TenKH'],$item['Tong'],$item['TrangThai'], $item['ThanhToan']);
        }
        return $list;
    }
    static function find($id)
    {
        $db = DB::getInstance();
        $req = $db->prepare('SELECT db.Id ,db.NgayBan , nv.TaiKhoan ,kh.TenKH ,db.Tong,db.TrangThai, db.ThanhToan FROM DonBan db JOIN NhanVien nv JOIN KhachHang kh ON nv.Id =db.IdNV AND kh.Id = db.IdKH WHERE db.Id = :id');
        $req->execute(array('id' => $id));
        $item = $req->fetch();
        if (isset($item['Id'])) {
            return new DonBan($item['Id'],$item['NgayBan'],$item['TaiKhoan'],$item['TenKH'],$item['Tong'],$item['TrangThai'], $item['ThanhToan']);
        }
        return null;
    }
    static function add($ngayban,$IdNV,$IdKH,$Tong,$TrangThai,$ThanhToan)
    {
        $maHD = uniqid('HDB_');
        $db =DB::getInstance();
        $time = strtotime($ngayban);
        $ngay = date('Y-m-d H:i:s',$time);
        $sql = 'INSERT INTO donban(NgayBan,IdNV, IdKH, Tong, TrangThai, ThanhToan, MAHD) VALUES ("'.$ngay.'",'.$IdNV.','.$IdKH.','.$Tong.','.$TrangThai.', '.$ThanhToan.', "'.$maHD.'")';
        $reg =$db->query($sql);
    }
    static function  update($id,$DonBan)
    {
        $db = DB::getInstance();
        $reg =$db->query('UPDATE DonBan SET DonBan ="'.$DonBan.'" WHERE Id='.$id);
        header('location:index.php?controller=donban&action=index');
    }
    static function  thanhtoan($id)
    {
        $db = DB::getInstance();
        $reg =$db->query('UPDATE DonBan SET TrangThai ="1" WHERE Id='.$id);
    }
    static function  chuathanhtoan($id)
    {
        $db = DB::getInstance();
        $reg =$db->query('UPDATE DonBan SET TrangThai ="0" WHERE Id='.$id);
    }
    static function delete($id)
    {
        $db =DB::getInstance();
        $reg =$db->query('DELETE FROM ChiTietBan WHERE IdDonBan='.$id);
        $reg1 =$db->query('DELETE FROM DonBan WHERE Id = '.$id);
        header('location:index.php?controller=donban&action=index');
    }
}
