<!doctype html>
<?php include('../../db.php') ?>
<?php include('../../common.php'); ?>
<?php require('../head.php'); ?>
<?php session_start(); ?>

<body>
	<!-- Add your site or application content here -->

	<?php require('../headertop.php'); ?>

	<?php require('../headermiddle.php'); ?>

	<?php require('../menuarea.php'); ?>

	<?php
	
	$id = intval($_GET["id"]);
	// $sdt = trim($_SESSION['khachhang']['modal_sdt']);
	$query = "SELECT * FROM [dbo].[qlhh_hanghoa] WHERE id=" . $id . "";
	
	$params = array();
	$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$result = sqlsrv_query($conn, $query, $params, $options);
	$dsSP = arrayListDB($result);
	
	?>
	<!-- MAIN-CONTENT-SECTION START -->
	<section class="main-content-section">
		<div class="container">

			<div class="row" style="margin-top:24px;">
				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
					<!-- SINGLE-PRODUCT-DESCRIPTION START -->
					<div class="row">
						<div class="col-lg-5 col-md-5 col-sm-4 col-xs-12">
							<div class="single-product-view">
								<!-- Tab panes -->
								<div class="tab-content">
									<div class="tab-pane active" id="thumbnail_1">
										<div class="single-product-image">
											<img src="<?php echo diachi; ?>/img/product/sale/<?php echo $dsSP[0]['img']; ?>" alt="<?php echo $dsSP[0]['tenhanghoa']; ?>" />
											<a class="new-mark-box" href="#">new</a>
											<a class="fancybox" href="<?php echo diachi; ?>/img/product/sale/<?php echo $dsSP[0]['img']; ?>" data-fancybox-group="gallery"><span class="btn large-btn">View larger <i class="fa fa-search-plus"></i></span></a>
										</div>
									</div>
								</div>
							</div>

						</div>
						<div class="col-lg-7 col-md-7 col-sm-8 col-xs-12">
							<div class="single-product-descirption">
								<h2><?php echo $dsSP[0]['tenhanghoa']; ?></h2>

								<div class="single-product-review-box">
									<div class="rating-box">
										<?php for ($i = 0; $i < intval($dsSP[0]['start']); $i++) { ?>
											<i class="fa fa-star"></i>
										<?php } ?>
									</div>

								</div>

								<div class="single-product-price">
									<h2><?php echo number_format($dsSP[0]['giaban']); ?> VNĐ</h2>
								</div>
								<div class="single-product-desc">
									<p><?php echo $dsSP[0]['mieuta']; ?></p>

								</div>

								<div class="single-product-add-cart">
									<a class="add-cart-text" title="Add to cart" href="javascript:void(0)" onclick="addToCart(<?php echo $dsSP[0]['id'];?>);">Add to cart</a>
								</div>
							</div>
						</div>
					</div>
					<!-- SINGLE-PRODUCT-DESCRIPTION END -->
					<!-- SINGLE-PRODUCT INFO TAB START -->
					<div class="row">
						<div class="col-sm-12">
							<div class="product-more-info-tab">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs more-info-tab">
									<li class="active"><a href="#moreinfo" data-toggle="tab">Nhiều thông tin hơn</a></li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content">
									<div class="tab-pane active" id="moreinfo">
										<div class="tab-description">
											<p><?php echo $dsSP[0]['mieuta']; ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- SINGLE-PRODUCT INFO TAB END -->

				</div>

			</div>
		</div>
	</section>
	<!-- MAIN-CONTENT-SECTION END -->

	<?php require('../footer.php'); ?>
</body>

<script>
	function addToCart(_val) {
		callAjax('<?php echo diachi;?>/controller/ControllerTrangChu.php', 'post', 'json', {
				action: 'themGioHang',
				idCart: _val
			},
			function(data) {
				console.log(data);
				if (data) {
					alert("thêm vào giỏ hàng thành công.", "Thành công");
				} else {
					alert("thêm vào giỏ hàng thành công.", "Thất bại");
				}

				// else showAlert('Lỗi dữ liệu', null);
			}, null
		);
	}
</script>

</html>