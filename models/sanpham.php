<?php
class SanPham
{
    public $Id;
    public $TenSP;
    public $IdDVT;
    public $IdNCC;
    public $GiaMua;
    public $GiaBan;
    public $SoLuong;
    public $Max;
    public $Min;
    public $khoId;

    function   __construct($Id,$TenSP,$IdDVT,$IdNCC,$GiaMua,$GiaBan,$SoLuong, $Max, $Min, $khoId)
    {
        $this->Id=$Id;
        $this->TenSP=$TenSP;
        $this->IdDVT=$IdDVT;
        $this->IdNCC=$IdNCC;
        $this->GiaMua=$GiaMua;
        $this->GiaBan=$GiaBan;
        $this->SoLuong=$SoLuong;
        $this->Max = $Max;
        $this->Min = $Min;
        $this->khoId = $khoId;
    }
    static function all()
    {
        $list = [];
        $db = DB::getInstance();
        $reg = $db->query('SELECT sp.Id,sp.TenSP,dvt.DonVi,ncc.TenNCC,sp.GiaMua,sp.GiaBan,sp.SoLuong, sp.SLMax, sp.SLMin,sp.khoId FROM SanPham sp JOIN DonViTinh dvt JOIN NhaCungCap ncc ON sp.IdNCC = ncc.Id AND sp.IdDVT = dvt.Id');
        foreach ($reg->fetchAll() as $item) {
            $list[] = new SanPham($item['Id'], $item['TenSP'], $item['DonVi'],$item['TenNCC'], $item['GiaMua'], $item['GiaBan'], $item['SoLuong'], $item['SLMax'], $item['SLMin'], $item['khoId']);
        }
        return $list;
    }
    static function find($id)
    {
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM SanPham WHERE Id = :id');
        $req->execute(array('id' => $id));
        $item = $req->fetch();
        if (isset($item['Id'])) {
                return  new SanPham($item['Id'], $item['TenSP'], $item['IdDVT'],$item['IdNCC'], $item['GiaMua'], $item['GiaBan'], $item['SoLuong'], $item['SLMax'], $item['SLMin'], $item['khoId']);
        }
        return null;
    }

    static function findByNcc($id)
    {
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM SanPham WHERE IdNCC = :id');
        $req->execute(array('id' => $id));
        $result = $req->fetchAll(PDO::FETCH_CLASS);
        return $result;
    }

   
    static function findByNccAndOwner($id)
    {
        $db = DB::getInstance();
        $req = $db->prepare('SELECT SanPham.Id, SanPham.TenSP, SanPham.IdDVT, SanPham.IdNCC, SanPham.GiaMua, SanPham.GiaBan, SanPham.SoLuong, SanPham.SLMax, SanPham.SLMin, sanPham.khoId FROM SanPham JOIN khohang ON khohang.id = SanPham.khoId WHERE IdNCC = :id AND khohang.thukho like :thukho ');
        $req->execute(array('id' => $id, 'thukho' => $_SESSION['userId']));
        $result = $req->fetchAll(PDO::FETCH_CLASS);
        return $result;
    }
    static function findByKho($id)
    {
        $list[] = [];
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM SanPham WHERE khoId = :id');
        $req->execute(array('id' => $id));
        $result = $req->fetchAll(PDO::FETCH_CLASS);
        return $result;
    }

    static function add($ten,$IdDVT,$IdNCC,$giamua,$giaban,$soluong, $max, $min, $KhoId)
    {
        $db = DB::getInstance();
        $reg=$db->query('INSERT INTO SanPham(TenSP,IdDVT,IdNCC,GiaMua,GiaBan,SoLuong, SLMax,SLMin,khoId) VALUES ("'.$ten.'",'.$IdDVT.','.$IdNCC.','.$giamua.','.$giaban.','.$soluong.', '.$max.', '.$min.', '.$KhoId.' )');
        header('location:index.php?controller=sanpham&action=index');
    }

    static function addNew($ten,$IdDVT,$IdNCC,$giamua,$giaban,$soluong, $max, $min, $KhoId)
    {
        $db = DB::getInstance();
        $reg=$db->query('INSERT INTO SanPham(TenSP,IdDVT,IdNCC,GiaMua,GiaBan,SoLuong, SLMax,SLMin,khoId) VALUES ("'.$ten.'",'.$IdDVT.','.$IdNCC.','.$giamua.','.$giaban.','.$soluong.', '.$max.', '.$min.', '.$KhoId.' )');
        var_dump($reg);
        return $db->lastInsertId();
    }
    static function update($id, $ten, $IdDVT, $IdNCC, $giamua, $giaban, $soluong, $max, $min, $khoId)
    {
        $db =DB::getInstance();
        $reg =$db->query('UPDATE SanPham SET TenSP ="'.$ten.'",IdDVT="'.$IdDVT.'",IdNCC="'.$IdNCC.'",GiaMua="'.$giamua.'",GiaBan="'.$giaban.'",SoLuong="'.$soluong.'", SLMax='.$max.', SLMin='.$min.', khoId='.$khoId.', update_at=now() WHERE Id='.$id);
        header('location:index.php?controller=sanpham&action=index');
    }
    static function updatesl($id,$soluong)
    {
        $db =DB::getInstance();
        $reg =$db->query('UPDATE SanPham SET SoLuong="'.$soluong.'", update_at=now() WHERE Id='.$id);
    }

    static function delete($id)
    {
        $db =DB::getInstance();
        $reg =$db->query('DELETE FROM SanPham WHERE Id='.$id);
        header('location:index.php?controller=sanpham&action=index');
    }
}