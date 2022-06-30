<?php include 'inc/header.php';?>
<?php
	if(isset($_GET['delPro'])){
	$delid=$_GET['delPro'];
    $delid=preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['delPro']);
    $delProduct=$cart->delProByCat($delid);
}
?>

<?php

 if($_SERVER['REQUEST_METHOD']== 'POST'){
        $cart_Id=$_POST['cart_Id'];
        $quantity=$_POST['quantity'];
        $updateCart=$cart->updateCartQuantity($cart_Id,$quantity);
        if ($quantity<=0) {
 			$delProduct=$cart->delProByCat($cart_Id);   	# code...
        }
    }

?>
<?php
	if (!isset($_GET['id'])) {
		echo "<meta http-equiv='refresh' content='0;URL=?id=Live'/>";# code...
	}

?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    	<?php
			    	if (isset($updateCart)) {
			    		echo $updateCart;# code...
			    	}
					?>
			    	<?php
			    	if (isset($delProduct)) {
			    		echo $delProduct;# code...
			    	}


			    	?>
						<table class="tblone">
							<tr>
								<th width="5%">SL</th>
								<th width="30%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Quantity</th>
								<th width="15%">Total Price</th>
								<th width="10%">Action</th>
							</tr>

							<?php
								$getPro=$cart->getCartPro();
								if($getPro){
									$i=0;
									$qty=0;
									$sum=0;
									while ($result=$getPro->fetch_assoc()) {
										$i++;
										?>
							<tr><td><?php echo $i;?></td>
								<td><?php echo $result['product_name'];?></td>
								<td><img src="admin/<?php echo $result['image'];?>" alt=""/></td>
								<td>$<?php echo $result['price'];?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cart_Id" value="<?php echo $result['cart_Id'];?>"/>
										<input type="number" name="quantity" value="<?php echo $result['quantity'];?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>$<?php 

									$total=$result['price'] * $result['quantity'];

								echo $total;?></td>
								<td><a onclick="return confirm('Are you sure to delete?')" href="?delPro=<?php echo $result['cart_Id'];?>">X</a></td>
							</tr>
							
							<?php  
								$qty=$qty+$result['quantity'];

								$sum=$sum+$total;
									Session::set("sum",$sum);
									Session::set("qty",$qty);
								 } } ?>
							
						</table>
						<?php
							if($getData){
						?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>$<?php echo $sum; ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>$<?php $vat=$sum*0.1;
								$gtotal=$sum+$vat;
								echo $gtotal; ?></td>
							</tr>
					   </table>
					   <?php } 
					   else {
					   	header("Location:index.php");
					   }
					   	?>
					  
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php';?>