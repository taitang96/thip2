<!-- HEADER-TOP START -->
<div class="header-top">
	<div class="container">
		<div class="row">
			<!-- HEADER-LEFT-MENU START -->
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="header-left-menu">
					<div class="welcome-info">
						Chào mừng <span> <?php echo isset($_SESSION["khachhang"]) ? $_SESSION["khachhang"]["tenkhachhang"] : "Guest"; ?></span>
					</div>
				</div>
			</div>
			<!-- HEADER-LEFT-MENU END -->
			<!-- HEADER-RIGHT-MENU START -->
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="header-right-menu">
					<nav>
						<ul class="list-inline">
							<li><a href="<?php echo diachi; ?>clientsite/component/mycart.php">My Cart</a></li>
							<!-- <li><a href="<?php echo diachi; ?>/clientsite/component/signin.php">Sign in</a></li> -->
							<?php if (isset($_SESSION["khachhang"])) { ?>
								<li><a href="<?php echo diachi; ?>/logout_khach.php">Log out</a></li>
								<li><a href="<?php echo diachi; ?>clientsite/component/dsdonhang.php">DS ĐƠN HÀNG</a>
							<?php } else { ?>
								<li><a href="<?php echo diachi; ?>/clientsite/component/signin.php">Sign in</a></li>
							<?php } ?>
						</ul>
					</nav>
				</div>
			</div>
			<!-- HEADER-RIGHT-MENU END -->
		</div>
	</div>
</div>
<!-- HEADER-TOP END -->