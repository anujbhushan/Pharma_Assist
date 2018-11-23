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
		FROM med_stock where M_instock = 0';
		
$query = mysqli_query($conn, $sql);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));
}
?>
<html>
<head>
	<title>Out of STOCK</title>
	<style type="text/css">
		body {
			font-size: 15px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			padding: 0;
			margin: 0;
			background-image: url('/images/bkg14.jpeg')
		}
		#backBtn{
			width: 200px;
			height:45px;
			font-size: 25px;
			margin:10px;
			color:green;
			font-weight: bold;
			background-color: whitesmoke;
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
			font-size:37px;
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
			color: red;
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
		]
		
		.title{
			font-size: 40px;
		}
		div{
			width:50%;
            margin-left: 25%;
            padding-top: 10px;
            border:1px solid black;
			box-shadow:0 10px 20px 0 lightslategray;
			background-color:white;
		}
	</style>
</head>
<body>
	<a id="back" href="../index.html"> <button id="backBtn">  To Dashboard </button> </a>
	<div>
		<h1>PES MEDS</h1>
		<table class="data-table">
			<caption class="title">OUT OF STOCK MEDICINES</caption>
			<thead>
				<tr>
					<th>MEDICINE NAME</th>
					<th>PRICE</th>
				</tr>
			</thead>
			<tbody>
			<?php
			while ($row = mysqli_fetch_array($query))
			{
				echo '<tr>
						<td>'.$row['M_name'].'</td>
						<td>'.$row['M_price'].'</td>
					</tr>';
			}?>
			</tbody>
		</table>
	<br><br>	
	</div>	
</body>
</html>
