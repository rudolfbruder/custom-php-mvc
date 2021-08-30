<?php
	if(isset($_SESSION['u_id'])) {
		if ($this->details->ownerId == $_SESSION['u_id']) {
			?>
					<div class="col-md-1  text-center text-md-right">
						<a href="/profile/edit" class="btn btn-success">Upravit</a>
					</div>
			<?php
		}
	}
?>