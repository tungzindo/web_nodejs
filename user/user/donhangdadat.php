<?php
		session_start();
		include('../admincp/config/config.php');
		require('../carbon/autoload.php');
     	use Carbon\Carbon;
     	$now = Carbon::now('Asia/Ho_Chi_Minh');
		if(isset($_GET['option'])){
			switch($_GET['option']){
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
    <title>TDT mobile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet"/>
    <!-- Customize styles -->
    <link href="style.css" rel="stylesheet"/>
    <!-- font awesome styles -->
	<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
		<!--[if IE 7]>
			<link href="css/font-awesome-ie7.min.css" rel="stylesheet">
		<![endif]-->

		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

	<!-- Favicons -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
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
                    if(empty($_SESSION['tk'])){
                ?>
					<a href="login.php"><span class="icon-lock"></span> Đăng nhập </a>
                    <a href="register.php"><span class="icon-edit"></span>Đăng ký</a>  
                <?php
                }else{
                ?>
				<a href="taikhoan.php"><span class="icon-user"></span> Tài khoản</a>
					<span style="color:red"><?php echo $_SESSION['dangky']?></span>
					<a href="?option=dangxuat"><span class="icon-edit"></span>Đăng xuất</a>
                    <a href="thaydoimatkhau.php"><span class="icon-lock"></span>Thay đổi mật khẩu</a>
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
		<img src="assets/img/logo-bootstrap-shoping-cart.png" alt="bootstrap sexy shop">
	</a>
	</h1>
	</div>
	<div class="span4">
	
	</div>
	<div class="span4 alignR">
	<p><br> <strong> Hỗ trợ (24/7) :  0384662267 </strong><br><br></p>
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
			  <li class=""><a href="index.php">Trang chủ	</a></li>
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
	<?php
		if(isset($_SESSION['tk'])){
	?>
    	<li><a href="cart.php" style="color: #999999">Giỏ hàng</a> <span class="divider" >/</span></li>
		<li><a href="vanchuyen.php" style="color: #999999">Vận chuyển</a> <span class="active">/</span></li>
		<li><a href="thongtinthanhtoan.php" style="color: #999999">Thanh toán</a> <span class="active">/</span></li>
		<li><a href="donhangdadat.php" class="active">Lịch sử đơn hàng</a> <span class="active"></span></li>
    <?php 
		}
	?>
	</ul>
	<div class="well well-small">
		<h2 class="icon-edit" >Lịch sử đơn hàng</h2>
			<?php
				$id_khachhang=$_SESSION['id_khachhang'];
				$sql_lietke_dh = "SELECT * FROM tbl_cart,tbl_dangky 
				WHERE tbl_cart.id_khachhang=tbl_dangky.id_dangky
				AND tbl_cart.id_khachhang='$id_khachhang'
				ORDER BY tbl_cart.id_khachhang DESC";
				$query_lietke_dh = mysqli_query($mysqli,$sql_lietke_dh);
			?>
			<table class="table table-bordered table-condensed" style="margin-top: 45px;">
				<tr>
					<!-- <th scope="col">Id</th> -->
					<th scope="col">Mã đơn hàng</th>
					<th scope="col">Tên khách hàng</th>
					<th scope="col">Địa chỉ</th>
					<th scope="col">Email</th>
					<th scope="col">Số điện thoại</th>
					<th scope="col">Quản lý</th>
					<th scope="col">Hóa đơn</th>
					<th scope="col">Ngày đặt</th>
					<th scope="col">Hình thức thanh toán</th>
				</tr>
			<?php
				$i = 0;
				while($row = mysqli_fetch_array($query_lietke_dh)){
					$i++;
			?> 
					<tr>
					
					<td><?php echo $row['code_cart'] ?></td>
					<td><?php echo $row['tenkhachhang'] ?></td>
					<td><?php echo $row['diachi'] ?></td>
					<td><?php echo $row['email'] ?></td>
					<td><?php echo $row['dienthoai'] ?></td>
					<td>
						<li style="list-style: none;">
							<a class="btn btn-outline-secondary" href="xemdonhang.php?code=<?php echo $row['code_cart']?>" role="button">Xem đơn hàng</a> 
						</li>
					</td>
					<td>
						<li style="list-style: none;">
							<a class="btn btn-outline-secondary" href="../admincp/modules/quanlydonhang/indonhang.php?code=<?php echo $row['code_cart']?>" role="button">In đơn hàng</a> 
						</li>
					</td>
					<td><?php echo $row['cart_date'] ?></td>
					<td><?php echo $row['cart_payment'] ?></td>
					</tr>
			<?php
				}
			?>
			
			</table>

	<hr class="soften"/>	
</div>
</div>
</div>
<!-- 
Clients 
-->
<section class="our_client">
	<hr class="soften"/>
	<h4 class="title cntr"><span class="text"></span></h4>
	<hr class="soften"/>
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
<h5>CHỬ ANH TIẾN- 19810310105	</h5>
<h5>HOÀNG ANH ĐỨC- 19810310068	</h5>
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

	<!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "100833749325420");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v14.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
  </body>
</html>
