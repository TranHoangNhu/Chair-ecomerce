<?php
    include('../db/connect.php');
?>
<?php

if (isset($_POST['themsanpham'])) {
    // if (is_array($_POST['danhmuc'])) {
    //     foreach($_POST['danhmuc'] as $value){
    //        echo $value.'|';
    //     }
    // } else {
    //     $value = $_POST['danhmuc'];
    //     echo $value.'|';
    // }
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $path = "../uploads/";
    $tensanpham = $_POST['tensanpham'];
    $soluong = $_POST['soluong'];
    $gia = $_POST['gia'];
    $giakhuyenmai = $_POST['giakhuyenmai'];
    $danhmuc = $_POST['danhmuc'];
    $chitiet = $_POST['chitiet'];
    $mota = $_POST['mota'];

    $sql_them = mysqli_query($mysqli, "INSERT INTO tbl_sanpham (category_id,sanpham_name,sanpham_chitiet,sanpham_mota,sanpham_gia,sanpham_giakhuyenmai,sanpham_soluong,sanpham_image) VALUES ('$danhmuc','$tensanpham','$chitiet','$mota','$gia','$giakhuyenmai','$soluong','$hinhanh')");
    move_uploaded_file($hinhanh_tmp, $path . $hinhanh);
} elseif (isset($_POST['capnhatsanpham'])) {
    // if (is_array($_POST['danhmuc'])) {
    //     foreach($_POST['danhmuc'] as $value){
    //         echo $value.'|';
    //     }
    // } else {
    //     $value = $_POST['danhmuc'];
    //     echo $value.'|';
    // }
    $id = $_GET['id'];
    $tensanpham = $_POST['tensanpham'];
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $soluong = $_POST['soluong'];
    $gia = $_POST['gia'];
    $giakhuyenmai = $_POST['giakhuyenmai'];
    $danhmuc = $_POST['danhmuc'];
    $chitiet = $_POST['chitiet'];
    $mota = $_POST['mota'];
    $path = "../uploads/";

    if ($hinhanh == '') {
        $sql_capnhat_image = "UPDATE tbl_sanpham SET category_id='$danhmuc',sanpham_name='$tensanpham',sanpham_chitiet='$chitiet',sanpham_mota='$mota',sanpham_gia='$gia',sanpham_giakhuyenmai='$giakhuyenmai',sanpham_soluong='$soluong' WHERE sanpham_id = '$id'";
    } else {
        move_uploaded_file($hinhanh_tmp, $path . $hinhanh);
        $sql_capnhat_image = "UPDATE tbl_sanpham SET category_id='$danhmuc',sanpham_name='$tensanpham',sanpham_chitiet='$chitiet',sanpham_mota='$mota',sanpham_gia='$gia',sanpham_giakhuyenmai='$giakhuyenmai',sanpham_soluong='$soluong',sanpham_image='$hinhanh' WHERE sanpham_id = '$id'";
    }
    mysqli_query($mysqli, $sql_capnhat_image);
}

if (isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    $path_delete = "../uploads/";

    $sql_xoa = mysqli_query($mysqli, "DELETE FROM tbl_sanpham WHERE sanpham_id = '$id'");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <title>Danh mục</title>
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
            if (isset($_GET['quanly']) == 'sanpham') {
                $id_sanpham = $_GET['id'];
                $sql_sanpham = mysqli_query($mysqli, "SELECT * FROM tbl_sanpham WHERE sanpham_id = '$id_sanpham'");
                $row_sanpham = mysqli_fetch_array($sql_sanpham);
                $id_cate = $row_sanpham['category_id'];
            ?>

                <div class="col-md-4">
                    <h4>Cập nhật sản phẩm</h4><br>

                    <form action="" method="post" enctype=multipart/form-data>
                        <label>Tên sản phẩm</label>
                        <input type="text" class="form-control" name="tensanpham" placeholder="Tên sản phẩm" value="<?php echo $row_sanpham['sanpham_name'] ?>"><br>
                        <label>Hình ảnh</label>
                        <input type="file" class="form-control" name="hinhanh"><br>
                        <img src="../uploads/<?php echo $row_sanpham['sanpham_image'] ?>" height="80px" width="80px"><br><br>
                        <label>Giá</label>
                        <input type="text" class="form-control" name="gia" placeholder="Giá" value="<?php echo $row_sanpham['sanpham_gia'] ?>"><br>
                        <label>Giá khuyến mãi</label>
                        <input type="text" class="form-control" name="giakhuyenmai" placeholder="Giá khuyến mãi" value="<?php echo $row_sanpham['sanpham_giakhuyenmai'] ?>"><br>
                        <label>Số lượng</label>
                        <input type="text" class="form-control" name="soluong" placeholder="Số lượng" value="<?php echo $row_sanpham['sanpham_soluong'] ?>"><br>
                        <label>Mô tả</label>
                        <textarea class="form-control" rows="10px" name="mota" placeholder="Mô tả"><?php echo $row_sanpham['sanpham_mota'] ?></textarea><br>
                        <label>Chi tiết</label>
                        <textarea class="form-control" rows="10px" name="chitiet" placeholder="Chi tiết"><?php echo $row_sanpham['sanpham_chitiet'] ?></textarea><br>
                        <label>Danh mục</label>

                        <?php
                            $sql_danhmuc = mysqli_query($mysqli, "SELECT * FROM tbl_category ORDER BY category_id DESC");
                        ?>

                        <select class="form-control" name="danhmuc">
                            <option value="">------- Chọn danh mục -------</option>

                            <?php
                            while ($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                                if ($id_cate == $row_danhmuc['category_id']) {
                            ?>

                                    <option selected value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>

                                <?php
                                } else {
                                ?>
                                    <option value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
                            <?php

                                }
                            }
                            ?>

                        </select><br>

                        
                        <input type="submit" name="capnhatsanpham" value="Cập nhật sản phẩm" class="btn btn-default">
                    </form>
                </div>

            <?php
            } else {
            ?>

                <div class="col-md-4">
                    <h4>Thêm sản phẩm</h4><br>

                    <form action="" method="post" enctype=multipart/form-data>
                        <label>Tên sản phẩm</label>
                        <input type="text" class="form-control" name="tensanpham" placeholder="Tên sản phẩm"><br>
                        <label>Hình ảnh</label>
                        <input type="file" class="form-control" name="hinhanh"><br>
                        <img src="../uploads/<?php echo $row_sanpham['sanpham_image'] ?>" height="80px" width="80px"><br><br>
                        <label>Giá</label>
                        <input type="text" class="form-control" name="gia" placeholder="Giá"><br>
                        <label>Giá khuyến mãi</label>
                        <input type="text" class="form-control" name="giakhuyenmai" placeholder="Giá khuyến mãi"><br>
                        <label>Số lượng</label>
                        <input type="text" class="form-control" name="soluong" placeholder="Số lượng"><br>
                        <label>Mô tả</label>
                        <textarea class="form-control" rows="10px" name="mota" placeholder="Mô tả"></textarea><br>
                        <label>Chi tiết</label>
                        <textarea class="form-control" rows="10px" name="chitiet" placeholder="Chi tiết"></textarea><br>
                        <label>Danh mục</label>

                        <?php
                            $sql_danhmuc = mysqli_query($mysqli, "SELECT * FROM tbl_category ORDER BY category_id DESC");
                        ?>

                        <select class="form-control" name="danhmuc[]">
                            <option value="">------- Chọn danh mục -------</option>

                            <?php
                            while ($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                            ?>

                            <option value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
                            
                            <?php
                            }
                            ?>

                        </select><br>

                        <!-- <?php
                            $sql_active = mysqli_query($mysqli, "SELECT * FROM tbl_sanpham ORDER BY sanpham_id DESC");
                        ?>

                        <select class="form-control" name="active[]">
                            <option value="">------- Chọn trạng thái -------</option>

                            <?php
                            while ($row_active = mysqli_fetch_array($sql_active)) {
                            ?>

                            <option value="<?php echo $row_active['san'] ?>"><?php echo $row_active['category_name'] ?></option>
                            
                            <?php
                            }
                            ?>

                        </select><br> -->

                            <!-- <div class="multiselect">

                                <?php
                                $sql_danhmuc = mysqli_query($mysqli, "SELECT * FROM tbl_category ORDER BY category_id DESC")
                                ?>

                                <div class="selectBox" onclick="showCheckboxes()">
                                    <select>
                                        <option>Select an option</option>
                                    </select>
                                    <div class="overSelect"></div>
                                </div>

                                <div id="checkboxes">
                                    <br>
                                    <form method="post" action="">
                                        <?php
                                        while ($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                                        ?>
                                            <input type="checkbox" id="<?php echo $row_danhmuc['category_id'] ?>" name ="danhmuc[]"/><?php echo $row_danhmuc['category_name'] ?><br>
                                        <?php
                                        }
                                        ?>
                                    </form>
                                </div>

                            </div> -->

                        <input type="submit" name="themsanpham" value="Thêm sản phẩm" class="btn btn-default">
                    </form>
                </div>

            <?php
            }
            ?>

            <div class="col-md-8">
                <h4>Liệt kê sản phẩm</h4>

                <?php
                $sql_chon_sp = mysqli_query($mysqli, "SELECT * FROM tbl_category,tbl_sanpham WHERE tbl_category.category_id = tbl_sanpham.category_id ORDER BY sanpham_id DESC");
                ?>

                <table class="table table-bordered">
                    <tr>
                        <th>Thứ tự</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Giá</th>
                        <th>Giá khuyến mãi</th>
                        <th>Số lượng</th>
                        <th>Mô tả</th>
                        <th>Chi tiết</th>
                        <th>Danh mục</th>
                        <th>Tình trạng</th>
                        <th>Quản lý</th>
                    </tr>

                    <?php
                    $i = 0;
                    while ($row_chon_sp = mysqli_fetch_array($sql_chon_sp)) {
                        $i++;
                    ?>

                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row_chon_sp['sanpham_name'] ?></td>
                            <td><img src="../uploads/<?php echo $row_chon_sp['sanpham_image'] ?>" height="80px" width="80px"></td>
                            <td><?php echo number_format($row_chon_sp['sanpham_gia']) . ' VND' ?></td>
                            <td><?php echo number_format($row_chon_sp['sanpham_giakhuyenmai']) . ' VND' ?></td>
                            <td><?php echo $row_chon_sp['sanpham_soluong'] ?></td>
                            <td><?php echo $row_chon_sp['sanpham_mota'] ?></td>
                            <td><?php echo $row_chon_sp['sanpham_chitiet'] ?></td>
                            <td><?php echo $row_chon_sp['category_name'] ?></td>
                            <td><?php echo $row_chon_sp['sanpham_active'] ?></td>
                            <td><a href="?xoa=<?php echo $row_chon_sp['sanpham_id'] ?>">Xóa</a> || <a href="?quanly=sanpham&id=<?php echo $row_chon_sp['sanpham_id'] ?>">Cập nhật</a></td>
                        </tr>

                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

</body>
<script src="../js/form.js"></script>

</html>