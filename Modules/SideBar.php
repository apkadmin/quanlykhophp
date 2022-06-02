<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Kho hàng<sup>v1</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDVT"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Đơn vị</span>
        </a>
        <div id="collapseDVT" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Action:</h6>
                <a class="collapse-item" href="?controller=donvitinh">Danh sách</a>
                <a class="collapse-item" href="?controller=donvitinh&action=insert">Thêm</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNCC"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Nhà Cung Cấp</span>
        </a>
        <div id="collapseNCC" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Action:</h6>
                <a class="collapse-item" href="?controller=nhacungcap">Danh sách</a>
                <a class="collapse-item" href="?controller=nhacungcap&action=insert">Thêm</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseT"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Hàng Hóa</span>
        </a>
        <div id="collapseT" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Action:</h6>
                <a class="collapse-item" href="?controller=sanpham">Danh sách</a>
                <a class="collapse-item" href="?controller=sanpham&action=insert">Thêm</a>
            </div>
        </div>
    </li>
    <?php 
    if($_SESSION['quyen'] == "admin") {
        echo '<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNV"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Nhân viên</span>
        </a>
        <div id="collapseNV" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Action:</h6>
                <a class="collapse-item" href="?controller=nhanvien">Danh sách</a>
                <a class="collapse-item" href="?controller=nhanvien&action=insert">Thêm</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsequyen"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Phân quyền</span>
        </a>
        <div id="collapsequyen" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Action:</h6>
                <a class="collapse-item" href="?controller=quyen">Danh sách quyền</a>
                <a class="collapse-item" href="?controller=phanquyen">quyền-nhân viên</a>
            </div>
        </div>
    </li>';
    }
    
    ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKH"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Khách hàng</span>
        </a>
        <div id="collapseKH" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Action:</h6>
                <a class="collapse-item" href="?controller=khachhangs">Danh sách</a>
                <a class="collapse-item" href="?controller=khachhangs&action=insert">Thêm</a>
            </div>
        </div>
    </li>

    <?php 
    if($_SESSION['quyen'] == "manager" ) {
        echo '<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Nhập hàng</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="?controller=donmua">Danh sách đơn</a>
                <a class="collapse-item" href="?controller=donmua&action=insert">Tạo đơn</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
           aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Xuất hàng</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="?controller=donban">Danh sách đơn</a>
                <a class="collapse-item" href="?controller=donban&action=insert">Tạo đơn</a>

            </div>
        </div>
    </li>
    <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Khohang"
       aria-expanded="true" aria-controls="collapseKho">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Kho hàng</span>
    </a>
    <div id="Khohang" class="collapse" aria-labelledby="headingUtilities"
         data-parent="#Khohang">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="?controller=khohang">Danh sách</a>
        </div>
    </div>
</li>';
}
if($_SESSION['quyen'] == "admin" ) {
    echo '<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
       aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Nhập hàng</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="?controller=donmua">Danh sách đơn</a>
            <a class="collapse-item" href="?controller=donmua&action=insert">Tạo đơn</a>
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
       aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Xuất hàng</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
         data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="?controller=donban">Danh sách đơn</a>
            <a class="collapse-item" href="?controller=donban&action=insert">Tạo đơn</a>

        </div>
    </div>
</li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Khohang"
           aria-expanded="true" aria-controls="collapseKho">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Kho hàng</span>
        </a>
        <div id="Khohang" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#Khohang">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="?controller=khohang">Danh sách</a>
                <a class="collapse-item" href="?controller=khohang&action=insert">Thêm mới</a>
            </div>
        </div>
    </li>

    ';
}
    ?>
    

    
  

    <!-- Divider -->
    <hr class="sidebar-divider">
<?php
    if($_SESSION['quyen'] == "manager" || $_SESSION['quyen'] == "admin") {
    echo ' <li class="nav-item">
    <a class="nav-link" href="index.php?controller=baocao&acton=index">
        <i class="fas fa-fw fa-table"></i>
        <span>Báo cáo</span></a>
</li>';
   
    } 
    ?>
  
</ul>