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
        $sql_chon_khachhang = mysqli_query($mysqli, "SELECT * FROM tbl_khachhang,tbl_giaodich WHERE tbl_giaodich.khachhang_id = tbl_khachhang.khachhang_id GROUP BY tbl_giaodich.giaodich_magiaodich ORDER BY tbl_khachhang.khachhang_id DESC");
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
                            <th>Ngày mua hàng</th>
                            <th>Quản lý</th>
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
                                <td><?php echo $row_chon_khachhang['giaodich_datetime'] ?></td>
                                <td><a href="?quanly=xemgiaodich&magiaodich=<?php echo $row_chon_khachhang['giaodich_magiaodich'] ?>">Xem giao dịch</a></td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liệt kê lịch sử đơn hàng</h6>
        </div>

        <?php
        if (isset($_GET['magiaodich'])) {
            $magiaodich = $_GET['magiaodich'];
        } else {
            $magiaodich = '';
        }
        ?>

        <?php
        $sql_chon_donhang = mysqli_query($mysqli, "SELECT * FROM tbl_giaodich,tbl_khachhang,tbl_sanpham WHERE tbl_giaodich.sanpham_id = tbl_sanpham.sanpham_id AND tbl_giaodich.khachhang_id = tbl_khachhang.khachhang_id AND tbl_giaodich.giaodich_magiaodich = '$magiaodich' ORDER BY tbl_giaodich.giaodich_id DESC");
        ?>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Thứ tự</th>
                            <th>Mã giao dịch</th>
                            <th>Thanh toán</th>
                            <th>Tên sản phẩm</th>
                            <th>Ngày đặt</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $i = 0;
                        while ($row_chon_donhang = mysqli_fetch_array($sql_chon_donhang)) {
                            $i++;
                        ?>

                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row_chon_donhang['giaodich_magiaodich'] ?></td>
                                <td><?php
                                    if ($row_chon_donhang['khachhang_giaohang'] == 0) {
                                        echo 'Thanh toán khi nhận hàng';
                                    } else {
                                        echo 'Thanh toán ATM';
                                    }
                                    ?></td>
                                <td><?php echo $row_chon_donhang['sanpham_name'] ?></td>
                                <td><?php echo $row_chon_donhang['giaodich_datetime'] ?></td>
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