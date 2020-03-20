<?php
include 'includes/header.php';
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$tukhoa = $_POST['search_product'];
	$search_product = $cat->search_product($tukhoa);
}
?>

<!-- BREADCRUMB -->

<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="filter-list-box">
				<h3>
					Kết quả tìm kiếm cho '<?php echo $tukhoa ?>':
				</h3>
				<!-- Keyword suggestion list -->
			</div>
		</div>
		<div class="row">
			<!-- ASIDE -->
			<div id="store" class="col-md-1">
				<!-- aside Widget -->

				<!-- /aside Widget -->
				<!-- aside Widget -->

				<!-- /aside Widget -->

				<!-- aside Widget -->

				<!-- /aside Widget -->
			</div>
			<!-- /ASIDE -->

			<!-- STORE -->
			<div id="store" class="col-md-10">
				<!-- store top filter -->

				<!-- /store top filter -->

				<!-- store products -->
				<div class="row">


					<!-- /store products -->

					<!-- store bottom filter -->
					<div class="store-filter clearfix">
						<?php
						$search_product = $cat->search_product($tukhoa);
						if ($search_product) {
							while ($result = $search_product->fetch_assoc()) {
								?>
								<!-- product -->
								<div class="col-md-4 col-xs-6">
									<div class="product">
										<div class="product-img">
											<img height="180px" src="./admin/uploads/<?php echo $result['image'] ?>">
											<div class="product-label">
												<span class="new"><?php echo $result['Name'] ?></span>
											</div>
										</div>
										<div class="product-body">
											<h3 class="product-name"><a href="productdetail.php?proid=<?php echo $result['ProductId'] ?>"><?php echo $result['productName']; ?></a>
											</h3>
											<?php
													if (($result['pricesale'] < $result['price']) && ($result['pricesale']) > 0) { ?>
												<h4 class="product-price">
													<?php echo number_format($result['pricesale']) . " VNĐ"; ?></h4>
												<del class="product-price"><?php echo number_format($result['price']) . " VNĐ"; ?></del>
												</h4>
											<?php } else { ?>
												<h4 class="product-price"><?php echo number_format($result['price']) . " VNĐ"; ?>
												</h4>
												<h4 class="product-price">&nbsp;</h4>
											<?php
													}
													?>
											<div class="product-btns">
												<button class="quick-view"><a href="productdetail.php?proid=<?php echo $result['ProductId'] ?>"><i class="fa fa-eye"></i></a><span class="tooltipp">xem chi
														tiết</span></button>
											</div>
										</div>

									</div>
								</div>
								<!-- /product -->

							<?php }
							} else if ($search_product != true) {
								?>
							<div class="product-list">
								<div id="beta-search-list">
									<div data-reactroot="" style="position: relative;">
										<div class="result-text">
											<!-- react-text: 5 -->Không tìm thấy kết quả cho "<?php echo $tukhoa;?>"
											<!-- /react-text -->
										</div>
										<div class="product-list-beta"></div><!-- react-text: 4 -->
										<!-- /react-text -->
									</div>
								</div>
							</div>
						<?php
						}
						?>

					</div>
					<div class="store-filter clearfix">



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