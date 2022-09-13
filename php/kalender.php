<?php
/****** Kalender darstellen ********/

#Zeitzone festlegen

date_default_timezone_set('Europe/Berlin');

#vorheriger und nächster Monat

if (isset($_GET['ym'])) 
{
	$ym = $_GET['ym'];
	$ym_array = explode("-", $ym);
	$month = $ym_array[1];
	$year = $ym_array[0];
	// echo "</br>";
	// echo $month;
	// echo $year;
}
else 
{
	$ym = date('Y-m');	
	$month = date('m');
	$year = date('Y');
	// echo "</br>";
	// echo $month;
	// echo $year;
	 // echo "</br>";
	 // echo $ym;
}


# Format überprüfen

$timestamp = strtotime($ym, "-01");
if($timestamp === false)
{
	$ym = date('Y-m');
	$timestamp = strtotime($ym.'-01');
}

#Heute
$today = date('Y-m-d', time());
$today_num = date('Ymd', time());
// echo $today_num;


#Überschrift
$html_title = date('F Y', $timestamp);
// echo "</br>";
// echo $html_title;

#Link für vorherigen und nächsten Monat
$prev = date('Y-m', strtotime('-1 month', $timestamp));
$next = date('Y-m', strtotime('+1 month', $timestamp));


#Anzahl der Tage pro Monat

$day_count = date('t', $timestamp);


$str = date('N', $timestamp);


/*********Termine aus der Datenbank abrufen ************/
$response = mysqli_query($link, "select * from termine
					where monat = $month
					and jahr = $year					
					");

$data_array = [];

while($data = mysqli_fetch_array($response))
	{
		$data_array[] = $data;
	}


#Kalender erstellen
$weeks = [];
$week = '';

#leere Zelle(n) hinzufügen
$week .= str_repeat('<td></td>', $str -1);

for ($day = 1; $day <= $day_count; $day++, $str++)
{	
	#einstellige Nummern mit führender 0 darstellen
	$length = 2;
	$day = substr(str_repeat(0, $length).$day, - $length);
	
	#date-variable
	$date = $ym.'-'.$day;
	$date_num = $year.$month.$day;
	// echo $date_num;
	// $date = $day.'-'.$month.'-'.$year;
	
	#Anzeige im internen Bereich
	#heutiges Datum
	if($today == $date && isset($_SESSION["loggedIn"]))
	{
		$week .= '<td class="today"><a href="?page=admin&subpage=neuer_termin&day='.$date.'">'.$day.'</a></br></br>';
		#Termine einfügen
		for ($i = 0; $i <= count($data_array)-1; $i++)
		{
			if($data_array[$i]['Datum'] === $date)
			{
			$week .= "<span><a href='?page=admin&subpage=termin_ansehen&id=".$data_array[$i]['TerminID']."'>".$data_array[$i]['Titel']."</a></span></br>";
			}
		}
		$week .= '</td>';
	}
	elseif($today !== $date && isset($_SESSION["loggedIn"]))
	{
		$week .= '<td><a href="?page=admin&subpage=neuer_termin&day='.$date.'">'.$day.'</a></br></br>';
				
		#Termine einfügen
		for ($i = 0; $i <= count($data_array)-1; $i++)
		{
			if($data_array[$i]['Datum'] === $date)
			{
				#prüfen, ob Termin in Vergangenheit liegt
				if($today_num > $date_num)
				{ 
					$week .= "<span class='pastdate'><a href='?page=admin&subpage=termin_ansehen&id=".$data_array[$i]['TerminID']."'>".$data_array[$i]['Titel']."</a></span></br>";
				}
				else
				{
					$week .= "<span class='upcomingdate'><a href='?page=admin&subpage=termin_ansehen&id=".$data_array[$i]['TerminID']."'>".$data_array[$i]['Titel']."</a></span></br>";
				}
			}
			
		}
		
		$week .= '</td>';		
	}
	#Anzeige im externen Bereich
	#heutiges Datum
	elseif($today == $date && !isset($_SESSION["loggedIn"]))
	{
		$week .= '<td class="today">'.$day.'</br>';
		#Termine einfügen
		for ($i = 0; $i <= count($data_array)-1; $i++)
		{
			if($data_array[$i]['Datum'] === $date)
			{
			$week .= "<span><a href='?page=admin&subpage=termin_ansehen'>".$data_array[$i]['Titel']."</span></br>";
			}
		}		
		$week .= '</td>';
	}
	else
	{
		$week .= '<td>'.$day.'</br>';
		#Termine einfügen
		for ($i = 0; $i <= count($data_array)-1; $i++)
		{
			if($data_array[$i]['Datum'] === $date)
			{
				#prüfen, ob Termin in Vergangenheit liegt
				if($today_num > $date_num)
				{
				$week .= "<span class='pastdate'><a href='?page=admin&subpage=termin_ansehen'>".$data_array[$i]['Titel']."</span></br>";
				}
				else
				{
				$week .= "<span class='upcomingdate'><a href='?page=admin&subpage=termin_ansehen'>".$data_array[$i]['Titel']."</span></br>";
				}
			}
		}
		$week .= '</td>';
	}
	
	
	#Wochen- oder Monatsende
	if($str % 7 == 0 || $day == $day_count)
	{
		if($day == $day_count && $str % 7 != 0) {
			#leere Zelle hinzufügen
			$week .= str_repeat('<td></td>', 7 - ($str % 7));
		}
		
		$weeks[]= '<tr>'.$week.'</tr>';
		
		$week = '';
	}
	
}	



?>

<div class="container">
	<?php
	
	if(isset($_SESSION["loggedIn"]))
	{			
		echo '<h3><a href="?page=admin&ym='.$prev.'"> <<- </a>'.$html_title.'<a href="?page=admin&ym='.$next.'"> ->> </a></h3>';
	}
	else
	{
		echo '<h3><a href="?page=home&ym='.$prev.'"> <<- </a>'.$html_title.'<a href="?page=home&ym='.$next.'"> ->> </a></h3>';
	}
	
	?>
	
	<br>
	<table class="table table-bordered">
		<tr>
			<th>Mo</th>
			<th>Di</th>
			<th>Mi</th>
			<th>Do</th>
			<th>Fr</th>
			<th>Sa</th>		
			<th>So</th>
		</tr>
		<?php
			foreach($weeks as $week)
			{
				echo $week;
			}
		?>	
	
	</table>
</div>