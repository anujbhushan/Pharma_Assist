<?php
	# to calculate cost and get values from form
	
	$hostname = 'localhost';
	$username = 'root';
	$password = '';

	$dbh = new PDO("mysql:host=$hostname;dbname=pms", $username, $password);
	$query = "SELECT ord_no FROM orders ORDER BY ord_no DESC LIMIT 1 ";
	$stmt = $dbh->query($query);
	
	$res = $stmt->fetchColumn();

	$ordNo = (int) $res;
	$ordNo++;
	$date = date('Y-m-d');
	
	$dist = $_POST["dist"];
    $med = $_POST["mname"];
    $price = $_POST["price"];
	$qty = $_POST["qty"];

	
	$cnt = sizeof($med);
	$amt = 0;
	
	try {		
		
		for($i=0;$i <$cnt; $i++){
			
            $tot = $price[$i] * $qty[$i];
            $amt += $tot;
			$query = "INSERT INTO order_meds(ord_no, o_med, o_qty, o_quote, o_total) VALUES ('$ordNo','$med[$i]','$qty[$i]','$price[$i]','$tot' )";
			$stmt = $dbh->query($query);
			
		}
		

		//add to bills
		$query = "INSERT INTO orders(ord_no, ord_date, dist_name, quote_amt) VALUES ('$ordNo','$date','$dist','$amt')";
		$stmt = $dbh->query($query);
			
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}

?>
