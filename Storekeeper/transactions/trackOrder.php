<?php
$db_host = 'localhost'; // Server Name
$db_user = 'root'; // Username
$db_pass = ''; // Password
$db_name = 'pms'; // Database Name

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());	
}

$sql = 'SELECT * 
		FROM track_ord WHERE delivered=0';
		
$query = mysqli_query($conn, $sql);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));
}
?>
<html>
<head>
	<title>PES MEDS</title>
	<style type="text/css">
		.button {
    		background-color: #4CAF50; /* Green */
    		border: none;
    		color: white;
    		padding: 16px 32px;
    		text-align: center;
    		text-decoration: none;
    		display: inline-block;
    		font-size: 16px;
    		margin: 4px 2px;
    		-webkit-transition-duration: 0.4s; /* Safari */
    		transition-duration: 0.4s;
    		cursor: pointer;
			}

		.button2 {
    		background-color: white; 
    		color: black; 
    		border: 2px solid #008CBA;
		}
		
.button2:hover {
    background-color: #008CBA;
    color: white;
}

		body {
			font-size: 15px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			padding: 0;
			background-image: url('/images/bkg15.jpeg') ;
			background-size:cover;
			margin: 0;
		}
		table {
			margin: auto;
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
			font-size: 12px;
		}

		h1 {
			margin: 25px auto 0;
			text-align: center;
			text-transform: uppercase;
			font-size: 37px;
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
			border: 1px solid #e1edff;
			padding: 7px 17px;
		}
		.data-table caption {
			margin: 7px;
		}

		/* Table Header */
		.data-table thead th {
			background-color: #508abb;
			color: #FFFFFF;
			border-color: #6ea1cc !important;
			text-transform: uppercase;
		}

		/* Table Body */
		.data-table tbody td {
			color: #353535;
		}
		.data-table tbody td:first-child,
		.data-table tbody td:nth-child(4),
		.data-table tbody td:last-child {
			text-align: right;
		}

		.data-table tbody tr:nth-child(odd) td {
			background-color: #f4fbff;
		}
		.data-table tbody tr:hover td {
			background-color: #ffffa2;
			border-color: #ffff0f;
		}

		/* Table Footer */
		.data-table tfoot th {
			background-color: #e5f5ff;
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
			margin:10px;
			color:green;
			font-weight: bold;
			background-color: white;
		}
		div{
			width:60%;
            margin-left: 20%;
			padding: 20px;
            border:2px solid black;
			background-color:white;
		}
		.title{
			font-size:20px;
		}
	</style>
</head>
<body>
	<a id="back" href="../index.html"> <button id="backBtn">  To Dashboard </button> </a>
	<div>
		<h1>PES MEDS</h1>
		<table class="data-table">
			<caption class="title">Current Orders</caption>
			<thead>
				<tr>
					<th>ORDER ID</th>
					<th>DISTRIBUTOR NAME</th>
					<th>EXPECTED ARRIVAL</th>
					<th>DELIVERED</th>
					<th> ... </th>
				</tr>
			</thead>
			<tbody>
			<?php
			while ($row = mysqli_fetch_array($query))
			{
				echo '<tr>
						<td>'.$row['ord_id'].'</td>
						<td>'.$row['dist_name'].'</td>
						<td>'.$row['arv_date'].'</td>
						<td> <button class="button button2" onclick="completeOrder(event)" > Order Completed </button><div id = "oid" style = "display: none">'. $row['ord_id']. '</div></td>
						<td> <button id = "orderButton" class = "button button2" onclick="displayOrder(event)"> View Order </button> <div id = "oid" style = "display: none">'. $row['ord_id']. '</div></td>
					</tr>';
			}
			?>
		</table>
		<br><br>
	</div>
	
<script>
	function displayOrder(event) {
    	var button = event.target;
		var orderId = button.parentElement.lastChild.innerHTML;
		window.location.href = "displayOrder.php?oid="+orderId;
	}
	function completeOrder(event) {
    	var button = event.target;
		var orderId = button.parentElement.lastChild.innerHTML;
		window.location.href = "completeOrder.php?oid="+orderId;
	}
</script>

</body>
</html>
