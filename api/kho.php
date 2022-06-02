<?php
require_once(__DIR__.'/../connection.php');
require_once (__DIR__.'/../models/khohang.php');
echo json_encode(array('data'=>  KhoHang::all(), 'message' => 'success'), JSON_UNESCAPED_UNICODE );


?>