 <?php

# mysqli_report(MYSQLI_REPORT_OFF);

if(isset($_POST["termin_loeschen_ja"]))
{
	include("alte_termin_daten_laden.php");
	
	mysqli_query($link, "delete from termine
					where	
					terminID = $terminID");
					
	echo "<h3 class='green'>Der Termin wurde gelöscht!</h3>";
	echo "<br />";
	echo '<h3><a href="?page=admin">Zurück zum Kalender</a></h3>';	
	exit;
} 
else if(isset($_POST["termin_loeschen_nein"]))
{
	include("alte_termin_daten_laden.php");
	
	header("Location: ?page=admin&subpage=termin_ansehen&id=".$terminID);
}
else
{
	include("alte_termin_daten_laden.php");
	include("loeschbestaetigung.php");
}
?>
