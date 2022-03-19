<?php
include('../db/connect.php');
?>
<?php

if (isset($_POST['themsanpham'])) {
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

    if($hinhanh != "" && $path != "" && $tensanpham != "" && $soluong != "" && $giakhuyenmai != "" && $danhmuc != "" && $chitiet != "" && $mota != "")
    {
        $sql_them = mysqli_query($mysqli, "INSERT INTO tbl_sanpham (category_id,sanpham_name,sanpham_chitiet,sanpham_mota,sanpham_gia,sanpham_giakhuyenmai,sanpham_soluong,sanpham_image) VALUES ('$danhmuc','$tensanpham','$chitiet','$mota','$gia','$giakhuyenmai','$soluong','$hinhanh')");
        move_uploaded_file($hinhanh_tmp, $path . $hinhanh);
    } 
    
} elseif (isset($_POST['capnhatsanpham'])) {
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

<?php
include('../admin/include/header.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <center><input id="btnTest" style="border:1px solid black; " class="btn btn-success" type="submit" value="Đóng mở form"></center>
    <br>
    <!-- Page Heading -->
    <div class="test">
    
        <?php
        if (isset($_GET['quanly']) == 'sanpham') {
            $id_sanpham = $_GET['id'];
            $sql_sanpham = mysqli_query($mysqli, "SELECT * FROM tbl_sanpham WHERE sanpham_id = '$id_sanpham'");
            $row_sanpham = mysqli_fetch_array($sql_sanpham);
            $id_cate = $row_sanpham['category_id'];
        ?>

            <h1 class="h3 mb-2 text-gray-800">Cập nhật sản phẩm</h1>
            <form action="" method="post" enctype=multipart/form-data>
                <label>Tên sản phẩm</label>
                <input type="text" class="form-control" require name="tensanpham" placeholder="Tên sản phẩm" value="<?php echo $row_sanpham['sanpham_name'] ?>"><br>
                <label>Hình ảnh</label>
                <input type="file" class="form-control" require name="hinhanh"><br>
                <img src="../uploads/<?php echo $row_sanpham['sanpham_image'] ?>" height="80px" width="80px"><br><br>
                <label>Giá</label>
                <input type="text" class="form-control" require name="gia" placeholder="Giá" value="<?php echo $row_sanpham['sanpham_gia'] ?>"><br>
                <label>Giá khuyến mãi</label>
                <input type="text" class="form-control" require name="giakhuyenmai" placeholder="Giá khuyến mãi" value="<?php echo $row_sanpham['sanpham_giakhuyenmai'] ?>"><br>
                <label>Số lượng</label>
                <input type="text" class="form-control" require name="soluong" placeholder="Số lượng" value="<?php echo $row_sanpham['sanpham_soluong'] ?>"><br>
                <label>Mô tả</label>
                <textarea class="form-control" rows="10px" require name="mota" placeholder="Mô tả"><?php echo $row_sanpham['sanpham_mota'] ?></textarea><br>
                <label>Chi tiết</label>
                <textarea class="form-control" rows="10px" require name="chitiet" placeholder="Chi tiết"><?php echo $row_sanpham['sanpham_chitiet'] ?></textarea><br>
                <label>Danh mục</label>

                <?php
                $sql_danhmuc = mysqli_query($mysqli, "SELECT * FROM tbl_category ORDER BY category_id DESC");
                ?>

                <select class="form-control" require name="danhmuc">
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

                <center><input style="border:1px solid black; " class="btn btn-success" name="capnhatsanpham" type="submit" value="Cập nhật sản phẩm"></center>
            </form>
            <br>
        <?php
        } else {
        ?>

            <h1 class="h3 mb-2 text-gray-800">Thêm sản phẩm</h1>
            <form action="" method="post" enctype=multipart/form-data>
                <label>Tên sản phẩm</label>
                <input type="text" class="form-control" require name="tensanpham" placeholder="Tên sản phẩm"><br>
                <label>Hình ảnh</label>
                <input type="file" class="form-control" require name="hinhanh"><br>
                <img src="../uploads/<?php echo $row_sanpham['sanpham_image'] ?>" height="80px" width="80px"><br><br>
                <label>Giá</label>
                <input type="text" class="form-control" require name="gia" placeholder="Giá"><br>
                <label>Giá khuyến mãi</label>
                <input type="text" class="form-control" require name="giakhuyenmai" placeholder="Giá khuyến mãi"><br>
                <label>Số lượng</label>
                <input type="text" class="form-control" require name="soluong" placeholder="Số lượng"><br>
                <label>Mô tả</label>
                <textarea class="form-control" rows="10px" require name="mota" placeholder="Mô tả"></textarea><br>
                <label>Chi tiết</label>
                <textarea class="form-control" rows="10px" require name="chitiet" placeholder="Chi tiết"></textarea><br>
                <label>Danh mục</label>

                <?php
                $sql_danhmuc = mysqli_query($mysqli, "SELECT * FROM tbl_category ORDER BY category_id DESC");
                ?>

                <select class="form-control" require name="danhmuc">
                    <option value="">------- Chọn danh mục -------</option>

                    <?php
                    while ($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                    ?>

                        <option value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>

                    <?php
                    }
                    ?>

                </select><br>

                <center><input style="border:1px solid black; " class="btn btn-success" name="themsanpham" type="submit" value="Thêm sản phẩm"></center>
            </form>
            <br>
        <?php
        }
        ?>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liệt kê sản phẩm</h6>
        </div>

        <?php
        $sql_chon_sp = mysqli_query($mysqli, "SELECT * FROM tbl_category,tbl_sanpham WHERE tbl_category.category_id = tbl_sanpham.category_id ORDER BY sanpham_id DESC");
        ?>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
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
                    </thead>

                    <tbody>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include('../admin/include/footer.php');
?>

<script>
    $('#btnTest').click(() => {
        let dp = $('.test').css('display');
        if (dp != 'none') {
            $('.test').fadeOut();
        } else {
            $('.test').fadeIn();
        }

    })
</script>