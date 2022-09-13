<?php

session_start();

 
# **************Verbindung zur Datenbank **************************

$link = mysqli_connect("localhost",	"root", 	"", 		"terminkalender");
mysqli_query($link, "SET names utf8"); # Verbindung auf utf-8 umstellen

# *****************************************************************


if(isset($_GET["page"]) && $_GET["page"] == "logout")
{
	session_destroy();
	unset($_SESSION);
	setcookie("loggedInCookie", "", time() -1); 
	unset($_COOKIE["loggedInCookie"]);
}


if(isset($_POST["user"]) && isset($_POST["password"]))
{
	$sql = " select * from user ";
	$sql .= " where name='".$_POST["user"]."' ";
	
	// echo "<h1>$sql</h1>";
	
	$response = mysqli_query($link, $sql);
	// print_r($response);
	// echo "</br>";
	
	if($response->num_rows == 1)	
	{
		$data = mysqli_fetch_array($response);	
		// print_r($data);
		
		#Fingerabdruck vergleichen
		if( password_verify($_POST["password"], $data["password"]) )

		{
			// echo "</br>";
			// echo "klappt";
			$_SESSION["loggedIn"]= true;
			$_SESSION["userID"] = $data["userID"];
			$_SESSION["user"] = $data["name"];
			// $_SESSION["note"] = "<div style='color:green'>Erfolgreich eingeloggt</div>";
			if(isset($_POST["stay_loggedin"]))
			{
				setcookie("loggedInCookie", "User", time() + 60*60*24*365);
			}
			header("Location: ?page=admin");
			exit;
		}
		else
		{
			// echo "klappt nicht";
			$_SESSION["note"]= "<div style='color:red'>Passwort nicht korrekt</div>";
		}
	}
	else
	{
		$_SESSION["note"] = "<div style='color:red'>Benutzer existiert nicht</div>";
		
	}
}

if(isset($_COOKIE["loggedInCookie"]))
{
	
	$_SESSION["loggedIn"] = true;
	$_SESSION["user"] = "Lisa Lustig";	
}
?>
<html>
<head>
	<title>Mein Terminkalender</title>
	<meta charset="utf-8" />	
	<link rel="stylesheet" href="css/style.css" />	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
	
</head>

<body>
<header>
		
	<?php
	if(isset($_SESSION["loggedIn"]))
	{		
		echo '<nav><span>'.$_SESSION["user"].'s Terminkalender</span><a href="?page=logout">Logout</a></nav>';	
		if($_GET["page"] === "admin")
		{echo '<nav><a class="suchen" href="?page=suchen">Termin suchen</a></nav>';}
		
	}
	else
	{
		
		echo '<nav class="nav"><a href="?page=home">Home</a><a href="?page=login">Login</a></nav>';
	}	
	?>
	
	
</header>

<main>
<?php
if(isset($_SESSION["note"]))
{
	echo $_SESSION["note"]; # Anzeigen
	unset($_SESSION["note"]); # Entfernen / Löschen
}

# wenn die Seite nicht(!) gesetzt ist
if(!isset($_GET["page"]))
{
	$_GET["page"] = "home"; # Startseite einstellen
}

#print_r($_GET);

# Seitenauswahl
switch($_GET["page"])
{
	case "home":
		include("php/home.php"); 
	break;
	case "admin":
		if(isset($_SESSION["loggedIn"]))
		{
			include("php/admin.php"); 
		}
		else
		{
			header("Location: ?page=login"); 
			exit; 
		}	
	break;	
	case "termin":
		include("php/termin.php");	
	break;	
	case "login":
		include("php/login.php"); 
	break;
	case "logout":
		include("php/logout.php"); 
	break;		
	case "suchen":
		include("php/suchen.php");
	break;
	default:
		include("html/404.html");
}

?>
</main>

<footer>

</footer>

</body>
</html>
<?php
# Datenbankverbindung trennen
#########################################################################
mysqli_close($link);
#########################################################################
# password_hash("Lustig", PASSWORD_DEFAULT);
?>