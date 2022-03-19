<?php
include('../db/connect.php');
?>
<?php
if (isset($_POST['capnhatdonhang'])) {
    $xuly = $_POST['xuly'];
    $mahang = $_POST['mahang_xuly'];

    $sql_updates = mysqli_query($mysqli, "UPDATE tbl_donhang SET donhang_tinhtrang = '$xuly' WHERE donhang_mahang ='$mahang'");
    $sql_updates_giaodich = mysqli_query($mysqli, "UPDATE tbl_giaodich SET giaodich_tinhtrang = '$xuly' WHERE giaodich_magiaodich ='$mahang'");
}
?>
<?php

if (isset($_GET['xoa'])) {
    $mahang = $_GET['mahang'];

    $sql_xoa = mysqli_query($mysqli, "DELETE FROM tbl_donhang WHERE donhang_mahang = '$mahang'");
    header("Location:xulydonhang.php");
}
if (isset($_GET['xacnhanhuy']) && isset($_GET['mahang'])) {
    $huydon = $_GET['xacnhanhuy'];
    $magiaodich = $_GET['mahang'];
} else {
    $huydon = '';
    $magiaodich = '';
}

$sql_updates_donhang = mysqli_query($mysqli, "UPDATE tbl_donhang SET donhang_huydon = '$huydon' WHERE donhang_mahang ='$magiaodich'");
$sql_updates_giaodich = mysqli_query($mysqli, "UPDATE tbl_giaodich SET giaodich_huydon = '$huydon' WHERE giaodich_magiaodich ='$magiaodich'");
?>

<?php
include('../admin/include/header.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liệt kê đơn hàng</h6>
        </div>

        <?php
        $sql_chon_donhang = mysqli_query($mysqli, "SELECT * FROM tbl_donhang,tbl_sanpham,tbl_khachhang WHERE tbl_donhang.sanpham_id = tbl_sanpham.sanpham_id AND tbl_donhang.khachhang_id = tbl_khachhang.khachhang_id GROUP BY tbl_donhang.donhang_mahang DESC");
        ?>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Thứ tự</th>
                            <th>Mã hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Ngày đặt</th>
                            <th>Ghi chú</th>
                            <th>Tình trạng đơn hàng</th>
                            <th>Hủy đơn hàng</th>
                            <th>Quản lý</th>
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
                                <td><?php echo $row_chon_donhang['donhang_mahang'] ?></td>
                                <td><?php echo $row_chon_donhang['khachhang_name'] ?></td>
                                <td><?php echo $row_chon_donhang['donhang_datetime'] ?></td>
                                <td><?php echo $row_chon_donhang['khachhang_note'] ?></td>
                                <td><?php
                                    if ($row_chon_donhang['donhang_tinhtrang'] == 0) {
                                        echo 'Chưa xử lý';
                                    } else {
                                        echo 'Đã xử lý';
                                    }
                                    ?></td>
                                <td><?php
                                    if ($row_chon_donhang['donhang_huydon'] == 0) {
                                        echo '';
                                    } elseif ($row_chon_donhang['donhang_huydon'] == 1) {
                                        echo '<a href="xulydonhang.php?quanly=xemdonhang&mahang=' . $row_chon_donhang['donhang_mahang'] . '&xacnhanhuy=2">Xác nhận hủy đơn</a>';
                                    } else {
                                        echo 'Đã hủy hàng';
                                    }
                                    ?></td>
                                <td><a href="?xoa&mahang=<?php echo $row_chon_donhang['donhang_mahang'] ?>">Xóa</a> || <a href="?quanly=xemdonhang&mahang=<?php echo $row_chon_donhang['donhang_mahang'] ?>">Xem đơn hàng</a></td>
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
    if (isset($_GET['quanly']) == 'xemdonhang') {
        $mahang = $_GET['mahang'];
        $sql_chitiet = mysqli_query($mysqli, "SELECT * FROM tbl_donhang,tbl_sanpham WHERE tbl_donhang.sanpham_id = tbl_sanpham.sanpham_id AND tbl_donhang.donhang_mahang = '$mahang'");
    ?>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Xem chi tiết đơn hàng</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <form method="Post" action="">
                    <select class="form-control" name="xuly">
                        <option value="0">Chưa xử lý</option>
                        <option value="1">Đã xử lý</option>
                        </select><br>
                        <center><input style="border:1px solid black; " class="btn btn-success" name="capnhatdonhang" type="submit" value="Cập nhật đơn hàng"></center>
                        <br>   
                        
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Thứ tự</th>
                                    <th>Mã hàng</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Tổng tiền</th>
                                    <th>Ngày đặt</th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i = 0;
                                while ($row_chon_donhang_1 = mysqli_fetch_array($sql_chitiet)) {
                                    $i++;
                                ?>

                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $row_chon_donhang_1['donhang_mahang'] ?></td>
                                        <td><?php echo $row_chon_donhang_1['sanpham_name'] ?></td>
                                        <td><?php echo $row_chon_donhang_1['donhang_soluong'] ?></td>
                                        <td><?php echo number_format($row_chon_donhang_1['sanpham_giakhuyenmai']) . ' VND' ?></td>
                                        <td><?php
                                            if ($row_chon_donhang_1['sanpham_giakhuyenmai'] == 0) {
                                                echo number_format($row_chon_donhang_1['sanpham_gia'] * $row_chon_donhang_1['donhang_soluong']) . ' VND';
                                            } else {
                                                echo number_format($row_chon_donhang_1['sanpham_giakhuyenmai'] * $row_chon_donhang_1['donhang_soluong']) . ' VND';
                                            }
                                            ?></td>
                                        <td><?php echo $row_chon_donhang_1['donhang_datetime'] ?></td>
                                        <input type="hidden" name="mahang_xuly" value="<?php echo $row_chon_donhang_1['donhang_mahang'] ?>" />
                                        <td><a href="?xoa&mahang=<?php echo $row_chon_donhang_1['donhang_mahang'] ?>">Xóa</a> || <a href="?quanly=xemdonhang&mahang=<?php echo $row_chon_donhang_1['donhang_mahang'] ?>">Xem đơn hàng</a></td>
                                    </tr>
                            </tbody>
                        <?php
                            }
                        ?>
                        </table> 

                    </form>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

</div>

<?php
include('../admin/include/footer.php');
?>