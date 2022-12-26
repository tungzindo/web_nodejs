<?php
    include('../admincp/config/config.php');
    $code = $_GET['code'];
    $sql_lietke_dh = "SELECT * FROM tbl_cart_details,tbl_sanpham WHERE tbl_cart_details.id_sanpham=tbl_sanpham.id_sanpham AND tbl_cart_details.code_cart='".$code."' ORDER BY tbl_cart_details.id_cart_details DESC";
    $query_lietke_dh = mysqli_query($mysqli,$sql_lietke_dh);

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
    <table class="table table-bordered table-condensed" style="margin-top: 45px; background:cornsilk">
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Mã đơn hàng</th>
        <th scope="col">Tên sản phẩm</th>
        <th scope="col">Số lượng</th>
        <th scope="col">Đơn giá</th>
        <th scope="col">Thành tiền</th>
    </tr>
    <?php
    $i = 0;
    $tongtien = 0;
    while($row = mysqli_fetch_array($query_lietke_dh)){
        $i++;
        $thanhtien = $row['giasp']*$row['soluongmua'];
        $tongtien += $thanhtien;
    ?> 
        <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $row['code_cart'] ?></td>
        <td><?php echo $row['tensanpham'] ?></td>
        <td><?php echo $row['soluongmua'] ?></td>
        <td><?php echo number_format($row['giasp'],0,',','.').'vnđ'?></td>
        <td><?php echo number_format($thanhtien,0,',','.').'vnđ' ?></td>
        </tr>
    <?php
    }
    ?>
    <tr>
        <td colspan="6">
            <p style="color:red">Tổng tiền : <?php echo number_format($tongtien,0,',','.').'vnđ' ?></p>
        </td>

    </tr>
    </table>
</body>
</html>

