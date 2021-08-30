<?php
	foreach ($this->awardsTypes as $award) {
		if ($award->id == $this->awardDetails->awardTypeId) {
			echo "<option selected='selected' value='".$award->id."'>".$award->name. "</option>";
		}else{
			echo "<option value='".$award->id."'>".$award->name. "</option>";
		}
	}
?>