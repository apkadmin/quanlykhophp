<?php
require_once ('models/nhacungcap.php');
//?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-center text-gray-800 ">Kho hàng</h1>
<!--<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.-->
<!--    For more information about DataTables, please visit the <a target="_blank"-->
<!--                                                               href="https://datatables.net">official DataTables documentation</a>.</p>-->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách kho</h6>
    </div>

    <div class="card-body">
       <?php if($_SESSION['quyen'] == 'admin') echo '<a href="index.php?controller=khohang&action=insert" class="btn btn-primary mb-3">Thêm</a>'; ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Kho</th>
                    <th>Địa chỉ</th>
                    <th>NV Quản lý</th>
                    <th>Hoạt động</th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($khohang as $item){

                    ?>
                    <form method="post">
                        <tr>
                            <td onclick="showDetail('khohang', <?=$item->id?>)"><?= $item->id?></td>
                            <td  onclick="showDetail('khohang', <?=$item->id?>)"><?= $item->ten?></td>
                            <td  onclick="showDetail('khohang', <?=$item->id?>)"><?= $item->diachi?></td>
                            <td  onclick="showDetail('khohang', <?=$item->id?>)"><?= $item->thukho?></td>
                            <td>
                                
                <a href="index.php?controller=khohang&action=thekho&id=<?=$item->id?>" class="btn btn-primary">Thẻ kho</a>
                                <!--                       <a  href="index.php?controller=khachhangs&action=showPost&id=--><!--"  class='btn btn-primary mr-3'>Details</a>-->
                                <a  href="index.php?controller=khohang&action=edit&id=<?= $item->id?>"  class='btn btn-primary mr-3'>Edit</a>
                                <button type="submit" name="dele" value="<?= $item->id ?>"    class='btn btn-danger'>Delete</button>
                    </form>
                    </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
if(isset($_POST['dele'])){
    $id =$_POST['dele'];
    NhaCungCap::delete($id);
}
?>


