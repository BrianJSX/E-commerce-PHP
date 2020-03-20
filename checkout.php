<?php
include 'includes/header.php';
?>
<?php
$check_login = Session::get('custumer_longin');
if ($check_login == false) {
	echo "<script>window.location='login.php'</script>";
}
$check_cart = $ct->get_product_cart();
if ($check_cart == false) {
	echo "<script>window.location='cart.php'</script>";
}
if (isset($_POST['submit'])) {
    $id = Session::get("custumer_id");
	$insertorder = $cs->insert_order($id);
	
	echo "<script>window.location='ordersuccess.php'</script>";
	$delCart = $ct->del_all_data_cart();		
}

?>
<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<form action="" method="POST">
			<?php
			$id = Session::get("custumer_id");
			$get_custumers = $cs->show_custumers($id);
			if ($get_custumers) {
				while ($result = $get_custumers->fetch_assoc()) {
					?>
					<div class="row">
						<div class="col-md-7">
							<!-- Billing Details -->
							<div class="section-title">
								<h3 class="title">Billing address</h3>
							</div>
							<div class="form-group">
								<label for="">Name</label>
								<input class="input" type="text" name="name" value="<?php echo $result['name'] ?>" disabled>
							</div>
							<div class="form-group">
								<label for="">City</label>
								<input class="input" type="text" name="city" value="<?php echo $result['city'] ?>" disabled>
							</div>
							<div class="form-group">
								<label for="">Zipcode</label>
								<input class="input" type="text" name="zipcode" value="<?php echo $result['zipcode'] ?>" disabled>
							</div>
							<div class="form-group">
								<label for="">email</label>
								<input class="input" type="email" name="email" value="<?php echo $result['email'] ?>" disabled>
							</div>
							<div class="form-group">
								<label for="">address</label>
								<input class="input" type="text" name="address" value="<?php echo $result['address'] ?>" disabled>
							</div>
							<div class="form-group">
								<label for="">country</label>
								<input class="input" type="text" name="country" value="<?php echo $result['country'] ?>" disabled>
							</div>
							<div class="form-group">
								<label for="">Phone</label>
								<input class="input" type="text" name="phone" value="<?php echo $result['phone'] ?>" disabled>
							</div>
							<div>
								<a class="btn btn-primary" href="profile.php">Chỉnh sửa thông tin</a>
							</div>
							<!-- /Billing Details -->
						</div>
				<?php
					}
				}
				?>
				<!-- Order Details -->
				<div class="col-md-5 order-details" style="margin-top:50px;">
					<div class="section-title text-center">
						<h3 class="title">Your Order</h3>
					</div>

					<div class="order-summary">
						<div class="row">
							<div class="col-md-4"><b>QUANTITY<b></div>
							<div class="col-md-4"><b>PRODUCT<b></div>
							<div class="col-md-4"><b>TOTAL<b></div>
						</div>
						<br>
						<?php
						$get_product_cart = $ct->get_product_cart();

						if ($get_product_cart) {
							$subtotal = 0;
							while ($result = $get_product_cart->fetch_assoc()) {
								?>
								<div class="order-products">
									<div class="row">
										<span class="col-md-3"><?php echo $result['quantity'] ?></span>
										<span class="col-md-5"><?php echo $result['productName'] ?></span>
										<div class="col-md-1"><?php
										 $check_cart = $ct->get_product_cart();
										 if ($check_cart) {
										 $totalprice = $result['quantity'] * $result['price']; echo number_format($totalprice);
										 }else{
											 echo "Không có sản phẩm nào được order!!";
										 }
										 ?>
										 </div>
									</div>
							<?php
									$subtotal += $totalprice;
								}
							}
							?>
								</div>
								<br>
								<div class="order-col">
									<div><strong>SUB TOTAL</strong></div>
									<div><strong class="order-total"><input style="border:0;background: white;text-align:right;" type="text" value="<?php echo number_format($subtotal) ?> VNĐ"></strong></div>
								</div>
					</div>



					<input type="submit" name="submit" class="primary-btn order-submit" value="Order Now">
				</div>
				<!-- /Order Details -->
					</div>
		</form>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /row -->
</div>
<!-- /container -->
</div>
<!-- /SECTION -->
<?php
include 'includes/footer.php';
?>






