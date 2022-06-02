<?php
require_once(__DIR__.'/../connection.php');
$db = DB::getInstance();
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);  
  $result = [];
  if(isset($data['fromDate']) && isset($data['toDate'])  && isset($data['kho']) && isset($data['index']) && isset($data['take'])) {
    $fromDate = strtotime($data['fromDate']);
    $toDate = strtotime($data['toDate']);
      $kho = $data['kho'];
      $daukynhap = [];
      $daukyxuat =[];
      $cuoikynhap = [];
      $cuoikyxuat = [];
        $req = $db->prepare('SELECT sanpham.TenSP , donvitinh.DonVi,tempTable.SLHienTai, temptable.total, temptable.NgayMua as thoigian, tempTable.SoLuong from sanpham JOIN donvitinh JOIN ( SELECT chitietmua.Id, chitietmua.TenSP, donmua.NgayMua, maxtable.total, chitietmua.SLHienTai,  chitietmua.SoLuong from chitietmua JOIN donmua JOIN ( SELECT chitietmua.TenSP, MAX(donmua.NgayMua) as NgayMua ,SUM(chitietmua.SoLuong) as total from chitietmua JOIN donmua ON chitietmua.IdDonMua = donmua.Id WHERE date(donmua.NgayMua) BETWEEN date(:fromDate) AND date(:toDate) GROUP BY chitietmua.TenSP ) as maxtable ON chitietmua.TenSP = maxtable.TenSP AND donmua.NgayMua = maxtable.NgayMua and chitietmua.IdDonMua = donmua.Id) as tempTable ON sanpham.IdDVT = donvitinh.Id AND tempTable.TenSP = sanpham.Id  WHERE sanpham.khoId like :kho');
        $req->execute(array('kho' => $kho, 'fromDate' => date('Y/m/d',$fromDate) , 'toDate' => date('Y/m/d',$toDate)));
        $cuoikynhap = $req->fetchAll(PDO::FETCH_CLASS);

        $req = $db->prepare('SELECT sanpham.TenSP , donvitinh.DonVi,tempTable.SLHienTai, temptable.total, temptable.NgayMua as thoigian, tempTable.SoLuong from sanpham JOIN donvitinh JOIN ( SELECT chitietmua.Id, chitietmua.TenSP, donmua.NgayMua, maxtable.total, chitietmua.SLHienTai,  chitietmua.SoLuong from chitietmua JOIN donmua JOIN ( SELECT chitietmua.TenSP, MIN(donmua.NgayMua) as NgayMua ,SUM(chitietmua.SoLuong) as total from chitietmua JOIN donmua ON chitietmua.IdDonMua = donmua.Id WHERE date(donmua.NgayMua) BETWEEN date(:fromDate) AND date(:toDate) GROUP BY chitietmua.TenSP ) as maxtable ON chitietmua.TenSP = maxtable.TenSP AND donmua.NgayMua = maxtable.NgayMua and chitietmua.IdDonMua = donmua.Id) as tempTable ON sanpham.IdDVT = donvitinh.Id AND tempTable.TenSP = sanpham.Id  WHERE sanpham.khoId like :kho');
        $req->execute(array('kho' => $kho, 'fromDate' => date('Y/m/d',$fromDate) , 'toDate' => date('Y/m/d',$toDate)));
        $daukynhap = $req->fetchAll(PDO::FETCH_CLASS);
       
  
        $req = $db->prepare('SELECT sanpham.TenSP , donvitinh.DonVi,tempTable.SLHienTai, temptable.total, temptable.NgayBan as thoigian, tempTable.SoLuong from sanpham JOIN donvitinh JOIN ( SELECT chitietban.Id, chitietban.IdSP, donban.NgayBan, maxtable.total, chitietban.SLHienTai, chitietban.SoLuong from chitietban JOIN donban JOIN ( SELECT chitietban.IdSP, MAX(donban.NgayBan) as NgayBan ,SUM(chitietban.SoLuong) as total from chitietban JOIN donban ON chitietban.IdDonBan = donban.Id WHERE date(donban.NgayBan) BETWEEN date(:fromDate) AND date(:toDate) GROUP BY chitietban.IdSP ) as maxtable ON chitietban.IdSP = maxtable.IdSP AND donban.NgayBan = maxtable.NgayBan and chitietban.IdDonBan = donban.Id) as tempTable ON sanpham.IdDVT = donvitinh.Id AND tempTable.IdSP = sanpham.Id WHERE sanpham.khoId like :kho');
        $req->execute(array('kho' => $kho, 'fromDate' => date('Y/m/d',$fromDate) , 'toDate' => date('Y/m/d',$toDate)));
        $cuoikyxuat = $req->fetchAll(PDO::FETCH_CLASS);

        $req = $db->prepare('SELECT sanpham.TenSP , donvitinh.DonVi,tempTable.SLHienTai, temptable.total, temptable.NgayBan as thoigian, tempTable.SoLuong from sanpham JOIN donvitinh JOIN ( SELECT chitietban.Id, chitietban.IdSP, donban.NgayBan, maxtable.total, chitietban.SLHienTai, chitietban.SoLuong from chitietban JOIN donban JOIN ( SELECT chitietban.IdSP, MIN(donban.NgayBan) as NgayBan ,SUM(chitietban.SoLuong) as total from chitietban JOIN donban ON chitietban.IdDonBan = donban.Id WHERE date(donban.NgayBan) BETWEEN date(:fromDate) AND date(:toDate) GROUP BY chitietban.IdSP ) as maxtable ON chitietban.IdSP = maxtable.IdSP AND donban.NgayBan = maxtable.NgayBan and chitietban.IdDonBan = donban.Id) as tempTable ON sanpham.IdDVT = donvitinh.Id AND tempTable.IdSP = sanpham.Id WHERE sanpham.khoId like :kho');
        $req->execute(array('kho' => $kho, 'fromDate' => date('Y/m/d',$fromDate) , 'toDate' => date('Y/m/d',$toDate)));
        $daukyxuat = $req->fetchAll(PDO::FETCH_CLASS);
     
        foreach($daukynhap as $item){
            $result[$item->TenSP] =array("TenSP" => $item->TenSP, "DVT"=> $item->DonVi, "SLDauKy" => $item->SLHienTai, "SLCuoiKy" =>  $item->SLHienTai + $item->SoLuong, "ngay" => $item->thoigian, "LuongNhap" => $item->total, "LuongXuat" => 0);
        }
        foreach($daukyxuat as $item){
            if(in_array($item->TenSP, array_keys( $result))){
               if(strtotime($result[$item->TenSP]['ngay']) > strtotime($item->thoigian)) {
                $result[$item->TenSP]['ngay']  = $item->thoigian;
                $result[$item->TenSP]['SLDauKy'] = $item->SLHienTai;
               }
               $result[$item->TenSP]['LuongXuat'] = $item->total;
            } else {
                $result[$item->TenSP] =array("TenSP" => $item->TenSP, "DVT"=> $item->DonVi, "SLDauKy" => $item->SLHienTai, "SLCuoiKy" =>  $item->SLHienTai - $item->SoLuong, "ngay" => $item->thoigian, "LuongXuat" => $item->total, "LuongNhap" => 0);
            }
        }

        foreach($cuoikynhap as $item){
            if(in_array($item->TenSP, array_keys( $result))){
               if(strtotime($result[$item->TenSP]['ngay']) < strtotime($item->thoigian)) {
                $result[$item->TenSP]['ngay']  = $item->thoigian;
                $result[$item->TenSP]['SLCuoiKy'] =  $item->SLHienTai + $item->SoLuong;
               }
            } else {
                $result[$item->TenSP] =array("TenSP" => $item->TenSP, "DVT"=> $item->DonVi, "SLDauKy" => $item->SLHienTai, "SLCuoiKy" =>  $item->SLHienTai + $item->SoLuong, "ngay" => $item->thoigian);
            }
        }

        foreach($cuoikyxuat as $item){
            if(in_array($item->TenSP, array_keys( $result))){
               if(strtotime($result[$item->TenSP]['ngay']) < strtotime($item->thoigian)) {
                $result[$item->TenSP]['ngay']  = $item->thoigian;
                $result[$item->TenSP]['SLCuoiKy'] =  $item->SLHienTai - $item->SoLuong;
               }
            } else {
                $result[$item->TenSP] =array("TenSP" => $item->TenSP, "DVT"=> $item->DonVi, "SLDauKy" => $item->SLHienTai, "SLCuoiKy" =>  $item->SLHienTai - $item->SoLuong, "ngay" => $item->thoigian);
            }
        }

        $req = $db->prepare('SELECT sanpham.TenSP , donvitinh.DonVi,sanpham.SoLuong from sanpham JOIN donvitinh ON  sanpham.IdDVT = donvitinh.Id WHERE sanpham.khoId = :kho');
        $req->execute(array('kho' => (int)$kho));
      
        foreach($req->fetchAll(PDO::FETCH_CLASS) as $item){
            if(!in_array($item->TenSP, array_keys( $result))) {
                 $result[$item->TenSP] = array("TenSP" => $item->TenSP, "DVT"=> $item->DonVi, "SLDauKy" => $item->SoLuong, "SLCuoiKy" =>  $item->SoLuong, "ngay" => "",  'LuongXuat' => 0,"LuongNhap" => 0);
             }
        }
      
    
      echo json_encode(array('data' => array_slice(array_values($result), $data['index'] * $data['take'], $data['take']), 'total' => count($result))  , 0);


  }

?>