<form class="form terminform" method='post' enctype="multipart/form-data">

<?php
# <?= == <?php echo
# @ = Fehler unterdrücken

$datum = $_GET["day"];

?>
Titel
<input class="form-input" type="text" name="titel" value="<?= @$titel;?>" />

Datum
<input class="form-input" type="date" name="datum" value="<?= @$datum;?>" />

Start
<input class="form-input" type="time" name="start" value="<?= @$start;?>" />

Ende
<input class="form-input" type="time" name="ende" value="<?= @$ende;?>" />

Beschreibung
<textarea class="form-input" rows="4" name="beschreibung"><?= @$beschreibung;?></textarea>

<input class="form-input" type="submit" name="termin_speichern" />
<a class="form-input" href="?page=admin">Zurück</a>

</form>


