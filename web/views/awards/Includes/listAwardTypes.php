<?php
	foreach ($this->awardsTypes as $award) {
	   echo "<option value='".$award->id."'>".$award->name. "</option>";
	}
?>