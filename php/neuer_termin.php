<?php

mysqli_report(MYSQLI_REPORT_OFF);

if(isset($_POST["termin_speichern"]))
{
	#Auswertung
	// echo "<pre>";
	// print_r($_POST);
	// echo "</pre>";
		
	$titel 			= $_POST["titel"];
	$datum			= $_POST["datum"];
	$start 			= $_POST["start"];
	$ende 			= $_POST["ende"];
	$beschreibung	= $_POST["beschreibung"];
	
	#Monat und Jahr aus Datum holen
	$datum_array = explode('-', $datum);
	$monat = $datum_array[1];
	$jahr = $datum_array[0];
	
	
	# Datenbank
	
	# Termin speichern
	mysqli_query($link, "insert into termine
				(titel, datum, start, ende, monat, jahr, beschreibung)
				values
				('$titel', '$datum', '$start', '$ende', '$monat', '$jahr', '$beschreibung')
				 ");	
	
	$terminID = $link->insert_id; # primärschlüssel

	echo "<br />";
	echo "<h3 class='green'>Der Termin wurde gespeichert!</h3>";
	echo "<br />";
	echo '<h3><a href="?page=admin">Zurück zum Kalender</a></h3>';						
}
else
{
	# Formular
	echo "<h3>Neuer Termin</h3><br />";
	include("termin_formular.php");
	
}
?>
