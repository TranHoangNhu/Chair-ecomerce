<?php 

	if(isset($_POST['timkiem_button'])){
	$tukhoa = $_POST['timkiem_name'];

	$sql_product = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham WHERE tbl_sanpham.sanpham_name LIKE '%$tukhoa%' ORDER BY tbl_sanpham.sanpham_id DESC");
	$tittle = $tukhoa;
	}
?>

<!-- top Products -->
<div class="ads-grid py-sm-5 py-4">
	<div class="container py-xl-4 py-lg-2">
		<!-- tittle heading -->
		<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">Từ khóa tìm kiếm : <?php echo $tittle ?></h3>
		<!-- //tittle heading -->
		<div class="row">
			<!-- product left -->
			<div class="agileinfo-ads-display col-lg-9">
				<div class="wrapper">
					<!-- first section -->
					<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
						<div class="row">
							<?php 
								while ($row_cate = mysqli_fetch_array($sql_product)){
							?>
							<div class="col-md-4 product-men">
								<div class="men-pro-item simpleCart_shelfItem">
									<div class="men-thumb-item text-center">
										<img src="images/<?php echo $row_cate['sanpham_image'] ?>" alt="" height="150px" width="150px">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="?quanly=chitietsp&id=<?php echo $row_cate['sanpham_id'] ?>" class="link-product-add-cart">Xem chi tiết</a>
											</div>
										</div>
									</div>
									<div class="item-info-product text-center border-top mt-4">
										<h4 class="pt-1">
											<a href="?quanly=chitietsp&id=<?php echo $row_cate['sanpham_id'] ?>"><?php echo $row_cate['sanpham_name'] ?></a>
										</h4>
										<div class="info-product-price my-2">
											<span class="item_price"><?php echo number_format($row_cate['sanpham_giakhuyenmai']).' VND' ?><br></span>
											<del><?php echo number_format($row_cate['sanpham_gia']).' VND' ?></del>
										</div>
										<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
										<form action="?quanly=giohang" method="post">
												<fieldset>
													<input type="hidden" name="tensanpham" value="<?php echo $row_cate['sanpham_name']?>" />
													<input type="hidden" name="sanphamid" value="<?php echo $row_cate['sanpham_id']?>" />
													<input type="hidden" name="giasanpham" value="<?php echo $row_cate['sanpham_giakhuyenmai']?>" />
													<input type="hidden" name="hinhanh" value="<?php echo $row_cate['sanpham_image']?>" />
													<input type="hidden" name="soluong" value="1" />
													
													<input type="submit" name="submit" value="Thêm vào giỏ hàng" class="button" />
												</fieldset>
											</form>
										</div>

									</div>
								</div>
							</div>
							<?php 
							}
							?>
						</div>
					</div>
					<!-- //first section -->
				</div>
			</div>
			<!-- //product left -->
			<!-- product right -->
			<div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
				<div class="side-bar p-sm-4 p-3">
					<!-- <div class="search-hotel border-bottom py-2">
						<h3 class="agileits-sear-head mb-3">Brand</h3>
						<form action="#" method="post">
							<input type="search" placeholder="Search Brand..." name="search" required="">
							<input type="submit" value=" ">
						</form>
						<div class="left-side py-2">
							<ul>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Samsung</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Red Mi</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Apple</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Nexus</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Motorola</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Micromax</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Lenovo</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Oppo</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Sony</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">LG</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">One Plus</span>
								</li>
							</ul>
						</div>
					</div> -->
					<!-- ram -->
					<!-- <div class="left-side border-bottom py-2">
						<h3 class="agileits-sear-head mb-3">Ram</h3>
						<ul>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">Less than 512 MB</span>
							</li>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">512 MB - 1 GB</span>
							</li>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">1 GB</span>
							</li>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">2 GB</span>
							</li>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">3 GB</span>
							</li>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">5 GB</span>
							</li>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">6 GB</span>
							</li>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">6 GB & Above</span>
							</li>
						</ul>
					</div> -->
					<!-- //ram -->
					<!-- price -->
					<!-- <div class="range border-bottom py-2">
						<h3 class="agileits-sear-head mb-3">Price</h3>
						<div class="w3l-range">
							<ul>
								<li>
									<a href="#">Under $1,000</a>
								</li>
								<li class="my-1">
									<a href="#">$1,000 - $5,000</a>
								</li>
								<li>
									<a href="#">$5,000 - $10,000</a>
								</li>
								<li class="my-1">
									<a href="#">$10,000 - $20,000</a>
								</li>
								<li>
									<a href="#">$20,000 $30,000</a>
								</li>
								<li class="mt-1">
									<a href="#">Over $30,000</a>
								</li>
							</ul>
						</div>
					</div> -->
					<!-- //price -->
					<!-- discounts -->
					<!-- <div class="left-side border-bottom py-2">
						<h3 class="agileits-sear-head mb-3">Discount</h3>
						<ul>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">5% or More</span>
							</li>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">10% or More</span>
							</li>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">20% or More</span>
							</li>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">30% or More</span>
							</li>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">50% or More</span>
							</li>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">60% or More</span>
							</li>
						</ul>
					</div> -->
					<!-- //discounts -->
					<!-- offers -->
					<!-- <div class="left-side border-bottom py-2">
						<h3 class="agileits-sear-head mb-3">Offers</h3>
						<ul>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">Exchange Offer</span>
							</li>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">No Cost EMI</span>
							</li>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">Special Price</span>
							</li>
						</ul>
					</div> -->
					<!-- //offers -->
					<!-- delivery -->
					<!-- <div class="left-side border-bottom py-2">
						<h3 class="agileits-sear-head mb-3">Cash On Delivery</h3>
						<ul>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">Eligible for Cash On Delivery</span>
							</li>
						</ul>
					</div> -->
					<!-- //delivery -->
					<!-- arrivals -->
					<!-- <div class="left-side border-bottom py-2">
						<h3 class="agileits-sear-head mb-3">New Arrivals</h3>
						<ul>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">Last 30 days</span>
							</li>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">Last 90 days</span>
							</li>
						</ul>
					</div>
					<div class="left-side py-2">
						<h3 class="agileits-sear-head mb-3">Availability</h3>
						<ul>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">Exclude Out of Stock</span>
							</li>
						</ul>
					</div> -->
					<!-- //arrivals -->
					<div class="left-side border-bottom py-2">

							<h3 class="agileits-sear-head mb-3">Danh mục sản phẩm</h3>
							<?php 
								$sql_category_sidebar = mysqli_query($mysqli,"SELECT * FROM tbl_category ORDER BY category_id DESC");
								while($row_category_sidebar =  mysqli_fetch_array($sql_category_sidebar)){
							?>
							<ul>
								<li>
									<!-- <input type="checkbox" class="checked"> -->
									<span class="span"><a href="index.php?quanly=danhmuc&id=<?php echo $row_category_sidebar['category_id'] ?>"><?php echo $row_category_sidebar['category_name'] ?></a></span>
								</li>
								
							</ul>
							<?php 
							}
							?>

						</div>
						<!-- //electronics -->
						
						<!-- best seller -->
						<div class="f-grid py-2">
							<h3 class="agileits-sear-head mb-3">Sản phẩm bán chạy</h3>
							<div class="box-scroll">
								<div class="scroll">
									<?php
									$sql_sanpham_sidebar = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham WHERE sanpham_hot = '0' ORDER BY sanpham_id DESC");
									while ($row_sanpham_sidebar = mysqli_fetch_array($sql_sanpham_sidebar)){
									?>
									<div class="row">
										<div class="col-lg-3 col-sm-2 col-3 left-mar">
											<img src="images/<?php echo $row_sanpham_sidebar['sanpham_image'] ?>" alt="" class="img-fluid">
										</div>
										<div class="col-lg-9 col-sm-10 col-9 w3_mvd">
											<a href=""><?php echo $row_sanpham_sidebar['sanpham_name'] ?></a>
											<a href="" class="price-mar mt-2"><?php echo number_format($row_sanpham_sidebar['sanpham_giakhuyenmai']). ' VND' ?></a>
											<del><?php echo number_format($row_sanpham_sidebar['sanpham_gia']). ' VND' ?></del>
										</div>
									</div>
									<?php
									}
									?>

								</div>
							</div>
						</div>
						<!-- //best seller -->
				</div>
				<!-- //product right -->
			</div>
		</div>
	</div>
</div>
<!-- //top products -->