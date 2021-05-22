<?php require ('./components/head.php');?>
<?php include ('./components/navbar.php');?>
<div class="container text-center">
<?php include ('./components/brand.php');?>
      <form action="brand_manage.php" method= "POST"> 
         <div class ="form-group">
            <input type="text" name="brandname" placeholder="Brand name" required/><br><br> 
            <button class="btn btn-info" type="submit" name="brand"> Save</button><br><br>
         </div>
      </form>
  <?php
 $servername = "localhost";
 $dbUsername = "root";
 $dbPassword = "";
 $dbName ="hair_care";

     $conn = new mysqli($servername,$dbUsername,$dbPassword,$dbName) or die ($mysqli_error($mysqli));
$id= 0;     
//$update =false;
$brandname='';
if (isset($_POST['brand'])) {
    $brandname = $_POST['brandname'];
        $sql = "INSERT INTO tbl_brand (brandname) VALUES('$brandname')" 
        or die (mysqli_error());
        $stmt=$conn->prepare($sql);
        $conn->query($sql);  
        echo "Brand has been saved";
       
    }
    if(isset($_GET['delete'])){
        $id =$_GET['delete'];
        $query ="DELETE FROM tbl_brand WHERE id='$id'" or die (mysqli_error());
        $stmt=$conn->prepare ($query);
        $conn->query($query);
        echo "Brand has been deleted"; 
     }
    if(isset($_GET['edit'])){
        $id =$_GET['edit'];
        $edit= "SELECT * FROM tbl_brand WHERE id='$id'" or die (mysqli_error());
        $data = mysqli_query($conn, $edit);
        if (mysqli_num_rows($data) == 1) {
         $row = $data->fetch_assoc();
         $brandname= $row['brandname'];
         $itemname= $row['itemname'];
    }
}
    if (isset($_POST['update'])) {
            $id =$_POST['brand_id'];
            $brandname = $_POST['brandname'];
            $update = "UPDATE tbl_brand SET brandname ='$brandname' WHERE id= '$id'" or die (mysqli_error()); 
            $stmt = $conn->prepare ($update);
            $conn->query($update);
            echo "Brand has been updated"; 
        
    }    
  ?>
  <div class="container justify-content-center">  
       <table class="table table-striped table-responsive ">
          <thead>
            <tr>
              <th>Brand name</th>
             <th colspan="2">Action</th>
            </tr>
          </thead>
          <?php 
          $servername = "localhost";
          $dbUsername = "root";
          $dbPassword = "";
          $dbName ="hair_care";
          $conn = new mysqli ($servername,$dbUsername,$dbPassword,$dbName) or die ($conn_error($mysqli));
          $sql= "SELECT*FROM tbl_brand";
          $result = mysqli_query($conn, $sql);
          while ($row = $result->fetch_assoc()): ?>
          <tr>
             <td><?php echo $row['brandname'] ?></td>
             <td>
             <a href="brand_manage.php?edit=<?php echo $row['brand_id'];?>" class="btn btn-primary">Edit</a>
             <a href="brand_manage.php?delete=<?php echo $row['brand_id'];?>" class="btn btn-danger">Delete</a>
             </td>
          </tr>
          <?php endwhile; ?>
        <form action="item_manage.php" method= "POST"> 
           <div class ="form-group">
           <tr>
                  <input type="hidden" name="brand_id" value="<?php echo $brand_id; ?>">
              <td>  
                   <input type="text" name="brandname" value="<?php echo $brandname; ?>"
                   placeholder="Brand name" required/>
              </td>
             
             <td> 
                <button class="btn btn-primary" type="submit" name="update"> Update</button>
             </td>           
           </tr>
          </div>
        </form>    
      </table>
    </div>
 <?php require ('./components/footer.php');?>
