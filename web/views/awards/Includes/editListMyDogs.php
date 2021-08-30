<?php
	foreach ($this->dogs as $dog) {
		if ($dog->id == $this->awardDetails->dogId) {
			echo "<option selected='selected' value='".$dog->id."'>".$dog->name."</option>";
		}else{
			echo "<option value='".$dog->id."'>".$dog->name."</option>";
		}
	   
	}
?>