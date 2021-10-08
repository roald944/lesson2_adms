<?php

$hostname = "localhost";
$u_host = "root";
$p_host = "";

$db = "products_db";

$conn = new mysqli($hostname,$u_host,$p_host);

if(!$conn){
    die('No Connection - ').mysqli_connect_error();
}else{
    $connDB = mysqli_select_db($conn,$db);
}


?>