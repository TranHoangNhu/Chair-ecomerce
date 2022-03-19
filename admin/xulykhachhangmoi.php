<?php
include('../db/connect.php');
?>
<!-- <?php
        if (isset($_POST['capnhatdonhang'])) {
            $xuly = $_POST['xuly'];
            $mahang = $_POST['mahang_xuly'];

            $sql_updates = mysqli_query($mysqli, "UPDATE tbl_donhang SET donhang_tinhtrang = '$xuly' WHERE donhang_mahang ='$mahang'");
        }
        ?>
<?php

if (isset($_GET['xoa'])) {
    $mahang = $_GET['mahang'];

    $sql_xoa = mysqli_query($mysqli, "DELETE FROM tbl_donhang WHERE donhang_mahang = '$mahang'");
    header("Location:xulydonhang.php");
}
?> -->

<?php
include('../admin/include/header.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Khách hàng</h6>
        </div>

        <?php
        $sql_chon_khachhang = mysqli_query($mysqli, "SELECT * FROM tbl_khachhang ORDER BY tbl_khachhang.khachhang_id DESC");
        ?>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Thứ tự</th>
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Email</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $i = 0;
                        while ($row_chon_khachhang = mysqli_fetch_array($sql_chon_khachhang)) {
                            $i++;
                        ?>

                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row_chon_khachhang['khachhang_name'] ?></td>
                                <td><?php echo $row_chon_khachhang['khachhang_phone'] ?></td>
                                <td><?php echo $row_chon_khachhang['khachhang_address'] ?></td>
                                <td><?php echo $row_chon_khachhang['khachhang_email'] ?></td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php
include('../admin/include/footer.php');
?>