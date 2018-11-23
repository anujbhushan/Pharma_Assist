<?php 
//load database connection
    $host = "localhost";
    $user = "root";
    $password = "";
    $database_name = "pms";
    $pdo = new PDO("mysql:host=$host;dbname=$database_name", $user, $password, array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));
// Search from MySQL database table
$search=$_POST['search'];
$query = $pdo->prepare("select * from med_stock where M_name LIKE '%$search%'");
$query->bindValue(1, "%$search%", PDO::PARAM_STR);
$query->execute();
?>

<html>
<head>
	<title>PES MEDS</title>
	<style type="text/css">
		body {
			font-size: 15px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			padding: 0;
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
			color:green;
			font-weight: bold;
			margin:15px;	
			background-color: smokewhite;
		}
	</style>
</head>
<body>
	<a id="back" href="../index.html"> <button id="backBtn">  To Dashboard </button> </a>
	<h1>PES MEDS</h1>
	<table class="data-table">
		<caption class="title">SEARCH RESULTS</caption>
		<thead>
			<tr>
				<th>MEDICINE NAME</th>
				<th>PRICE</th>
				<th>QUANTITY</th>
				<th>MANUFACTURE DATE</th>
				<th>EXPIRY DATE</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if (!$query->rowCount() == 0) {
		while ($results = $query->fetch()) 
		{
			echo '<tr>
					<td>'.$results['M_name'].'</td>
					<td>'.$results['M_price'].'</td>
					<td>'.$results['M_qty'].'</td>
					<td>'.$results['M_mfgdate'] . '</td>
					<td>'.$results['M_expdate'].'</td>
				</tr>';
			
		}
	}else {

		echo " <h2> NOT FOUND </h2>";
	}		
	?>
		</tbody>
	</table>
</body>
</html>
