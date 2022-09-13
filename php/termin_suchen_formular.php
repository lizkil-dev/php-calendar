<?php

if($_GET["page"] === "suchen")
{
	$_SESSION["suche"] = "";
}
if(isset($_POST["suchbutton"]))
{
	$_SESSION["suche"] = $_POST["suche"];
}
?>
<div class="form suchform">
<form method='post'>
Suche: <input type='text' name='suche' value='<?= @$_SESSION["suche"]; ?>' />
<input class="searchbtn" type='submit' name='suchbutton' value='Suchen' />

</form>
</div>