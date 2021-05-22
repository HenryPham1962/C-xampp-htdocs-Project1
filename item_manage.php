
<?php require ('./components/head.php');?>
<?php include ('./components/navbar.php');?>
<div class="container text-center">
      <form action="item_manage.php" method= "POST"> 
         <div class ="form-group">
            <input type="text" name="code" placeholder="Item code" required/> 
            <input type="text" name="image" placeholder="Image link" required/> 
            <input type="text" name="itemname" placeholder="Item name" required/> 
            <input type="text" name="brandname" placeholder="Brand name" required/>
            <input type="text" name="price" placeholder="Price" required/>
            <button class="btn btn-info" type="submit" name="item"> Save</button>
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
$code='';
$image='';
$itemname ='';
$brandname='';
$price='';
if (isset($_POST['item'])) {
    $code = $_POST['code'];
    $image = $_POST['image'];
    $itemname = $_POST['itemname'];
    $brandname = $_POST['brandname'];
    $price = $_POST['price'];
      $result= mb_substr($code,0,3);
      if($result =="Equ"){
        $sql = "INSERT INTO tbl_equip (code,image,itemname, brandname,price) VALUES('$code','$image','$itemname','$brandname','$price')" 
        or die (mysqli_error());
        $stmt=$conn->prepare($sql);
        $conn->query($sql);  
        echo "Equipment has been saved";
        }  
        elseif($result=="Pro"){
        $sql = "INSERT INTO tbl_products (code,image,itemname, brandname,price) VALUES('$code','$image','$itemname','$brandname','$price')" 
        or die (mysqli_error());
        $stmt=$conn->prepare($sql);
        $conn->query($sql);  
        echo "Product has been saved";
        }     
    }
    if(isset($_GET['delete'])){
        $code =$_GET['delete'];
        $result= mb_substr($code,0,3);
        if($result =="Equ"){
        $query ="DELETE FROM tbl_equip WHERE code='$code'" or die (mysqli_error());
        $stmt=$conn->prepare ($query);
        $conn->query($query);
        echo "Equipment item has been deleted"; 
     }
       elseif($result=="Pro"){
        $query ="DELETE FROM tbl_products WHERE code='$code'" or die (mysqli_error());
        $stmt=$conn->prepare ($query);
        $conn->query($query);
        echo "Product item has been deleted"; 
       }
    }
  if(isset($_GET['edit'])){
        $code =$_GET['edit'];
        $result= mb_substr($code,0,3);
     if($result =="Equ"){
        $edit= "SELECT * FROM tbl_equip WHERE code='$code'" or die (mysqli_error());
        $data = mysqli_query($conn, $edit);
       if (mysqli_num_rows($data) == 1) {
         $row = $data->fetch_assoc();
         $code= $row['code'];
         $image= $row['image'];
         $itemname= $row['itemname'];
         $brandname= $row['brandname'];
         $price= $row['price'];
    }
  }
      elseif($result=="Pro"){
            $edit= "SELECT * FROM tbl_products WHERE code='$code'" or die (mysqli_error());
            $data = mysqli_query($conn, $edit);
          if (mysqli_num_rows($data) == 1) {
             $row = $data->fetch_assoc();
             $code= $row['code'];
             $image= $row['image'];
             $itemname= $row['itemname'];
             $brandname= $row['brandname'];
             $price= $row['price'];
        }    
 }
}
    if (isset($_GET['update'])) {
            $code = $_GET['code'];
            $image = $_GET['image'];
            $itemname = $_GET['itemname'];
            $brandname = $_GET['brandname'];
            $price = $_GET['price'];
            $result= mb_substr($code,0,3); 
       if($result =="Equ"){
            $update = "UPDATE tbl_equip SET code= '$code', image='$image',itemname ='$itemname', brandname ='$brandname',price='$price'
             WHERE code= '$code'" or die (mysqli_error()); 
             $stmt = $conn->prepare ($update);
            $conn->query($update);
            echo "Equipment item has been updated";         
    } 
       elseif($result=="Pro"){
        $update = "UPDATE tbl_products SET code= '$code', image='$image',itemname ='$itemname', brandname ='$brandname',price='$price' 
        WHERE code= '$code'" or die (mysqli_error()); 
         $stmt = $conn->prepare ($update);
         $conn->query($update);
         echo "Product item has been updated";     
  }
}
    $conn->close(); 
  ?>
   
  <div class="container justify-content-center">  
       <table class="table table-striped table-responsive ">
          <thead>
          <tr>
            <th >Item code </th>
            <th >Image</th>
            <th >Item name</th>
            <th>Brand name</th>
            <th >Price</th>
            <th colspan="2">Action</th>
          </tr>
          </thead>
        <?php 
             $servername = "localhost";
             $dbUsername = "root";
             $dbPassword = "";
             $dbName ="hair_care";
             $conn = new mysqli ($servername,$dbUsername,$dbPassword,$dbName) or die ($conn_error($mysqli));
             $sql= "SELECT*FROM tbl_equip";
             $result = mysqli_query($conn, $sql);
          while ($row = $result->fetch_assoc()): ?>
          <tr>
              <td><?php echo $row['code']; ?></td>
              <td><?php echo $row['image']; ?></td>
              <td><?php echo $row['itemname']; ?></td>
              <td><?php echo $row['brandname']; ?></td>
              <td><?php echo $row['price']; ?></td>
                    
             <td>
             <a href="item_manage.php?edit=<?php echo $row['code'];?>" class="btn btn-primary">Edit</a>
             <a href="item_manage.php?delete=<?php echo $row['code'];?>" class="btn btn-danger">Delete</a>
             </td>
          </tr>
          <?php endwhile; ?>
          <?php 
             $servername = "localhost";
             $dbUsername = "root";
             $dbPassword = "";
             $dbName ="hair_care";
             $conn = new mysqli ($servername,$dbUsername,$dbPassword,$dbName) or die ($conn_error($mysqli));
             $sql= "SELECT*FROM tbl_products";
             $result = mysqli_query($conn, $sql);
          while ($row = $result->fetch_assoc()): ?>
          <tr>
              <td><?php echo $row['code']; ?></td>
              <td><?php echo $row['image']; ?></td>
              <td><?php echo $row['itemname']; ?></td>
              <td><?php echo $row['brandname']; ?></td>
              <td><?php echo $row['price']; ?></td>
                    
             <td>
             <a href="item_manage.php?edit=<?php echo $row['code'];?>" class="btn btn-primary">Edit</a>
             <a href="item_manage.php?delete=<?php echo $row['code'];?>" class="btn btn-danger">Delete</a>
             </td>
          </tr>
          <?php endwhile; ?>  
     <form action="item_manage.php" method= "GET">   
          <div class ="form-group">
             <tr>
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
               <td> <input type="text" name="code" value="<?php echo $code; ?>"
                   placeholder="Item code" required/></td>
               <td> <input type="text" name="image" value="<?php echo $image; ?>"
                   placeholder="Item image" required/></td>     
               <td> <input type="text" name="itemname" value="<?php echo $itemname; ?>"
                   placeholder="Item name" required/></td> 
               <td>  
                   <input type="text" name="brandname" value="<?php echo $brandname; ?>"
                   placeholder="Brand name" required/></td>
               <td>
                   <input type="text" name="price" value="<?php echo $price; ?>"
                   placeholder="Price" required/></td>
               <td> 
                <button class="btn btn-info" type="submit" name="update" value="1"> Update</button>
              </td>           
            </tr>
          </div> 
         </form>  
      </table>
    </div>
 <?php require ('./components/footer.php');?>
