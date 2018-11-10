<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$user = new User($db);
// set ID property of user to be edited
$user->username = isset($_GET['username']) ? $_GET['username'] : die();
$user->password = base64_encode(isset($_GET['password']) ? $_GET['password'] : die());
// read the details of user to be edited
$stmt = $user->login();
if($stmt->rowCount() > 0){
    ?>
	<script> 
	alert("Login Successful"); 
	window.location="https://www.google.com/";// To be changed
	</script>
	<?php
}
else{
    ?>
	<script> 
	alert("Invalid Credentials"); 
	window.location="http://localhost/app/index.html";
	</script>
	<?php
}
// make it json format
//print_r(json_encode($user_arr));
?>