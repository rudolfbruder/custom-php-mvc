<?php
	foreach ($this->bestDogs as $bestDog) {
       echo " <tr class='clickable-row'>
       	  <th scope='row'>".$bestDog->row."</th>
       	  <td>" .$bestDog->name."</td>
       	  <td>" .$bestDog->race."</td>
       	  <td>" .$bestDog->gender."</td>
   	      <td>".$bestDog->firstName." " .$bestDog->lastName. "</td>								      
   	      <td>" .$bestDog->point."</td>
   	    </tr>"; 
	}
?>