<?php
    include('../db/connect.php');
?>
<?php
    if(isset($_POST['themdanhmuc']))
    {
        $tendanhmuc = $_POST['danhmuc'];

        $sql_them = mysqli_query($mysqli,"INSERT INTO tbl_danhmuc_tin (danhmuc_tin_name) VALUES ('$tendanhmuc')");
    }

    elseif(isset($_POST['capnhatdanhmuc']))
    {
        $tendanhmuc = $_POST['danhmuc'];
        $id_danhmuc_post = $_POST['id_danhmuc'];

        $sql_capnhat = mysqli_query($mysqli,"UPDATE tbl_danhmuc_tin SET danhmuc_tin_name = '$tendanhmuc' WHERE danhmuc_tin_id = '$id_danhmuc_post'");
        header("Location:xulydanhmuc.php");
    }

    if(isset($_GET['xoa']))
    {
        $id = $_GET['xoa'];

        $sql_xoa = mysqli_query($mysqli,"DELETE FROM tbl_danhmuc_tin WHERE danhmuc_tin_id = '$id'");
    }
?>

<?php
include('../admin/include/header.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div>
        <?php
        if (isset($_GET['quanly']) == 'capnhat') {
            $id_capnhat = $_GET['id'];
            $sql_capnhat = mysqli_query($mysqli, "SELECT * FROM tbl_danhmuc_tin WHERE danhmuc_tin_id = '$id_capnhat'");
            $row_capnhat = mysqli_fetch_array($sql_capnhat);
        ?>

            <h1 class="h3 mb-2 text-gray-800">Cập nhật danh mục</h1>
            <label>Tên danh mục</label>
            <form action="" method="post">
                <input type="text" require class="form-control" name="danhmuc" value="<?php echo $row_capnhat['danhmuc_tin_name'] ?>"><br>
                <input type="hidden" class="form-control" name="id_danhmuc" value="<?php echo $row_capnhat['danhmuc_tin_id'] ?>">
                <center><input style="border:1px solid black; " class="btn btn-success" name="capnhatdanhmuc" type="submit" value="Cập nhật danh mục"></center>
            </form>
            <br>
        <?php
        } else {
        ?>

            <h1 class="h3 mb-2 text-gray-800">Thêm danh mục</h1>
            <label>Tên danh mục</label>
            <form action="" method="post">
                <input type="text" require class="form-control" name="danhmuc" placeholder="Tên danh mục"><br>
                <center><input style="border:1px solid black; " class="btn btn-success" name="themdanhmuc" type="submit" value="Thêm danh mục"></center>
            </form>
            <br>
        <?php
        }
        ?>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liệt kê danh mục</h6>
        </div>

        <?php
        $sql_chon = mysqli_query($mysqli, "SELECT * FROM tbl_danhmuc_tin ORDER BY danhmuc_tin_id DESC");
        ?>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Thứ tự</th>
                            <th>Tên danh mục</th>
                            <th>Quản lý</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $i = 0;
                        while ($row_chon = mysqli_fetch_array($sql_chon)) {
                            $i++;
                        ?>

                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row_chon['danhmuc_tin_name'] ?></td>
                                <td><a href="?xoa=<?php echo $row_chon['danhmuc_tin_id'] ?>">Xóa</a> || <a href="?quanly=capnhat&id=<?php echo $row_chon['danhmuc_tin_id'] ?>">Cập nhật</a></td>
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