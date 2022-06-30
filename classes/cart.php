<?php
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php');/**
* 
*/?>
<?php
class Cart
{

	private $db;
    private $fm;	
	function __construct()
	{
		$this->db=new Database();
		$this->fm=new Format();
	}

	public function addToCart($quantity,$id)
	{
		$quantity=$this->fm->validation($quantity);
		$quantity=mysqli_real_escape_string($this->db->link,$quantity);
		$product_id=mysqli_real_escape_string($this->db->link,$id);
		$sId=session_id();
		$squery="SELECT * FROM db_product WHERE product_id='$product_id'";
		$result=$this->db->select($squery)->fetch_assoc();

		$product_name=$result['product_name'];
		$price=$result['price'];
		$image=$result['image'];

		$chquery="SELECT * FROM db_cart WHERE product_id='$product_id' AND sId='$sId'";
		$getpro=$this->db->select($chquery);
		if($getpro){
			$msg="Product has already been added to Cart !!";
			return $msg;
		}
		else {
		$query = "INSERT INTO db_cart(sId,product_id,product_name,price,quantity,image) VALUES ('$sId','$product_id','$product_name','$price','$quantity','$image')";
	    	$inserted_row=$this->db->insert($query);
	    	if($inserted_row){
		 	header("Location:cart.php");
		 	} 
		 	else{
              header("Location:404.php");
		 }
		}
	}
	public function getCartPro()
	{
		$sId=session_id();
		$query="SELECT * FROM db_cart WHERE sId='$sId'";
	$result=$this->db->select($query);
	return $result;# code...
	}

	public function updateCartQuantity($cart_Id,$quantity)
	{
		$cart_Id=mysqli_real_escape_string($this->db->link,$cart_Id);
		$quantity=mysqli_real_escape_string($this->db->link,$quantity);

		$query="UPDATE db_cart SET quantity='$quantity' WHERE cart_Id='$cart_Id'";
			$updated_row=$this->db->update($query);
			if($updated_row){
				header("Location:cart.php");
			}
			else{
				$msg="<span class='error'>Quantity not updated!</span>";
				return $msg;
		
		
	}
	
}

public function delProByCat($delid)
{
	$delid=mysqli_real_escape_string($this->db->link,$delid);
	$query="DELETE from db_cart WHERE cart_Id='$delid'";
	$delData=$this->db->delete($query);
	if ($delData) {
		echo "<script>window.location='cart.php';</script>";
	}
	else{
		$msg="<span class='error'>Catagory not deleted successfully!</span>";
				return $msg;
	}# code...
}

public function checkCartTab()
{
	$sId=session_id();
	$query="SELECT * FROM db_cart WHERE sId='$sId'";
	$result=$this->db->select($query);
	return $result;# code...
}

public function delCustomerCart()
{
	$sId=session_id();
	$query="DELETE from db_cart WHERE sId='$sId'";
	$this->db->delete($query);
}
public function orderProduct($cmrid)
{
	$sId=session_id();
	$query="SELECT * FROM db_cart WHERE sId='$sId'";
	$getPro=$this->db->select($query);
	if($getPro){
		while ($result=$getPro->fetch_assoc()) {
			$product_id=$result['product_id'];
			$product_name=$result['product_name'];
			$quantity=$result['quantity'];
			$price=$result['price'] * $quantity;
			$image=$result['image'];
			$query = "INSERT INTO db_order(cmrid,product_id,product_name,quantity,price,image) VALUES ('$cmrid','$product_id','$product_name','$quantity','$price','$image')";
	    	$inserted_row=$this->db->insert($query);
		}
	}
}
public function PayableAmount($cmrid)
{
	$query="SELECT price FROM db_order WHERE cmrid='$cmrid' AND date =now()";
	$result=$this->db->select($query);
	return $result;
}

public function getOrderedPro($cmrid)
{
	$query="SELECT * FROM db_order WHERE cmrid='$cmrid' ORDER BY product_id DESC";
	$result=$this->db->select($query);
	return $result;
}

public function checkOrderTab($Customerid)
{
	
	$query="SELECT * FROM db_order WHERE cmrid='$Customerid'";
	$result=$this->db->select($query);
	return $result;
}

}

?>