<h3>Termin suchen</h3>
<?php

include('termin_suchen_formular.php');


$bedingungen = "";

if(isset($_SESSION["suche"]) && $_SESSION["suche"] != "")
{
	$bedingungen = "
	where
	(	
	Titel LIKE '%".$_SESSION["suche"]."%'
	OR
	Beschreibung LIKE '%".$_SESSION["suche"]."%'
	)	
	";


$sql_befehl = "
select * from termine
$bedingungen
order by Datum";


$antwort = mysqli_query($link, $sql_befehl);

// print_r($datasuche);
// print_r($datasuche[1]);
// print_r($_SESSION["suche"]);
// print_r($link);

if($link->affected_rows === 0)
 {
	echo "<h3 class='green'>Kein Eintrag zu Deiner Suche gefunden</h3>";
 }



echo "<div class='singlecontainer'>";
while($datasuche = mysqli_fetch_array($antwort))
{
	echo '<table class="table table-bordered">';
	echo '<tr>';
		echo '<th>Titel</th>';
		echo '<th>Datum</th>';
		echo '<th>Start</th>';
		echo '<th>Ende</th>';
		echo '<th>Beschreibung</th>';
		echo '</tr>';
		echo '<tr>';
		for ($i = 1; $i <= 5; $i++)
			{
				echo "<td>".$datasuche[$i]."</td>";
			}
		echo "</tr>";
		echo "</table>";
		echo "</br>";
		echo "<div class='nav2'>";
		echo "<a href='?page=admin&subpage=termin_bearbeiten&id=".$datasuche['TerminID']."'>Termin bearbeiten</a>";
		echo "<a href='?page=admin&subpage=termin_loeschen&id=".$datasuche['TerminID']."'>Termin loeschen</a>";
		echo "</div>";
		echo "</br>";
		echo "</br>";
}

}



?>
<div class="suche-zurueck" >
<a href="?page=admin">Zurück</a>
</div>



