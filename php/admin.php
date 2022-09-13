<?php

#Unterseiten zur Bearbeitung der Termine steuern

if(isset($_GET["subpage"]))
{
	switch($_GET["subpage"])
	{
		case "neuer_termin": 		include("neuer_termin.php"); 		break;
		case "termin_ansehen": 		include("termin_ansehen.php"); 	break;
		case "termin_bearbeiten": 	include("termin_bearbeiten.php"); 	break;
		case "termin_loeschen": 	include("termin_loeschen.php"); 	break;
	}
}
else
{
	include("kalender.php");
}


