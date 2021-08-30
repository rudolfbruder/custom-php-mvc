<?php
if (isset($this->awards)) {
	foreach ($this->awards as $award) {
		?>
	    <tr class='clickable-row'>
	      <td><?=$award->city?></td>
	      <td><?=$award->name?></td>
	      <td><?=$award->dogName?></td>
	      <td><?=$award->date?></td>
	    </tr>
		<?php
	}
}
?>