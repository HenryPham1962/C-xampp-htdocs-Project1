<?php require ('components/head.php');?>
<?php include ('components/header.php');?>  
<?php include ('components/background_img.php'); ?>
<div class="container-fluid" style="border: 1px solid blue">
     <nav class="navbar navbar-light bg-light">
       <div class="container justify-content-center">
          <form action="index.php" method="GET">
	        <input type="text" placeholder="Type query" name="search">&nbsp;
            <input type="submit" value="SEARCH" name="btn" class="btn btn-sm btn-primary">
	      </form>
       </div>
      </nav>
    
 <div class="container justify-content-center"> 
    <table class="table table-striped table-responsive">
      <tr>
    	<th style="text-align:left;" width="30%">Image & Item Name</th>	
    	<th style="text-align:left;" width="5%">Code</th>	
	    <th style="text-align:left;" width="5%">Brand name</th>
	    <th style="text-align:left;" width="5%">Price</th>

      </tr>
    	<?php
	    $servername = "localhost";
	    $dbUsername = "root";
	    $dbPassword = "";
	    $dbName ="hair_care";
	    $conn = new mysqli($servername,$dbUsername,$dbPassword,$dbName) or die ($mysqli_error($mysqli));
		$sql = "SELECT * FROM tbl_equip";
	    if(isset($_GET['search'])){ 
		$itemname = mysqli_real_escape_string($conn, htmlspecialchars($_GET['search']));
		$sql = "SELECT * FROM tbl_equip WHERE itemname ='$itemname' UNION SELECT * FROM tbl_products WHERE itemname ='$itemname' ";
	}
	    $result = $conn->query($sql);   
	  while($row = $result->fetch_assoc()):;
	   ?>
        <tr>
	       <td> <img src="<?php echo $row["image"]; ?>"class="image col-lg-1"/>
					  <?php echo $row["itemname"]; ?></td>
           <td><?php echo $row['code']; ?></td>
           <td><?php echo $row['brandname']; ?></td>
           <td><?php echo $row['price']; ?></td>
         </tr>
	   </table>
	<?php endwhile; ?>    
   </div>
 </div>				  			  
   
 </header>  
<?php include ('components/remedies.php'); ?>
<?php include ('components/contact_us.php'); ?>   
<?php require ('components/footer.php');?>


