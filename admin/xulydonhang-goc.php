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
if(isset($_GET['xacnhanhuy']) && isset($_GET['mahang'])){
    $huydon = $_GET['xacnhanhuy'];
    $magiaodich = $_GET['mahang'];
}
else{
    $huydon = '';
    $magiaodich = '';
}

$sql_updates_donhang = mysqli_query($mysqli, "UPDATE tbl_donhang SET donhang_huydon = '$huydon' WHERE donhang_mahang ='$magiaodich'");
$sql_updates_giaodich = mysqli_query($mysqli, "UPDATE tbl_donhang SET giaodich_huydon = '$huydon' WHERE giaodich_magiaodich ='$magiaodich'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <title>Đơn hàng</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="xulydonhang.php">Đơn hàng <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="xulydanhmuc.php">Danh mục</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="xulysanpham.php">Sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="xulykhachhang.php">Khách hàng</a>
                </li>
            </ul>
        </div>
    </nav>

    <br><br>

    <div class="container">
    <div class="row">

        <?php
            if(isset($_GET['quanly']) == 'xemdonhang')
            {
                $mahang = $_GET['mahang'];
                $sql_chitiet = mysqli_query($mysqli, "SELECT * FROM tbl_donhang,tbl_sanpham WHERE tbl_donhang.sanpham_id = tbl_sanpham.sanpham_id AND tbl_donhang.donhang_mahang = '$mahang'");
        ?>
        <div class="col-md-7">
                <h4>Xem chi tiết đơn hàng</h4>

                <form method="post" action="">

                    <table class="table table-bordered">
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

                        <?php
                            $i = 0; 
                            while ($row_chon_donhang_1 = mysqli_fetch_array($sql_chitiet)){
                                $i++;  
                        ?>

                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row_chon_donhang_1['donhang_mahang'] ?></td>
                            <td><?php echo $row_chon_donhang_1['sanpham_name'] ?></td>
                            <td><?php echo $row_chon_donhang_1['donhang_soluong'] ?></td>
                            <td><?php echo number_format($row_chon_donhang_1['sanpham_giakhuyenmai']). ' VND' ?></td>
                            <td><?php 
                                if($row_chon_donhang_1['sanpham_giakhuyenmai'] == 0)
                                {
                                    echo number_format($row_chon_donhang_1['sanpham_gia'] * $row_chon_donhang_1['donhang_soluong']). ' VND';
                                }
                                else
                                {
                                    echo number_format($row_chon_donhang_1['sanpham_giakhuyenmai'] * $row_chon_donhang_1['donhang_soluong']). ' VND';
                                }
                            ?></td>
                            <td><?php echo $row_chon_donhang_1['donhang_datetime'] ?></td>
                            <input type="hidden" name="mahang_xuly" value="<?php echo $row_chon_donhang_1['donhang_mahang'] ?>" />
                            <td><a href="?xoa&mahang=<?php echo $row_chon_donhang_1['donhang_mahang'] ?>">Xóa</a> || <a href="?quanly=xemdonhang&mahang=<?php echo $row_chon_donhang_1['donhang_mahang'] ?>">Xem đơn hàng</a></td>
                        </tr>

                        <?php
                        }
                        ?>
                    </table>

                    <select class="form-control" name="xuly">
                        <option value="0">Chưa xử lý</option>
                        <option value="1">Đã xử lý</option>
                    </select><br>
                    <input type="submit" value="Cập nhật đơn hàng" name="capnhatdonhang" class="btn btn-default">

                </form>

        </div>
                
        <?php
            }
            else
            {
            ?>
                <div class="col-md-7">
                    <p>Đơn hàng</p>
                </div>

            <?php
            }
        ?>          

        <div class="col-md-5">
            <h4>Liệt kê đơn hàng</h4>

            <?php
                $sql_chon_donhang = mysqli_query($mysqli,"SELECT * FROM tbl_donhang,tbl_sanpham,tbl_khachhang WHERE tbl_donhang.sanpham_id = tbl_sanpham.sanpham_id AND tbl_donhang.khachhang_id = tbl_khachhang.khachhang_id ORDER BY tbl_donhang.donhang_id DESC");
            ?>

            <table class="table table-bordered">
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

                <?php
                    $i = 0; 
                    while ($row_chon_donhang = mysqli_fetch_array($sql_chon_donhang)){
                        $i++;
                ?>

                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row_chon_donhang['donhang_mahang'] ?></td>
                    <td><?php echo $row_chon_donhang['khachhang_name'] ?></td>
                    <td><?php echo $row_chon_donhang['donhang_datetime'] ?></td>
                    <td><?php echo $row_chon_donhang['khachhang_note'] ?></td>
                    <td><?php 
                        if($row_chon_donhang['donhang_tinhtrang'] == 0)  
                        {
                            echo 'Chưa xử lý';
                        }
                        else
                        {
                            echo 'Đã xử lý';
                        }
                    ?></td>
                    <td><?php
                        if ($row_chon_donhang['donhang_huydon'] == 0) {
                            echo '';
                        } elseif($row_chon_donhang['donhang_huydon'] == 1) {
                            echo '<a href="xulydonhang.php?quanly=xemdonhang&mahang='.$row_chon_donhang['donhang_mahang'].'&xacnhanhuy=2">Xác nhận hủy đơn</a>';
                        }
                        else{
                            echo 'Đã hủy hàng';
                        }
                        ?></td>
                    <td><a href="?xoa&mahang=<?php echo $row_chon_donhang['donhang_mahang'] ?>">Xóa</a> || <a href="?quanly=xemdonhang&mahang=<?php echo $row_chon_donhang['donhang_mahang'] ?>">Xem đơn hàng</a></td>
                </tr>

                <?php
                }
                ?>
            </table>

        </div>
        
    </div>
    </div>
    
</body>
</html>