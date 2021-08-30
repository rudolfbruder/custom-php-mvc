<?php
if (isset($this->races)) {
	foreach ($this->races as $race) {
		if ($race->name == $this->dogDetails->race) {
			echo "<option selected='selected' value='".$race->name."'>".$race->name ."</option>";
		}else{
			echo "<option value='".$race->name."'>".$race->name ."</option>";
		}
	}
}
?>