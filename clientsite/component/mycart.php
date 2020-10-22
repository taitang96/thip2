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

	<!-- MAIN-CONTENT-SECTION START -->
	<section class="main-content-section">
		<div class="container">
			<div class="row" style="margin-top: 24px;">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<!-- SHOPPING-CART SUMMARY START -->
					<h2 class="page-title">Thông tin đặt hàng<span class="shop-pro-item">Bạn đã chọn: <?php echo isset($_SESSION['idCart']) ? count($_SESSION['idCart']) : 0 ?> sản phẩm</span></h2>
					<!-- SHOPPING-CART SUMMARY END -->
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<!-- SHOPING-CART-MENU START -->
					<div class="shoping-cart-menu">
						<ul class="step">
							<li class="step-current first">
								<span>Thông tin thanh toán</span>
							</li>
						</ul>
					</div>
					<!-- SHOPING-CART-MENU END -->
					<?php if (isset($_SESSION['idCart']) && (count($_SESSION['idCart']) > 0)) { ?>
						<!-- CART TABLE_BLOCK START -->
						<?php
						$idList = join(",", array_keys($_SESSION['idCart']));

						$query = "SELECT * FROM [dbo].[qlhh_hanghoa] where id IN (" . $idList . ")";
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
						<div class="table-responsive">
							<!-- TABLE START -->
							<table class="table table-bordered" id="cart-summary">
								<!-- TABLE HEADER START -->
								<thead>
									<tr>
										<th class="cart-product">Tên sản phẩm</th>
										<th class="cart-description">Miêu tả</th>
										<!-- <th class="cart-unit text-right">Khả dụng</th> -->
										<th class="cart-unit text-right">Giá bán</th>
										<th class="cart_quantity text-center">Số lượng mua</th>
										<th class="cart-delete">&nbsp;</th>
										<th class="cart-total text-right">Tổng cộng</th>
									</tr>
								</thead>
								<!-- TABLE HEADER END -->
								<!-- TABLE BODY START -->
								<tbody>
									<?php foreach ($dsSP as $row) { ?>
										<!-- SINGLE CART_ITEM START -->
										<tr>
											<td class="cart-product">
												<a href="#"><img alt="<?php echo $row['tenhanghoa']; ?>" src="<?php echo diachi; ?>/img/product/sale/<?php echo $row['img']; ?>"></a>
											</td>
											<td class="cart-description">
												<p class="product-name"><a href="#"><?php echo $row['tenhanghoa']; ?></a></p>
												<small><?php echo $row['mieuta']; ?></small>
											</td>
											<!-- <td class="cart-avail"><span class="label label-success">Còn hàng</span></td> -->
											<td class="cart-unit">
												<ul class="price text-right">
													<li class="price"><b style="color:red;"><?php echo number_format($row['giaban']); ?> VNĐ</b></li>
												</ul>
											</td>
											<td class="cart_quantity text-center">
												<input class="cart-plus-minus" type="text" name="qtybutton" value="<?php echo $_SESSION['idCart'][$row['id']]; ?>" disabled>
												<!-- <div class="cart-plus-minus-button">
											</div> -->
											</td>
											<td class="cart-delete text-center">
												<!-- <span>
												<a href="#" class="cart_quantity_delete" title="Delete"><i class="fa fa-trash-o"></i></a>
											</span> -->
												<input type="checkbox" onclick="capNhatXoa();" checked value="<?php echo $row["id"]; ?>" />
											</td>
											<td class="cart-total">
												<span class="price"><b style="color:red;"><?php echo number_format($row['giaban'] * $_SESSION['idCart'][$row['id']]); ?> VNĐ</b></span>
											</td>
										</tr>
										<!-- SINGLE CART_ITEM END -->
									<?php } ?>

								</tbody>
								<!-- TABLE BODY END -->
								<!-- TABLE FOOTER START -->
								<tfoot>
									<!-- <tr class="cart-total-price">
										<td class="cart_voucher" colspan="3" rowspan="4"></td>
										<td class="text-right" colspan="3">Tổng tiền</td>
										<td id="total_product" class="price" colspan="1"></td>
									</tr> -->
									<!-- <tr>
										<td class="text-right" colspan="3">Total shipping</td>
										<td id="total_shipping" class="price" colspan="1">$5.00</td>
									</tr>
									<tr>
										<td class="text-right" colspan="3">Total vouchers (tax excl.)</td>
										<td class="price" colspan="1">$0.00</td>
									</tr> -->
									<!-- <tr>
										<td class="total-price-container text-right" colspan="3">
											<span>Total</span>
										</td>
										<td id="total-price-container" class="price" colspan="1">
											<span id="total-price">$76.46</span>
										</td>
									</tr> -->
								</tfoot>
								<!-- TABLE FOOTER END -->
							</table>
							<!-- TABLE END -->
						</div>
						<!-- CART TABLE_BLOCK END -->
					<?php } ?>
				</div>
				<?php if (isset($_SESSION['khachhang'])) { ?>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="first_item primari-box mycartaddress-info">
							<!-- SINGLE ADDRESS START -->
							<ul class="address">
								<li>
									<h3 class="page-subheading box-subheading">
										Thông tin khách hàng:
									</h3>
								</li>
								<li><span class="address_name">Họ và tên: <?php echo $_SESSION['khachhang']['tenkhachhang']; ?></span></li>
								<li><span class="address_company">Số điện thoại: <?php echo $_SESSION['khachhang']['modal_sdt']; ?></span></li>
								<li><span class="address_address1">Địa chỉ: <?php echo $_SESSION['khachhang']['diachi']; ?></span></li>
								<li><span class="address_address2"></span></li>
								<!-- <li><span class="">Rampura</span></li>
							<li><span class="">Dhaka</span></li>
							<li><span class="address_phone">+880 1735161598</span></li>
							<li><span class="address_phone_mobile">+880 1975161598</span></li> -->
							</ul>
							<!-- SINGLE ADDRESS END -->
						</div>
					</div>
				<?php } ?>

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<!-- RETURNE-CONTINUE-SHOP START -->
					<div class="returne-continue-shop">
						<!-- <a href="index.html" class="continueshoping"><i class="fa fa-chevron-left"></i>Tiếp tục mua sắm</a> -->
						<a href="javascript:void(0);" class="procedtocheckout" onclick="thanhToan();">Thanh toán đơn hàng<i class="fa fa-chevron-right"></i></a>
					</div>
					<!-- RETURNE-CONTINUE-SHOP END -->
					<input type="hidden" id="xoaSanPham" value="" />
				</div>
			</div>
		</div>
	</section>
	<!-- MAIN-CONTENT-SECTION END -->

	<?php require('../footer.php'); ?>

	<!-- MODAL Thanh Toán -->
	<div id="modalThanhToan" class="modal fade">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-arrow-circle-down" aria-hidden="true">
						</i> THÔNG TIN THANH TOÁN CỦA KHÁCH HÀNG<span>
					</h4>
				</div>
				<div class="modal-body">
					<div id="output6">
						<div>
							<div class="row margin0">
								<div class="col-md-12"> Số điện thoại:
									<input type="text" id="modal_sdt" name="modal_sdt" style="width:100%;" class="form-control" placeholder="Nhập số điện thoại" autocomplete="off">
								</div>
								<div class="col-md-12">Tên khách hàng:
									<div id="output">
										<input type="text" id="modal_tenkhachhang" name="modal_tenkhachhang" style="width:100%;" class="form-control" placeholder="Nhập tên" autocomplete="off">
									</div>
								</div>
								<div class="col-md-12">Địa chỉ
									<input type="text" id="modal_diachi" name="modal_diachi" style="width:100%;" class="form-control" placeholder="Nhập địa chỉ" autocomplete="off">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input class="btn btn-primary btn-login" onclick="xacnhan();" name="xacnhan" id="xacnhan" value="Xác nhận" style="height: 40px" />
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</body>

<!-- <script>
		getListProduct();
		function getListProduct() {
			callAjax('controller/ControllerTrangChu.php', 'post', 'json', {
                    action: 'getlist_product'
                },
                function (data) {
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
	</script> -->
<script>
	function thanhToan() {
		callAjax('<?php echo diachi; ?>/controller/ControllerTrangChu.php', 'post', 'json', {
				action: 'check_dangnhap'
			},
			function(data) {
				console.log(data);
				if (data) {
					if (confirm("Bạn đồng ý thanh toán")) {
						var idSanPham = '';
						$("#cart-summary").find('.cart-delete input[type=checkbox]').map(function() {
							return this.checked ? (idSanPham == '' ? idSanPham = idSanPham + this.value : idSanPham = idSanPham + ',' + this.value) : '';
						});
						var soluong = '';
						soluong = '';
						for (i = 0; i < $("#cart-summary tr").length - 1; i++) {
							if ($(($($($("#cart-summary").find('tbody tr')[i]).find("td")))[4]).find('input[type=checkbox]')[0].checked) {
								temp = $(($($($("#cart-summary").find('tbody tr')[i]).find("td")))[3]).find("input[type=text]")[0].value;
								soluong == '' ? soluong = soluong + temp : soluong = soluong + "," + temp;
							}
						}
						console.log(soluong);
						console.log(idSanPham);
						callAjax('<?php echo diachi; ?>/controller/ControllerTrangChu.php', 'post', 'json', {
								action: 'themHoaDonDatHang',
								idListXoa: $("#xoaSanPham").val(),
								idSanPham: idSanPham,
								soluong: soluong
							},
							function(data) {
								console.log(data);
								if (data) {
									alert("thông tin thanh toán đã được ghi lại");
									location.reload();
								} else {
									alert("thông tin thanh toán không thành công");
								}
							}, null
						);
					}
				} else {
					$("#modalThanhToan").modal('show');
				}
			}, null
		);
	}

	function xacnhan() {
		if (!validateThanhToan()) return;
		obj = new Object();
		obj.action = 'checkSDT';
		obj.modal_sdt = $("#modal_sdt").val();
		callAjax('<?php echo diachi; ?>/controller/ControllerTrangChu.php', 'post', 'json', obj,
			function(data) {
				if (data) {
					alert("Số điện thoại này đã tồn tại trong hệ thống");
				} else {
					console.log("số điện thoại này chưa có");
					obj = new Object();
					obj.action = 'ThemKhachHang';
					obj.modal_sdt = $("#modal_sdt").val();
					obj.modal_tenkhachhang = $("#modal_tenkhachhang").val();
					obj.modal_diachi = $("#modal_diachi").val();

					callAjax('<?php echo diachi; ?>/controller/ControllerTrangChu.php', 'post', 'json', obj,
						function(data) {
							console.log(data);
							if (data) {
								alert("Thêm thông tin khách hàng thành công");
								location.reload();
							} else {
								alert("Thêm thông tin khách hàng thất bại");
							}
						}, null
					);
				}
			}, null
		);
	}

	function validateThanhToan() {
		if ($('#modal_sdt').val() == "") {
			alert("vui lòng nhập số điện thoại");
			return false;
		}

		if ($('#modal_tenkhachhang').val() == "") {
			alert("vui lòng nhập tên khách hàng");
			return false;
		}
		return true;
	}

	function capNhatXoa() {
		console.log("hello");
		str = '';
		str1 = '';
		var t = $("#cart-summary").find('.cart-delete input[type=checkbox]').map(function() {
			return !this.checked ? (str == '' ? str = str + this.value : str = str + ',' + this.value) : '';
		});

		$("#xoaSanPham").val(str);

	}
</script>



</html>