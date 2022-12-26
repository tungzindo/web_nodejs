<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "web_mysqli1");
mysqli_set_charset($mysqli, "utf8");
$id = $_GET['id'];
$sql_danhmuc = "select * from tbl_danhmuc";
$query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
$sql = "select * from tbl_sanpham where id_sanpham= '$id'";
$qr = mysqli_query($mysqli, $sql) or die("Lỗi truy vấn");
$rs = mysqli_fetch_array($qr);


$sql_comment = "SELECT DISTINCT tenkhachhang,ngay,binhluan FROM tbl_dangky,tbl_rating WHERE tbl_dangky.id_dangky=tbl_rating.id_khachhang AND tbl_rating.id_sanpham=$id";
$query_comment = mysqli_query($mysqli, $sql_comment);

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
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
	<style>

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
					<a class="" href="index.php"> <span class="icon-home"></span> Trang chủ</a>

					<!-- <a href="register.php"><span class="icon-edit"></span> Đăng ký </a> 
				<a href="login.php"><span class="icon-lock"></span> Đăng nhập </a>  -->
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
					<p><br> <strong> Hỗ trợ (24/7) : 038466226 </strong><br><br></p>
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
							<li class=""><a href="chitietsp.php
			  ">Bài viết</a></li>
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
			<div id="sidebar" class="span3">
				<div class="well well-small">
					<ul class="nav nav-list">
						<?php
						while ($rs_danhmuc = mysqli_fetch_array($query_danhmuc)) {
						?>
							<li><a href="products.php"><span class="icon-chevron-right"></span><?php echo $rs_danhmuc['tendanhmuc']; ?></a></li>
						<?php
						} ?>

					</ul>
				</div>

				<div class="well well-small alert alert-warning cntr">
					<h2>Giảm giá 50%</h2>
					<p>
						chỉ áp dụng đặt hàng online. <br><br><a class="defaultBtn" href="">Xem</a>
					</p>
				</div>
				<div class="well well-small"><a href="#"><img src="assets/img/paypal.jpg" alt="payment method paypal"></a></div>


				<br>
				<br>
				<ul class="nav nav-list promowrapper">
					<li>
						<div class="thumbnail">
							<a class="zoomTool" href="product_details.php" title="add to cart"><span class="icon-search"></span> Xem</a>
							<img src="../images/anhnen/banner1.png" alt="bootstrap ecommerce templates">
							<div class="caption">
								<h4><a class="defaultBtn" href="product_details.php">Xem</a> <span class="pull-right"></span></h4>
							</div>
						</div>
					</li>
					<li style="border:0"> &nbsp;</li>
					<li>
						<div class="thumbnail">
							<a class="zoomTool" href="product_details.php" title="add to cart"><span class="icon-search"></span> Xem</a>
							<img src="../images/anhnen/banner2.png" alt="shopping cart template">
							<div class="caption">
								<h4><a class="defaultBtn" href="product_details.php">Xem</a> <span class="pull-right"></span></h4>
							</div>
						</div>
					</li>
					<li style="border:0"> &nbsp;</li>
					<li>
						<div class="thumbnail">
							<a class="zoomTool" href="product_details.php" title="add to cart"><span class="icon-search"></span> Xem</a>
							<img src="../images/anhnen/banner3.png" alt="bootstrap template">
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
			<div class="span9">
				<ul class="breadcrumb">
					<li><a href="index.php">Trang chủ</a> <span class="divider">/</span></li>
					<li><a href="danhsachsp.php">Sản phẩm</a> <span class="divider">/</span></li>
					<li class="active"><?php echo $rs['tensanpham'] ?></li>
				</ul>
				<form method="POST" action="themgiohang.php?id=<?php echo $rs['id_sanpham']; ?>">
					<div class="well well-small">
						<div class="row-fluid">
							<form method="post">
								<div class="span5">
									<div id="myCarousel" class="carousel slide cntr">
										<div class="carousel-inner">

											<a href=""> <img src="../../src/public/image/<?php echo $rs['hinhanh'] ?>" alt="" style="width:100%"></a>

										</div>
										<a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
										<a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
									</div>
								</div>
								<div class="span7">
									<h3><?php echo $rs['tensanpham'] ?></h3>
									<hr class="soft" />

									<form class="form-horizontal qtyFrm">
										<div class="control-group">
											<label class="control-label"><span><?php $rs['giasp'] ?></span></label>
											<!-- <div class="controls">
					<input type="number" class="span6" placeholder="0">
					</div> -->
										</div>

										<h4>Số hàng trong kho: <?php echo $rs['soluong'] ?> sản phẩm</h4>
										<h3 style="color:	#FF3333">Giá: <?php echo number_format($rs['giasp'], 0, ',', '.') . 'vnđ' ?></h3><br>
										<h4 style="color:#00DD00;">Tình trạng : Còn hàng</h4><br>

										<button type="submit" class="shopBtn" name="themgiohang"><span class=" icon-shopping-cart"></span> Thêm giỏ hàng</button>
									</form>
								</div>
						</div>
						<hr class="softn clr" />
						<ul id="productDetail" class="nav nav-tabs">
							<li class="active"><a href="#home" data-toggle="tab">Thông tin sản phẩm</a></li>
							<!-- <li class=""><a href="#profile" data-toggle="tab">Đánh giá</a></li>  -->
						</ul>
						<div id="myTabContent" class="tab-content tabWrapper">
							<div class="tab-pane fade active in" id="home">
								<h4>Thông tin sản phẩm :</h4>
								<table class="table table-striped">
									<tbody>
										<tr class="techSpecRow">
											<td class="techSpecTD1">Tên sản phẩm:</td>
											<td class="techSpecTD2"><?php echo $rs['tensanpham'] ?></td>
										</tr>
									</tbody>
								</table>
								<p>Mô tả: <?php echo $rs['noidung'] ?></p>
							</div>
							<br>
							<div class="tab-pane fade active in" id="home">
								<h4>Đánh giá từ khách hàng :</h4>
								<?php
								$sql_rating = "SELECT AVG(rating) AS 'sao'
						FROM tbl_rating
						WHERE id_sanpham=$id;";
								$query_rating = mysqli_query($mysqli, $sql_rating);
								$rs_rating = mysqli_fetch_array($query_rating);


								?>
								<div class="vote" style="display: flex;height:120px;border-style:inset">
									<div class="vote1" style="flex: 1;text-align: center;line-height: 120px;border-style:hidden">
										<span class="icon-star" style="font-size: 40px;"><b style="color:black"><?php echo number_format($rs_rating['sao'], 1, ',', ',') ?></b></span>
									</div>
									<div class="vote2" style="flex: 2">
										<div class="vote21" style="margin: 10px 5px 5px 5px;text-align:end">
											<span class="icon-star"><b>1</b></span><br>
											<span class="icon-star"><b>2</b></span><br>
											<span class="icon-star"><b>3</b></span><br>
											<span class="icon-star"><b>4</b></span><br>
											<span class="icon-star"><b>5</b></span>
										</div>
									</div>
									<div class="vote3" style="flex: 0.5;">
										<div class="vote31" style="margin: 10px 5px 5px 5px;text-align:center">
											<?php for ($i = 1; $i <= 5; $i++) {
												$sql_star1 = "SELECT COUNT(rating) AS 'solan'
									FROM tbl_rating
									WHERE id_sanpham=$id and rating=$i;";
												$query_star1 = mysqli_query($mysqli, $sql_star1);
												$rs_star1 = mysqli_fetch_array($query_star1);
												$arr = array($i => $rs_star1['solan']); ?>
												<span class=""><b><?php echo $arr[$i] ?> đánh giá</b></span></br>
											<?php
											} ?>
										</div>
									</div>
								</div>
								<br>
								<div class="stars">
									<p>Bạn đánh giá sao về sản phẩm này?</p>
									<form method="POST" action="danhgia.php?id=<?php echo $rs['id_sanpham'] ?>">
										<input class="star star-5" id="star-5" type="radio" name="star5" />
										<label class="star star-5" for="star-5"></label>
										<input class="star star-4" id="star-4" type="radio" name="star4" />
										<label class="star star-4" for="star-4"></label>
										<input class="star star-3" id="star-3" type="radio" name="star3" />
										<label class="star star-3" for="star-3"></label>
										<input class="star star-2" id="star-2" type="radio" name="star2" />
										<label class="star star-2" for="star-2"></label>
										<input class="star star-1" id="star-1" type="radio" name="star1" />
										<label class="star star-1" for="star-1"></label>
										<!-- <form action="vote.php"> -->
										<div class="input-group">
											<textarea type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" style="margin-top: 10px;width:635px" rows="5" name="danhgia"></textarea>
											<?php
											if (isset($_SESSION['dangky'])) {
												$id_khachhang = $_SESSION['id_khachhang'];
												$sql_check = "SELECT * FROM tbl_rating WHERE id_khachhang=$id_khachhang AND id_sanpham=$id";
												$row_check = mysqli_query($mysqli, $sql_check);
												$count_check = mysqli_num_rows($row_check);
												if ($count_check > 0) {
													echo "Bạn đã đánh giá cho sản phẩm này rồi!";
												} else {
											?>
													<input type="submit" value="Gửi" name="submit">
												<?php
												} ?>
											<?php	} else {
												echo "Bạn chưa đăng nhập vào hệ thống. Vui lòng <a href='login.php'>Đăng nhập</a> hoặc <a href='register.php'>Đăng kí</a>";
											?>
												<!-- <p><a class="btn btn-outline-info" href="register.php">Gửi</a></p> -->
											<?php
											}

											?>


										</div>
										<!-- </form>  -->
									</form>

								</div>
							</div>
						</div>
						<!-- <div class="tab-pane fade" id="profile">
					<div class="row-fluid">	  
						<div class="span2">
							<img src="../../src/public/image/<?php echo $rs['hinhanh'] ?>">
						</div>
						<div class="span6">
							<h5><?php echo $rs['tensanpham'] ?> </h5>
							<p>
							<?php echo $rs['noidung'] ?>
							</p>
						</div>
						<div class="span4 alignR">
							<form class="form-horizontal qtyFrm">
								<h3> 100.000d</h3>
								<label class="checkbox">
									<input type="checkbox">  Đặt hàng
								</label><br>
								<div class="btn-group">
									<a href="product_details.html" class="defaultBtn"><span class=" icon-shopping-cart"></span> Thêm Giỏ Hàng</a>
									<a href="chitietsp.php?id=<?php echo $rs['id_sanpham'] ?>" class="shopBtn">Xem</a>
								</div>
							</form>
						</div>
					</div>
				</div>  -->

					</div>
			</div>

		</div>

		<!-- Body wrapper -->
		<!-- 
Clients 
-->

		<section class="our_client" style="margin-left:245px">

			<!-- Main Body -->
			<?php

			?>
			<section>
				<div class="container">
					<div class="row">
						<div class="col-sm-5 col-md-6 col-12 pb-4">
							<h1>Comments</h1>
							<?php while ($rs_comment = mysqli_fetch_array($query_comment)) { ?>
								<div class="comment mt-4 text-justify float-left" style="display:flex"> <img src="https://i.imgur.com/yTFUilP.jpg" alt="" class="rounded-circle" width="40" height="40">
									<h4 style="margin-left:10px"><?php echo $rs_comment['tenkhachhang'] ?></h4>
									<span style="font-size:18px;margin-left:23px;line-height:41px"><?php echo $rs_comment['ngay'] ?></span> <br>

								</div>
								<p><?php echo $rs_comment['binhluan'] ?></p>
							<?php
							} ?>
						</div>

					</div>
				</div>
			</section>
			<hr class="soften" />
			<h4 class="title cntr"><span class="text"></span></h4>
			<hr class="soften" />
			<div class="row">
				<div class="span2">
					<a href="#"><img alt="" src=""></a>
				</div>
				<div class="span2">
					<a href="#"><img alt="" src=""></a>
				</div>
				<div class="span2">
					<a href="#"><img alt="" src=""></a>
				</div>
				<div class="span2">
					<a href="#"><img alt="" src=""></a>
				</div>
				<div class="span2">
					<a href="#"><img alt="" src=""></a>
				</div>
				<div class="span2">
					<a href="#"><img alt="" src=""></a>
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