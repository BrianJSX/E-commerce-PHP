<!DOCTYPE html>
<?php
include_once './admin/model/session.php';
Session::init(); ?>
<html lang="en">
<div style="display:none">
	<?php
	include_once 'admin/controller/cart.php';
	include_once 'admin/controller/product.php';
	?>
</div>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>LAPTOP Việt Nam</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="css/slick.css" />
	<link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />
	<!-- PHP CODE -->
	

</head>

<body>
	<!-- HEADER -->
	<header>
		<!-- TOP HEADER -->
		
		<div id="top-header">
			<div class="container">
				<ul class="header-links pull-right">
					<?php
					$ct = new cart();
					if (isset($_GET["custumerid"])) {
						$delCart = $ct->del_all_data_cart();
						Session::destroy();
					}
					?>
					<?php
					$check_login = Session::get('custumer_longin');
					$custumerId = Session::get("custumer_id");
					$custumerName = Session::get("custumer_name");
					if ($check_login == false) {
						?>
						<li><a href="register.php"><i class="fa fa-user-o"></i>Đăng Kí</a></li>
						<li><a href="login.php"><i class="fa fa-user-o"></i>Đăng Nhập</a></li>
					<?php } else { ?>
						<li><a href="profile.php"><i class="fa fa-user-o"></i><?php echo $custumerName ?></a></li>
						<li><a href="?custumerid=<?php echo $custumerId ?>"><i class="fa fa-sign-out"></i>Logout</a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<!-- /TOP HEADER -->

		<!-- MAIN HEADER -->
		<div id="header">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- LOGO -->
					<div class="col-md-3">
						<div class="header-logo">
							<a href="#" class="logo">
								<img src="./img/logo.png" alt="">
							</a>
						</div>
					</div>
					<!-- /LOGO -->

					<!-- SEARCH BAR -->
					<div class="col-md-6">
						<div class="header-search">
							<form class="row" action="search.php" method="POST">
								<span class="col-md-2"></span>	
								<input class="col-md-5 input" placeholder="Nhập từ khoá" name="search_product">
								<button class="search-btn col-md-5" type="submit"  >Tìm Kiếm</button>
							</form>
						</div>
					</div>
					<!-- /SEARCH BAR -->

					<!-- ACCOUNT -->
					<div class="col-md-3 clearfix">
						<div class="header-ctn">
							<!-- Cart -->
							<div class="dropdown">
								<a aria-expanded="true" href="cart.php">
									<i class="fa fa-shopping-cart"></i>
									<span>Giỏ Hàng</span>
									<?php 
										 $get_product_cart = $ct->get_product_cart();
										 if ($get_product_cart) {
									?>
									<div class="qty" style="background-color: red;right: 28px;top: -2px;width: 10px;height: 10px;"></div>
									<?php }?>
								</a>
							</div>
						</div>
					</div>
				</div>
				<!-- /ACCOUNT -->
			</div>
			<!-- row -->
		</div>
		<!-- container -->
		</div>
		<!-- /MAIN HEADER -->
	</header>
	<!-- /HEADER -->

	<!-- NAVIGATION -->
	<nav id="navigation">
		<!-- container -->
		<div class="container">
			<!-- responsive-nav -->
			<div id="responsive-nav">
				<!-- NAV -->
				<ul class="main-nav nav navbar-nav">
					<li ><a href="index.php">Trang Chủ</a></li>
					<li class=""><a href="cart.php">Giỏ Hàng</a></li>
					<?php 
					$get_product_order_nav = $ct->get_product_order($custumerId);
					if($get_product_order_nav){
					?>
					<li class=""><a href="orderdetail.php">Đơn Hàng Đã Đặt</a></li>
					<?php }?>
					<?php
					$cat = new category();
					$get_category_index = $cat->get_category_index();
					if ($get_category_index) {
						while ($result = $get_category_index->fetch_assoc()) {
							?>
							<li><a href="store.php?catid=<?php echo $result['Id'] ?>&page=1"><?php echo $result['Name'] ?></a></li>
					<?php
						}
					}
					?>
				</ul>
				<!-- /NAV -->
			</div>
			<!-- /responsive-nav -->
		</div>
		<!-- /container -->
	</nav>
	<!-- /NAVIGATION -->
	<?php
	include_once './admin/model/database.php';
	include_once './admin/helpers/format.php';
	include_once 'admin/controller/custummer.php';
	?>
	<?php
	$db = new Database();
	$fm = new Format();
	$cs = new custumer();
	$product = new product();
	?>