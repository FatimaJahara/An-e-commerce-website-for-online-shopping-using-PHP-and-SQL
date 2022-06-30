<?php include 'inc/header.php';?>
<?php
		$login=Session::get("CustomerLogin");
		if($login==false){
		  header("Location:login.php");
		}
	?>
<style>
.payment{
	width: 500px;
	height: 200px;
	text-align: center;
	border: 1px solid #167a8c;
	margin: 0 auto;
	padding: 80px;
}
.payment h2{
	border-bottom: 1px solid #167a8c;
	margin-bottom: 40px;
	padding-bottom: 10px;
}
.payment a{
	background: red none repeat scroll 0 0;
	border-radius: 3px;
	color: white;
	font-size: 25px;
	padding: 5px 30px;
}
.payment a:hover{color: #242d75;}
.back{}
.back a{width: 150px;margin: 5px auto 0;padding: 7px 0; text-align: center;display: block;background: #242d75;border: 1px solid #333;color: #fff;border-radius: 3px;font-size: 25px;}
.back a:hover{color: #18e9f4;}
</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="payment">
    			<h2>Choose Payment Option</h2>
    			<a href="payoffline.php">Offline Payment</a>
    			<a href="payonline.php">Online Payment</a>
    		</div>
    		<div class="back"><a href="cart.php">Previous</a></div>
 		</div>
 	</div>
 </div>
 <?php include 'inc/footer.php';?>