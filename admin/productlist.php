<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';?>
<?php include_once '../helpers/Format.php';?>

<?php
$product=new Product();
$fm=new Format();
?>
<?php
    $product=new Product();
    if(isset($_GET['delproduct'])){
        $id=$_GET['delproduct'];
        $id=preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['delproduct']);
        $delproduct=$product->delProById($id);

    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block"> 
         <?php 
                	if (isset($delproduct)) {
                		echo $delproduct;     # code...
                	}

                ?>  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL</th>
					<th>Product Name</th>
					<th>Catagory</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$getpd=$product->getAllProduct();	
				if($getpd){
					$i=0;
					while ($result=$getpd->fetch_assoc()) {
						$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['product_name']; ?></td>
					<td><?php echo $result['catName']; ?></td>
					<td><?php echo $result['brand_name']; ?></td>
					<td><?php echo $fm->textShorten($result['body'],50); ?></td>
					<td>$<?php echo $result['price']; ?></td>
					<td><img src="<?php echo $result['image']; ?>" height="40 px" width="60 px"</td>
					<td>
						<?php
						if ($result['type']==0) {
						 	echo "Featured"; # code...
						 }
						 else{
						  	echo "General"; # code...
						  } 
						
						?></td>  
					<td><a href="productEdit.php?product_id=<?php echo $result['product_id'];?>">Edit</a> || <a onclick="return confirm('Are you sure to delete?')" href="?delproduct=<?php echo $result['product_id'];?>">Delete</a></td>
				</tr>
				<?php
				}
				}
			?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
