<?php
class KhoHang{

    public $id;
    public $ten;
    public $diachi;
    public $thukho;

    function __construct($id,$ten, $diachi, $thukho)
    {
        $this->id = $id;
        $this->ten= $ten;
        $this->diachi = $diachi;
        $this->thukho = $thukho;
    }
    static function all()
    {
        $list = [];
        $db =DB::getInstance();
        $reg = $db->query('SELECT nhanvien.TenNV as TenNV, khohang.id as id,khohang.ten as ten,khohang.diachi as diachi FROM khohang LEFT JOIN nhanvien ON nhanvien.Id = khohang.thukho');
        foreach ($reg->fetchAll() as $item){
            $list[] =new KhoHang($item['id'],$item['ten'], $item['diachi'], $item["TenNV"] );
        }
        return $list;
    }

    static function owner()
    {
       $userId = $_SESSION['userId'];
        $list = [];
        $db =DB::getInstance();
        $sql = "";
        if($_SESSION['quyen'] == "admin"){
            $sql = 'SELECT nhanvien.TenNV as TenNV, khohang.id as id,khohang.ten as ten,khohang.diachi as diachi FROM khohang LEFT JOIN nhanvien ON nhanvien.Id = khohang.thukho';
        } else {
            $sql = 'SELECT nhanvien.TenNV as TenNV, khohang.id as id,khohang.ten as ten,khohang.diachi as diachi FROM khohang LEFT JOIN nhanvien ON nhanvien.Id = khohang.thukho WHERE nhanvien.Id = "'.$userId.'"';
        }
            
        $reg = $db->query( $sql);
        foreach ($reg->fetchAll() as $item){
            $list[] =new KhoHang($item['id'],$item['ten'], $item['diachi'], $item["TenNV"] );
        }
        return $list;
    }

    static function find($id)
    {
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM khohang WHERE id = :id');
        $req->execute(array('id' => $id));

        $item = $req->fetch();
        if (isset($item['id'])) {
            return new KhoHang($item['id'],$item['ten'], $item['diachi'], $item["thukho"] );
        }
        return null;
    }
    static function add($ten, $diachi, $thukho)
    {
        $db =DB::getInstance();
        $reg =$db->query('INSERT INTO khohang(ten,diachi,thukho) VALUES ("'.$ten.'","'.$diachi.'", "'.$thukho.'")');
        header('location:index.php?controller=khohang&action=index');
    }
    static function update($id,$ten, $diachi, $thukho)
    { 
        $sql = 'UPDATE khohang SET ';
        if(strlen($ten) > 0){
            $sql = $sql.'ten = "'.$ten.'", ';
        }
        if(strlen($diachi) > 0) {
            $sql = $sql.'diachi = "'.$diachi.'", ';
        }
        if(strlen($thukho) > 0) {
            $sql = $sql.'thukho = '.$thukho.', ';
        }
        $sql = rtrim($sql, ", ");
        $sql = $sql.' WHERE Id='.$id;

        $db = DB::getInstance();
        $reg =$db->query( $sql);
        header('location:index.php?controller=khohang&action=index');
    }
    static function delete($id)
    {
        $db =DB::getInstance();
        $reg =$db->query('DELETE FROM khohang WHERE id='.$id);
        header('location:index.php?controller=khohang&action=index');
    }
}
