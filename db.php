<?php
//$con = mysqli_connect("localhost","root","123456","test");
//if (mysqli_connect_errno())
//  {
//  echo "Không thể kết nối đến MySQL: " . mysqli_connect_error();
//  }
 $serverName = "localhost"; 
 $connectionInfo = array( "Database"=>"p2","UID"=>"sa", "PWD"=>"vinhtai1511","CharacterSet" => "UTF-8");
 $conn = sqlsrv_connect($serverName, $connectionInfo);
;

        if( $conn ) {
             echo "";
        }else{
            echo "Kết nối database không thành công.<br />";
            die(print_r(sqlsrv_errors(), true));
        }
