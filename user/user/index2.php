<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "web_mysqli1");
mysqli_set_charset($mysqli, "utf8");
$id = $_GET['id'];
$sql_sp = "select * from tbl_sanpham,tbl_danhmuc where tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc AND tbl_sanpham.id_danhmuc=$id";
$query_sp = mysqli_query($mysqli, $sql_sp);
$sql_danhmuc = "select * from tbl_danhmuc";
$query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
$sql_tendanhmuc = "select * from tbl_danhmuc where id_danhmuc=$id";
$query_tendanhmuc = mysqli_query($mysqli, $sql_tendanhmuc);
$row = mysqli_fetch_array($query_tendanhmuc);

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
					<a class="" href="index.php"> <span class="icon-home"></span> Trang ch???</a>

					<!-- 	<a href="register.php"><span class="icon-edit"></span> ????ng k?? </a>
				<a href="login.php"><span class="icon-lock"></span> ????ng nh???p </a>   -->
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
							<li class=""><a href="baiviet.php">B??i vi???t</a></li>
						</ul>
						<form action="" class="navbar-search pull-left">
							<input type="text" placeholder="Search" class="search-query span2">
						</form>
						<!-- <ul class="nav pull-right">
			<li class="dropdown">
				<a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="icon-lock"></span> Login <b class="caret"></b></a>
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
					<input type="checkbox"> Remember me
					</label>
					<button type="submit" class="shopBtn btn-block">Sign in</button>
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
							<li><a href="index2.php?id=<?php echo $rs_danhmuc['id_danhmuc'] ?>"><span class="icon-chevron-right"></span><?php echo $rs_danhmuc['tendanhmuc']; ?></a></li>
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
								<h4><a class="defaultBtn" href="product_details.php">Xem</a> <span class="pull-right"></span></h4>
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
				<div class="well np">
					<div id="myCarousel" class="carousel slide homCar">
						<div class="carousel-inner">
							<div class="item">
								<img style="width:100%;cursor: pointer;" src="../images/anhnen/banner1.png" alt="bootstrap ecommerce templates">
								<div class="carousel-caption">

								</div>
							</div>
							<div class="item">
								<img style="width:100%;cursor: pointer;" src="../images/anhnen/banner2.png" alt="bootstrap ecommerce templates">
								<div class="carousel-caption">

								</div>
							</div>
							<div class="item active">
								<img style="width:100%;cursor: pointer;" src="../images/anhnen/banner3.png" alt="bootstrap ecommerce templates">
								<div class="carousel-caption">

								</div>
							</div>
							<div class="item">
								<img style="width:100%;cursor: pointer;" src="../images/anhnen/banner4.jpg" alt="bootstrap templates">
								<div class="carousel-caption">

								</div>
							</div>
						</div>
						<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
						<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
					</div>
				</div>
				<!--
New Products
-->
				<div class="well well-small">
					<h3><?php echo $row['tendanhmuc'] ?> </h3>
					<hr class="soften" />
				</div>
				<div class="row-fluid">
					<ul class="thumbnails">
						<?php
						while ($rs = mysqli_fetch_array($query_sp)) {
						?>
							<li class="span4">

								<div class="thumbnail">
									<a class="zoomTool" href="chitietsp.php?id=<?php echo $rs['id_sanpham'] ?>" title="add to cart"><span class="icon-search"></span> Xem</a>
									<a href="chitietsp.php?id=<?php echo $rs['id_sanpham'] ?>"><img src="../../src/public/image/<?php echo $rs['hinhanh'] ?>"></a>
									<div class="caption cntr">
										<p><?php echo $rs['tensanpham'] ?></p>
										<p><strong> <?php echo number_format($rs['giasp'], 0, ',', '.') . 'vn??' ?></strong></p>
										<h4><a class="shopBtn" href="" title="add to cart"> Th??m gi??? h??ng </a></h4>
										<br class="clr">
									</div>
								</div>
							<?php
						} ?>
							</li>
					</ul>
				</div>
			</div>
			<!--
	Featured Products
	-->


			<div class="well well-small">
				<a class="btn btn-mini pull-right" href="">Xem th??m <span class="icon-plus"></span></a>
				S???n ph???m ph??? bi???n
			</div>
			<hr>
			<div class="well well-small">
				<a class="btn btn-mini pull-right" href="">Xem th??m <span class="icon-plus"></span></a>
				S???n ph???m gi???m gi??
			</div>
		</div>
	</div>
	<!-- 
Clients 
-->
	<!-- <section class="our_client">
	<hr class="soften"/>
	<h4 class="title cntr"><span class="text">Manufactures</span></h4>
	<hr class="soften"/>
	<div class="row">
		<div class="span2">
			<a href=""><img alt="" src="assets/img/1.png"></a>
		</div>
		<div class="span2">
			<a href=""><img alt="" src="assets/img/2.png"></a>
		</div>
		<div class="span2">
			<a href=""><img alt="" src="assets/img/3.png"></a>
		</div>
		<div class="span2">
			<a href=""><img alt="" src="assets/img/4.png"></a>
		</div>
		<div class="span2">
			<a href=""><img alt="" src="assets/img/5.png"></a>
		</div>
		<div class="span2">
			<a href=""><img alt="" src="assets/img/6.png"></a>
		</div>
	</div>
</section> -->

	<!--
Footer
-->
	<footer class="footer">
		<div class="row-fluid">

			<div class="span6" style="text-align: center;margin-left: 214px">
				<h5>Tr?????ng ?????i h???c ??i???n L???c- Khoa CNTT- D14CNPM2</h5>
				<h5>NGUY???N THANH T??NG- 19810310181</h5>
				<h5>CH??? ANH TI???N- 19810310105 </h5>
				<h5>HO??NG ANH ?????C- 19810310068 </h5>
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