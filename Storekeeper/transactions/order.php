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


<html>
<head>
    <title>Orders</title>
    
    <style>
        #header{
            margin-left: 20%;
            font-size: 50px;
            font-family:  'Montserrat', 'Lucida Sans', Arial, sans-serif;
        }
        img{
            margin-left:35%;
            width: 200px;
            height: 200px;
        }
        div{
            width: 35%;
            margin-left:30%;
            background-color:white ;
            box-shadow:0 10px 20px 0 lightslategray;
        }
        body{
            background-color:rgba(186, 232, 238, 0.342);
        }
       #btn{
            width: 200px;
            height:40px;
            border-radius:2px;
            margin-left: 30%;
            font-weight: bold;
            color: rgba(41, 100, 46, 0.705);
            
        }
        #backBtn{
			width: 200px;
			height:45px;
			font-size: 25px;
			color:green;
			font-weight: bold;
			background-color: whitesmoke;
		}
    </style>

</head>
<body>
    <a id="back" href="../index.html"> <button id="backBtn">  To Dashboard </button> </a>
    <div>
        <br>
        <h1 id="header">Order Placed!</h1><br>
        <img src = "/images/tick2.png"/><br><br><br>
        <a href="order.html" ><button id="btn">Place New Order</button></a><br>
        <br><br>
    </div>    
</body>
</html>