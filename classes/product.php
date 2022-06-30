<?php
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php');


?>

<?php

class Product
{
	private $db;
    private $fm;	
	function __construct()
	{
		$this->db=new Database();
		$this->fm=new Format();
	}
	public function proInsert($data,$file)
	{
		$product_name=$this->fm->validation($data['product_name']);
		$product_name=mysqli_real_escape_string($this->db->link,$data['product_name']);

		$catID=$this->fm->validation($data['catID']);
		$catID=mysqli_real_escape_string($this->db->link,$data['catID']);

		$brand_id=$this->fm->validation($data['brand_id']);
		$brand_id=mysqli_real_escape_string($this->db->link,$data['brand_id']);

		$body=$this->fm->validation($data['body']);
		$body=mysqli_real_escape_string($this->db->link,$data['body']);

		$price=$this->fm->validation($data['price']);
		$price=mysqli_real_escape_string($this->db->link,$data['price']);

		$type=$this->fm->validation($data['type']);
		$type=mysqli_real_escape_string($this->db->link,$data['type']);

		$permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name']; #temporary torage of uploaded pic until it is stored in database.
	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext; # substr(string_name,start_position,string_length_to_cut)
	    #md5(time()) encrypts current time
	    $uploaded_image = "upload/".$unique_image;# code..

	    if($product_name== "" || $catID== "" || $brand_id== "" || $body== "" || $price== "" || $file_name== ""|| $type== ""){
	    	$msg="<span class='error'> fields must not be empty!</span>";
			return $msg;
	    } 
	    elseif ($file_size >1048567) {
	     echo "<span class='error'>Image Size should be less then 1MB!
	     </span>";
	    } 
	    elseif (in_array($file_ext, $permited) === false) {
	     echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
	    }
	    else
	    {
	    	move_uploaded_file($file_temp, $uploaded_image);
	    	$query = "INSERT INTO db_product(product_name,catID,brand_id,body,price,image,type) VALUES ('$product_name','$catID','$brand_id','$body','$price','$uploaded_image','$type')";
	    	$inserted_row=$this->db->insert($query);
	    	if($inserted_row){
		 	$msg= "<span class='success'>Product inserted successfully!</span>";
		 	return $msg;
		 	} 
		 	else{
              	$msg= "<span class='error'>Product is not inserted successfully!</span>";
		 		return $msg;
		 }
	    }
	}

	public function getAllProduct()
	{
		$query="SELECT p.*,c.catName,b.brand_name FROM db_product AS p,db_catagory AS c,db_brand AS b WHERE p.catID=c.catID AND p.brand_id=b.brand_id ORDER BY p.product_id DESC";
		/* $query="SELECT db_product.* ,db_catagory.catName,db_brand.brand_name FROM db_product INNER JOIN db_catagory ON db_product.catID=db_catagory.catID
		INNER JOIN db_brand ON db_product.brand_id=db_brand.brand_id ORDER BY  db_product.product_id DESC"; */
		$result=$this->db->select($query);
		return $result;# code...
	}

	public function getProById($id)
{
	$query="SELECT * FROM `db_product` WHERE product_id='$id'";
	$result=$this->db->select($query);
	return $result;
}


public function proUpdate($data,$file,$id)
{
	

		$product_name=$this->fm->validation($data['product_name']);
		$product_name=mysqli_real_escape_string($this->db->link,$data['product_name']);

		$catID=$this->fm->validation($data['catID']);
		$catID=mysqli_real_escape_string($this->db->link,$data['catID']);

		$brand_id=$this->fm->validation($data['brand_id']);
		$brand_id=mysqli_real_escape_string($this->db->link,$data['brand_id']);

		$body=$this->fm->validation($data['body']);
		$body=mysqli_real_escape_string($this->db->link,$data['body']);

		$price=$this->fm->validation($data['price']);
		$price=mysqli_real_escape_string($this->db->link,$data['price']);

		$type=$this->fm->validation($data['type']);
		$type=mysqli_real_escape_string($this->db->link,$data['type']);

		$permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name']; #temporary torage of uploaded pic until it is stored in database.
	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext; # substr(string_name,start_position,string_length_to_cut)
	    #md5(time()) encrypts current time
	    $uploaded_image = "upload/".$unique_image;# code..

	    if($product_name== "" || $catID== "" || $brand_id== "" || $body== "" || $price== "" || $type== ""){
	    	$msg="<span class='error'> fields must not be empty!</span>";
			return $msg;
	    } 
	    else{
	    	if(!empty($file_name)){

	    	if ($file_size >1048567) {
	     echo "<span class='error'>Image Size should be less then 1MB!
	     </span>";
	    } 
	    elseif (in_array($file_ext, $permited) === false) {
	     echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
	    }
	    else
	    {
	    	move_uploaded_file($file_temp, $uploaded_image);
	    	
	    	$query="UPDATE db_product SET product_name='$product_name',catID='$catID',brand_id='$brand_id',body='$body',price='$price',image='$uploaded_image',type='$type' WHERE product_id='$id'";
	    	$updated_row=$this->db->update($query);
	    	if($updated_row){
		 	$msg= "<span class='success'>Product updated successfully!</span>";
		 	return $msg;
		 	} 
		 	else{
              	$msg= "<span class='error'>Product is not updated successfully!</span>";
		 		return $msg;
		 }
		}
	    }
	    else
	    {
	    	$query="UPDATE db_product SET product_name='$product_name',catID='$catID',brand_id='$brand_id',body='$body',price='$price',type='$type' WHERE product_id='$id'";
	    	$updated_row=$this->db->update($query);
	    	if($updated_row){
		 	$msg= "<span class='success'>Product updated successfully!</span>";
		 	return $msg;
		 	} 
		 	else{
              	$msg= "<span class='error'>Product is not updated successfully!</span>";
		 		return $msg;
	    }
	}# code...
}
}

public function delProById($id)
{
	$query="SELECT * FROM db_product WHERE product_id='$id'";
	$getdata=$this->db->select($query);
	if($getdata){
		while ($delImg=$getdata->fetch_assoc()) {
			$delLink=$delImg['image'];
			unlink($delLink);
		}
}
	$delQuery="DELETE FROM db_product WHERE product_id='$id'";
	$delData=$this->db->delete($delQuery);
	if ($delData) {
		$msg="<span class='success'>Product deleted successfully!</span>";
		return $msg;
	}
	else{
		$msg="<span class='error'>Product not deleted successfully!</span>";
				return $msg;
	}
}
public function getFeaturedPro()
{
	$query="SELECT * FROM `db_product` WHERE type='0' ORDER BY product_id DESC LIMIT 4";
	$result=$this->db->select($query);
	return $result;# code...
}
public function getNewPro()
{
	$query="SELECT * FROM `db_product` ORDER BY product_id LIMIT 4";
	$result=$this->db->select($query);
	return $result;# code...
}
public function getSinglePro($id)
{
	$query="SELECT p.*,c.catName,b.brand_name FROM db_product AS p,db_catagory AS c,db_brand AS b WHERE p.catID=c.catID AND p.brand_id=b.brand_id AND p.product_id='$id'";
	$result=$this->db->select($query);
	return $result;# code...
}
public function latestFromIphn()
{
	$query="SELECT * FROM `db_product` WHERE brand_id='3' ORDER BY product_id DESC LIMIT 1";
	$result=$this->db->select($query);
	return $result;# code...
}
public function latestFromSam()
{
	$query="SELECT * FROM `db_product` WHERE brand_id='1' ORDER BY product_id DESC LIMIT 1";
	$result=$this->db->select($query);
	return $result;# code...
}
public function latestFromAcer()
{
	$query="SELECT * FROM `db_product` WHERE brand_id='4' ORDER BY product_id DESC LIMIT 1";
	$result=$this->db->select($query);
	return $result;# code...
}
public function latestFromCanon()
{
	$query="SELECT * FROM `db_product` WHERE brand_id='2' ORDER BY product_id DESC LIMIT 1";
	$result=$this->db->select($query);
	return $result;# code...
}

public function proByCat($id)
{
	$id=mysqli_real_escape_string($this->db->link,$id);
	$query="SELECT * FROM db_product WHERE catID='$id'";
	$result=$this->db->select($query);
	return $result;# code...
}
}

?>