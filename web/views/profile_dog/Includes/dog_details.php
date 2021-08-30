<?php
if (isset($this->details)) {
	?>
		<div class="row mt-3 text-center">
			<div class="col-md-6 border-right">
				<h4>Osobne informacie</h4>
				<div class="div-centered mt-3">
					<p><i class="fas fa-user-circle mr-4"></i><?=$this->details->name?></p>
					<p><i class="fas fa-flag-usa mr-4"></i><?=$this->details->nickName?></p>
					<p><i class="fas fa-envelope  mr-4"></i><?=$this->details->race?></p>
					<p><i class="fas fa-comment-medical  mr-4"></i><?=$this->details->gender?></p>
					<p><i class="fas fa-flag-usa mr-4"></i><?=$this->details->placeOfBirth?></p>
					<p><i class="fas fa-envelope  mr-4"></i><?=$this->details->about?></p>
				</div>
			</div>
			<div class="col-md-6">
				<h4>Tituly</h4>
				<div class="row mt-3">
					<div class="col-md-4">
						<img src="<?="//" .URL. 'views/profile/img/badge164.png';?>" class="mt-2" alt="">
						<p>Popis 1</p>
					</div>
					<div class="col-md-4">
						<img src="<?="//" .URL. 'views/profile/img/badge264.png';?>" class="mt-2" alt="">
						<h5>Popis 2</h5>
					</div>
					<div class="col-md-4">
						<img src="<?="//" .URL. 'views/profile/img/badge364.png';?>" class="mt-2" alt="">
						<h5>Popis 3</h5>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-md-4">
						<img src="<?="//" .URL. 'views/profile/img/badge264.png';?>" class="mt-2" alt="">
						<h5>Popis 1</h5>
					</div>
					<div class="col-md-4">
						<img src="<?="//" .URL. 'views/profile/img/badge1.png';?>" class="mt-2" alt="">
						<h5>Popis 2</h5>
					</div>
					<div class="col-md-4">
						<img src="<?="//" .URL. 'views/profile/img/badge2.png';?>" class="mt-2" alt="">
						<h5>Popis 3</h5>
					</div>
				</div>
			</div>
		</div>
	<?php
}
?>
