<?php 
	if (isset($this->exists)) {
		?>
			<div class="container" id="content">
				<div class="row">
					<div class="col-md-12 text-center mt-5">
						<h4>Gratulujeme! Úspešne ste vložili nového psa na DogChamp!</h4>
						<p>Prezrieť si ho možete <a href="">tu</a></p>
					</div>
				</div>
			</div>
		<?php
	}else{
		?>
		<div class="container" id="content">
			<div class="row">
				<div class="col-md-12 text-center mt-5">
					<h4>Nastala chyba. Skúste vložiť psa znova.</h4>
					<small>Ak by chyba pretrvávala kontaktujte nas <a href="../../contact">tu</a></small>
				</div>
			</div>
		</div>
		<?php
	}
?>