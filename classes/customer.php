<?php
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php');/**
* 
*/?>
<?php
class Customer
{

	private $db;
    private $fm;	
	function __construct()
	{
		$this->db=new Database();
		$this->fm=new Format();
	}

	public function CustomerReg($data)
	{
		$name=mysqli_real_escape_string($this->db->link,$data['Name']);
		$address=mysqli_real_escape_string($this->db->link,$data['address']);
		$city=mysqli_real_escape_string($this->db->link,$data['city']);
		$country=mysqli_real_escape_string($this->db->link,$data['country']);
		$zip=mysqli_real_escape_string($this->db->link,$data['zip']);
		$phone=mysqli_real_escape_string($this->db->link,$data['phone']);
		$email=mysqli_real_escape_string($this->db->link,$data['email']);
		$password=mysqli_real_escape_string($this->db->link,md5($data['password']));

		if($name== "" || $address== "" || $city== "" || $country== "" || $zip== "" || $phone== ""|| $email== "" || $password== ""){
	    	$msg="<span class='error'> fields must not be empty!</span>";
			return $msg;
	    } 
	    $mailQuery="SELECT * FROM db_customer WHERE email='$email' limit 1";
	    $mailcheck=$this->db->select($mailQuery);
	    if ($mailcheck!=false) {
	    	$msg="<span class='error'> E-mail already exits !</span>";
			return $msg;
	    }
	    else{
	    	$query = "INSERT INTO db_customer(name,address,city,country,zip,phone,email,password) VALUES ('$name','$address','$city','$country','$zip','$phone','$email','$password')";
	    	$inserted_row=$this->db->insert($query);
	    	if($inserted_row){
		 	$msg= "<span class='success'>Customer data inserted successfully!</span>";
		 	return $msg;
		 	} 
		 	else{
              	$msg= "<span class='error'>Customer data is not inserted successfully!</span>";
		 		return $msg;
		 }
	    }
		
	}

	public function CustomerLogin($data)
	{
		$email=mysqli_real_escape_string($this->db->link,$data['email']);
		$password=mysqli_real_escape_string($this->db->link,md5($data['password']));
		if($email== "" || $password== ""){
	    	$msg="<span class='error'> fields must not be empty!</span>";
			return $msg;
	    } 
	    $query="SELECT * FROM db_customer WHERE email='$email' AND password='$password'";
	    $result=$this->db->select($query);
	    if($result!=false){
	    	$value=$result->fetch_assoc();
	    	Session::set("CustomerLogin",true);
	    	Session::set("Customerid",$value['id']);
	    	Session::set("CustomerName",$value['name']);
	    	header("Location:cart.php");
	    }
	    else
	    {
	    		$msg= "<span class='error'>Email and password not matched!</span>";
		 		return $msg;
	    }

	}
	public function getCustomerData($id)
	{
		$query="SELECT * FROM db_customer WHERE id='$id'";
	    $result=$this->db->select($query);
	    return $result;
	}

	public function CustomerUpdate($data,$Customerid)
	{
		$name=mysqli_real_escape_string($this->db->link,$data['name']);
		$address=mysqli_real_escape_string($this->db->link,$data['address']);
		$city=mysqli_real_escape_string($this->db->link,$data['city']);
		$country=mysqli_real_escape_string($this->db->link,$data['country']);
		$zip=mysqli_real_escape_string($this->db->link,$data['zip']);
		$phone=mysqli_real_escape_string($this->db->link,$data['phone']);
		$email=mysqli_real_escape_string($this->db->link,$data['email']);
		

		if($name== "" || $address== "" || $city== "" || $country== "" || $zip== "" || $phone== ""|| $email== ""){
	    	$msg="<span class='error'> fields must not be empty!</span>";
			return $msg;
	    } 
	    
	    else{
	    	$query = "UPDATE db_customer SET name='$name',address='$address',city='$city',country='$country',zip='$zip',phone='$phone',email='$email' WHERE id='$Customerid'";
	    	$updated_row=$this->db->update($query);
	    	if($updated_row){
		 	$msg= "<span class='success'>Customer data updated successfully!</span>";
		 	return $msg;
		 	} 
		 	else{
              	$msg= "<span class='error'>Customer data is not updated successfully!</span>";
		 		return $msg;
		 }
	    }
		
		}
	
}
?>