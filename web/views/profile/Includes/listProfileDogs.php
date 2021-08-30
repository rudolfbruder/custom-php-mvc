<?php
if (isset($this->myDogs)) {
	$dogCount = count($this->myDogs);
	if ($dogCount < 5) {
		?> <div class="row"> <?php
		foreach ($this->myDogs as $myDog) {
			?>
					<div class="col-md-3">
						<div class="card mb-4" style="min-width: 209px!important;">
							<div class="card-header text-center"> <?=$myDog->name?>
							</div>

							<div class="card-body text-center">
								<?php
									$fileDir = "../Images/DogProfileImages/";
									$file = $fileDir . $myDog->image;
									if (file_exists($file))
									{
										
									     $b64image = base64_encode(file_get_contents($file));
									     echo "<img id='profileimg'class='rounded img-fluid pop'style='max-height: 120px;''  src = 'data:image/png;base64,$b64image'>";
									}else{
										?>
											<img src="img/dogs128.png" class='rounded img-fluid pop'style='max-height: 120px;' alt="">
										<?php
									}
								?>
								<p class=" mt-2 text-center"><?=$myDog->nickName?></p>
							</div>
							<div class="footer text-center mb-2">
								<a href="<?php echo "/profile_dog/index/".$myDog->id?>"><button class="btn btn-success">Prezriet</button></a>
							</div>
						</div>
					</div>	
			<?php
		}
		?></div><?php
	}else{
		
		?><div class='row mt-3'><?php
		foreach ($this->myDogs as $myDog) {
		?>
			<div class="col-md-3">
				<div class="card mt-4  mb-4"  >
					<div class="card-header text-center"> <?=$myDog->name?>
					</div>

					<div class="card-body text-center">
						<?php
							$fileDir = "../Images/DogProfileImages/";
							$file = $fileDir . $myDog->image;
							if (file_exists($file))
							{
							     $b64image = base64_encode(file_get_contents($file));
							     echo "<img id='profileimg'class='rounded img-fluid pop'style='max-height: 120px;''  src = 'data:image/png;base64,$b64image'>";
							}else{
										?>
											<img src="img/dogs128.png" class='rounded img-fluid pop'style='max-height: 120px;' alt="">
										<?php
									}
						?>
						<p class=" mt-2 text-center"><?=$myDog->nickName?></p>
					</div>
					<div class="footer text-center mb-2">
						<a href="<?php echo "/profile_dog/index/".$myDog->id?>"><button class="btn btn-success">Prezriet</button></a>
					</div>
				</div>
			</div>
		<?php
		}
		?></div><?php
	}
}else{
	?>
	<div class="row">
		<div class="col-md-12 text-center mt-5">
			<p>Tento uzivatel nema zaregistrovanych ziadnych psov</p>
		</div>
	</div>
	<?php
}
?>