<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "web_mysqli1");
mysqli_set_charset($mysqli, "utf8");


$sql_danhmuc = "select * from tbl_danhmuc";
$query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);

if (isset($_GET['trang'])) {
	$page = $_GET['trang'];
} else {
	$page = 1;
}
if ($page == '' || $page == 1) {
	$begin = 0;
} else {
	$begin = ($page * 12) - 12;
}
$sql_pro = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc  ORDER BY tbl_sanpham.id_sanpham DESC LIMIT $begin,12";
$query_pro = mysqli_query($mysqli, $sql_pro);

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
	<style type="text/css">
		ul.list_trang {
			padding: 0;
			margin: 0;
			list-style: none;
		}

		ul.list_trang li {
			float: left;
			padding: 5px 13px;
			margin: 5px;
			background: burlywood;
		}

		ul.list_trang li a {
			text-align: center;
			text-decoration: none;
			color: #000;
			display: block;
		}
	</style>
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
					<a href="index.php"> <span class="icon-home"></span> Trang ch???</a>

					<!-- <a href="register.php"><span class="icon-edit"></span> ????ng k?? </a> 
				<a href="login.php"><span class="icon-lock"></span> ????ng nh???p </a>  -->
					<?php
					if (empty($_SESSION['tk'])) {
					?>
						<a href="login.php"><span class="icon-lock"></span> ????ng nh???p </a>
						<a href="register.php"><span class="icon-edit"></span>????ng ky??</a>
					<?php
					} else {
					?>
						<a href="taikhoan.php"><span class="icon-user"></span> T??i kho???n</a>
						<span style="color:red"><?php echo $_SESSION['dangky'] ?></span>
						<a href="?option=dangxuat"><span class="icon-edit"></span>????ng xu????t</a>
						<a href="#"><span class="icon-lock"></span>Thay ??????i m????t kh????u</a>
						<a href="cart.php"><span class="icon-shopping-cart"></span> Gi??? h??ng <span class="badge badge-warning"> $</span></a>
					<?php
					}
					?>
					<a href="contact.php"><span class="icon-envelope"></span> Li??n h???</a>
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
					<p><br> <strong> H??? tr??? (24/7) : 0384662267 </strong><br><br></p>
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
							<li class=""><a href="index.php">Trang ch??? </a></li>
							<li class=""><a href="danhsachsp.php">Danh s??ch s???n ph???m</a></li>
							<li class=""><a href="baiviet.php
			  ">B??i vi???t</a></li>
						</ul>
						<form action="timkiem.php" method="POST" class="navbar-search pull-left">
							<input type="text" placeholder="Search" class="search-query span2" name='tukhoa'>
							<input style="height: 30px;" type="submit" name="timkiem" value="T??m ki???m">
						</form>
						<!-- <ul class="nav pull-right">
			<li class="dropdown">
				<a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="icon-lock"></span> ????ng nh???p <b class="caret"></b></a>
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
					<input type="checkbox"> Nh??? m???t kh???u
					</label>
					<button type="submit" class="shopBtn btn-block">????ng nh???p</button>
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
							<li><a href="danhsachsp2.php?id=<?php echo $rs_danhmuc['id_danhmuc'] ?>"><span class="icon-chevron-right"></span><?php echo $rs_danhmuc['tendanhmuc']; ?></a></li>
						<?php
						} ?>

					</ul>
				</div>

				<div class="well well-small alert alert-warning cntr">
					<h2>Gi???m gi?? 50%</h2>
					<p>
						ch??? ??p d???ng ?????t h??ng online. <br><br><a class="defaultBtn" href="">Click v??o ????y </a>
					</p>
				</div>
				<div class="well well-small"><a href="#"><img src="assets/img/paypal.jpg" alt="payment method paypal"></a></div>


				<br>
				<br>
				<ul class="nav nav-list promowrapper">
					<li>
						<div class="thumbnail">
							<a class="zoomTool" href="product_details.php" title="add to cart"><span class="icon-search"></span> Xem</a>
							<img src="../images/anhnen/slider-1.jpg" alt="bootstrap ecommerce templates">
							<div class="caption">
								<h4><a class="defaultBtn" href="product_details.php">Xem</a> <span class="pull-right"></span></h4>
							</div>
						</div>
					</li>
					<li style="border:0"> &nbsp;</li>
					<li>
						<div class="thumbnail">
							<a class="zoomTool" href="product_details.php" title="add to cart"><span class="icon-search"></span> Xem</a>
							<img src="../images/anhnen/slider-2.jpg" alt="shopping cart template">
							<div class="caption">
								<h4><a class="defaultBtn" href="product_details.php">VIEW</a> <span class="pull-right"></span></h4>
							</div>
						</div>
					</li>
					<li style="border:0"> &nbsp;</li>
					<li>
						<div class="thumbnail">
							<a class="zoomTool" href="product_details.php" title="add to cart"><span class="icon-search"></span> Xem</a>
							<img src="../images/anhnen/slider-3.jpg" alt="bootstrap template">
							<div class="caption">
								<h4><a class="defaultBtn" href="product_details.php">Xem</a> <span class="pull-right"></span></h4>
							</div>
						</div>
					</li>
				</ul>

			</div>
			<div class="span9">

				<!--
New Products
-->
				<div class="well well-small">
					<h3>S???n ph???m </h3>
					<div class="row-fluid">
						<ul class="thumbnails">
							<?php
							while ($rs = mysqli_fetch_array($query_pro)) {
							?>
								<li class="span4" style="height: 337px;list-style: none;
                float: left; width:30%">
									<div class="thumbnail" style="height: 337px;">
										<a href="chitietsp.php?id=<?php echo $rs['id_sanpham'] ?>" class="overlay"></a>
										<a class="zoomTool" href="chitietsp.php?id=<?php echo $rs['id_sanpham'] ?>" title="add to cart"><span class="icon-search"></span> Xem</a>
										<a href="chitietsp.php?id=<?php echo $rs['id_sanpham'] ?>"><img src="../../src/public/image/<?php echo $rs['hinhanh'] ?>" alt=""></a>
										<div class="caption cntr">
											<p><?php echo $rs['tensanpham'] ?></p>
											<p><strong> <?php echo $rs['giasp'] ?></strong></p>
											<!-- <h4><a class="shopBtn" href="#" title="add to cart"> Th??m gi??? h??ng </a></h4> -->

											<br class="clr">
										</div>
									</div>


								</li>
							<?php
							} ?>

						</ul>
					</div>

				</div>
			</div>
		</div>
		<div style="clear: both;"></div>
		<p style="text-align: center;">Trang : </p>
		<?php
		$sql_trang = mysqli_query($mysqli, "SELECT * FROM tbl_sanpham");
		$row_count = mysqli_num_rows($sql_trang);
		$trang = ceil($row_count / 12);

		?>
		<ul class="list_trang" style="margin-left: 425px;">
			<?php
			for ($i = 1; $i <= $trang; $i++) {
			?>
				<li <?php if ($i == $page) {
						echo 'style="background : brown;"';
					} else {
						echo '';
					} ?>><a href="danhsachsp.php?trang=<?php echo $i ?>"><?php echo $i ?></a></li>
			<?php
			}
			?>
		</ul>
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
					<h5>Tr?????ng ?????i h???c ??i???n L???c- Khoa CNTT- D14CNPM2</h5>
					<h5>NGUY???N THANH T??NG- 19810310181</h5>
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