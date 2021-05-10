<?php
   include ('./database/connection.php');
   $stmt = $conn->prepare("SELECT * FROM tbl_order ORDER BY order_id DESC");
   $stmt->execute();
   $all_result = $stmt->fetchAll();
   $total_rows= $stmt->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <script src="js/mdb.min.js"></script>
  </head>
   <body>
     <div class="container-fluid">
     
       <table id="table-data" class="table table-bordered table-triped">
          <thead>
             <tr>
              <th>Invoice No</th>
              <th>Receiver name</th>
              <th>Total</th>
              <th>PDF</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
         </thead>
         </php 
            if($total_rows >0 ){
                foreach ($all_result as $row){
                    echo'
                     <tr>
                      <td>'.$row["order_no"].'</td>
                      <td>'.$row["order_date"].'</td>
                      <td>'.$row["order_receiver_name"].'</td>
                      <td>'.$row["order_total_after_tax"].'</td>
                      <td> <a href="print_invoice.php?pdf=1& id='.$row['order_id'].'">PDF</a></td>
                      <td> <a href ="invoice.php? update=1 &id ='.$row['order_id'].'"><span class="glyphicon glyphicon-edit"></span></a></td>
                      <td> <a href ="# id ='.$row['order_id'].'"class="delete" ><span class="glyphicon glyphicon-remove"></span></a></td>
                     </tr> 
                    ';
                }
            }
         ?>
       </table>
      </div>
    <?php require ('components/footer.php');?>
   </body>
 </html>
 <script type="text/javascript">
    $(document).ready(function()){
        var table = $('#data-table').DataTable();
    });
 </script>