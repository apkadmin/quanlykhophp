<?php
require_once(__DIR__.'/../connection.php');
require_once (__DIR__.'/../models/donvitinh.php');
echo json_encode(array('data'=>  DonViTinh::all(), 'message' => 'success'), JSON_UNESCAPED_UNICODE );


?>