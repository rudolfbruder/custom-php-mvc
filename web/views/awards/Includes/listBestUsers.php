<?php
	foreach ($this->bestUsers as $bestUser) {
       echo " <tr class='clickable-row'>
       	  <th scope='row'>".$bestUser->row."</th>
       	  <td>" .$bestUser->firstName."</td>
       	  <td>" .$bestUser->lastName."</td>
       	  <td>" .$bestUser->point."</td>
   	    </tr>"; 
	}
?>