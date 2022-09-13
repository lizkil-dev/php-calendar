<form class="form terminform" method='post' action enctype="multipart/form-data">

<?php
# <?php echo 	==	      <?= 
# @ = Fehler unterdrücken

include("alte_termin_daten_laden.php");

?>
Titel
<input class="form-input" type="text" name="titel" value="<?= $data['Titel'];?>" />

Datum
<input class="form-input" type="date" name="datum" value="<?= $data['Datum'];?>" />

Start
<input class="form-input" type="time" name="start" value="<?= $data['Start'];?>" />

Ende
<input class="form-input" type="time" name="ende" value="<?= $data['Ende']?>" />

Beschreibung
<textarea class="form-input" rows="4" name="beschreibung"><?= $data['Beschreibung'];?></textarea>

<input class="form-input" type="submit" name="termin_speichern" />
<a class="form-input" href="?page=admin">Zurück zum Kalender</a>
</form>


