<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "web_mysqli1");
mysqli_set_charset($mysqli, "utf8");
$sql = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc  ORDER BY tbl_sanpham.id_sanpham DESC LIMIT 4";
$query = mysqli_query($mysqli, $sql);
$sql_sp = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc  ORDER BY tbl_sanpham.id_sanpham DESC LIMIT 3";
$query_sp = mysqli_query($mysqli, $sql_sp);
$sql_danhmuc = "select * from tbl_danhmuc";
$query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);

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
						<a href="#"><span class="icon-twitter"></span></a>
						<a href="#"><span class="icon-facebook"></span></a>
						<a href="#"><span class="icon-youtube"></span></a>
						<a href="#"><span class="icon-tumblr"></span></a>
					</div>
					<a href="index.php"> <span class="icon-home"></span> Trang chủ</a>

					<!-- <a href="register.php"><span class="icon-edit"></span>Đăng ký</a> 
				<a href="login.php"><span class="icon-lock"></span> Đăng nhập </a> -->
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
					<p><br> <strong> Hỗ trợ (24/7) : 0800 1234 678 </strong><br><br></p>
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
						<form action="#" class="navbar-search pull-left">
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
			<div id="sidebar" class="span3">
				<div class="well well-small">
					<ul class="nav nav-list">
						<?php
						while ($rs_danhmuc = mysqli_fetch_array($query_danhmuc)) {
						?>
							<li>
								<a href="baiviet2.php?id=<?php echo $rs_danhmuc['id_danhmuc'] ?>">
									<span class="icon-chevron-right"></span><?php echo $rs_danhmuc['tendanhmuc']; ?>
								</a>
							</li>
						<?php
						} ?>
					</ul>
				</div>

				<div class="well well-small alert alert-warning cntr">
					<h2>Giảm giá 50%</h2>
					<p>
						Chỉ áp dụng đặt hàng online <br><br><a class="defaultBtn" href="#">Chi tiết</a>
					</p>
				</div>
				<div class="well well-small"><a href="#"><img src="assets/img/paypal.jpg" alt="payment method paypal"></a></div>
				<br>
				<br>
				<ul class="nav nav-list promowrapper">
					<li>
						<div class="thumbnail">
							<a class="zoomTool" href="product_details.html" title="add to cart"><span class="icon-search"></span>Xem</a>
							<img src="../images/anhnen/banner1.png" alt="bootstrap ecommerce templates">
							<div class="caption">
								<h4><a class="defaultBtn" href="product_details.html">Xem</a></h4>
							</div>
						</div>
					</li>
					<li style="border:0"> &nbsp;</li>
					<li>
						<div class="thumbnail">
							<a class="zoomTool" href="product_details.html" title="add to cart"><span class="icon-search"></span>Xem</a>
							<img src="../images/anhnen/banner2.png" alt="shopping cart template">
							<div class="caption">
								<h4><a class="defaultBtn" href="product_details.html">Xem</a></h4>
							</div>
						</div>
					</li>
				</ul>

			</div>
			<div class="span9">
				<ul class="breadcrumb">
					<li><a href="index.php">Trang chủ</a> <span class="divider">/</span></li>
					<li class="active">Đăng nhập</li>
				</ul>
				<h3>Đăng nhập</h3>
				<hr class="soft" />
				<div class="well">
					<form class="form-horizontal" method="POST">
						<h3>Nhập thông tin của bạn</h3>
						<div class="control-group">
							<label class="control-label" for="inputFname">Tài khoản</label>
							<div class="controls">
								<input type="text" type="text" name="email" placeholder="Email..." required="True">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="inputEmail">Mật khẩu</label>
							<div class="controls">
								<input type="password" name="password" placeholder="Mật khẩu..." required="True">
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<input type="submit" name="dangnhap" value="Đăng nhập" class="exclusive shopBtn">
								<?php
								if (isset($_POST['dangnhap'])) {
									$email = $_POST['email'];
									$matkhau = md5($_POST['password']);
									$sql = "SELECT * FROM tbl_dangky WHERE email='" . $email . "' AND matkhau='" . $matkhau . "' LIMIT 1";
									$row = mysqli_query($mysqli, $sql);
									$count = mysqli_num_rows($row);

									if ($count > 0) {
										$row_data = mysqli_fetch_array($row);
										$_SESSION['dangky'] = $row_data['tenkhachhang'];
										$_SESSION['id_khachhang'] = $row_data['id_dangky'];
										$_SESSION['tk'] = $row_data['email'];
										//header('Location:cart.php');
										echo "Đăng nhập thành công. <a href='index.php'>Quay về trang chủ</a>";
									} else {
										echo "Tài khoản hoặc mật khẩu không chính xác! Vui lòng <a href='login.php'>Thử lại</a>.";
									}
								}
								?>
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>
		<!-- 
Clients 
-->
		<section class="our_client">
			<!-- <hr class="soften"/>
	<h4 class="title cntr"><span class="text">EPU</span></h4>
	<hr class="soften"/> -->
			<div class="row">
				<div class="span2">
					<p></p>
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
		<footer class="footer" style="width: 100%">
			<div class="row-fluid">
				<div class="span6" style="text-align: center;width: 100%;">
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