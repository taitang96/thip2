<!DOCTYPE html>
<html lang="en">

<?php require('../head.php'); 
include("../../auth.php");
?>


<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

  <?php require('../navbar.php'); ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
         
        <?php require('../topbar.php'); ?>
        
        <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Phân loại Database</h6>
            </div>
            <div class="card-body">
              <div class="btn btn-primary">+ Thêm mới</div>
              <hr></hr>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tên Máy</th>
                      <th>Loại máy</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Tiger Nixon</td>
                      <td>System Architect</td>
                      <td>Edinburgh</td>
                      <!-- Begin Page Content
            
        <!-- Begin Page Content -->
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <?php 
                include('../../db.php');
                //$query = "SELECT * FROM [dbo].[sanpham]";
               
                $query = "INSERT INTO [dbo].[sanpham] VALUES (N'Tài Tăng', N'Tăng Vĩnh Tài');";
                //echo $query;
                $params = array();
                $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                $result = sqlsrv_query( $conn, $query , $params, $options );
                // $rows = sqlsrv_num_rows($result);
                // while($row = sqlsrv_fetch_array($result) ) {
                //     echo $row['tenmay'];
                //     echo $row['loaimay'];
                // }
                sqlsrv_close($conn);
                echo "Tai Tang";
                
            ?> 
        </div>
        <!-- /.container-fluid -->
         
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <?php require('../footer.php') ?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <?php require('../enscroll.php') ?>

</body>

</html>
