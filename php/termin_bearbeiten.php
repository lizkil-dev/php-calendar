 <?php

# mysqli_report(MYSQLI_REPORT_OFF);

echo "<h3>Termin bearbeiten</h3><br />";

include("alte_termin_daten_laden.php");

$terminID = $_GET['id'];

if(isset($_POST["termin_speichern"]))
	{
	#Neue Daten	
	$titel 			= $_POST["titel"];
	$datum			= $_POST["datum"];
	$start 			= $_POST["start"];
	$ende 			= $_POST["ende"];
	$beschreibung	= $_POST["beschreibung"];
	
	# Datenbank
	
	# Termin speichern
	mysqli_query($link, "update termine set
					titel = '$titel', 
					datum = '$datum',
					start = '$start',
					ende = '$ende', 
					beschreibung = '$beschreibung'
					where terminID = $terminID ");
					
	// echo "<br />";
	// echo "<h3 class='green'>Der Termin wurde geändert!</h3>";
	// echo "<br />";
	// echo '<h3><a href="?page=admin&subpage=termin_ansehen&id='.$terminID.'">Zurück zur Terminansicht</a></h3>';		
	header("Location: ?page=admin&subpage=termin_ansehen&id=".$terminID);
	}
	else 
	{
		include("termin_bearbeiten_formular.php");
	}

	
	
	
 
?>
