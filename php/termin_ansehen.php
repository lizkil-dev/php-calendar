<?php

# mysqli_report(MYSQLI_REPORT_OFF);

echo "<h3>Terminansicht</h3><br />";

include("alte_termin_daten_laden.php");


?>

<div class="singlecontainer">
<table class="table table-bordered">
		<tr>
			<th>Titel</th>
			<th>Datum</th>
			<th>Start</th>
			<th>Ende</th>
			<th>Beschreibung</th>		
		</tr>
		<tr>
		<?php
			for ($i = 1; $i <= 5; $i++)
			{
				echo "<td>".$data[$i]."</td>";
			}
			
		echo "</tr>";
		echo "</table>";
		echo "</br>";
		echo "<div class='nav2'>";
		echo "<a href='?page=admin&subpage=termin_bearbeiten&id=".$data['TerminID']."'>Termin bearbeiten</a>";
		echo "<a href='?page=admin&subpage=termin_loeschen&id=".$data['TerminID']."'>Termin loeschen</a>";
		echo "</div>";
?>
</br>
</br>
<a href="?page=admin">Zurück zum Kalender</a>



