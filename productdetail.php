<?php
include 'includes/header.php';
?>
<?php
if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
	echo "<script>window.location='productdetail.php'</script>";
} else {
	$id = $_GET['proid'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$quantity = $_POST['quantity'];
	$AddtoCard = $ct->add_to_cart($quantity, $id);
}
?>
<!-- BREADCRUMB -->


<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">

	<!-- container -->
	<div class="container">

		<!-- row -->
		<?php
		$get_product_detail = $product->getproductdetail($id);
		if ($get_product_detail) {
			while ($result_detail = $get_product_detail->fetch_assoc()) {
				?>
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-8 mx-auto">
								<?php
								if (isset($AddtoCard)) {
									echo $AddtoCard;
								}
								?>
					</div>
				</div>
				<br>
				<br>
				<div class="row">
					<!-- Product main img -->

					<div class="col-md-5 ">
						<div id="product-main-img">
							<div class="product-preview">
								<img height="250px;" style="border-radius:20px;border:2px solid black;" src="./admin/uploads/<?php echo $result_detail['image'] ?>">
							</div>
						</div>
					</div>

					<div class="col-md-5">
						<div class="product-details">

							<ul class="product-links">
								<li>Tình trạng:</li>
								<?php if ($result_detail['stock'] == 0) {
											echo "<li style='color:red;'><b>Hết Hàng</b></li>";
										} else {
											echo "<li style='color:green;'><b>Còn Hàng<b></li>";
										} ?>

							</ul>
							<br>
							<div class="mt-3">
								<h2 class="product-name w-5">
									<?php echo $result_detail['productName'] ?>
								</h2>
							</div>


							<div>
								<?php
										if (($result_detail['pricesale'] < $result_detail['price']) && ($result_detail['pricesale']) > 0) { ?>
									<h4 style="color:red" class="product-price"><?php echo number_format($result_detail['pricesale']) . " VNĐ"; ?></h4>
									<del style="color:red" class="product-price"><?php echo number_format($result_detail['price']) . " VNĐ"; ?></del></h4>
								<?php } else { ?>
									<h3 style="color:red" class="product-price"><?php echo number_format($result_detail['price']) . " VNĐ"; ?></h3>
								<?php
										}
										?>

							</div>

							<div class="add-to-cart">
								<form action="" method="POST">
									<div class="qty-label">
										Số lượng
										<div class="input-number">
											<input min="1" name="quantity" value="1" type="number" required>

										</div>
									</div>
									<?php if ($result_detail['stock'] == 0) { ?>

										<button type="submit" name="submit" style="" class="btn btn-danger" disabled><i class="fa fa-shopping-cart"></i>Add to cart</button>

									<?php } else { ?>

										<button type="submit" name="submit" class="add-to-cart-btn btnSend"><i class="fa fa-shopping-cart"></i>Add to cart</button>

									<?php } ?>
								</form>
							</div>
							<ul class="product-links">
								<li>Danh mục:</li>
								<li><a href="#"><?php echo $result_detail['Name'] ?></a></li>
							</ul>

							<ul class="product-links">
								<li>Chia sẻ:</li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope"></i></a></li>
							</ul>

						</div>
					</div>
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li><a data-toggle="tab" href="#tab2">Chi tiết</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								
								<!-- tab2  -->
								<div id="tab2" class="tab-pane fade in active">
									<div class="row ">
										<span class="col-md-5"></span>
										<button id="btn1" class="btn btn-primary ">Ẩn chi tiết</button>
										<span class=""></span>
										<button id="btn2" class="btn btn-primary ">Hiện chi tiết</button>
										<span class="col-md-6"></span>
									</div>
									<div class="row">
										<div id="content" style="display:none" class="col-md-12">
											<p><?php echo ($result_detail['product_desc']) ?></p>
										</div>
									</div>
								</div>
							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
				</div>
		<?php
			}
		}
		?>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- Section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<div class="col-md-12">
				<div class="section-title text-center">
					<h3 class="title">Những sản phẩm liên quan</h3>
				</div>
			</div>
			<?php

			$cat = $product->getcategoryidproduct($id);
			$catid = $cat->fetch_assoc();
			$getproduct_Relate = $product->getproductRelate($catid['categoryId']);
			if ($getproduct_Relate) {
				while ($result_relate = $getproduct_Relate->fetch_assoc()) {
					?>
					<!-- product -->
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img height="180px" src="./admin/uploads/<?php echo $result_relate['image'] ?>">

								<div class="product-label">
									<span class="new">Liên Quan</span>
								</div>
							</div>
							<div class="product-body">
								<p class="product-category"><?php echo $result_relate['Name'] ?></p>
								<h3 class="product-name"><?php echo $result_relate['productName'] ?><a href="#"></a></h3>
								<?php
										if (($result_relate['pricesale'] < $result_relate['price']) && ($result_relate['pricesale']) > 0) { ?>
									<h4 class="product-price"><?php echo number_format($result_relate['pricesale']) . " VNĐ"; ?></h4>
									<del class="product-price"><?php echo number_format($result_relate['price']) . " VNĐ"; ?></del></h4>
								<?php } else { ?>
									<h4 class="product-price"><?php echo number_format($result_relate['price']) . " VNĐ"; ?></h4>
									<h4 class="product-price">&nbsp;</h4>
								<?php
										}
										?>
								<div class="product-rating">
								</div>
								<div class="product-btns">
									<button class="quick-view"><a href="productdetail.php?proid=<?php echo $result_relate['ProductId'] ?>"><i class="fa fa-eye"></i></a><span class="tooltipp">xem chi tiết</span></button>
								</div>
							</div>
							<?php if ($result_detail['stock'] == 0) { ?>
								<div class="add-to-cart" style="display:none;	">
									<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Add to cart</button>
								</div>
							<?php } else { ?>
								<div class="add-to-cart">
									<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Add to cart</button>
								</div>
							<?php } ?>
						</div>
					</div>
					<!-- /product -->
			<?php
				}
			}
			?>

		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /Section -->

<!-- NEWSLETTER -->
<div id="newsletter" class="section">
	<!-- container -->

	<!-- /container -->
</div>
<!-- /NEWSLETTER -->

<!-- FOOTER -->
<script language="javascript">
	document.getElementById("btn1").onclick = function() {
		document.getElementById("content").style.display = 'none';
	};

	document.getElementById("btn2").onclick = function() {
		document.getElementById("content").style.display = 'block';
	};
</script>
<?php
include 'includes/footer.php';
?>