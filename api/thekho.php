<?php
require_once(__DIR__.'/../connection.php');
$db = DB::getInstance();
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);  
  $result = [];
  if(isset($data['fromDate']) && isset($data['toDate']) && isset($data['trangthai']) && isset($data['kho']) && isset($data['product']) && isset($data['index']) && isset($data['take'])) {
    $fromDate = strtotime($data['fromDate']);
    $toDate = strtotime($data['toDate']);
      $product = $data['product'];
      $kho = $data['kho'];
      if($product == -1) {$product = '%';}
      if ($data['trangthai'] == 0 || $data['trangthai'] == 1) {
      
        $req = $db->prepare('SELECT sanpham.TenSp as TenSP,chitietmua.SoLuong as SL, chitietmua.ThanhTien as ThanhTien, donmua.NgayMua as CreateAt, donvitinh.DonVi as DV, sanpham.SLMax as SLMax, sanpham.SLMin as SLMin, donmua.MAHD as MAHD FROM chitietmua JOIN sanpham JOIN donvitinh JOIN donmua ON chitietmua.IdDVT = donvitinh.Id AND sanpham.Id = chitietmua.TenSp AND chitietmua.IdDonMua = donmua.Id WHERE chitietmua.TenSp LIKE :id AND sanpham.khoId LIKE :kho AND date(donmua.NgayMua)  BETWEEN date(:fromDate) AND date(:toDate)');
        $req->execute(array('id' => $product, 'kho' => $kho, 'fromDate' => date('Y/m/d',$fromDate) , 'toDate' => date('Y/m/d',$toDate)));
        foreach($req->fetchAll(PDO::FETCH_CLASS) as $row){
          $row->TrangThai = "Nhập hàng";
            array_push($result, $row);
        }
       
      }
      if ($data['trangthai'] == 0 || $data['trangthai'] == 2) {
        $req = $db->prepare('SELECT sanpham.TenSp as TenSP,chitietban.SoLuong as SL, chitietban.ThanhTien as ThanhTien, donban.NgayBan as CreateAt, donvitinh.DonVi as DV, sanpham.SLMax as SLMax, sanpham.SLMin as SLMin, donban.MAHD as MAHD FROM chitietban  JOIN sanpham JOIN donvitinh JOIN donban ON sanpham.IdDVT = donvitinh.Id AND sanpham.Id = chitietban.IdSP AND chitietban.IdDonBan = donban.Id WHERE chitietban.IdSP LIKE :id AND sanpham.khoId LIKE :kho  AND date(donban.NgayBan)
        BETWEEN date(:fromDate)
          AND date(:toDate)');
        $req->execute(array('id' => $product, 'kho' => $kho, 'fromDate' => date('Y/m/d',$fromDate) , 'toDate' => date('Y/m/d',$toDate)));
        foreach($req->fetchAll(PDO::FETCH_CLASS) as $row){
            $row->TrangThai = "Xuất hàng";
            array_push($result, $row);
        }
      }
      echo json_encode(array('data' => array_slice($result, $data['index'] * $data['take'], $data['take']), 'total' => count($result))  , 0);
  }

?>