<?php
session_start();
require_once(__DIR__.'/../connection.php');
require_once (__DIR__.'/../models/sanpham.php');

if (isset($_GET['nccId'])) {
    if($_SESSION['quyen'] == "admin") {
        echo json_encode(array('data'=>  SanPham::findByNcc($_GET['nccId']), 'message' => 'success'), JSON_UNESCAPED_UNICODE );

    } else {
        echo json_encode(array('data'=>  SanPham::findByNccAndOwner($_GET['nccId']), 'message' => 'success'), JSON_UNESCAPED_UNICODE );

    }
   }

?>