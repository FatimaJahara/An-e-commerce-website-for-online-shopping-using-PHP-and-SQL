<?php include '../classes/Adminlogin.php';?>
<?php
    $al=new Adminlogin();
    if($_SERVER['REQUEST_METHOD']== 'POST'){
    	$admin_User=$_POST['admin_User'];
    	$admin_Pass=md5($_POST['admin_Pass']);

    	$loginCHK=$al->adminLogin($admin_User,$admin_Pass);
    }
?>


<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<span style="color:red;font-size:18px;">
				<?php
				    if(isset($loginCHK)){
				    	echo $loginCHK;
				    }
				 ?>
		    </span>
			<div>
				<input type="text" placeholder="Username" name="admin_User"/>
			</div>
			<div>
				<input type="password" placeholder="Password" name="admin_Pass"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		
</body>
</html>