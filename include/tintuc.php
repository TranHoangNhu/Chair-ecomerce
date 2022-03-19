<?php
if (isset($_GET['id'])) {
	$id_danhmuc = $_GET['id'];
} else {
	$id_danhmuc = '';
}
?>
<!-- page -->
<div class="services-breadcrumb">
	<div class="agile_inner_breadcrumb">
		<div class="container">
			<ul class="w3_short">
				<li>
					<a href="index.php">Trang chủ</a>
					<i>|</i>
				</li>
				<?php
				$sql_tendanhmuc = mysqli_query($mysqli, "SELECT * FROM tbl_danhmuc_tin WHERE danhmuc_tin_id = '$id_danhmuc'");
				$row_tendanhmuc = mysqli_fetch_array($sql_tendanhmuc);
				?>

				<li><?php echo $row_tendanhmuc['danhmuc_tin_name'] ?></li>
			</ul>
		</div>
	</div>
</div>
<!-- //page -->
<!-- about -->
<div class="welcome py-sm-5 py-4">
	<div class="container py-xl-4 py-lg-2">
		<!-- tittle heading -->
		<?php
		$sql_danhmuc = mysqli_query($mysqli, "SELECT * FROM tbl_danhmuc_tin WHERE danhmuc_tin_id = '$id_danhmuc'");
		$row_danhmuc = mysqli_fetch_array($sql_danhmuc);
		?>
		<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
			<?php echo $row_danhmuc['danhmuc_tin_name'] ?></h3>
		<!-- //tittle heading -->
		<?php
		$sql_baiviet = mysqli_query($mysqli, "SELECT * FROM tbl_baiviet, tbl_danhmuc_tin WHERE tbl_danhmuc_tin.danhmuc_tin_id = tbl_baiviet.danhmuc_tin_id AND tbl_danhmuc_tin.danhmuc_tin_id = '$id_danhmuc'");
		while ($row_baiviet = mysqli_fetch_array($sql_baiviet)) {
		?>
			<div class="row">
				<div class="col-lg-4 welcome-right-top mt-lg-0 mt-sm-5 mt-4">
					<img src="images/<?php echo $row_baiviet['baiviet_image'] ?>" class="img-fluid" alt=" ">
				</div>
				<div class="col-lg-8 welcome-left">
					<h3><a href="index.php?quanly=chitiettin&id=<?php echo $row_baiviet['baiviet_id'] ?>"><?php echo $row_baiviet['baiviet_name'] ?></a></h3>
					<h4 class="my-sm-3 my-2"><?php echo $row_baiviet['baiviet_tomtat'] ?></h4>
				</div>
			</div><br>
		<?php
		}
		?>

	</div>
</div>
<!-- //about -->