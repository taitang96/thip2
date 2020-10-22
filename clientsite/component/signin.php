<!doctype html>
<?php require('../head.php'); ?>
<?php include('../../common.php'); ?>
<?php session_start();?>
<body>
	<!-- Add your site or application content here -->

	<?php require('../headertop.php'); ?>

	<?php require('../headermiddle.php'); ?>

	<?php require('../menuarea.php'); ?>

	
	<!-- MAIN-CONTENT-SECTION START -->
	<section class="main-content-section">
		<div class="container">

			<div class="row" style="margin-top:24px;">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h2 class="page-title">Đăng nhập / Đăng ký</h2>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<!-- CREATE-NEW-ACCOUNT START -->
					<div class="create-new-account">
						<form class="new-account-box primari-box" id="create-new-account" method="post" action="#">
							<h3 class="box-subheading">Đăng ký</h3>
							<div class="form-content">
								<p>Vui lòng nhập các thông tin dưới đây</p>
								<div class="form-group primary-form-group">
									<label for="email">Số Điện Thoại(Dùng để đăng nhập):</label>
									<input type="text" value="" name="dk_sdt" id="dk_sdt" class="form-control input-feild" required>
								</div>
								<div class="form-group primary-form-group">
									<label for="email">Họ và tên:</label>
									<input type="text" value="" name="dk_ht" id="dk_ht" class="form-control input-feild" required>
								</div>
								<div class="form-group primary-form-group">
									<label for="email">Địa chỉ:</label>
									<input type="text" value="" name="dk_diachi" id="dk_diachi" class="form-control input-feild" required>
								</div>
								<div class="form-group primary-form-group">
									<label for="email">Mật khẩu:</label>
									<input type="password" value="" name="dk_mk" id="dk_mk" class="form-control input-feild" required autocomplete="off">
								</div>
								<div class="submit-button">
									<a href="javascript:void(0)" id="SubmitCreate" class="btn main-btn" onclick="dangKi();">
										<span>
											<i class="fa fa-user submit-icon"></i>
											Tạo tài khoản
										</span>
									</a>
								</div>
							</div>
						</form>
					</div>
					<!-- CREATE-NEW-ACCOUNT END -->
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<!-- REGISTERED-ACCOUNT START -->
					<div class="primari-box registered-account">
						<form class="new-account-box" id="accountLogin" method="post" action="#">
							<h3 class="box-subheading">Đăng Nhập</h3>
							<div class="form-content">
								<div class="form-group primary-form-group">
									<label for="loginemail">SĐT ĐĂNG NHẬP</label>
									<input type="text" value="" name="sdt" id="sdt" class="form-control input-feild">
								</div>
								<div class="form-group primary-form-group">
									<label for="password">Mật Khẩu</label>
									<input type="password" value="" name="matkhau" id="matkhau" class="form-control input-feild">
								</div>

								<div class="submit-button">
									<a href="javascript:void(0);" id="signinCreate" class="btn main-btn" onclick="DangNhap();">
										<span>
											<i class="fa fa-lock submit-icon"></i>
											Đăng Nhập
										</span>
									</a>
								</div>
							</div>
						</form>
					</div>
					<!-- REGISTERED-ACCOUNT END -->
				</div>
			</div>
		</div>
	</section>
	<!-- MAIN-CONTENT-SECTION END -->

	<?php require('../footer.php'); ?>
</body>

<script>
	function DangNhap() {
		if(!validateDangNhap()) return;

		obj = new Object();
		obj.action = 'dangNhap';
		obj.sdt = $("#sdt").val();
		obj.matkhau = $("#matkhau").val();

		callAjax('<?php echo diachi; ?>/controller/ControllerTrangChu.php', 'post', 'json', obj,
			function(data) {
				console.log(data);
				if (data) {
					alert("Đăng nhập thành công");
					window.location.assign('<?php echo diachi;?>');
				} else {
					alert("Đăng nhập thật bại");
				}
			}, null
		);
	}

	function validateDangNhap() {
		if ($('#sdt').val() == "") {
			alert("vui lòng nhập số điện thoại");
			return false;
		}

		if ($('#matkhau').val() == "") {
			alert("vui lòng nhập mật khẩu");
			return false;
		}
		return true;
	}

	function dangKi() {
		if (!validateDangKi()) return;
		obj = new Object();
		obj.action = 'checkSDT';
		obj.modal_sdt = $("#dk_sdt").val();
		callAjax('<?php echo diachi; ?>/controller/ControllerTrangChu.php', 'post', 'json', obj,
			function(data) {
				if (data) {
					alert("Số điện thoại này đã tồn tại trong hệ thống");
				} else {
					console.log("số điện thoại này chưa có");
					obj = new Object();
					obj.action = 'ThemTaiKhoan';
					obj.dk_sdt = $("#dk_sdt").val();
					obj.dk_ht = $("#dk_ht").val();
					obj.dk_diachi = $("#dk_diachi").val();
					obj.dk_mk = $("#dk_mk").val();

					callAjax('<?php echo diachi; ?>/controller/ControllerTrangChu.php', 'post', 'json', obj,
						function(data) {
							console.log(data);
							if (data) {
								alert("Thêm thông tin khách hàng thành công");
								window.location.assign('<?php echo diachi;?>');
							} else {
								alert("Thêm thông tin khách hàng thất bại");
							}
						}, null
					);
				}
			}, null
		);
	}

	function validateDangKi() {
		if ($('#dk_sdt').val() == "") {
			alert("vui lòng nhập số điện thoại");
			return false;
		}

		if ($('#dk_ht').val() == "") {
			alert("vui lòng nhập họ tên");
			return false;
		}

		if ($('#dk_mk').val() == "") {
			alert("vui lòng nhập mật khẩu");
			return false;
		}
		return true;
	}
</script>

</html>