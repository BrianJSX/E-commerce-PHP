<?php
include 'includes/header.php';
?>
<?php
if (isset($_GET['page'])) {
	$page = $_GET['page'];
} elseif (!isset($_GET['page'])) {
	$page = 1;
} else {
	header('location:store.php');
}
?>

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb-tree">
					<li><a href="index.php">Trang chủ</a></li>
					<?php
					// $get_category_store = $cat->get_category_Name($id);
					// $result_category = $get_category_store->fetch_assoc();
					?>
					<li><a href="sale.php">Sale</a></li>
				</ul>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- ASIDE -->
			<div id="aside" class="col-md-3">
				<!-- aside Widget -->

				<!-- /aside Widget -->
				<!-- aside Widget -->

				<!-- /aside Widget -->

				<!-- aside Widget -->
				<div class="aside">
					<h3 class="aside-title">Sản phẩm Mới</h3>
					<?php
					$product_category_new = $product->getproduct_feathered_new();
					if ($product_category_new) {
						while ($result = $product_category_new->fetch_assoc()) {
							?>
							<div class="product-widget">
								<div class="product-img">
									<img height="50px" src="./admin/uploads/<?php echo $result['image'] ?>">
								</div>

								<div class="product-body">
									<p class="product-category"><?php echo $result['Name']; ?></p>
									<h3 class="product-name"><a href="productdetail.php?proid=<?php echo $result['ProductId'] ?>"><?php echo $result['productName']; ?></a></h3>
									<?php
											if (($result['pricesale'] < $result['price']) && ($result['pricesale']) > 0) { ?>
										<h4 class="product-price"><?php echo number_format($result['pricesale']) . " VNĐ"; ?></h4>
										<del class="product-price"><?php echo number_format($result['price']) . " VNĐ"; ?></del></h4>
									<?php } else { ?>
										<h4 class="product-price"><?php echo number_format($result['price']) . " VNĐ"; ?></h4>
										<h4 class="product-price">&nbsp;</h4>
									<?php
											}
											?>
								</div>
							</div>
					<?php
						}
					}
					?>
				</div>
				<!-- /aside Widget -->
			</div>
			<!-- /ASIDE -->

			<!-- STORE -->
			<div id="store" class="col-md-9">
				<!-- store top filter -->

				<!-- /store top filter -->

				<!-- store products -->
				<div class="row">

					<?php
					$limit = 10;
					$total_pages = $cat->total_page_sale();
					$result_total_page = $total_pages->fetch_assoc();
					$total_page = ceil($result_total_page['total'] / $limit);
					// echo "tổng số page là:".$total_page;
					if ($page > $total_page) {
						$page = $total_page;
					} elseif ($page < 1) {
						$page = 1;
					}
					?>
					<?php
					$show_product_cat = $cat->show_product_sale($page);
					if ($show_product_cat) {
						while ($result = $show_product_cat->fetch_assoc()) {
							?>
							<!-- product -->
							<div class="col-md-4 col-xs-6">
								<div class="product">
									<div class="product-img">
										<img height="180px" src="./admin/uploads/<?php echo $result['image'] ?>">
										<div class="product-label">
											<span class="new"><?php echo $result['Name']?></span>
										</div>
									</div>
									<div class="product-body">
										<h3 class="product-name"><a href="productdetail.php?proid=<?php echo $result['ProductId'] ?>"><?php echo $result['productName']; ?></a></h3>
										<?php
												if (($result['pricesale'] < $result['price']) && ($result['pricesale']) > 0) { ?>
											<h4 class="product-price"><?php echo number_format($result['pricesale']) . " VNĐ"; ?></h4>
											<del class="product-price"><?php echo number_format($result['price']) . " VNĐ"; ?></del></h4>
										<?php } else { ?>
											<h4 class="product-price"><?php echo number_format($result['price']) . " VNĐ"; ?></h4>
											<h4 class="product-price">&nbsp;</h4>
										<?php
												}
												?>
										<div class="product-btns">
											<button class="quick-view"><a href="productdetail.php?proid=<?php echo $result['ProductId'] ?>"><i class="fa fa-eye"></i></a><span class="tooltipp">xem chi tiết</span></button>
										</div>
									</div>

								</div>
							</div>
							<!-- /product -->

					<?php }
					}
					?>

				</div>
				<!-- /store products -->

				<!-- store bottom filter -->
				<div class="store-filter clearfix">
					<?php
					if ($page > 1) {
						?>
						<ul class="store-pagination">
							<li><a href="?catid=<?php echo $id ?>&page=<?php echo $page - 1 ?>">Prev</a></li>
							<?php
								for ($i = $page; $i <= $total_page; $i++) {
									?>
								<li class="<?php if ($i == $page) {
														echo 'active';
													} ?>"><a href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
							<?php
								}
								?>
							<li><a href="?page=<?php echo $page + 1 ?>">Next</a></li>
							<ul>
							<?php } else if ($page <= 1) { ?>
								<ul class="store-pagination">
									<?php
										for ($i = $page; $i <= $total_page; $i++) {
											?>
										<li class="<?php if ($i == $page) {
																echo 'active';
															} ?>"><a href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
									<?php
										}
										?>
									<li><a href="?page=<?php echo $page + 1 ?>">Next</a></li>
									<ul>
									<?php } ?>
				</div>
				<!-- /store bottom filter -->
			</div>
			<!-- /STORE -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<?php
include 'includes/footer.php';
?>