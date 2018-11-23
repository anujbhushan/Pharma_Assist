<?php    
    if(isset($_POST['SubmitButton'])){ //check if form was submitted
        
        $flag=1;

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

    }
    else{
        $flag=0;
    }    
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    body {
        font-family: Arial;
        background-image: url('/images/bkg8.jpg');
    }

    * {
        box-sizing: border-box;
    }

    form.example input[type=text] {
        padding: 10px;
        font-size: 17px;
        border: 1px solid grey;
        float: left;
        width: 80%;
        background: #f1f1f1;
    }

    form.example button {
        float: left;
        width: 20%;
        padding: 10px;
        background: #2196F3;
        color: white;
        font-size: 17px;
        border: 1px solid grey;
        border-left: none;
        cursor: pointer;
    }

    form.example button:hover {
        background: #0b7dda;
    }

    form.example::after {
        content: "";
        clear: both;
        display: table;
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
            .title{
			font-size: 40px;
		}
</style>
</head>
<body>
    <a id="back" href="../index.html"> <button id="backBtn">  To Dashboard </button> </a>
    <h2 style = "text-align:center"> PLEASE ENTER THE MEDICINE NAME </h2>
    
    <form class="example"style="margin:auto;max-width:1000px" action="" method = "post">
        <input type="text"  placeholder="Search.." name="search">
        <button type="submit" name="SubmitButton"><i class="fa fa-search"></i></button>
    </form>
    <br><br>
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
            if($flag==1)
            {
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
                }
                else
                {
                    echo " <h2> NOT FOUND </h2>";
                }
            }
            	
	    ?>
		</tbody>
	</table>
</body>
</html> 

