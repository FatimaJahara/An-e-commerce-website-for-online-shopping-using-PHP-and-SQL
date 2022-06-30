<?php include 'inc/header.php';?>

<?php
$login=Session::get(
  "CustomerLogin");
if($login==false){
  header("Location:login.php");
}
?>
<style>
.tblone tr td{text-align: center;}

</style>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 <div class="main">
    <div class="content">
    	  	
       <div class="clear"></div>
       		<div class="section group">
       			<div class="order">
       			<h2 style="color: #d36b04">Your Order Details</h2>
            <table class="tblone">
              <tr>
                <th>SL</th>
                <th >Product Name</th>
                <th >Image</th>
                <th >Quantity</th>
                <th >Total Price</th>
                <th >Date</th>
                <th >Status</th>
                <th >Action</th>
              </tr>

              <?php
                $cmrid=Session::get("Customerid");
                $getOrder=$cart->getOrderedPro($cmrid);
                if($getOrder){
                  $i=0;
                  
                  while ($result=$getOrder->fetch_assoc()) {
                    $i++;
                    ?>
              <tr><td><?php echo $i;?></td>
                <td><?php echo $result['product_name'];?></td>
                <td><img src="admin/<?php echo $result['image'];?>" alt=""/></td>
                <td><?php echo $result['quantity'];?></td>
               
                <td>$<?php 

                  $total=$result['price'] * $result['quantity'];

                echo $total;?></td>
                <td><?php echo $fm->formatDate($result['date']);?></td>
                <td><?php
                if($result['status']=='0') {
                echo "Pending";}
                else echo "Shifted"?></td>
                <?php
                if($result['status']=='1') { ?>
                <td><a onmouseover="this.style.color='red';" onmouseout="this.style.color='';" onclick="return confirm('Are you sure to delete?')" href="" >X</a></td>
                <?php } else {?>
                <td style="color: red">N/A</td>
                <?php } ?>
              </tr>
              
             <?php } } ?>
            </table>
       			</div>	
       			</div>
       	</div>
    </div>
 </div>
<?php include 'inc/footer.php';?>