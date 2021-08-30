<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/css/bootstrap4-toggle.min.css" rel="stylesheet">
<body>

	<div class="container" id="content">
		<div class="row">		
			<div class="col-md-12  animated fadeInLeft">
				<nav aria-label="breadcrumb" >
				  <ol class="breadcrumb" style="background-color: white!important;">
				    <li class="breadcrumb-item"><a href="../dashboard" class="mytoplink">Moje menu</a></li>
				    <li class="breadcrumb-item"><a href="../dogs" class="mytoplink">Moji psy</a></li>
				    <li class="breadcrumb-item" aria-current="page">Pridat psa</li>
				  </ol>
				</nav>
			</div>
			<div class="col-md-12 text-center mb-3  animated fadeInRight"><h4>Pridať psa na DogChamp</h4></div>
		</div>
		<div class="col-md-12  animated fadeInLeft">
			<form action="createDog" method="post" id="newdog" class="needs-validation" enctype="multipart/form-data" novalidate>
				<div class="form-row">
					<div class="col-md-12 text-center">
						<img src="/views/dogs/img/dogs128.png" id="profileImage" class="border border-secondary rounded img-fluid pop" style="max-height: 120.500px;" alt="profileImg2">

					</div>
					<div class="col-md-12 text-center mt-2">
					  	<label for="profilePhoto" class="btn btn-success" id="profilePhotoLab">
					  	<input id="profilePhoto" name="profilePhoto" class="d-none" value="" type="file">
						  Nahrať profilovú fotku</label>
						  <span class='label label-info' id="upload-file-info" value=""></span>
					</div>
					<div class="col-md-6 mt-1">
						<label  for="name">Meno</label>
						<input type="text" name="name" class="form-control" id="name" placeholder="Vložte celé meno" required>
						  <div class="invalid-tooltip">
						    Zadajte celé meno psa.
						  </div>
					</div>
					<div class="col-md-6 mt-1">
						<label  for="nickname">Prezyvka</label>
						<input type="text" name="nickname" class="form-control" id="nickname" placeholder="Vložte prezyvku" required>
						  <div class="invalid-tooltip">
						    Zadajte prezývku psa.
						  </div>
					</div>
	          		<div class="col-md-6 mt-1">
	      				<label  for="gender">Pohlavie</label>
	          			<select  class="selectpicker form-control" title="Zvolte pohlavie"  data-show-subtext="true" data-live-search="true" id="gender" name="gender"  required>
	          			  	<option></option>
	          			  	<option>Pes</option>
	          			  	<option>Suka</option>
	          			</select>
						 <div class="invalid-tooltip">
						    Zadajte pohlavie psa.
						 </div>
	          		</div>
	          		<div class="col-md-6 mt-1">
	          			<label  for="race">Rasa</label>
	          			<select  class="selectpicker form-control" title="Zvolte rasu"  data-show-subtext="true" data-live-search="true" id="race"  name="race" required>
		          			<option></option>
		          			<?php Include('Includes/listRaces.php');?>
	          			</select>
	          			<div class="invalid-tooltip">
	          			   Zadajte rasu psa.
	          			</div>
	          		</div>
	              	<div class="col-md-6 mt-1">
	              	  <label for="dateofbirth" class="">Dátum narodenia</label>
					  <input class="form-control" type="date" value=" " id="dateofbirth" name="dateofbirth" required>	
					  <div class="invalid-tooltip">
					     Zadajte dátum narodenia psa.
					  </div>
	              	</div>
	              	<div class="col-md-6 mt-1">
	              		<label  for="placeOfBirth">Miesto narodenia</label>
	              		<input type="text" name="placeOfBirth" class="form-control" id="placeOfBirth" placeholder="Vložte miesto narodenia" required>
	              		  <div class="invalid-tooltip">
	              		    Zadajte miesto narodenia psa.
	              		  </div>
	              	</div>
	              	<div class="col-md-12 mt-3 text-center">
	      				<label for="">Súkromné nastavenie psa </label>
	      				<input type="checkbox" name="privacyset" id="privacyset" checked data-toggle="toggle" data-on="Verejny" data-off="Sukromny" data-onstyle="success" data-offstyle="danger">
	              	</div>
	      		</div>
		     <div class="mt-3 text-center">
		     	<a  ><button type="submit" name="submit" id="btnAddNewDog12"class="btn btn-success">Pridať psa</button></a>              	
		     </div>
			</form>
		</div>
	</div>



<script src="<?="//" .URL. 'views/dogs/js/scripts.js';?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/js/bootstrap4-toggle.min.js"></script>
	<div class="modal fade" tabindex="-1" role="dialog" id="imageModal">
	  <div class="modal-dialog" role="document">

	      <div class="modal-body text-center">
			  <img class="modal-content" id="img01" >
			  <div id="caption"></div>
	      </div>

	  </div>
	</div>
	<script>
		$(function() {
		$('.pop').on('click', function() {
			$('#imagemodal').modal('show');   
		});		
});
	</script>

<script>
// Get the modal
var modal = document.getElementById("imageModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("profileimg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  $('#imageModal').modal('show')
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

</script>
