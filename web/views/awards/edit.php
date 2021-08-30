<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>
<body>
	<div class="container animated fadeInLeft mt-2" id="content">
		<div class="row">
			<div class="col-md-12" >
				<nav aria-label="breadcrumb" >
				  <ol class="breadcrumb" style="background-color: white!important;">
				    <li class="breadcrumb-item"><a href="/dashboard" class="mytoplink">Moje menu</a></li>
				    <li class="breadcrumb-item"><a href="/awards/myawards" class="mytoplink">Moje Ocenenia a Tituly</a></li>
				    <li class="breadcrumb-item" aria-current="page">Pridat ocenenie</li>
				  </ol>
				</nav>
			</div>
			<div class="col-md-12 text-center mb-4">
				<h4>Upravenie ceny</h4>
			</div>
		</div>
			<div class="col-md-12">
			<form action="../update/<?=$this->awardDetails->id?>" method="post" id="newaward" class="needs-validation"novalidate>
				<div class="form-row">
					<div class="col-md-6 mb-3 mt-1">
						<label  for="dogId">Meno psa</label>
						<select name="dogId" class="selectpicker form-control" id="dogId" title="Zvolte psa" data-show-subtext="true" data-live-search="true" required>
							<?php include("Includes/editListMyDogs.php");?>
						</select>
						<div class="invalid-tooltip">
						  Vyberte  meno psa!
						</div>
					</div>
					<div class="col-md-6 mb-3 mt-1">
						<label  for="competition">Sutaz</label>
						<select  name="competition" class="selectpicker form-control" id="competition" title="Zvolte sutaz" data-show-subtext="true" data-live-search="true" required>
							<?php include("Includes/editListCompetitions.php");?>
						</select>
					  	<div class="invalid-tooltip">
						    Zvolte sutaz zo zoznamu!
					  	</div>
					</div>	          		
	          		<div class="col-md-12 mb-3 mt-1">
          				<label  for="award">Vyberte ocenenie</label>
	          			<select  class="selectpicker form-control" title="Zvolte ocenenie"  data-show-subtext="true" data-live-search="true" id="award" name="award"  required>
	          				<?php include("Includes/editListAwardTypes.php");?>
	          			</select>
						 <div class="invalid-tooltip">
						    Zvolte typ ocenenia!
						 </div>
	          		</div>
	          		<div class="col-md-12">
	          			<label  for="comment">Vas komentar</label>
	          			<textarea type="text" name="comment" class="form-control" id="comment" placeholder="Ak chcete vložte poznamku..."  style="min-height: 100px; resize: none;"><?=$this->awardDetails->comment?></textarea>
	          		</div>
		      		</div>	      		
	      		<div class="mt-3 text-center">
	      			<a><button type="submit" name="submit" id="btnAddNewAward211" class="btn btn-success">Upravit cenu</button></a>             	
	      		</div>
			</form>
			</div>
		</div>
	</div>	