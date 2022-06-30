<?php include 'inc/header.php';?>
<?php


  if(!isset($_GET['catID'])|| $_GET['catID']==NULL)
{
      echo "<script>window.location='404.php';</script>";  
}else {
    $id=$_GET['catID'];
    $id=preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['catID']);
}

?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Latest from Catagory</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php
	      	$proByCat=$product->proByCat($id);
	      	if($proByCat){
	      		while ($result=$proByCat->fetch_assoc()) {
	      		?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proId=<?php echo $result['product_id'];?>"><img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					 <h2><?php echo $result['product_name'];?> </h2>
					 <p><?php echo $fm->textShorten($result['body'],60);?></p>
					 <p><span class="price">$<?php echo $result['price'];?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $result['product_id'];?>" class="details">Details</a></span></div>
				</div>
				
				<?php } } else {
					echo "<p>Products Of this Catagory are not available!</p>";
				} ?>
			</div>

	
	
    </div>
 </div>
<?php include 'inc/footer.php';?>

