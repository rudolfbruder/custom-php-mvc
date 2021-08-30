<?php
	foreach ($this->dogs as $dog) {
	   echo "<option value='".$dog->id."'>".$dog->name."</option>";
	}
?>