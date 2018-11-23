<?php
	# to calculate cost and get values from form
	
	
	$hostname = 'localhost';
	$username = 'root';
	$password = '';

	$dbh = new PDO("mysql:host=$hostname;dbname=pms", $username, $password);
	$query = "SELECT COUNT(*) FROM med_stock where M_instock = 0";
	$stmt = $dbh->query($query);
	
    $res =(int) $stmt->fetchColumn();
	
	if($res !=0)
	{
		echo "<script>  parent.obj.stockAlerts('$res'); </script>";
	}
    
?>