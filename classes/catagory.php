<?php
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php');/**
* 
*/?>

<?php
class Catagory
{
    private $db;
    private $fm;	
	function __construct()
	{
		$this->db=new Database();
		$this->fm=new Format();
	}
	public function catInsert($catName){
		$catName=$this->fm->validation($catName);
		$catName=mysqli_real_escape_string($this->db->link,$catName);
		if (empty($catName)) {
			$msg="<span class='error'>Catagory field must not be empty!</span>";
			return $msg;
	} else{
		$query="INSERT INTO `db_catagory` (`catID`, `catName`) VALUES (NULL, '$catName')";
		 $catInsert=$this->db->insert($query);
		 if($catInsert){
		 	$msg="<span class='success'>Catagory inserted successfully!</span>";
		 	return $msg;
		 } else{
              $msg="<span class='error'>Catagory is not inserted successfully!</span>";
		 	return $msg;
		 }
			}
}
public function getAllCat(){
	$query="SELECT * FROM `db_catagory` ORDER BY catID ASC";
	$result=$this->db->select($query);
	return $result;
}
public function getCatbyId($id)
{
	$query="SELECT * FROM `db_catagory` WHERE catID='$id'";
	$result=$this->db->select($query);
	return $result;
}
public function catUpdate($catName,$id){
	$catName=$this->fm->validation($catName);
		$catName=mysqli_real_escape_string($this->db->link,$catName);
		$id=mysqli_real_escape_string($this->db->link,$id);
		if (empty($catName)) {
			$msg="<span class='error'>Catagory field must not be empty!</span>";
			return $msg;
		}
		else{
			$query="UPDATE db_catagory SET catName='$catName' WHERE catID='$id'";
			$updated_row=$this->db->update($query);
			if($updated_row){
				$msg="<span class='success'>Catagory updated successfully!</span>";
				return $msg;
			}
			else{
				$msg="<span class='error'>Catagory not updated!</span>";
				return $msg;
			}
		}

}
public function delCatById($id){
	$id=mysqli_real_escape_string($this->db->link,$id);
	$query="DELETE from db_catagory WHERE catID='$id'";
	$delData=$this->db->delete($query);
	if ($delData) {
		$msg="<span class='success'>Catagory deleted successfully!</span>";
		return $msg;
	}
	else{
		$msg="<span class='error'>Catagory not deleted successfully!</span>";
				return $msg;
	}
}
}
?>