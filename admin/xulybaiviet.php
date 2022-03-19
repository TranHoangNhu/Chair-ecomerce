<?php
include('../db/connect.php');
?>
<?php

if (isset($_POST['thembaiviet'])) {
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $path = "../uploads/";
    $tenbaiviet = $_POST['tenbaiviet'];
    $chitiet = $_POST['chitiet'];
    $mota = $_POST['mota'];
    $danhmuc = $_POST['danhmuc'];

    if($hinhanh != "" && $path != "" && $tenbaiviet != "" && $chitiet != "" && $mota != "")
    {
        $sql_them = mysqli_query($mysqli, "INSERT INTO tbl_baiviet (baiviet_name,baiviet_tomtat,baiviet_noidung,danhmuc_tin_id,baiviet_image) VALUES ('$tenbaiviet','$mota','$chitiet','$danhmuc','$hinhanh')");
        move_uploaded_file($hinhanh_tmp, $path . $hinhanh);
    } 
    
} elseif (isset($_POST['capnhatbaiviet'])) {
    $id = $_GET['id'];
    $tenbaiviet = $_POST['tenbaiviet'];
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $chitiet = $_POST['chitiet'];
    $mota = $_POST['mota'];
    $path = "../uploads/";
    $danhmuc = $_POST['danhmuc'];

    if ($hinhanh == '') {
        $sql_capnhat_image = "UPDATE tbl_baiviet SET danhmuc_tin_id='$danhmuc',baiviet_name='$tenbaiviet',baiviet_noidung='$chitiet',baiviet_tomtat='$mota' WHERE baiviet_id = '$id'";
    } else {
        move_uploaded_file($hinhanh_tmp, $path . $hinhanh);
        $sql_capnhat_image = "UPDATE tbl_baiviet SET danhmuc_tin_id='$danhmuc',baiviet_name='$tenbaiviet',baiviet_noidung='$chitiet',baiviet_tomtat='$mota',baiviet_image='$hinhanh' WHERE baiviet_id = '$id'";
    }
    mysqli_query($mysqli, $sql_capnhat_image);
}

if (isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    $path_delete = "../uploads/";

    $sql_xoa = mysqli_query($mysqli, "DELETE FROM tbl_baiviet WHERE baiviet_id = '$id'");
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
        if (isset($_GET['quanly']) == 'baiviet') {
            $id_baiviet = $_GET['id'];
            $sql_baiviet = mysqli_query($mysqli, "SELECT * FROM tbl_baiviet WHERE baiviet_id = '$id_baiviet'");
            $row_baiviet = mysqli_fetch_array($sql_baiviet);
            $id_cate = $row_baiviet['danhmuc_tin_id'];
        ?>

            <h1 class="h3 mb-2 text-gray-800">Cập nhật bài viết</h1>
            <form action="" method="post" enctype=multipart/form-data>
                <label>Tên sản phẩm</label>
                <input type="text" class="form-control" require name="tenbaiviet" placeholder="Tên bài viết" value="<?php echo $row_baiviet['baiviet_name'] ?>"><br>
                <label>Hình ảnh</label>
                <input type="file" class="form-control" require name="hinhanh"><br>
                <img src="../uploads/<?php echo $row_baiviet['baiviet_image'] ?>" height="80px" width="80px"><br><br>
                <label>Tóm tắt</label>
                <textarea class="form-control" rows="10px" require name="mota" placeholder="Tóm tắt"><?php echo $row_baiviet['baiviet_tomtat'] ?></textarea><br>
                <label>Nội dung</label>
                <textarea class="form-control" rows="10px" require name="chitiet" placeholder="Nội dung"><?php echo $row_baiviet['baiviet_noidung'] ?></textarea><br>
                <label>Danh mục</label>

                <?php
                $sql_danhmuc = mysqli_query($mysqli, "SELECT * FROM tbl_danhmuc_tin ORDER BY danhmuc_tin_id DESC");
                ?>

                <select class="form-control" require name="danhmuc">
                    <option value="">------- Chọn danh mục -------</option>

                    <?php
                    while ($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                        if ($id_cate == $row_danhmuc['danhmuc_tin_id']) {
                    ?>

                            <option selected value="<?php echo $row_danhmuc['danhmuc_tin_id'] ?>"><?php echo $row_danhmuc['danhmuc_tin_name'] ?></option>

                        <?php
                        } else {
                        ?>
                            <option value="<?php echo $row_danhmuc['danhmuc_tin_id'] ?>"><?php echo $row_danhmuc['danhmuc_tin_name'] ?></option>
                    <?php

                        }
                    }
                    ?>

                </select><br>

                <center><input style="border:1px solid black; " class="btn btn-success" name="capnhatbaiviet" type="submit" value="Cập nhật bài viết"></center>
            </form>
            <br>
        <?php
        } else {
        ?>

            <h1 class="h3 mb-2 text-gray-800">Thêm bài viết</h1>
            <form action="" method="post" enctype=multipart/form-data>
                <label>Tên sản phẩm</label>
                <input type="text" class="form-control" require name="tenbaiviet" placeholder="Tên bài viết"><br>
                <label>Hình ảnh</label>
                <input type="file" class="form-control" require name="hinhanh"><br>
                <img src="../uploads/<?php echo $row_baiviet['baiviet_image'] ?>" height="80px" width="80px"><br><br>
                <label>Tóm tắt</label>
                <textarea class="form-control" rows="10px" require name="mota" placeholder="Tóm tắt"></textarea><br>
                <label>Nội dung</label>
                <textarea class="form-control" rows="10px" require name="chitiet" placeholder="Nội dung"></textarea><br>
                <label>Danh mục</label>

                <?php
                $sql_danhmuc = mysqli_query($mysqli, "SELECT * FROM tbl_danhmuc_tin ORDER BY danhmuc_tin_id DESC");
                ?>

                <select class="form-control" require name="danhmuc">
                    <option value="">------- Chọn danh mục -------</option>

                    <?php
                    while ($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                    ?>

                        <option value="<?php echo $row_danhmuc['danhmuc_tin_id'] ?>"><?php echo $row_danhmuc['danhmuc_tin_name'] ?></option>

                    <?php
                    }
                    ?>

                </select><br>
                
                <center><input style="border:1px solid black; " class="btn btn-success" name="thembaiviet" type="submit" value="Thêm bài viết"></center>
            </form>
            <br>
        <?php
        }
        ?>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liệt kê bài viết</h6>
        </div>

        <?php
        $sql_chon_sp = mysqli_query($mysqli, "SELECT * FROM tbl_danhmuc_tin,tbl_baiviet WHERE tbl_danhmuc_tin.danhmuc_tin_id = tbl_baiviet.danhmuc_tin_id ORDER BY baiviet_id DESC");
        ?>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Thứ tự</th>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Tóm tắt</th>
                            <th>Nội dung</th>
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
                                <td><?php echo $row_chon_sp['baiviet_name'] ?></td>
                                <td><img src="../uploads/<?php echo $row_chon_sp['baiviet_image'] ?>" height="80px" width="80px"></td>
                                <td><?php echo $row_chon_sp['baiviet_tomtat'] ?></td>
                                <td><?php echo $row_chon_sp['baiviet_noidung'] ?></td>
                                <td><a href="?xoa=<?php echo $row_chon_sp['baiviet_id'] ?>">Xóa</a> || <a href="?quanly=baiviet&id=<?php echo $row_chon_sp['baiviet_id'] ?>">Cập nhật</a></td>
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