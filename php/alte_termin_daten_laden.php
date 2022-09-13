<?php


$terminID = $_GET['id'];
// echo $terminID;

# Datenbank auslesen
$response = mysqli_query($link, "select * from termine
					where terminID = $terminID				
					");

// $data_array = [];

$data = mysqli_fetch_array($response);
// print_r($data);	
	


	
?>