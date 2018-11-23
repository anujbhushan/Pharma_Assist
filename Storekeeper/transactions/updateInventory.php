<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="storekeeper.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
	.center {
    margin: auto;
	margin-top : 40px;
    width: 50%;
    border: 3px solid blue;
    padding: 10px;
	text-align: center;
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

    <?php
      $db_host = 'localhost'; // Server Name
      $db_user = 'root'; // Username
      $db_pass = ''; // Password
      $db_name = 'pms'; // Database Name

      $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
      if (!$conn) {
        die ('Failed to connect to MySQL: ' . mysqli_connect_error());	
      }

      $sql1 = "SELECT MAX(M_ID) FROM med_stock";
      $query1 = mysqli_query($conn,$sql1);
      $row = mysqli_fetch_array($query1);
      $mid = $row['MAX(M_ID)'] + 1;
      $sql="INSERT INTO med_stock (M_Id, M_name, M_price,M_qty,M_mfgdate,M_expdate,M_instock) VALUES
          ($mid,'$_POST[med_name]','$_POST[med_price]','$_POST[med_qty]','$_POST[med_mfg]','$_POST[med_exp]',1)";

          
      $query = mysqli_query($conn, $sql);

      if (!$query) {
        die ('SQL Error: ' . mysqli_error($conn));
      }
    ?>
    <div class = center>
      <h2> Inverntory Updated ! </h2><br><br>
      <img src = "/images/tick.png"/><br><br><br><br>
      <a href = "../index.html"> <button class="btn btn-lg buttonFade">Back to Dashboard</button></a><br><br>
      <a href = "updateInventoryForm.html"> <button class="btn btn-lg buttonFade">Add Another Medicine</button></a><br><br>
    </div>
</body>
</html>


