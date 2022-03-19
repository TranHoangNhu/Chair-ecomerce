<?php
	if(isset($_POST['submit']))
    {
		$tensanpham = $_POST['tensanpham'];
		$sanphamid = $_POST['sanphamid'];
		$giasanpham = $_POST['giasanpham'];
		$hinhanh = $_POST['hinhanh'];
		$soluong = $_POST['soluong'];
		$khachhang_id = $_SESSION['khachhang_id'];
		
		$sql_giohang_chon = mysqli_query($mysqli,"SELECT * FROM tbl_giohang WHERE sanpham_id = '$sanphamid' ");
        $count = mysqli_num_rows($sql_giohang_chon);
        if($count > 0)
        {
            $row_sanpham = mysqli_fetch_array($sql_giohang_chon);
            $soluong = $row_sanpham['giohang_soluong']  + 1;
            $sql_giohang = "UPDATE tbl_giohang SET giohang_soluong = '$soluong' WHERE sanpham_id = '$sanphamid'";
        } 
		else 
		{
			$soluong = $soluong;
			$sql_giohang = "INSERT INTO tbl_giohang (giohang_tensanpham,giohang_image,giohang_soluong,giohang_gia,sanpham_id,khachhang_id) VALUES ('$tensanpham','$hinhanh','$soluong','$giasanpham','$sanphamid','$khachhang_id')";
		}

        $insert_row = mysqli_query($mysqli,$sql_giohang);
		if($insert_row == 0)
		{
			header('location:index.php?quanly=chitiet&id='.$sanphamid);
		}
	}
	elseif(isset($_POST['capnhatgiohang']))
	{
		for($i = 0; $i < count($_POST['sanpham_id']);$i++){
			$sanpham_id = $_POST['sanpham_id'][$i];
			$soluong = $_POST['soluong'][$i];
			if($soluong <= 0)
			{
				$sql_xoa = mysqli_query($mysqli,"DELETE FROM tbl_giohang WHERE sanpham_id = '$sanpham_id'");
			}
			else
			{
				$sql_capnhat = mysqli_query($mysqli,"UPDATE tbl_giohang SET giohang_soluong = '$soluong' WHERE sanpham_id = '$sanpham_id'");
			}	
		}
	}
	elseif(isset($_GET['xoa'])){
		$id = $_GET['xoa'];
		$sql_xoa = mysqli_query($mysqli,"DELETE FROM tbl_giohang WHERE giohang_id = '$id'");
	}
	elseif(isset($_GET['dangxuat']))
	{
		$id = $_GET['dangxuat'];
		$xoa = $_SESSION['khachhang_id'];

		if($id == 1)
		{
			$sql_xoa_don = mysqli_query($mysqli,"DELETE FROM tbl_giohang WHERE khachhang_id = '$xoa'");
			// unset($_SESSION['dangnhap']);
			session_destroy();
			// header("location:index.php");
			echo" <script> alert('Đăng xuất thành công'); window.location.href = 'index.php' </script>" ;
		}
	}
	elseif(isset($_POST['thanhtoan'])){
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$pass = base64_encode(md5($_POST['password']));
		$note = $_POST['note'];
		$address = $_POST['address'];
		$giaohang = $_POST['giaohang'];

		$sql_khachhang = mysqli_query($mysqli,"INSERT INTO tbl_khachhang (khachhang_name,khachhang_address,khachhang_phone,khachhang_note,khachhang_email,khachhang_password,khachhang_giaohang) VALUES ('$name','$address','$phone','$note','$email','$pass','$giaohang')");
		if($sql_khachhang == 1){
			$sql_khachhang_chon = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang ORDER BY khachhang_id DESC LIMIT 1");
			$mahang = rand(0,9999) + date("dmY");
			$row_khachhang = mysqli_fetch_array($sql_khachhang_chon);
			$khachhang_id = $row_khachhang['khachhang_id'];

			$_SESSION['dangnhap'] = $row_khachhang['khachhang_name'];
			$_SESSION['khachhang_id'] = $khachhang_id;
			for($i = 0; $i < count($_POST['thanhtoan_sanpham_id']);$i++){
				$sanpham_id = $_POST['thanhtoan_sanpham_id'][$i];
				$soluong = $_POST['thanhtoan_soluong'][$i];
				
				$sql_donhang = mysqli_query($mysqli,"INSERT INTO tbl_donhang (sanpham_id,donhang_soluong,donhang_mahang,khachhang_id) VALUES ('$sanpham_id','$soluong','$mahang','$khachhang_id')");

				$sql_giaodich = mysqli_query($mysqli,"INSERT INTO tbl_giaodich (sanpham_id,giaodich_soluong,giaodich_magiaodich,khachhang_id) VALUES ('$sanpham_id','$soluong','$mahang','$khachhang_id')");

				$sql_xoa_thanhtoan = mysqli_query($mysqli,"DELETE FROM tbl_giohang WHERE sanpham_id = '$sanpham_id'");
			}
		}
	}
	elseif(isset($_POST['thanhtoangiohang'])){
		$khachhang_id = $_SESSION['khachhang_id'];		
		$mahang = rand(0,9999) + date("dmY");	
		for($i = 0; $i < count($_POST['thanhtoan_sanpham_id']);$i++){
			$sanpham_id = $_POST['thanhtoan_sanpham_id'][$i];
			$soluong = $_POST['thanhtoan_soluong'][$i];
			
			$sql_donhang = mysqli_query($mysqli,"INSERT INTO tbl_donhang (sanpham_id,donhang_soluong,donhang_mahang,khachhang_id) VALUES ('$sanpham_id','$soluong','$mahang','$khachhang_id')");

			$sql_giaodich = mysqli_query($mysqli,"INSERT INTO tbl_giaodich (sanpham_id,giaodich_soluong,giaodich_magiaodich,khachhang_id) VALUES ('$sanpham_id','$soluong','$mahang','$khachhang_id')");

			$sql_xoa_thanhtoan = mysqli_query($mysqli,"DELETE FROM tbl_giohang WHERE sanpham_id = '$sanpham_id'");
		}
	}
?>

<div class="privacy py-sm-5 py-4">
	<div class="container py-xl-4 py-lg-2">
	<?php
		if(isset($_SESSION['dangnhap']))
		{
			// echo '<h2 style="color:#000;">Xin chào bạn : '.$_SESSION['dangnhap'].' -<a href="index.php?quanly=giohang&dangxuat=1"> Đăng xuất</a></h2>';
		}
	?>
	</div>

	<div class="container py-xl-4 py-lg-2">
		<!-- tittle heading -->
		<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
			Giỏ hàng của bạn
		</h3>
		<!-- //tittle heading -->
		<div class="checkout-right">

			<?php
				$sql_giohang_lay = mysqli_query($mysqli,"SELECT * FROM tbl_giohang ORDER BY giohang_id DESC");
			?>

			<div class="table-responsive">
				<form action="" method="post">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>STT</th>
								<th>Hình sản phẩm</th>
								<th>Số lượng</th>
								<th>Tên sản phẩm</th>
								<th>Đơn giá</th>
								<th>Thành tiền</th>
								<th>Hành động</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$i = 0;
								$total = 0;
								while($row_giohang_lay = mysqli_fetch_array($sql_giohang_lay)){
									$subtotal = $row_giohang_lay['giohang_soluong'] * $row_giohang_lay['giohang_gia'];
									$total += $subtotal;
									$i++;
							?>

							<tr class="rem1">
								<td class="invert"><?php echo $i ?></td>
								<td class="invert-image">
									<a href="single.html">
										<img src="images/<?php echo $row_giohang_lay['giohang_image'] ?>" alt=" " height="150px" class="img-responsive">
									</a>
								</td>
								<td class="invert">
									<div class="quantity">
										<div class="quantity-select">
											<!-- <div class="entry value-minus">&nbsp;</div>
											<div class="entry value">
												<span id="soluong[]"><?php echo $row_giohang_lay['giohang_soluong'] ?></span>
											</div>
											<div class="entry value-plus active">&nbsp;</div> -->
											<input type="number" name="soluong[]" min="0" style="text-align: center;" value="<?php echo $row_giohang_lay['giohang_soluong'] ?>">
											<input type="hidden" name="sanpham_id[]" value="<?php echo $row_giohang_lay['sanpham_id'] ?>">
										</div>
									</div>
								</td>
								<td class="invert"><?php echo $row_giohang_lay['giohang_tensanpham'] ?></td>
								<td class="invert"><?php echo number_format($row_giohang_lay['giohang_gia']).' VND' ?></td>
								<td class="invert"><?php echo number_format($subtotal).' VND' ?></td>
								<td class="invert">
									<a href="?quanly=giohang&xoa=<?php echo $row_giohang_lay['giohang_id'] ?>">Xóa</a>
								</td>
							</tr>
							<?php
							}
							?>
							<tr>
								<td colspan="7">Tổng tiền cần thanh toán : <?php echo number_format($total).' VND' ?></td>
							</tr>
							<tr>
								<td colspan="7"><input type="submit" class="btn btn-success" value="Cập nhật giỏ hàng" name="capnhatgiohang">
								
								<?php
									$sql_giohang_select = mysqli_query($mysqli,"SELECT * FROM tbl_giohang");
									$count_giohang_select = mysqli_num_rows($sql_giohang_select);

									if(isset($_SESSION['dangnhap']) && $count_giohang_select > 0){

								?>
								
								<?php
									while ($row_giohang_select = mysqli_fetch_array($sql_giohang_select)){
									
								?>
									<input type="hidden" name="thanhtoan_soluong[]" style="text-align: center;" value="<?php echo $row_giohang_select['giohang_soluong'] ?>">
									<input type="hidden" name="thanhtoan_sanpham_id[]" value="<?php echo $row_giohang_select['sanpham_id'] ?>">
								<?php
								}
								?>

								<input type="submit" class="btn btn-primary" value="Thanh toán" name="thanhtoangiohang">

								<?php
								}
								?>
								
								</td>

							</tr>
						</tbody>
					</table>
				</form>
			</div>
		</div>

		<?php
			if(!isset($_SESSION['dangnhap'])){
		?>

		<div class="checkout-left">
			<div class="address_form_agile mt-sm-5 mt-4">
				<h4 class="mb-sm-4 mb-3">Thông tin giao hàng</h4>
				<form action="" method="post" class="creditly-card-form agileinfo_form">
					<div class="creditly-wrapper wthree, w3_agileits_wrapper">
						<div class="information-wrapper">
							<div class="first-row">
								<div class="controls form-group">
									<input class="billing-address-name form-control" type="text" name="name" placeholder="Họ tên" required="">
								</div>
								<div class="w3_agileits_card_number_grids">
									<div class="w3_agileits_card_number_grid_left form-group">
										<div class="controls">
											<input type="text" class="form-control" placeholder="Số điện thoại" name="phone" required="">
										</div>
									</div>
									<div class="w3_agileits_card_number_grid_right form-group">
										<div class="controls">
											<input type="text" class="form-control" placeholder="Địa chỉ" name="address" required="">
										</div>
									</div>
								</div>
								<div class="controls form-group">
									<input type="email" class="form-control" placeholder="Email" name="email" required="">
								</div>
								<div class="controls form-group">
									<input type="password" class="form-control" placeholder="Mật khẩu" name="password" required="">
								</div>
								<div class="controls form-group">
									<textarea style="resize:none;" type="text" class="form-control" placeholder="Ghi chú" name="note" required=""></textarea>
								</div>
								<div class="controls form-group">
									<select class="option-w3ls" name="giaohang">
										<option>Chọn hình thức giao hàng</option>
										<option value="1">Thanh toán ATM</option>
										<option value="0">Thanh toán khi nhận hàng</option>

									</select>
								</div>
							</div>

							<?php
								$sql_giohang_lay_sanpham = mysqli_query($mysqli,"SELECT * FROM tbl_giohang ORDER BY giohang_id DESC"); 
								while ($row_thanhtoan = mysqli_fetch_array($sql_giohang_lay_sanpham)){
								
							?>
								<input type="hidden" name="thanhtoan_soluong[]" style="text-align: center;" value="<?php echo $row_thanhtoan['giohang_soluong'] ?>">
								<input type="hidden" name="thanhtoan_sanpham_id[]" value="<?php echo $row_thanhtoan['sanpham_id'] ?>">
							<?php
							}
							?>

							<input type="submit" name="thanhtoan" class="btn btn-success" style="width: 20%;" value="Thanh toán">
						</div>
					</div>
				</form>
				<!-- <div class="checkout-right-basket">
					<a href="payment.html">Make a Payment
						<span class="far fa-hand-point-right"></span>
					</a>
				</div> -->
			</div>
		</div>

		<?php
		}
		?>

	</div>
</div>

<!-- jquery -->
<script src="js/jquery-2.2.3.min.js"></script>
<!-- //jquery -->

<!-- quantity -->
<script>
	$('.value-plus').on('click', function () {
		var divUpd = $(this).parent().find('.value'),
			newVal = parseInt(divUpd.text(), 10) + 1;
		divUpd.text(newVal);
	});

	$('.value-minus').on('click', function () {
		var divUpd = $(this).parent().find('.value'),
			newVal = parseInt(divUpd.text(), 10) - 1;
		if (newVal >= 1) divUpd.text(newVal);
	});
</script>