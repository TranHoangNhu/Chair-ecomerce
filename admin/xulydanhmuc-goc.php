<?php
    include('../db/connect.php');
?>
<?php
    if(isset($_POST['themdanhmuc']))
    {
        $tendanhmuc = $_POST['danhmuc'];

        $sql_them = mysqli_query($mysqli,"INSERT INTO tbl_category (category_name) VALUES ('$tendanhmuc')");
    }

    elseif(isset($_POST['capnhatdanhmuc']))
    {
        $tendanhmuc = $_POST['danhmuc'];
        $id_danhmuc_post = $_POST['id_danhmuc'];

        $sql_capnhat = mysqli_query($mysqli,"UPDATE tbl_category SET category_name = '$tendanhmuc' WHERE category_id = '$id_danhmuc_post'");
        header("Location:xulydanhmuc.php");
    }

    if(isset($_GET['xoa']))
    {
        $id = $_GET['xoa'];

        $sql_xoa = mysqli_query($mysqli,"DELETE FROM tbl_category WHERE category_id = '$id'");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
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
            if(isset($_GET['quanly']) == 'capnhat')
            {
                $id_capnhat = $_GET['id'];
                $sql_capnhat = mysqli_query($mysqli, "SELECT * FROM tbl_category WHERE category_id = '$id_capnhat'");
                $row_capnhat = mysqli_fetch_array($sql_capnhat);
            ?>

                <div class="col-md-4">
                    <h4>Cập nhật danh mục</h4>
                    <label>Tên danh mục</label>
                    <form action="" method="post">
                        <input type="text" class="form-control" name="danhmuc" value="<?php echo $row_capnhat['category_name']?>"><br>
                        <input type="hidden" class="form-control" name="id_danhmuc" value="<?php echo $row_capnhat['category_id']?>">
                        <input type="submit" name="capnhatdanhmuc" value="Cập nhật danh mục" class="btn btn-default">
                    </form>
                </div>

            <?php
            }
            else
            {
            ?>

                <div class="col-md-4">
                    <h4>Thêm danh mục</h4>
                    <label>Tên danh mục</label>
                    <form action="" method="post">
                        <input type="text" class="form-control" name="danhmuc" placeholder="Tên danh mục"><br>
                        <input type="submit" name="themdanhmuc" value="Thêm danh mục" class="btn btn-default">
                    </form>
                </div>

            <?php
            }
            ?>          

        <div class="col-md-8">
            <h4>Liệt kê danh mục</h4>

            <?php
                $sql_chon = mysqli_query($mysqli,"SELECT * FROM tbl_category ORDER BY category_id DESC");
            ?>

            <table class="table table-bordered">
                <tr>
                    <th>Thứ tự</th>
                    <th>Tên danh mục</th>
                    <th>Quản lý</th>
                </tr>

                <?php
                    $i = 0; 
                    while ($row_chon = mysqli_fetch_array($sql_chon)){
                        $i++;
                ?>

                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row_chon['category_name'] ?></td>
                    <td><a href="?xoa=<?php echo $row_chon['category_id'] ?>">Xóa</a> || <a href="?quanly=capnhat&id=<?php echo $row_chon['category_id'] ?>">Cập nhật</a></td>
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