<?php
	# to calculate cost and get values from form
	
	$hostname = 'localhost';
	$username = 'root';
	$password = '';

	$dbh = new PDO("mysql:host=$hostname;dbname=pms", $username, $password);
	$query = "SELECT Bill_no FROM bills ORDER BY Bill_no DESC LIMIT 1 ";
	$stmt = $dbh->query($query);
	
	$res = $stmt->fetchColumn();

	$billNo = (int) $res;
	$billNo++;
	$date = date('Y-m-d');
	
	$cname = $_POST["cust"];
	$pay = $_POST["pay"];
	$med = $_POST["Mname"];
	$qty = $_POST["Mqty"];

	
	$cnt = sizeof($med);
	$prices = array();

	
	try {		
		
		for($i=0;$i <$cnt; $i++){
			//echo 'Connected to database';
			$query = "SELECT M_price from med_stock where M_name='$med[$i]'";
			$stmt = $dbh->query($query);
			$res = $stmt->fetchColumn();
			array_push($prices,$res);

			//remove from stock
			$query = "SELECT M_qty from med_stock where M_name='$med[$i]'";
			$stmt = $dbh->query($query);
			$res = $stmt->fetchColumn();
			$oldqty = (int) $res;

			#echo "here<br>";
			
			$qty[$i]= (int)$qty[$i];
			$newQty =  $oldqty-$qty[$i] ;
			
			$query = "UPDATE med_stock SET M_qty='$newQty' where M_name='$med[$i]'";
			$stmt = $dbh->query($query);

			if($newQty == 0){
				//add to out of stock
				echo "here<br>";
				$query = "UPDATE med_stock SET M_instock='$newQty' WHERE M_qty='$newQty'";
				$stmt = $dbh->query($query);
			}

			
			
			#echo "here 2<br>";
			
			//adding to billed_meds
			$query = "INSERT INTO billed_med(bill_no, b_med, b_qty) VALUES ('$billNo','$med[$i]','$qty[$i]')";
			$stmt = $dbh->query($query);
			

			
		}
		
		$tot = array();
		$amt = 0;
		for($i =0;$i<$cnt;$i++){
			
			$cost = $prices[$i]*$qty[$i];
			array_push($tot,$cost);
			$amt +=$cost;
		}

		#print_r($tot);
		//add to bills
		$query = "INSERT INTO bills(Bill_no, B_date, Cust_name, Pay_method, B_amt) VALUES ('$billNo','$date','$cname','$pay','$amt')";
		$stmt = $dbh->query($query);
		
		#exit();
			
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}

?>


<html>
<head>
    <title>Invoice</title>
    
    <style>
        body{
            font-family:  'Montserrat', 'Lucida Sans', Arial, sans-serif;
        }
        #header{
            margin-left: 43%;
            font-size: 45px;
            font-family:  'Montserrat', 'Lucida Sans', Arial, sans-serif;
        }
        
        table {
			margin: auto;
			font-family:  'Montserrat', 'Lucida Sans', Arial, sans-serif;
            font-size: 12px;
            
		}

		h1 {
			margin: 25px auto 0;
			text-align: center;
			text-transform: uppercase;
			font-size: 17px;
		}

		table td {
			transition: all .5s;
		}
		
		/* Table */
		.data-table {
			border-collapse: collapse;
			font-size: 14px;
			min-width: 537px;
		}

		.data-table th, 
		.data-table td {
			border: 1px solid #e1edff00;
			padding: 7px 17px;
		}
		.data-table caption {
			margin: 7px;
		}

		/* Table Header */
		.data-table thead th {
			background-color: #23e273;
			color: #FFFFFF;
			border-color: #e9ebec00 !important;
			text-transform: uppercase;
		}

		/* Table Body */
		.data-table tbody td {
			text-align:center;
			color: rgb(24, 7, 7);
		}
		.data-table tbody td:first-child,
		.data-table tbody td:nth-child(4),
		.data-table tbody td:last-child {
			text-align: center;
		}

		.data-table tbody tr:nth-child(odd) td {
			background-color: #f4fbff;
		}
		.data-table tbody tr:hover td {
			background-color: #8a99a777;
			border-color: #ffff0f00;
		}

		/* Table Footer */
		.data-table tfoot th {
			background-color: #48c779;
			text-align: right;
		}
		.data-table tfoot th:first-child {
			text-align: left;
		}
		.data-table tbody td:empty
		{
			background-color: #ffcccc;
		}

		#backBtn{
			width: 200px;
			height:45px;
			font-size: 25px;
			color:green;
			font-weight: bold;
			background-color: whitesmoke;
		}
		#backImg{
			width:50px;
			height:50px;
        }
        
        h2{
            font-family:  'Montserrat', 'Lucida Sans', Arial, sans-serif;
            margin-top:-2px;
            margin-left: 60%;
        }
        h4{
            font-family:  'Montserrat', 'Lucida Sans', Arial, sans-serif;
            margin-left: 60%;
            margin-top:-20px;
        }
        h3{
            font-family:  'Montserrat', 'Lucida Sans', Arial, sans-serif;
            margin-left: 15%;
        }
        .title{
            font-size: 30px;
        }
        div{
            width:50%;
            margin-left: 25%;
            padding-top: 10px;
            border:1px solid black;
            box-shadow:0 10px 20px 0 lightslategray;
        }
        #print{
            float: right;
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
    <button id ="print">Print</button>
    <div>
        <h1 id="header">Invoice</h1>
        <h2>Bill No: <?php echo $billNo; ?></h2>
        <h4>Date: <?php echo $date; ?></h4>
        <h3>Customer: <?php echo $cname; ?> </h3>    
        <table id="tab" class="data-table"  border="1" align="center">
            <caption class="title">PES MEDS PHARMACY</caption>
            <thead>
                <tr>
                    <th id="pro">Product</th>
                    <th id="prc">Price</th>
                    <th id="qty" >Quantity</th>
                    <th id="line" >Line Total</th>
                </tr>
            </thead>	
            <tbody>
                <?php
                    $no = 0;
                    while ($no < $cnt)
                    {
                        echo '<tr>
                                <td>'.$med[$no].'</td>
                                <td>'.$prices[$no].'</td>
                                <td>'.$qty[$no].'</td>
                                <td>'. $tot[$no]. '</td>
                            </tr>';
                        $no++;
                    }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" id="tot">Total cost</th>
                    <th id="totval"> <?php echo $amt; ?> </th>
                </tr>
            </tfoot>
        </table>
        <br>
        <br><br>
    </div> 
</body>
</html>


