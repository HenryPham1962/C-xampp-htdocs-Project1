
<?php require ('./components/head.php');?>
<?php include ('./components/navbar.php');?>
<div class="container text-center">
      <form action="item_manage.php" method= "POST"> 
         <div class ="form-group">
            <input type="text" name="itemname" placeholder="Item name" required/><br><br> 
            <input type="text" name="brandname" placeholder="Brand name" required/><br><br> 
            <input type="text" name="price" placeholder="Price" required/><br><br> 
            <button class="btn btn-info" type="submit" name="item"> Save</button><br><br>
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
$itemname ='';
$brandname='';
$price='';
if (isset($_POST['item'])) {
    $itemname = $_POST['itemname'];
    $brandname = $_POST['brandname'];
    $price = $_POST['price'];
        
        $sql = "INSERT INTO tbl_items (itemname, brandname,price) VALUES('$itemname','$brandname','$price')" 
        or die (mysqli_error());
        $stmt=$conn->prepare($sql);
        $conn->query($sql);  
        echo "Item has been saved";
       
    }
    if(isset($_GET['delete'])){
        $id =$_GET['delete'];
        $query ="DELETE FROM tbl_items WHERE id='$id'" or die (mysqli_error());
        $stmt=$conn->prepare ($query);
        $conn->query($query);
        echo "Item has been deleted"; 
     }
    if(isset($_GET['edit'])){
        $id =$_GET['edit'];
        $edit= "SELECT * FROM tbl_items WHERE id='$id'" or die (mysqli_error());
        $data = mysqli_query($conn, $edit);
        if (mysqli_num_rows($data) == 1) {
         $row = $data->fetch_assoc();
         $itemname= $row['itemname'];
         $brandname= $row['brandname'];
         $price= $row['price'];
    }
}
    if (isset($_POST['update'])) {
            $id =$_POST['id'];
            $itemname = $_POST['itemname'];
            $brandname = $_POST['brandname'];
            $price = $_POST['price'];
            $update = "UPDATE tbl_items SET itemname ='$itemname', brandname ='$brandname',price ='$price'  WHERE id= '$id'" or die (mysqli_error()); 
            $stmt = $conn->prepare ($update);
            $conn->query($update);
            echo "Item has been updated"; 
        
    }    
  ?>
  <div class="container text-center">  
       <table class="table">
          <thead>
            <tr>
              <th>Item name</th>
              <th>Brand name</th>
              <th>Price</th>
              <th colspan="2">Action</th>
            </tr>
          </thead>
          <?php 
          $servername = "localhost";
          $dbUsername = "root";
          $dbPassword = "";
          $dbName ="hair_care";
          $conn = new mysqli ($servername,$dbUsername,$dbPassword,$dbName) or die ($conn_error($mysqli));
          $sql= "SELECT*FROM tbl_items";
          $result = mysqli_query($conn, $sql);
          while ($row = $result->fetch_assoc()): ?>
          <tr>
             <td><?php echo $row['itemname'] ?></td>
             <td><?php echo $row['brandname'] ?></td>
             <td><?php echo $row['price'] ?></td>
             <td>
             <a href="item_manage.php?edit=<?php echo $row['id'];?>" class="btn btn-primary">Edit</a>
             <a href="item_manage.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
             </td>
          </tr>
          <?php endwhile; ?>
          <tr>
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
             <td> <input type="text" name="itemname" value="<?php echo $itemname; ?>"
                   placeholder="Item name" required/>
             </td> 
             <td>  
                   <input type="text" name="brandname" value="<?php echo $brandname; ?>"
                   placeholder="Brand name" required/>
             </td>
             <td>
                   <input type="text" name="price" value="<?php echo $price; ?>"
                   placeholder="Price" required/>
             </td>
             <td> 
                <button class="btn btn-info" type="submit" name="update"> Update</button>
             </td>           
          </tr>
      </table>
    </div>
 <?php require ('./components/footer.php');?>
