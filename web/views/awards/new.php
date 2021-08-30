<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>
<body>
	<div class="container animated fadeInLeft mt-2" id="content">
		<div class="row">
			<div class="col-md-12" >
				<nav aria-label="breadcrumb" >
				  <ol class="breadcrumb" style="background-color: white!important;">
				    <li class="breadcrumb-item"><a href="../dashboard" class="mytoplink">Moje menu</a></li>
				    <li class="breadcrumb-item"><a href="../awards" class="mytoplink">Moje Ocenenia a Tituly</a></li>
				    <li class="breadcrumb-item" aria-current="page">Pridat ocenenie</li>
				  </ol>
				</nav>
			</div>
			<div class="col-md-12 hidden" id="positiveAlert">
				<div class="alert alert-success" role="alert">
				  Gratulujeme! Vlozili ste nove ocenenie. Zaratalo sa Vam do prehladu <a href="myawards" class="alert-link">tu!</a>
				</div>
			</div>
			<div class="col-md-12 text-center mb-4">
				<h4>Pridanie novej ceny</h4>
			</div>
		</div>
			<div class="col-md-12">
			<form action="" method="post" id="newaward" class="needs-validation"novalidate>
				<div class="form-row">
					<div class="col-md-6 mb-3 mt-1">
						<label  for="dogId">Meno psa</label>
						<select name="dogId" class="selectpicker form-control" id="dogId" title="Zvolte psa" data-show-subtext="true" data-live-search="true" required>
							<?php include("Includes/listMyDogs.php");?>
						</select>
						<div class="invalid-tooltip">
						  Vyberte  meno psa!
						</div>
					</div>
					<div class="col-md-6 mb-3 mt-1">
						<label  for="competition">Sutaz</label>
						<select  name="competition" class="selectpicker form-control" id="competition" title="Zvolte sutaz" data-show-subtext="true" data-live-search="true" required>
							<?php include("Includes/listCompetitions.php");?>
						</select>
					  	<div class="invalid-tooltip">
						    Zvolte sutaz zo zoznamu!
					  	</div>
					</div>	          		
	          		<div class="col-md-12 mb-3 mt-1">
          				<label  for="award">Vyberte ocenenie</label>
	          			<select  class="selectpicker form-control" title="Zvolte ocenenie"  data-show-subtext="true" data-live-search="true" id="award" name="award"  required>
	          				<?php include("Includes/listAwardTypes.php");?>
	          			</select>
						 <div class="invalid-tooltip">
						    Zvolte typ ocenenia!
						 </div>
	          		</div>
	          		<div class="col-md-12">
	          			<label  for="comment">Vas komentar</label>
	          			<textarea type="subject" name="comment" class="form-control" id="comment" placeholder="Ak chcete vložte poznamku..." style="min-height: 100px; resize: none;"></textarea>
	          		</div>
		      		</div>	      		
	      		<div class="mt-3 text-center">
	      			<a href=""><button type="submit" name="submit" id="btnAddNewAward2" class="btn btn-success">Pridat cenu</button></a>             	
	      		</div>
			</form>
			</div>
		</div>
	</div>	
<script>
	$(document).on('click','#btnAddNewAward2',function(e) {
	  e.preventDefault();
	    var data = $("#newaward").serialize();
	  if ($('#newaward')[0].checkValidity() === false) {
	      event.stopPropagation();
	  } else {
	       $.ajax({
	              data: data,
	              type: "post",
	              url: "create",
	              success: function(data){
	                document.getElementById('positiveAlert').classList.remove('hidden');
	                document.getElementById('positiveAlert').classList.add('showMe', 'animated', 'pulse');
	              }

	     });
	  }
	  $('#newaward').addClass('was-validated');

	 });
</script>