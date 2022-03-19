<?php
session_start();
include('../db/connect.php');
?>
<?php
// session_destroy();
// unset('dangnhap');
if (isset($_POST['dangnhap'])) {
	$taikhoan = $_POST['taikhoan'];
	$matkhau = base64_encode(md5($_POST['matkhau']));

	if ($taikhoan == "" && $matkhau == "") {
		echo "<p>Xin nhập đủ thông tin</p>";
	} else {
		$sql_admin_chon = mysqli_query($mysqli, "SELECT * FROM tbl_admin WHERE admin_email = '$taikhoan' AND admin_password = '$matkhau'");
		$count = mysqli_num_rows($sql_admin_chon);
		$row_dangnhap = mysqli_fetch_array($sql_admin_chon);
		if ($count > 0) {
			$_SESSION['dangnhap_admin'] = $row_dangnhap['admin_name']; //name admin
			$_SESSION['admin_id'] = $row_dangnhap['admin_id']; //od admin
			header("Location:dashboard.php");
		} else {
			echo "<p>Tài khoản hoặc mật khẩu sai.</p>";
		}
	}
}

?>
<!DOCTYPE HTML>
<html lang="en">

<head>
	<title>Đăng nhập Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
	<link rel="stylesheet" href="/WEB/admin/css/font-awesome.css">
	<link rel="stylesheet" href="/WEB/admin/css/style.css" type="text/css" media="all" />
</head>

<body>

	<div class="center-container">

		<div class="header-w3l">
			<h1>Đăng nhập Admin</h1>
		</div>

		<div class="main-content-agile">
			<div class="sub-main-w3">
				<form action="" method="post">
					<div class="pom-agile">
						<input placeholder="E-mail" name="taikhoan" class="user" type="email" required="">
						<span class="icon1"><i class="fa fa-user" aria-hidden="true"></i></span>
					</div>
					<div class="pom-agile">
						<input placeholder="Password" name="matkhau" class="pass" type="password" required="">
						<span class="icon2"><i class="fa fa-unlock" aria-hidden="true"></i></span>
					</div>
					<div class="sub-w3l">
						<h6><a href="#">Quên mật khẩu ?</a></h6>
						<div class="right-w3l">
							<input type="submit" name="dangnhap" value="Login">
						</div>
					</div>
				</form>
			</div>
		</div>

	</div>
</body>

</html>