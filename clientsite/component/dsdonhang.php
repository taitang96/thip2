<!doctype html>
<?php require('../head.php'); ?>
<?php include('../../db.php') ?>
<?php include('../../common.php'); ?>
<?php session_start(); ?>

<body>
    <!-- Add your site or application content here -->

    <?php require('../headertop.php'); ?>

    <?php require('../headermiddle.php'); ?>

    <?php require('../menuarea.php'); ?>

    <!-- MAIN-CONTENT-SECTION START -->
    <?php
    $sdt = trim($_SESSION['khachhang']['modal_sdt']);
    $query = "SELECT TOP 1 id FROM [dbo].[khachhang] WHERE sdt='" . $sdt . "'";
    $check = false;
    $params = array();
    $options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $result = sqlsrv_query($conn, $query, $params, $options);
    $idKhachHang = arrayListDB($result);
    $idKH = $idKhachHang[0]['id'];

    $query = "SELECT * FROM [dbo].[qldh_donhang] dh join [dbo].[qlhh_hanghoa] hh on dh.idhanghoa = hh.id where dh.idkhachhang = '" . $idKH . "'";

    $params = array();
    $options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $result = sqlsrv_query($conn, $query, $params, $options);
    $dsSP = arrayListDB($result);
    $sum = 0;
    ?>

    <!-- TABLE START -->
    <table class="table table-bordered" id="cart-summary" style="margin-top: 25px;">
        <!-- TABLE HEADER START -->
        <thead>
            <tr>
                <th class="cart-product">Mã vận đơn</th>
                <th class="cart-description">Tên Sản Phẩm</th>
                <th class="cart-unit text-right">Giá bán</th>
                <th class="cart_quantity text-center">Trạng thái giao hàng</th>
                <th class="cart-delete">SL Mua</th>
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
                        <?php echo $row['mavandon']; ?>
                    </td>
                    <td class="cart-description">
                        <p class="product-name"><a href="#"><?php echo $row['tenhanghoa']; ?></a></p>
                        <small></small>
                    </td>
                    <!-- <td class="cart-avail"><span class="label label-success">Còn hàng</span></td> -->
                    <td class="cart-unit">
                        <ul class="price text-right">
                            <li class="price"><b style="color:red;"><?php echo number_format($row['giaban']); ?> VNĐ</b></li>
                        </ul>
                    </td>
                    <td class="cart_quantity text-center">
                        <b style="color:red;"><?php echo $row['trangthaidonhang'] == 1 ? "chờ giao hàng" : "đang giao"; ?></b>

                        <!-- <div class="cart-plus-minus-button">
											</div> -->
                    </td>
                    <td class="cart-delete text-center">
                        <input class="cart-plus-minus" type="text" name="qtybutton" value="<?php echo $row['soluong']; ?>" disabled>
                    </td>
                    <td class="cart-total">
                        <span class="price" ><b style="color:red;"><?php echo number_format($row['soluong'] * $row['giaban']); ?> VNĐ </b></span>
                    </td>
                </tr>
                <!-- SINGLE CART_ITEM END -->
            <?php 
                $sum = $sum + $row['soluong'] * $row['giaban'];
            } ?>


        </tbody>
        <!-- TABLE BODY END -->
        <!-- TABLE FOOTER START -->
        <tfoot>
            <tr class="cart-total-price">
										<td class="cart_voucher" colspan="2" rowspan="5"></td>
										<td class="text-right" colspan="3">Tổng tiền</td>
										<td id="total_product" class="price" colspan="1"><b><?php echo number_format($sum); ?> VNĐ </b></td>
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
									</tr>
        </tfoot>
        <!-- TABLE FOOTER END -->
    </table>
    <!-- TABLE END -->

    <!-- CART TABLE_BLOCK END -->



    <!-- MAIN-CONTENT-SECTION END -->

    <?php require('../footer.php'); ?>
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

</html>