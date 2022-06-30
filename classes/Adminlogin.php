<?php
	$filepath=realpath(dirname(__FILE__));
   include_once ($filepath.'/../lib/Session.php');
   Session::checkLogin();

include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php');

?>

<?php
class Adminlogin{
    private $db;
    private $fm;
	public function __construct(){
         $this->db=new Database();
         $this->fm=new Format();
	}
	public function adminLogin($admin_User,$admin_Pass){
		$admin_User=$this->fm->validation($admin_User);
		$admin_Pass=$this->fm->validation($admin_Pass);
		$admin_User=mysqli_real_escape_string($this->db->link,$admin_User);
		$admin_Pass=mysqli_real_escape_string($this->db->link,$admin_Pass);

		if (empty($admin_User)|| empty($admin_Pass)) {
			$loginmsg="	Username or Password must not be empty!";
			return $loginmsg;
		} else{
			$query= "SELECT * FROM `db_admin` WHERE admin_User='$admin_User' AND admin_Pass='$admin_Pass'";
			$result=$this->db->select($query);
			if ($result !=false) {
				$value=$result->fetch_assoc();
				Session::set("adminLogin",true);
				Session::set("admin_Id",$value['admin_Id']);
				Session::set("admin_User",$value['admin_User']);
				Session::set("admin_Name",$value['admin_Name']);
				header("Location:dashbord.php");
			} else {
				$loginmsg="	Username or Password not match!";
			     return $loginmsg;
			}
		}
	}
}


?>