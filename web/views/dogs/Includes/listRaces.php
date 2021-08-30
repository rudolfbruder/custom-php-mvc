<?php
if (isset($this->races)) {
	foreach ($this->races as $race) {
	   echo "<option value='".$race->name."'>".$race->name ."</option>";
	}
}
?>