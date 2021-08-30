<?php
if (isset($this->myDogs)) {
		foreach ($this->myDogs as $myDog) {
	       echo " <tr class='clickable-row'>
	       	  <th scope='row'>".$myDog->row."</th>
	       	  <td>" .$myDog->dogId."</td>
	       	  <td>" .$myDog->name."</td>
	       	  <td>" .$myDog->nickName."</td>
	   	      <td>" .$myDog->race. "</td>								      
	   	    </tr>"; 
		}
}
?>