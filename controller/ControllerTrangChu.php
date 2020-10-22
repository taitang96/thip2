<?php
include('../db.php');
include('../common.php');
session_start();
if (isset($_REQUEST["action"])) {
    $s_action = $_REQUEST["action"];
    switch ($s_action) {
            //lay danh sach
        case 'getlist_product':
            $query = "SELECT * FROM [dbo].[sanpham]";
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
            echo json_encode(arrayListDB($result));
            break;
        case 'themGioHang':
            $sum = isset($_SESSION['idCart'][strval($_POST['idCart'])]) ? $_SESSION['idCart'][strval($_POST['idCart'])] : 0;
            $sum++;
            isset($_SESSION['idCart']) ? $arrayListCart = $_SESSION['idCart'] : $arrayListCart = array();

            $arrayListCart[strval($_POST['idCart'])] = $sum;
            //$_SESSION['idCart'] = $arrayListCart;
            $_SESSION['idCart'] = $arrayListCart;

            echo json_encode(true);
            break;
        case 'check_dangnhap';
            if (isset($_SESSION['khachhang'])) {
                echo json_encode(true);
            } else {
                echo json_encode(false);
            }
            break;
        case 'checkSDT';
            $sdt = trim($_POST["modal_sdt"]);
            $query = "SELECT * FROM [dbo].[khachhang] WHERE sdt='" . $sdt . "'";
            $check = false;
            $params = array();
            $options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
            $result = sqlsrv_query($conn, $query, $params, $options);
            $rows = sqlsrv_num_rows($result);

            if ($rows == 1) {
                $check = true;
            }
            echo json_encode($check);
            break;
        case 'ThemKhachHang';
            $sdt = trim($_POST["modal_sdt"]);
            $tenkhachhang = $_POST["modal_tenkhachhang"];
            $diachi = isset($_POST["modal_diachi"]) ? $_POST["modal_diachi"] : '';

            $query = "INSERT into [dbo].[khachhang] (tenkhachhang, sdt, diachi,matkhau) VALUES (N'$tenkhachhang', '" . $sdt . "', N'$diachi','123456')";
            $check;
            $result = sqlsrv_query($conn, $query);
            if ($result) {
                $check = true;
            } else {
                $check = false;
            }
            $arrayKH = [];
            $arrayKH["modal_sdt"] = $sdt;
            $arrayKH["tenkhachhang"] = $tenkhachhang;
            $arrayKH["diachi"] = $diachi;
            $_SESSION['khachhang'] = $arrayKH;

            echo json_encode($check);
            break;
        case 'themHoaDonDatHang';
            $idListXoa = $_POST["idListXoa"];
            $idSanPham = $_POST["idSanPham"];
            $soluong = $_POST["soluong"];
            $soluongarray = explode(",", $soluong);
            $idSanPham = explode(",", $idSanPham);
            $c = array_combine($idSanPham, $soluongarray);

            $idKH = getIDCURRENTUSER($conn);
            $date = new DateTime();
            $date = $date->getTimestamp();

            foreach ($c as $key => $value) {
                $query = "INSERT into [dbo].[qldh_donhang] (mavandon, tendonhang, idhanghoa,soluong,trangthaidonhang,idkhachhang) VALUES ('$date', '" . md5($date) . "', $key,$value,1,$idKH)";
                $check;
                $result = sqlsrv_query($conn, $query);
                if ($result) {
                    $check = true;
                } else {
                    $check = false;
                }
                if ($check) {
                    unset($_SESSION['idCart'][$key]);
                }
            }



            echo json_encode($check);
            break;
        case 'dangNhap';
            $sdt = trim($_POST['sdt']);
            $matkhau = trim($_POST['matkhau']);
            $query = "SELECT * FROM [dbo].[khachhang] WHERE sdt='$sdt' and matkhau='" . $matkhau . "'";

            $params = array();
            $options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
            $result = sqlsrv_query($conn, $query, $params, $options);
            $rows = sqlsrv_num_rows($result);

            if ($rows == 1) {
                $arrayTemp = arrayListDB($result);
                $arrayKH = [];
                $arrayKH["modal_sdt"] = $sdt;
                $arrayKH["tenkhachhang"] = $arrayTemp[0]['tenkhachhang'];
                $arrayKH["diachi"] = $arrayTemp[0]['diachi'];
                $_SESSION['khachhang'] = $arrayKH;
            }
            echo json_encode($rows == 1 ? true : false);
            break;
        case 'ThemTaiKhoan';
            $sdt = trim($_POST["dk_sdt"]);
            $tenkhachhang = $_POST["dk_ht"];
            $diachi = isset($_POST["dk_diachi"]) ? $_POST["dk_diachi"] : '';
            $matkhau = $_POST["dk_mk"];

            $query = "INSERT into [dbo].[khachhang] (tenkhachhang, sdt, diachi,matkhau) VALUES (N'$tenkhachhang', '" . $sdt . "', N'$diachi','$matkhau')";
            $check;
            $result = sqlsrv_query($conn, $query);
            if ($result) {
                $check = true;
            } else {
                $check = false;
            }
            $arrayKH = [];
            $arrayKH["modal_sdt"] = $sdt;
            $arrayKH["tenkhachhang"] = $tenkhachhang;
            $arrayKH["diachi"] = $diachi;
            $_SESSION['khachhang'] = $arrayKH;

            echo json_encode($check);
            break;
    }
}

function getIDCURRENTUSER($conn)
{
    $sdt = trim($_SESSION['khachhang']['modal_sdt']);
    $query = "SELECT TOP 1 id FROM [dbo].[khachhang] WHERE sdt='" . $sdt . "'";
    $check = false;
    $params = array();
    $options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $result = sqlsrv_query($conn, $query, $params, $options);
    $idKhachHang = arrayListDB($result);
    return $idKhachHang[0]['id'];
}
