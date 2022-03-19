<?php
// session_destroy();
// unset('dangnhap');
if (isset($_POST['dangnhap'])) {
	$taikhoan = $_POST['Email'];
	$matkhau = base64_encode(md5($_POST['Password']));

	if ($taikhoan == "" && $matkhau == "") {
		echo '<script>alert("Làm ơn không để trống.")</script>';
	} else {
		$sql_admin_chon = mysqli_query($mysqli, "SELECT * FROM tbl_khachhang WHERE khachhang_email = '$taikhoan' AND khachhang_password = '$matkhau'");
		$count = mysqli_num_rows($sql_admin_chon);
		$row_dangnhap = mysqli_fetch_array($sql_admin_chon);
		if ($count > 0) {
			$_SESSION['dangnhap'] = $row_dangnhap['khachhang_name'];
			$_SESSION['khachhang_id'] = $row_dangnhap['khachhang_id'];
			echo '<script>alert("Đăng nhập thành công.")</script>';
			header('Location:index.php?quanly=giohang');
		} else {
			echo '<script>alert("Tài khoản hoặc mật khẩu sai.")</script>';	
		}
	}
}
elseif(isset($_POST['dangky'])){
	$name = $_POST['Name'];
	$phone = $_POST['Phone'];
	$email = $_POST['Email'];
	$pass = base64_encode(md5($_POST['Password']));
	$note = $_POST['Note'];
	$address = $_POST['Address'];
	$giaohang = $_POST['giaohang'];

	$sql_chon_khachhang = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang ORDER BY khachhang_id DESC LIMIT 1");
	$sql_khachhang = mysqli_query($mysqli,"INSERT INTO tbl_khachhang (khachhang_name,khachhang_address,khachhang_phone,khachhang_note,khachhang_email,khachhang_password,khachhang_giaohang) VALUES ('$name','$address','$phone','$note','$email','$pass','$giaohang')");
	$row_chon_khachhang = mysqli_fetch_array($sql_chon_khachhang);
	$_SESSION['dangnhap'] = $name;
	$_SESSION['khachhang_id'] = $row_chon_khachhang['khachhang_id'];
	header("Location:index.php?quanly=giohang");
}
?>

<!-- top-header -->
<div class="agile-main-top">
		<div class="container-fluid">
			<div class="row main-top-w3l py-2">
				<div class="col-lg-4 header-most-top">
					
				</div>
				<div class="col-lg-8 header-right mt-lg-0 mt-2">
					<!-- header lists -->
					<ul>

						<?php
						if(isset($_SESSION['dangnhap']))
						{

						?>
						<li class="text-center border-right text-white">
							<a href="index.php?quanly=xemdonhang&id=<?php echo $_SESSION['khachhang_id'] ?>" class="text-white">
								<i class="fas fa-truck mr-2"></i>Xem đơn hàng</a>
						</li>
						<?php
						}
						?>
						<li class="text-center border-right text-white">
							<i class="fas fa-phone mr-2"></i> 0967666173
						</li>

						

						<?php
						if(isset($_SESSION['dangnhap']))
						{

						?>
						<li class="text-center text-white">
							<a href="#" data-toggle="modal" data-target="#exampleModal" class="text-white">
							<i class="fas fa-user"></i> <?php echo $_SESSION['dangnhap'] ?> - <a href="index.php?quanly=giohang&dangxuat=1"> Đăng xuất</a></a>	
						</li>
						<?php
						} else {
						?>
							<li class="text-center border-right text-white">
							<a href="#" data-toggle="modal" data-target="#exampleModal" class="text-white">
								<i class="fas fa-sign-in-alt mr-2"></i> Đăng nhập </a>
							</li>
							<li class="text-center text-white">
								<a href="#" data-toggle="modal" data-target="#exampleModal2" class="text-white">
									<i class="fas fa-sign-out-alt mr-2"></i>Đăng ký </a>
							</li>
						<?php
						}
						?>

					</ul>
					<!-- //header lists -->
				</div>
			</div>
		</div>
	</div>
    <!-- modals -->
	<!-- log in -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-center">Đăng nhập</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="#" method="post">
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="text" class="form-control" placeholder=" " name="Email" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Mật khẩu</label>
							<input type="password" class="form-control" placeholder=" " name="Password" required="">
						</div>
						<div class="right-w3l">
							<input type="submit" class="form-control" name="dangnhap" value="Đăng nhập">
						</div>
						<p class="text-center dont-do mt-3">Chưa có tài khoản ?
							<a href="#" data-toggle="modal" data-target="#exampleModal2">
								Đăng ký ngay</a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- đăng ký -->
	<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Đăng ký</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="" method="post">
						<div class="form-group">
							<label class="col-form-label">Tên khách hàng</label>
							<input type="text" class="form-control" placeholder=" " name="Name" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="email" class="form-control" placeholder=" " name="Email" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Số điện thoại</label>
							<input type="number" class="form-control" placeholder=" " name="Phone" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Địa chỉ</label>
							<input type="text" class="form-control" placeholder=" " name="Address" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Mật khẩu</label>
							<input type="password" class="form-control" placeholder=" " name="Password" required="">
							<input type="hidden" class="form-control" placeholder=" " name="giaohang" value="0">
						</div>
						<div class="form-group">
							<label class="col-form-label">Ghi chú</label>
							<input type="text" class="form-control" placeholder=" " name="Note" required="">
						</div>
						<div class="right-w3l">
							<input type="submit" class="form-control" name="dangky" value="Đăng ký">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- //modal -->
	<!-- //top-header -->
    <!-- header-bottom-->
	<div class="header-bot">
		<div class="container">
			<div class="row header-bot_inner_wthreeinfo_header_mid">
				<!-- logo -->
				<div class="col-md-3 logo_agile">
					<h1 class="text-center">
						<a href="index.php" class="font-weight-bold font-italic">
							<!-- <img src="images/download.png" alt=" " class="img-fluid"> -->
							Truyện Tranh TNT
						</a>
					</h1>
				</div>
				<!-- //logo -->
				<!-- header-bot -->
				<div class="col-md-9 header mt-4 mb-md-0 mb-4">
					<div class="row">
						<!-- search -->
						<div class="col-10 agileits_search">
							<form class="form-inline" action="index.php?quanly=timkiem" method="POST">
								<input class="form-control mr-sm-2" name="timkiem_name" type="search" placeholder="Tìm kiếm sản phẩm" aria-label="Search" required>
								<button class="btn my-2 my-sm-0" name="timkiem_button" type="submit">Tìm kiếm</button>
							</form>
						</div>
						<!-- //search -->
						<!-- cart details -->
						<div class="col-2 top_nav_right text-center mt-sm-0 mt-2">
							<div class="wthreecartaits wthreecartaits2 cart cart box_1">
								<button class="btn w3view-cart" type="submit" name="submit" value="" style="background:white;">
									<a href="index.php?quanly=giohang" class="fas fa-cart-arrow-down" role="button" aria-pressed="true"></a>
								</button>
							</div>
						</div>
						<!-- //cart details -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- shop locator (popup) -->
	<!-- //header-bottom -->
	<!-- navigation -->