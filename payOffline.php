
<?php include 'inc/header.php';?>
<?php
		$login=Session::get("CustomerLogin");
		if($login==false){
		  header("Location:login.php");
		}
	?>

	<?php
		if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
			$cmrid=Session::get("Customerid");
			$insertOrder=$cart->orderProduct($cmrid);
			$delData=$cart->delCustomerCart();
			header("Location:success.php");
		}

	?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<style>
.division{width: 50%;float: left;}
.tblone{width:90%;margin-left:  12px;border: 2px solid #0d3538;text-align: left;}	
.tblone tr td{text-align: justify;}
.tbltwo{width: 50%;text-align:left;border: 2px solid #0d3538;margin-right: 14px;margin-left: 10px;margin-top: 12px;}
.tbltwo tr td{text-align: justify;padding: 5px 10px;}
.tbltwo tr:nth-child(odd) {
    background-color: #fdf0f1;
}
.orderNow{padding-bottom: 30px;}
.orderNow a{width: 200px;margin: 20px auto 0;text-align: center;padding: 5px;font-size: 30px;display: block;background: red;color: white;border-radius: 3px}
.orderNow a:hover{color: #18e9f4;}
</style>


 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="division">
    			<table class="tblone">
							<tr>
								<th >No</th>
								<th >Product</th>
								
								<th >Price</th>
								<th >Quantity</th>
								<th >Total Price</th>
								
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
								<td>$<?php echo $result['price'];?></td>
								<td><?php echo $result['quantity'];?></td>
							
								<td>$<?php 

									$total=$result['price'] * $result['quantity'];

								echo $total;?></td>
								
							</tr>
							
							<?php  
								$qty=$qty+$result['quantity'];

								$sum=$sum+$total;
									
								 } } ?>
							
						</table>
						
						<table class="tbltwo">
							<tr>
								<td>Sub Total</td>
								<td>:</td>
								<td>$<?php echo $sum; ?></td>
							</tr>
							<tr>
								<td>Quantity</td>
								<td>:</td>
								<td><?php echo $qty; ?></td>
							</tr>
							<tr>
								<td>VAT</td>
								<td>:</td>
								<td>10%($<?php echo $vat=$sum*0.1;?>)</td>
							</tr>
							<tr>
								<td>Grand Total</td>
								<td>:</td>
								<td>$<?php $vat=$sum*0.1;
								$gtotal=$sum+$vat;
								echo $gtotal; ?></td>
							</tr>
					   </table>
    		</div>
    		<div class="division">
    			<?php
    		$id=Session::get("Customerid");
    		$getData=$cmr->getCustomerData($id);
    		if($getData){
    			while($result=$getData->fetch_assoc()){
    		?>
			<table class="tblone">
				<tr>
					<td colspan="3"><h2>Profile Details</h2></td>

				</tr>
				<tr>
					<td width="20%">Name</td>
					<td width="5%">:</td>
					<td><?php echo $result['name'];?></td>
				</tr> 
				<tr>
					<td>Phone</td>
					<td>:</td>
					<td><?php echo $result['phone'];?></td>
				</tr>
				<tr>
					<td>Address</td>
					<td>:</td>
					<td><?php echo $result['address'];?></td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td>:</td>
					<td><?php echo $result['email'];?></td>
				</tr>
				<tr>
					<td>Zip-Code</td>
					<td>:</td>
					<td><?php echo $result['zip'];?></td>
				</tr>
				<tr>
					<td>City</td>
					<td>:</td>
					<td><?php echo $result['city'];?></td>
				</tr>
				<tr>
					<td>Country</td>
					<td>:</td>
					<td><?php echo $result['country'];?></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td type ="HoverCell"><a  href ="editPro.php">Update Details</a></td>
				</tr>
			</table>
			<?php }} ?>
    		</div>
 		</div>
 	</div>
 	<div class="orderNow"><a href="?orderid=order">Order</a></div>
 </div>
</html>
 <?php include 'inc/footer.php';?>