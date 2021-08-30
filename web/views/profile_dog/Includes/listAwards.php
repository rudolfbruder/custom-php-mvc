<?php
if (isset($this->awards)) {
	foreach ($this->awards as $award) {
		?>
	    <tr class='clickable-row'>
    	  <th scope='row'><?=$award->row?></th>
	      <td><?=$award->id?></td>
	      <td><?=$award->city?></td>
	      <td><?=$award->name?></td>
	      <td><?=$award->points?></td>
	      <td><?=$award->dogName?></td>
	      <td><?=$award->date?></td>
	    </tr>
		<?php
	}
}
?>