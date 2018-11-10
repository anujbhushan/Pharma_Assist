<?php
 
// get database connection
include_once '../config/database.php';
 
// instantiate user object
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);
 
// set user property values
$user->username = $_POST['username'];
$user->password = base64_encode($_POST['password']);
$user->created = date('Y-m-d H:i:s');
 
// create the user
if($user->signup()){
    ?>
	<script> 
	alert("SignUp Successful"); 
	window.location="https://www.google.com/";// To be changed
	</script>
	<?php
}
else{
    ?>
	<script> 
	alert("User name exsists"); 
	window.location="http://localhost/app/index.html";
	</script>
	<?php
}
print_r(json_encode($user_arr));
?>