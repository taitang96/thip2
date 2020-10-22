<!doctype html>
<?php include('db.php') ?>
<?php include('common.php'); ?>
<?php require('clientsite/head.php'); ?>
<?php session_start();?>
<body>
	<!-- Add your site or application content here -->

	<?php require('clientsite/headertop.php'); ?>

	<?php require('clientsite/headermiddle.php'); ?>

	<?php require('clientsite/menuarea.php'); ?>

	<!-- MAIN-CONTENT-SECTION START -->
	<section class="main-content-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="right-all-product">
						<!-- PRODUCT-CATEGORY-HEADER START -->
						<div class="product-category-header" style="margin-top:15px">
							<div class="category-header-image">
								<img src="img/category-header.jpg" alt="category-header" />
								<div class="category-header-text">
									<h2>Thời trang nữ</h2>
									<strong>Tự tin khoe cá tính.</strong>

								</div>
							</div>
						</div>
						<!-- PRODUCT-CATEGORY-HEADER END -->
						<div class="product-category-title">
							<!-- PRODUCT-CATEGORY-TITLE START -->
							<h1>
								<span class="cat-name">Thời trang nữ</span>
							</h1>
							<!-- PRODUCT-CATEGORY-TITLE END -->
						</div>

					</div>
					<!-- ALL GATEGORY-PRODUCT START -->
					<div class="all-gategory-product">
						<div class="row">
							<ul class="gategory-product">
								<?php
								$query = "SELECT * FROM [dbo].[qlhh_hanghoa]";
								//echo $query;
								$params = array();
								//$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
								//$result = sqlsrv_query( $conn, $query , $params, $options );
								$result = sqlsrv_query($conn, $query);

								// while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
								//     $row['id'];
								// }
								//$resultSet['row'] = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
								//$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
								$dsSP = arrayListDB($result);
								?>
								<?php foreach ($dsSP as $row) { ?>
									<!-- SINGLE ITEM START -->
									<li class="cat-product-list">
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<div class="single-product-item">
												<div class="product-image">
													<a href="<?php echo diachi;?>/clientsite/component/singleproduct.php?id=<?php echo $row['id'];?>"><img src="img/product/sale/<?php echo $row['img']; ?>" alt="product-image" /></a>
													<a href="<?php echo diachi;?>/clientsite/component/singleproduct.php?id=<?php echo $row['id'];?>" class="new-mark-box">new</a>
												</div>
											</div>
										</div>
										<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
											<div class="list-view-content">
												<div class="single-product-item">
													<div class="product-info">
														<div class="customar-comments-box">
															<a href="<?php echo diachi;?>/clientsite/component/singleproduct.php?id=<?php echo $row['id'];?>"><?php echo $row['tenhanghoa']; ?></a>
															<div class="rating-box">
																<?php for ($i = 0; $i < intval($row['start']); $i++) { ?>
																	<i class="fa fa-star"></i>
																<?php } ?>
															</div>
															<!-- <div class="review-box">
																<span>1 Review(s)</span>
															</div> -->
														</div>
														<div class="product-datails">
															<p><?php echo $row['mieuta']; ?></p>
														</div>
														<div class="price-box">
															<span class="price"><?php echo number_format($row['giaban']); ?> VNĐ</span>
														</div>
													</div>
													<div class="overlay-content-list">
														<ul>
															<li><div href="#" title="Add to cart" class="add-cart-text" onclick="addToCart(<?php echo $row['id']; ?>)">Add to cart</div></li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</li>
									<!-- SINGLE ITEM END -->
								<?php } ?>
							</ul>
						</div>
					</div>
					
					<!-- ALL GATEGORY-PRODUCT END -->
					<!-- PRODUCT-SHOOTING-RESULT START -->
					<!-- <div class="product-shooting-result product-shooting-result-border">
							
							<div class="showing-item">
								<span>Showing 1 - 12 of 13 items</span>
							</div>
							<div class="showing-next-prev">
								<ul class="pagination-bar">
									<li class="disabled">
										<a href="#" ><i class="fa fa-chevron-left"></i>Previous</a>
									</li>
									<li class="active">
										<span><a class="pagi-num" href="#">1</a></span>
									</li>
									<li>
										<span><a class="pagi-num" href="#">2</a></span>
									</li>
									<li>
										<a href="#" >Next<i class="fa fa-chevron-right"></i></a>
									</li>
								</ul>
								<form action="#">
									<button class="btn showall-button">Show all</button>
								</form>
							</div>
						</div> -->
					<!-- PRODUCT-SHOOTING-RESULT END -->
				</div>
			</div>
		</div>
	</section>
	<!-- MAIN-CONTENT-SECTION END -->

	<?php require('clientsite/footer.php'); ?>
</body>

<script>
	getListProduct();

	function getListProduct() {
		callAjax('controller/ControllerTrangChu.php', 'post', 'json', {
				action: 'getlist_product'
			},
			function(data) {
				console.log(data);
				// if (isSuccess(data)){
				//     vb_time = data.LIST_DATA_TIME;
				//     dieudo_time = data.LIST_DATA_TIME;
				//     // xb_time = data.LIST_DATA_TIME;
				//     appendData(data.LIST_DATA);
				// }

				// else showAlert('Lỗi dữ liệu', null);
			}, null
		);
	}

	function addToCart(_val) {
		callAjax('controller/ControllerTrangChu.php', 'post', 'json', {
				action: 'themGioHang',
				idCart: _val
			},
			function(data) {
				console.log(data);
				if (data){
				    alert("thêm vào giỏ hàng thành công.","Thành công");
				} else {
					alert("thêm vào giỏ hàng thành công.","Thất bại");
				}

				// else showAlert('Lỗi dữ liệu', null);
			}, null
		);
	}
</script>

</html>