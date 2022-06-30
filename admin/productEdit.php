<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/catagory.php';?>
<?php
if(!isset($_GET['product_id'])|| $_GET['product_id']==NULL)
{
      echo "<script>window.location='productlist.php';</script>";  
}else {
    $id=$_GET['product_id'];
    $id=preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['product_id']);
}
$product=new Product();
  if($_SERVER['REQUEST_METHOD']== 'POST'){
        $product_name=$_POST['product_name'];

        $updatePro=$product->proUpdate($_POST,$_FILES,$id);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Product</h2>
        <div class="block">    
        <?php
            if(isset($updatePro)){
                echo $updatePro;
            }

        ?>  
        <?php
            $getPro=$product->getProById($id);
            if($getPro){
                while ($value=$getPro->fetch_assoc()) {
        ?>         
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text"name="product_name" value="<?php echo $value['product_name']?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catID">
                            <option>Select Category</option>
                             <?php
                                $cat=new Catagory();
                                $getCat=$cat->getAllCat();
                                if($getCat){
                                    while($result=$getCat->fetch_assoc()){
                                ?>
                            <option 

                            <?php
                                if ($value['catID']==$result['catID']) { ?>
                                    selected= "selected"
                                    <?php
                                }

                            ?>
                            value="<?php echo $result['catID'];?>"><?php echo $result['catName'];?>
                                
                            </option>
                           
                           <?php } } ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brand_id">
                            <option>Select Brand</option>
                            <?php
                                $brand=new Brand();
                                $getbrand=$brand->getAllBrand();
                                if($getbrand){
                                    while($result=$getbrand->fetch_assoc()){
                                ?>
                           <option 

                            <?php
                                if ($value['brand_id']==$result['brand_id']) { ?>
                                    selected= "selected"
                                    <?php
                                }

                            ?>
                            value="<?php echo $result['brand_id'];?>"><?php echo $result['brand_name'];?>
                                
                            </option>
                           <?php } } ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body">
                            <?php echo $value['body'];?>
                        </textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price"$ value="<?php echo $value['price'];?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Edit Image</label>
                    </td>
                    <td>
                        <img src="<?php echo $value['image']; ?>" height="80 px" width="200 px"<br/>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Edit Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php
                                if ($value['type']==0) {?>
                            
                            <option selected="selected" value="0">Featured</option>
                            <option value="1">General</option>
                            <?php } else { ?>
                            <option  value="0">Featured</option>
                            <option selected="selected"value="1">General</option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
            <?php
             }
            }            
            ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


