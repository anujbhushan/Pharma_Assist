<?php

/*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = '';

extract($_GET);
//echo $m_name.'<br>';

try {

   $dbh = new PDO("mysql:host=$hostname;dbname=pms", $username, $password);
    
    //echo 'Connected to database';
    $query = "SELECT Price from medicines where M_name='$m_name'";
    //echo '<br>'.$query;
    $stmt = $dbh->query($query);
    $res = $stmt->fetchColumn();
    //$value = $res['Price'];
    //echo "<script> console.log(".$value.");";
    //return $res;
    echo $res;
    //echo $value;
    
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
?>