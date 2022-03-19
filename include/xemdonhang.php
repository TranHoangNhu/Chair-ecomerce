<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = '';
}

$sql_cate = mysqli_query($mysqli, "SELECT * FROM tbl_category,tbl_sanpham WHERE tbl_category.category_id = tbl_sanpham.category_id AND tbl_sanpham.category_id = '$id' ORDER BY tbl_sanpham.sanpham_id DESC");
$sql_category = mysqli_query($mysqli, "SELECT * FROM tbl_category,tbl_sanpham WHERE tbl_category.category_id = tbl_sanpham.category_id AND tbl_sanpham.category_id = '$id' ORDER BY tbl_sanpham.sanpham_id DESC");
$row_title = mysqli_fetch_array($sql_category);
$tittle = $row_title['category_name'];
?>
<?php
if(isset($_GET['huydon']) && isset($_GET['magiaodich'])){
    $huydon = $_GET['huydon'];
    $magiaodich = $_GET['magiaodich'];
}
else{
    $huydon = '';
    $magiaodich = '';
}

$sql_updates_donhang = mysqli_query($mysqli, "UPDATE tbl_donhang SET donhang_huydon = '$huydon' WHERE donhang_mahang ='$magiaodich'");
$sql_updates_giaodich = mysqli_query($mysqli, "UPDATE tbl_giaodich SET giaodich_huydon = '$huydon' WHERE giaodich_magiaodich ='$magiaodich'");
?>

<!-- top Products -->
<div class="ads-grid py-sm-5 py-4">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3"><?php echo $tittle ?></h3>
        <!-- //tittle heading -->
        <div class="row">
            <!-- product left -->
            <div class="agileinfo-ads-display col-lg-9">
                <div class="wrapper">
                    <!-- first section -->
                    <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
                        <div class="shadow mb-4">
                            <center>
                                <h2 class="m-0 font-weight-bold text-primary"><?php
                                    if (isset($_SESSION['dangnhap'])) {
                                        echo 'Đơn hàng : ' . $_SESSION['dangnhap'];
                                    }
                                    ?>
                                </h2>
                            </center>
                        </div>

                        <div class="card shadow mb-4">


                            <?php
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                            } else {
                                $id = '';
                            }
                            ?>

                            <?php
                            $sql_chon_donhang = mysqli_query($mysqli, "SELECT * FROM tbl_giaodich,tbl_khachhang WHERE tbl_giaodich.khachhang_id = tbl_khachhang.khachhang_id AND tbl_giaodich.khachhang_id = '$id' GROUP BY tbl_giaodich.giaodich_magiaodich DESC");
                            ?>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Thứ tự</th>
                                                <th>Mã giao dịch</th>
                                                <th>Thanh toán</th>
                                                <th>Ngày đặt</th>
                                                <th>Tình trạng</th>
                                                <th>Yêu cầu</th>
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
                                                    <td><?php echo $row_chon_donhang['giaodich_magiaodich'] ?></td>
                                                    <td><?php
                                                        if ($row_chon_donhang['khachhang_giaohang'] == 0) {
                                                            echo 'Thanh toán khi nhận hàng';
                                                        } else {
                                                            echo 'Thanh toán ATM';
                                                        }
                                                        ?></td>
                                                    <td><?php echo $row_chon_donhang['giaodich_datetime'] ?></td>
                                                    <td><?php
                                                        if ($row_chon_donhang['giaodich_tinhtrang'] == 0) {
                                                            echo 'Đã đặt hàng';
                                                        } else {
                                                            echo 'Đã xử lý | Đang giao hàng';
                                                        }
                                                    ?></td>
                                                        <td>
                                                        <?php
                                                        if($row_chon_donhang['giaodich_huydon'] == 0){
                                                        ?>
                                                        <a href="index.php?quanly=xemdonhang&id=<?php echo $row_chon_donhang['khachhang_id'] ?>&magiaodich=<?php echo $row_chon_donhang['giaodich_magiaodich'] ?>&huydon=1">Yêu cầu hủy</a>
                                                        <?php
                                                        } elseif($row_chon_donhang['giaodich_huydon'] == 1){
                                                        ?>
                                                        <p>Đang chờ xác nhận</p>
                                                        <?php
                                                        } else
                                                        {
                                                            echo 'Đã hủy đơn';
                                                        }
                                                        ?>
                                                        </td>
                                                    <td><a href="index.php?quanly=xemdonhang&id=<?php echo $row_chon_donhang['khachhang_id'] ?>&magiaodich=<?php echo $row_chon_donhang['giaodich_magiaodich'] ?>">Xem chi tiết</a></td>
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
                                <h6 class="m-0 font-weight-bold text-primary">Chi tiết đơn hàng</h6>
                            </div>

                            <?php
                            if (isset($_GET['magiaodich'])) {
                                $magiaodich = $_GET['magiaodich'];
                            } else {
                                $magiaodich = '';
                            }
                            ?>

                            <?php
                            $sql_chon_donhang = mysqli_query($mysqli, "SELECT * FROM tbl_giaodich,tbl_khachhang,tbl_sanpham,tbl_donhang WHERE tbl_donhang.sanpham_id = tbl_sanpham.sanpham_id AND tbl_giaodich.sanpham_id = tbl_sanpham.sanpham_id AND tbl_giaodich.khachhang_id = tbl_khachhang.khachhang_id AND tbl_giaodich.giaodich_magiaodich = '$magiaodich'");
                            ?>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Thứ tự</th>
                                                <th>Mã giao dịch</th>
                                                <th>Tên sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Ngày đặt</th>
                                                <th>Tình trạng</th>
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
                                                    <td><?php echo $row_chon_donhang['sanpham_name'] ?></td>
                                                    <td><?php echo $row_chon_donhang['giaodich_soluong'] ?></td>
                                                    <td><?php echo $row_chon_donhang['giaodich_datetime'] ?></td>
                                                    <td><?php
                                                    if ($row_chon_donhang['donhang_tinhtrang'] == 0) {
                                                        echo 'Chưa xử lý';
                                                    } else {
                                                        echo 'Đã xử lý';
                                                    }
                                                    ?></td>
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
                </div>
                <!-- //first section -->
            </div>
        </div>
        <!-- //product left -->
    </div>
</div>
</div>
<!-- //top products -->