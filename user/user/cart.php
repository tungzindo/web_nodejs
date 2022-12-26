<?php
session_start();
if (isset($_GET['option'])) {
	switch ($_GET['option']) {
		case 'dangxuat':
			unset($_SESSION['tk']);
			unset($_SESSION['dangky']);
			header("Location:index.php");
			break;
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>TNC Store</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Bootstrap styles -->
	<link href="assets/css/bootstrap.css" rel="stylesheet" />
	<!-- Customize styles -->
	<link href="style.css" rel="stylesheet" />
	<!-- font awesome styles -->
	<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
	<!--[if IE 7]>
			<link href="css/font-awesome-ie7.min.css" rel="stylesheet">
		<![endif]-->

	<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

	<!-- Favicons -->
	<link rel="shortcut icon" href="./../images/anhnen/download.png">
</head>

<body>
	<!-- 
	Upper Header Section 
-->
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="topNav">
			<div class="container">
				<div class="alignR">
					<div class="pull-left socialNw">
						<a href=""><span class="icon-twitter"></span></a>
						<a href=""><span class="icon-facebook"></span></a>
						<a href=""><span class="icon-youtube"></span></a>
						<a href=""><span class="icon-tumblr"></span></a>
					</div>
					<a class="" href="index.php"> <span class="icon-home"></span> Trang chủ</a>

					<!-- <a href="register.php"><span class="icon-edit"></span> Đăng ký </a> 
				<a href="login.php"><span class="icon-lock"></span> Đăng nhập </a>   -->
					<?php
					if (empty($_SESSION['tk'])) {
					?>
						<a href="login.php"><span class="icon-lock"></span> Đăng nhập </a>
						<a href="register.php"><span class="icon-edit"></span>Đăng ký</a>
					<?php
					} else {
					?>
						<a href="taikhoan.php"><span class="icon-user"></span> Tài khoản</a>
						<span style="color:red"><?php echo $_SESSION['dangky'] ?></span>
						<a href="?option=dangxuat"><span class="icon-edit"></span>Đăng xuất</a>
						<a href="#"><span class="icon-lock"></span>Thay đổi mật khẩu</a>
						<a href="cart.php"><span class="icon-shopping-cart"></span> Giỏ hàng <span class="badge badge-warning"> $</span></a>
					<?php
					}
					?>
					<a href="contact.php"><span class="icon-envelope"></span> Liên hệ</a>
				</div>
			</div>
		</div>
	</div>

	<!--
Lower Header Section 
-->
	<div class="container">
		<div id="gototop"> </div>
		<header id="header">
			<div class="row">
				<div class="span4">
					<h1>
						<a class="logo" href="index.php">
							<img src="./../images/anhnen/download.png" alt=" bootstrap sexy shop" style="height: 100px;
    width: 170px;">
						</a>
					</h1>
				</div>
				<div class="span4">

				</div>
				<div class="span4 alignR">
					<p><br> <strong> Hỗ trợ (24/7) : 0384662267 </strong><br><br></p>
				</div>
			</div>
		</header>

		<!--
Navigation Bar Section 
-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container">
					<a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<div class="nav-collapse">
						<ul class="nav">
							<li class=""><a href="index.php">Trang chủ </a></li>
							<li class=""><a href="danhsachsp.php">Danh sách sản phẩm</a></li>
							<li class=""><a href="baiviet.php">Bài viết</a></li>
						</ul>
						<form action="" class="navbar-search pull-left">
							<input type="text" placeholder="Search" class="search-query span2">
						</form>
						<!-- <ul class="nav pull-right">
			<li class="dropdown">
				<a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="icon-lock"></span> Đăng nhập <b class="caret"></b></a>
				<div class="dropdown-menu">
				<form class="form-horizontal loginFrm">
				  <div class="control-group">
					<input type="text" class="span2" id="inputEmail" placeholder="Email">
				  </div>
				  <div class="control-group">
					<input type="password" class="span2" id="inputPassword" placeholder="Password">
				  </div>
				  <div class="control-group">
					<label class="checkbox">
					<input type="checkbox"> Nhớ mật khẩu
					</label>
					<button type="submit" class="shopBtn btn-block">Đăng nhập</button>
				  </div>
				</form>
				</div>
			</li>
			</ul> -->
					</div>
				</div>
			</div>
		</div>
		<!-- 
Body Section 
-->
		<div class="row">
			<div class="span12">
				<ul class="breadcrumb">
					<li><a href="index.php">Trang chủ</a> <span class="divider">/</span></li>
					<li class="active">Giỏ hàng/</li>
					<?php
						if(isset($_SESSION['tk'])){
					?>
						
						<li><a href="vanchuyen.php" class="">Vận chuyển</a> <span class="">/</span></li>
						
					<?php 
						}
					?>
				</ul>
				<div class="well well-small">
					<h2>
						<?php

						if (isset($_SESSION['dangky'])) {

							echo 'Đây là giỏ hàng của: ' . '<span style="color:red">' . $_SESSION['dangky'] . '</span>';
						}
						?>
					</h2>
					<hr class="soften" />

					<table class="table table-bordered table-condensed">
						<table class="table table-bordered table-condensed">
							<thead>
								<tr>
									<th scope="col">Id</th>
									<th scope="col">Mã sản phẩm</th>
									<th scope="col">Tên sản phẩm</th>
									<th scope="col">Hình ảnh</th>
									<th scope="col">Số lượng</th>
									<th scope="col">Giá sản phẩm</th>
									<th scope="col">Thành tiền</th>
									<th scope="col">Quản lý</th>
								</tr>
								<?php
								if (isset($_SESSION['cart'])) {
									$i = 0;
									$tongtien = 0;
									foreach ($_SESSION['cart'] as $cart_item) {
										$thanhtien = $cart_item['soluong'] * $cart_item['giasp'];
										$tongtien += $thanhtien;
										$i++;
								?>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $cart_item['masp'] ?></td>
									<td><?php echo $cart_item['tensanpham'] ?></td>
									<td><img src="../../src/public/image/<?php echo $cart_item['hinhanh']; ?>" width="150px"></td>
									<td>
										<a href="themgiohang.php?cong=<?php echo $cart_item['id'] ?>">+<i class="fa fa-plus fa-style" aria-hidden="True"></i></a>
										<?php echo $cart_item['soluong'] ?>
										<a href="themgiohang.php?tru=<?php echo $cart_item['id'] ?>">-<i class="fa fa-minus fa-style" aria-hidden="True"></i></a>

									</td>
									<td><?php echo number_format($cart_item['giasp'], 0, ',', '.') . 'vnđ' ?></td>
									<td><?php echo number_format($thanhtien, 0, ',', '.') . 'vnđ' ?></td>
									<td>

										<a class="btn btn-outline-danger" role="button" href="themgiohang.php?xoa=<?php echo $cart_item['id'] ?>">Xóa</a>
									</td>
								</tr>
							<?php
									}
							?>
							<tr>
								<td colspan="8">
									<p style="float: left;">Tổng tiền : <?php echo '<span style="color:red">' . number_format($tongtien, 0, ',', '.') . 'vnđ' . '</span>' ?></p><br />
									<p style="float: right;"><a class="btn btn-outline-danger" href="themgiohang.php?xoatatca=1">Xóa tất cả</a></p>

									<div style="clear: both;"></div>
									<?php
									if (isset($_SESSION['dangky'])) {
									?>
										<p style="text-align: center;"><a class="btn btn-outline-success" href="thanhtoan.php">Đặt hàng</a></p>
									<?php
									} else {
									?>
										<p><a class="btn btn-outline-info" href="register.php">Đăng ký đặt hàng</a></p>
									<?php
									}
									?>

								</td>

							</tr>
						<?php
								} else {
						?>
							<tr>
								<td colspan="8">
									<p style="text-align: center;">Hiện tại giỏ trống</p>
								</td>
							</tr>
						<?php
								}
						?>
							</tbody>
						</table><br />

						</tbody>
					</table><br />
				</div>
			</div>
		</div>
		<!-- 
Clients 
-->
		<section class="our_client">
			<hr class="soften" />
			<h4 class="title cntr"><span class="text"></span></h4>
			<hr class="soften" />
			<div class="row">
				<div class="span2">

				</div>
				<div class="span2">

				</div>
				<div class="span2">

				</div>
				<div class="span2">

				</div>
				<div class="span2">

				</div>
				<div class="span2">

				</div>
			</div>
		</section>

		<!--
Footer
-->
		<footer class="footer">
			<div class="row-fluid">

				<div class="span6" style="text-align: center;margin-left: 214px">
					<h5>Trường Đại học Điện Lực- Khoa CNTT- D14CNPM2</h5>
					<h5>NGUYỄN THANH TÙNG- 19810310181</h5>
				</div>
			</div>
		</footer>
	</div><!-- /container -->

	<div class="copyright">
		<div class="container">
			<p class="pull-right">
				<a href="#"><img src="assets/img/maestro.png" alt="payment"></a>
				<a href="#"><img src="assets/img/mc.png" alt="payment"></a>
				<a href="#"><img src="assets/img/pp.png" alt="payment"></a>
				<a href="#"><img src="assets/img/visa.png" alt="payment"></a>
				<a href="#"><img src="assets/img/disc.png" alt="payment"></a>
			</p>
			<span>Copyright &copy; 2021</span>
		</div>
	</div>
	<a href="#" class="gotop"><i class="icon-double-angle-up"></i></a>
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.easing-1.3.min.js"></script>
	<script src="assets/js/jquery.scrollTo-1.4.3.1-min.js"></script>
	<script src="assets/js/shop.js"></script>
</body>

</html>