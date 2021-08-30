<?php
	foreach ($this->competitions as $comp) {
	   echo "<option value='".$comp->id."'>".$comp->city. " " . $comp->date ."</option>";
	}
?>