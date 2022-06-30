<?php include 'inc/header.php';?>
<?php
  if(!isset($_GET['proId'])|| $_GET['proId']==NULL)
{
      echo "<script>window.location='404.php';</script>";  
}else {
    $id=$_GET['proId'];
    $id=preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['proId']);
}
  
  if($_SERVER['REQUEST_METHOD']== 'POST'){
        $quantity=$_POST['quantity'];

        $addCart=$cart->addToCart($quantity,$id);
    }
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">				
					<?php
					$getPd=$product->getSinglePro($id);
						if($getPd){
							while ($result=$getPd->fetch_assoc()) {
								# code..
				?>
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image'];?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['product_name'];?></h2>
										
					<div class="price">
						<p>Price: <span>$<?php echo $result['price'];?></span></p>
						<p>Category: <span><?php echo $result['catName'];?></span></p>
						<p>Brand:<span><?php echo $result['brand_name'];?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>				
				</div>
				<span style="color:red;font-size: 18px;">
					<?php
					If(isset($addCart)){
						echo $addCart;
					}

					?>
				</span>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo $result['body'];?></p>
	    </div>
		<?php } } ?>		
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
						<?php
						$getcat=$catagory->getAllCat();
						if ($getcat) {
							while ($result=$getcat->fetch_assoc()) {
								# code...
							
						?>
				      <li><a href="productbycat.php?catID=<?php echo $result['catID'];?>"><?php echo $result['catName'];?></a></li>
				    <?php } } ?>  
    				</ul>
    	
 				</div>
 		</div>
 	</div>
 </div>
 <?php include 'inc/footer.php';?>