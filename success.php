<?php include 'inc/header.php';?>
<?php
		$login=Session::get("CustomerLogin");
		if($login==false){
		  header("Location:login.php");
		}
	?>
<style>
.Psuccess{
	width: 500px;
	height: 200px;
	text-align: center;
	border: 1px solid #167a8c;
	margin: 0 auto;
	padding: 40px;
}
.Psuccess h2{
	border-bottom: 1px solid #167a8c;
	margin-bottom: 20px;
	padding-bottom: 10px;
}
.Psuccess p{line-height: 25px;/*color: #717535;*/font-size: 20px;text-align: left;}
.Psuccess p a:hover{color: darkorange}
.bold{font-weight: bold;color: red;}
</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="Psuccess">
    			<h2>Success</h2>
    			<?php
			      $cmrid=Session::get("Customerid");
			      $amount=$cart->PayableAmount($cmrid);
			      if ($amount) {
			      	$sum = 0;
				    while ($result=$amount->fetch_assoc()) {
						$price=$result['price']	;
						$sum=$sum+$price;  }  } 		
				    ?>
    			<p>Total Payable Amount (including vat):$
    			<?php 
    			$vat=$sum* 0.1; 
    			$total=$sum+$vat; 
    			echo $total;  
    			?>
    			</p>
    		<p class="bold">Payment Successful...</p>
    			<p>Thanks for Purchase.We have recieved your order successfully.We will contact you ASAP with delivery details.Here is your order details......<a href="orderdetails.php">Visit Here</a></p>
    		</div>

 		</div>
 	</div>
 </div>
 <?php include 'inc/footer.php';?>