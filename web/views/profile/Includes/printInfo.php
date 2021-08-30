<?php
if (isset($this->profileInfo)) {
	?>
		<div class="row mt-3">
			<div class="col-md-6  text-center border-right">
				<h4 class="mb-3">Osobné info</h4>
				<p><i class="fas fa-user-circle mr-4"></i><?=$this->profileInfo->firstName?>  <?=$this->profileInfo->lastName?></p>
				<p><i class="fas fa-flag-usa mr-4"></i><?=$this->profileInfo->lastName?></p>
				<p><i class="fas fa-envelope  mr-4"></i><?=$this->profileInfo->address?></p>
				<p><i class="fas fa-comment-medical  mr-4"></i><?=$this->profileInfo->desc?></p>
					
					<div class="text-center mt-5">
						<h4 class="text-center">Nástenka slávy</h4>
						<small><?=$this->profileInfo->firstName?> sa rozhodol zobrazit tieto ceny</small>
					</div>
					<div class="row mt-4 mb-4 text-center">
						<div class="col-md-4">
							<img src="<?="//" .URL. 'views/profile/img/badge364.png';?>" alt="">
							<p class="mt-1">Badge 1</p>
						</div>
						<div class="col-md-4">
							<img src="<?="//" .URL. 'views/profile/img/badge1.png';?>" alt="">
							<p class="mt-1">Badge 2</p>
						</div>
						<div class="col-md-4">
							<img src="<?="//" .URL. 'views/profile/img/badge2.png';?>" alt="">
							<p class="mt-1">Badge 3</p>
						</div>
					</div>
					<div class="col-md-12 text-center">
						<hr>
					</div>
					<h4 class="text-center.">Priatelia</h4>
					<div class="row ml-1 mr-1 d-none d-md-flex">
<!-- 						<div class="col-md-3" style="padding: 0!important; background-image: url(<?="//" .URL. 'views/profile/img/aboutMe2.JPG';?>);background-repeat:no-repeat;background-size:contain;background-position:center;">
							<span style="  margin: auto auto 0 auto;">Rudolf Bruder</span>
						</div> -->
						<div class="col-md-3" style="padding: 0!important;"><img src="<?="//" .URL. 'views/profile/img/aboutMe2.JPG';?>" class="img-thumbnail" alt=""></div>
						<div class="col-md-3" style="padding: 0!important;"><img src="<?="//" .URL. 'views/profile/img/aboutMe2.JPG';?>" class="img-thumbnail" alt=""></div>
						<div class="col-md-3" style="padding: 0!important;"><img src="<?="//" .URL. 'views/profile/img/aboutMe2.JPG';?>" class="img-thumbnail" alt=""></div>
					</div>
			</div>
			<div class="col-md-6">
				<?php if ($_SESSION['u_id'] == $this->profileId) {?>
					<h4 class="text-center mb-3">Váš blog</h4>
					<div class="text-center mb-2">
						<button class="btn btn-success">Spravovať Vaše články</button>
					</div>
					<?php Include('listArticles.php');
				}else{
					?>
					<h4 class="text-center">Príspevky a blog</h4>
					<?php Include('listArticles.php');
				}?>
				
				
			</div>
		</div>
	<?php
}
	
?>