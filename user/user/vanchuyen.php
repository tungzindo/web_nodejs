<?php
		session_start();
        $mysqli = new mysqli("localhost","root","","web_mysqli1");
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
		<li><a href="vanchuyen.php" class="active">Vận chuyển</a> <span class="active">></span></li>
		<li><a href="thongtinthanhtoan.php" style="color: #999999">Thanh toán</a> <span class="active">/</span></li>
		<li><a href="donhangdadat.php" style="color: #999999">Lịch sử đơn hàng</a> <span class="active"></span></li>
    <?php 
		}
	?>
	</ul>
	<div class="well well-small">
		<h2 class="icon-truck" style="font-weight:bold"> Thông tin vận chuyển</h2>
        <?php
            if(isset($_POST['themvanchuyen'])){
                $name=$_POST['name'];
                $phone=$_POST['phone'];
                $address=$_POST['address'];
                $note=$_POST['note'];
                $id_dangky=$_SESSION['id_khachhang'];
                $sql_them_vanchuyen=mysqli_query($mysqli,"INSERT INTO tbl_shipping(name,phone,address,note,id_dangky) VALUES('$name','$phone','$address','$note','$id_dangky')");
                if($sql_them_vanchuyen){
                    echo '<script>alert("Thêm thông tin vận chuyển thành công")</script>';
                }
            }elseif(isset($_POST['capnhatvanchuyen'])){
                $name=$_POST['name'];
                $phone=$_POST['phone'];
                $address=$_POST['address'];
                $note=$_POST['note'];
                $id_dangky=$_SESSION['id_khachhang'];
                $sql_update_vanchuyen=mysqli_query($mysqli,"UPDATE tbl_shipping SET name='$name',phone='$phone',address='$address',note='$note',id_dangky='$id_dangky' WHERE id_dangky='$id_dangky'");
                if($sql_update_vanchuyen){
                    echo '<script>alert("Cập nhật thông tin vận chuyển thành công")</script>';
                }
            }
        ?>
        <form action="" method="POST">
        <?php
            $id_dangky=$_SESSION['id_khachhang'];
            $sql_get_vanchuyen = mysqli_query($mysqli,"SELECT * FROM tbl_shipping WHERE id_dangky='$id_dangky' LIMIT 1");
            $count=mysqli_num_rows($sql_get_vanchuyen);
            if($count>0){
                $row_get_vanchuyen=mysqli_fetch_array($sql_get_vanchuyen);
                $name=$row_get_vanchuyen['name'];
                $phone=$row_get_vanchuyen['phone'];
                $address=$row_get_vanchuyen['address'];
                $note=$row_get_vanchuyen['note'];
            }else{
                $name='';
                $phone='';
                $address='';
                $note='';
            }
        ?>
            <div class="form-group">
                <label for="email">Họ Và Tên</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name ?>">
            </div>
            <div class="form-group">
                <label for="email">Số điện thoại</label>
                <input type="text" name="phone" class="form-control" value="<?php echo $phone ?>">
            </div>
            <div class="form-group">
                <label for="email">Địa chỉ</label>
                <input type="text" name="address" class="form-control" value="<?php echo $address ?>">
            </div>
            <div class="form-group">
                <label for="email">Ghi chú(Nếu có)</label>
                <input type="text" name="note" class="form-control" value="<?php echo $note ?>"></textarea>
            </div>
            <?php
                if($name=='' && $phone==''){
            ?>
            <button type="submit" name="themvanchuyen" class="btn btn-primary">Thêm thông tin vận chuyển</button>
            <?php
                }elseif($name !='' && $phone !=''){
            ?>
            <button type="submit" name="capnhatvanchuyen" class="btn btn-success">Cập nhật thông tin vận chuyển</button>
            <?php
                }
            ?>
        </form>
	<hr class="soften"/>	

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
					
				</tr>
				<?php
					if(isset($_SESSION['cart'])){
						$i = 0;
						$tongtien = 0;
						foreach($_SESSION['cart'] as $cart_item){
							$thanhtien = $cart_item['soluong']*$cart_item['giasp'];
							$tongtien+=$thanhtien;
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
					<a href="themgiohang.php?cong=<?php echo $cart_item['id']?>">+<i class="fa fa-plus fa-style" aria-hidden="True"></i></a>
					<?php echo $cart_item['soluong'] ?>
					<a href="themgiohang.php?tru=<?php echo $cart_item['id']?>">-<i class="fa fa-minus fa-style" aria-hidden="True"></i></a>
					
					</td>
					<td><?php echo number_format($cart_item['giasp'],0,',','.').'vnđ' ?></td>
					<td><?php echo number_format($thanhtien,0,',','.').'vnđ' ?></td>
                </tr>
				<?php
    				}
  				?>
				<tr>
					<td colspan="8">
						<p style="float: left;">Tổng tiền : <?php echo '<span style="color:red">'.number_format($tongtien,0,',','.').'vnđ'.'</span>'?></p><br/>
						

						<div style="clear: both;"></div>
						<?php
						if(isset($_SESSION['dangky'])){
								?>
							<p style="text-align: center;"><a class="btn btn-primary"  href="thongtinthanhtoan.php">Hình thức thanh toán thanh toán</a></p>
						<?php
						}else{
						?>
							<p><a class="btn btn-outline-info" href="register.php">Đăng ký đặt hàng</a></p>
						<?php  
						}
						?>
						
					</td>
					
				</tr>
				<?php
				}else{   
				?> 
				<tr>
					<td colspan="8"><p style="text-align: center;">Hiện tại giỏ trống</p></td>
				</tr>
				<?php
				}
				?>
				</tbody>
            </table><br/>
                
				</tbody>
            </table><br/>
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
