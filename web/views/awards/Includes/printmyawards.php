<?php
if (isset($this->myawards)) {
	foreach ($this->myawards as $element) {
	       echo " <tr class='clickable-row'>
	       	  <th scope='row'>".$element->row."</th>
	   	      <td>".$element->id."</td>
	   	      <td>" .$element->city."</td>
	   	      <td>" .$element->name."</td>
	   	      <td>" .$element->points."</td>
	   	      <td>" .$element->dogName."</td>
	   	      <td>" .$element->date."</td>
	   	    </tr>"; 
	}
}
?>