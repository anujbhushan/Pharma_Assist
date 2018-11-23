<?php
	# to calculate cost and get values from form
	
	
	

    $host = "localhost";
    $user = "root";
    $password = "";
    $database_name = "pms";
    $pdo = new PDO("mysql:host=$host;dbname=$database_name", $user, $password, array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));
    // Search from MySQL database table
    $query = $pdo->prepare("SELECT COUNT(*) FROM track_ord where delivered = 1");
    $query->execute();
    $res =  $query->fetchColumn();
    $cnt = $res;
    
    $ords = array();
    $query = $pdo->prepare("SELECT dist_name FROM track_ord where delivered = 1");
    $query->execute();
    for($i=0;$i<$cnt;$i++){
        $res = $query->fetchColumn();
        array_push($ords,$res);
    }
    
    print_r($ords);
    $ords = json_encode($ords);
        
    echo "<script>  parent.obj.recAlerts('$ords'); </script>";
    
    
    
?>