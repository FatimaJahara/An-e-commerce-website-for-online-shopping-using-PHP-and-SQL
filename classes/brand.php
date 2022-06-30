<?php
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php');/**
* 
*/?>

<?php
class Brand
{
	
	private $db;
    private $fm;	
	function __construct()
	{
		$this->db=new Database();
		$this->fm=new Format();
	}
	public function brandInsert($brand_name){
		$brand_name=$this->fm->validation($brand_name);
		$brand_name=mysqli_real_escape_string($this->db->link,$brand_name);
		if (empty($brand_name)) {
			$msg="<span class='error'>Brand field must not be empty!</span>";
			return $msg;
	} else{
		$query="INSERT INTO `db_brand` (`brand_id`, `brand_name`) VALUES (NULL, '$brand_name')";
		 $brandInsert=$this->db->insert($query);
		 if($brandInsert){
		 	$msg="<span class='success'>Brand name inserted successfully!</span>";
		 	return $msg;
		 } else{
              $msg="<span class='error'>Brand name is not inserted successfully!</span>";
		 	return $msg;
		 }
			}
}
	public function getAllBrand()
	{
		$query="SELECT * FROM `db_brand` ORDER BY brand_id ASC";
	$result=$this->db->select($query);
	return $result;
}
	public function getBrandbyId($id)
	{
		$query="SELECT * FROM `db_brand` WHERE brand_id='$id'";
		$result=$this->db->select($query);
		return $result;
	}
	public function brandUpdate($brand_name,$id){
		$brand_name=$this->fm->validation($brand_name);
			$brand_name=mysqli_real_escape_string($this->db->link,$brand_name);
			$id=mysqli_real_escape_string($this->db->link,$id);
			if (empty($brand_name)) {
				$msg="<span class='error'>Brand field must not be empty!</span>";
				return $msg;
			}
			else{
				$query="UPDATE db_brand SET brand_name='$brand_name' WHERE brand_id='$id'";
				$updated_row=$this->db->update($query);
				if($updated_row){
					$msg="<span class='success'>Brand name updated successfully!</span>";
					return $msg;
				}
				else{
					$msg="<span class='error'>Brand name is not updated!</span>";
					return $msg;
				}
			}

	}
	public function delBrandById($id){
	$id=mysqli_real_escape_string($this->db->link,$id);
	$query="DELETE from db_brand WHERE brand_id='$id'";
	$delData=$this->db->delete($query);
	if ($delData) {
		$msg="<span class='success'>Brand name is deleted successfully!</span>";
		return $msg;
	}
	else{
		$msg="<span class='error'>Brand name is not deleted successfully!</span>";
				return $msg;
	}
}

}

?>