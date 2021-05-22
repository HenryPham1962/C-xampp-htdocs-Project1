<?php
 session_start();
 require_once("database/connection.php");
  $db_handle = new DBconn();
    if(!empty($_GET["action"])) {
     switch($_GET["action"]) {
	   case "add1":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tbl_equip WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('itemname'=>$productByCode[0]["itemname"], 'code'=>$productByCode[0]["code"], 
      'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
		if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	  case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	  case "empty":
		unset($_SESSION["cart_item"]);
	break;	
  case "add2":
	   if(!empty($_POST["quantity"])) {
		   $productByCode = $db_handle->runQuery("SELECT * FROM tbl_products WHERE code='" . $_GET["code"] . "'");
		   $itemArray = array($productByCode[0]["code"]=>array('itemname'=>$productByCode[0]["itemname"], 'code'=>$productByCode[0]["code"], 
	 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
	   if(!empty($_SESSION["cart_item"])) {
			   if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
				   foreach($_SESSION["cart_item"] as $k => $v) {
						   if($productByCode[0]["code"] == $k) {
							   if(empty($_SESSION["cart_item"][$k]["quantity"])) {
								   $_SESSION["cart_item"][$k]["quantity"] = 0;
							   }
							   $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
						   }
				   }
			   } else {
				   $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
			   }
		   } else {
			   $_SESSION["cart_item"] = $itemArray;
		   }
	   }
   break;
}
}
?>
<?php require ('components/head.php');?>
<?php include ('components/header.php');?> 
<?php include ('./components/brand.php');?>
<div class="container-fluid" style="border: 1px solid blue">
     <nav class="navbar navbar-light bg-light">
       <div class="container justify-content-center">
          <form class="d-flex input-group w-auto" method="GET">
	        <input type="text" placeholder="Type query" name="search">&nbsp;
            <input type="submit" value="SEARCH" name="btn" class="btn btn-sm btn-primary">
	      </form>
       </div>
      </nav>
   <?php         
  
    ?>
  
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
  
 <div id="shopping-cart">
   <div class="txt-heading">Shopping Cart</div>
      <a id="btnEmpty" href="equip_products.php?action=empty">Empty Cart</a>
     <?php
     if(isset($_SESSION["cart_item"])){
      $total_quantity = 0;
      $subtotal = 0;
     ?>	
    <table class="tbl-cart" cellpadding="10" cellspacing="1">
      <tbody>
       <tr>
          <th style="text-align:left;">Item Name</th>
          <th style="text-align:left;">Code</th>
          <th style="text-align:right;" width="5%">Quantity</th>
          <th style="text-align:right;" width="10%">Unit Price</th>
          <th style="text-align:right;" width="10%">Price</th>
          <th style="text-align:center;" width="10%">Remove</th>
      </tr>	
        <?php		
     foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>  
				<tr >
				  <td> <img src="<?php echo $item["image"]; ?>"class="image col-lg-2"/>
                    <?php echo $item["itemname"]; ?></td>
				  <td><?php echo $item["code"]; ?></td>
				  <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				  <td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
				  <td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				  <td style="text-align:center;"><a href="equip_products.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction">
                  <i alt="Remove Item" class="far fa-trash-alt"></i></a></td>
               </tr>
			<?php
				$total_quantity += $item["quantity"];
				$subtotal += ($item["price"]*$item["quantity"]);
   		}
	    	?>

      <tr>
        <td colspan="2" align="right">Total:</td>
        <td align="right"><?php echo $total_quantity; ?></td>
        <td align="right" colspan="2"><strong><?php echo "$ ".number_format($subtotal, 2); ?></strong></td>
      </tr>
		<tr>
           <td></td> 
           <td width="10%"><a href="equip_products.php" class="btn btn-block btn-info">Countinue shopping</a></td>
           <form action="check_out.php" method="GET">
             <td position="left" width="15%"><button type="submit" name="order" class="btn btn-block btn-warning" value="<?= ($subtotal);?>">
             <i class="fab fa-amazon-pay">&nbsp;&nbsp;&nbsp;<?php echo "$ ".($subtotal); ?></i></button></td>   
		  </form> 
        </tr>
      </tbody>
   </table>		
  <?php
 }else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>
</div>

 <div class="txt-heading ml-5">Equipments</div>
   <div class= "row" style="margin: 2%">
	<?php 
    $product_array = $db_handle->runQuery("SELECT * FROM tbl_equip ORDER BY equip_id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
     	<div class="col-lg-2 col-md-12 mb-2">
		  <form method="post" action="equip_products.php?action=add1&code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image text-center"><img src="<?php echo $product_array[$key]["image"]; ?>"></div>
			<div class="product-tile-footer text-center ">
			  <div class="product-title"><?php echo $product_array[$key]["itemname"]; ?>:<?php echo $product_array[$key]["brandname"]; ?></div>
			  <div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
			  <div class="cart-action">
			  <input type="number" name="quantity" min="1" max="9" size="3"/>
              <input type="submit" value="Add to Cart" class="btnAddAction" /></div>
	      	</div>
            </form>
		 </div>
         
	<?php
		}
	 }
    ?>	
 </div>
 <div class="txt-heading ml-5">Products</div>
   <div class= "row" style="margin: 2%">
	<?php 
    $product_array = $db_handle->runQuery("SELECT * FROM tbl_products ORDER BY prod_id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
     	<div class="col-lg-2 col-md-12 mb-2">
		  <form method="post" action="equip_products.php?action=add2&code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image text-center"><img src="<?php echo $product_array[$key]["image"]; ?>"></div>
			<div class="product-tile-footer text-center">
			  <div class="product-title"><?php echo $product_array[$key]["itemname"]; ?>:<?php echo $product_array[$key]["brandname"]; ?></div>
              <div class="product-price text-center"><?php echo "$".$product_array[$key]["price"]; ?></div>
			  <div class="cart-action"><input type="number" name="quantity" min="1" max="9" size="3"/>
               <input type="submit" value="Add to Cart" class="btnAddAction" /></div>
            </div>
            </form>
		 </div>
         
	<?php
		}
	 }
    ?>	
 </div>

<?php include ('components/contact_us.php'); ?>   
<?php require ('components/footer.php');?>