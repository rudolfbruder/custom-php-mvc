<link rel="stylesheet" href="<?="//" .URL. 'public/css/dataTables.bootstrap4.min.css';?>">
<link rel="stylesheet" href="<?="//" .URL. 'views/profile_dog/css/styles.css';?>">
<script type="text/javascript" src="<?="//" .URL. 'public/js/jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?="//" .URL. 'public/js/dataTables.bootstrap4.min.js';?>"></script>
<script type="text/javascript" src="<?="//" .URL. 'public/js/TablesConfig.js';?>"></script>
<script type="text/javascript" src="<?="//" .URL. 'views/profile/js/scripts.js';?>"></script>
<body>
	<div class="container card mt-5" id="contnet">
		<div class="row card-header">
			<div class="col-md-3 mt-2 text-center">
				<?php Include('views/profile_dog/Includes/getProfilePictureIndex.php');?>
			</div>
			<div class="col-md-8 mt-2 text-lg-left text-center">
				<h4><?=$this->details->name?> , "<?=$this->details->nickName?>"</h4>
				<small><?=$this->details->shortDesc?></small>
					<div class="row text-center">
						<div class="col-4">
							<img src="/views/profile/img/winner128.png" class="img-fluid" alt="MyAwards">
							<p>Pocet absolvovanych sutazi: <?=$this->compCount?></p>
						</div>
						<div class="col-4">
							<img src="/views/profile/img/winner128.png" class="img-fluid" alt="MyAwards">
							<p>Pocet ziskanych bodov: <?=$this->points?></p>
						</div>
						<div class="col-4">
							<img src="/views/profile/img/winner128.png" class="img-fluid" alt="MyAwards">
							<p>DogChamp skore: 127</p>
						</div>
					</div>
			</div>
			<?php Include('Includes/showEditButton.php')?>	
		</div>	
		<div class="row mt-2">
			<div class="col-md-12 mt-2">
				<nav>
					<div class="nav nav-tabs nav-fill nav-justified" id="nav-tab" role="tablist">
						<a class="nav-item nav-link active mytoplink" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profil</a>
						<a class="nav-item nav-link mytoplink" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">Ocenenia a vyhry</a>
					</div>
				</nav>
				<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
						<?php Include('Includes/dog_details.php');?>
					</div>
					<div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
						<div class="row">
							<div class="col-md-12 hide-md">
								<table class="table table-striped table-bordered " id="tableAwardsProfile">
								  <thead>
								    <tr>
								      <th scope="col">#</th>
								      <th scope="col">ID ocenenia</th>
								      <th scope="col">Mesto sutaze</th>
								      <th scope="col">Nazov ocenenia</th>
								      <th scope="col">Pocet bodov</th>
								      <th scope="col">Pes</th>
								      <th scope="col">Datum</th>
								    </tr>
								  </thead>
								  <tbody>
								  <?php
								  	include("Includes/listAwards.php");
								  ?>
								  </tbody>
								</table>
							</div>
							<div class="col-md-12 hide-sm">
								<table class="table table-striped table-bordered " id="tableAwardsProfilePhone2">
								  <thead>
								    <tr>
								      <th scope="col">Mesto sutaze</th>
								      <th scope="col">Nazov ocenenia</th>
								      <th scope="col">Pes</th>
								      <th scope="col">Datum</th>
								    </tr>
								  </thead>
								  <tbody>
								  <?php
								  	//include("Includes/listAwardsPhone.php");
								  ?>
								  </tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>