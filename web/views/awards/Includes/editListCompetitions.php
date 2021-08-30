<?php
	foreach ($this->competitions as $comp) {
		if ($comp->id == $this->awardDetails->compId) {
			echo "<option selected='selected' value='".$comp->id."'>".$comp->city. " " . $comp->date ."</option>";
		}else{
			echo "<option value='".$comp->id."'>".$comp->city. " " . $comp->date ."</option>";
		}
	   
	}
?>