<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/js/bootstrap4-toggle.min.js"></script>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-12  animated fadeInLeft">
				<nav aria-label="breadcrumb" >
				  <ol class="breadcrumb" style="background-color: white!important;">
				    <li class="breadcrumb-item"><a href="/dashboard" class="mytoplink">Moje menu</a></li>
				    <li class="breadcrumb-item"><a href="/profile/index/<?=$_SESSION['u_id']?>" class="mytoplink">Moj profil</a></li>
				    <li class="breadcrumb-item" aria-current="page">Upravit profil</li>
				  </ol>
				</nav>
			</div>
			<div class="col-md-12 hidden" id="positiveAlert" style="display: none;">
				<div class="alert alert-success" role="alert">
				 <p>Uspesne ste si zmenili profilove informacie!</p>
				</div>
			</div>
			<div class="col-md-12 text-center mb-3  animated fadeInRight"><h4>Upravit moj profil</h4></div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<form action="/profile/updateProfile" id="updateProfile" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
					<div class="form-row">
						<div class="col-md-12 text-center mb-3">
							<?php Include('Includes/getProfilePicture.php');?>
						</div>

						<div class="col-md-4 offset-md-5  mt-1">
						  	<label for="profilePhoto" class="btn btn-success" id="profilePhotoLab">
						  	<input id="profilePhoto" name="profilePhoto"  value="<?=$this->user->path?>" type="file" style="display:none" 
							      onchange="$('#upload-file-info').html(this.files[0].name)">
							  Nahrat profilovu fotku</label>
							  <span class='label label-info' id="upload-file-info" value="<?=$this->user->path?>"></span>
						</div>
						<div class="col-md-6 mt-1">
							<label  for="firstName">Krstne meno</label>
							<input type="text" name="firstName" class="form-control" id="firstName" placeholder="Vložte celé meno" value="<?=$this->user->firstName?>" required>
							  <div class="invalid-tooltip">
							    Zadajte cele krsntne meno.
							  </div>
						</div>
						<div class="col-md-6 mt-1">
							<label  for="sureName">Priezvisko</label>
							<input type="text" name="sureName" class="form-control" id="sureName" placeholder="Vložte celé priezvisko" value="<?=$this->user->lastName?>" required>
							  <div class="invalid-tooltip">
							    Zadajte cele priezvisko.
							  </div>
						</div>
					</div>
						<div class="form-row mt-2">	
							<div class="col-md-6 mt-1">
								<label  for="contact">Kontakt</label>
								<input type="text" name="contact" class="form-control" id="contact" placeholder="Vložte celé meno"  value="<?=$this->user->contact?>" required>
								  <div class="invalid-tooltip">
								    Zadajte cele krsntne meno.
								  </div>
							</div>
							<div class="col-md-6 mt-1">
								<label  for="address">Mesto</label>
								<input type="text" name="address" class="form-control" id="address" placeholder="Vložte celé meno"  value="<?=$this->user->address?>" required>
								  <div class="invalid-tooltip">
								    Zadajte cele krsntne meno.
								  </div>
							</div>
						</div>
						<div class="form-row mt-2">
							<div class="col-md-12 mt-1">
								<label for="desc">Titulok</label>
								<input type="text" name="shortDesc" class="form-control" id="shortDesc" placeholder="Vlozte Vas kratky titulok, ktory zobrazeny pod vasim menom" value="<?=$this->user->shortDesc?>">
							</div>
						</div>
						<div class="form-row mt-2">
							<div class="col-md-12 mt-1">
								<label for="desc">Nieco o Vas</label>
								<textarea type="subject" name="desc" class="form-control" id="desc" placeholder="Vlozte nieco o vas" style="min-height: 120px; resize: none;"><?=$this->user->desc?></textarea>
							</div>
						</div>
						<div class="form-row mt-2">
							<div class="col-md-12 mt-4 text-center">
								<label for="">Sukromne nastavenie profilu </label>
								<input type="checkbox" name="privacyset" id="privacyset" data-toggle="toggle" data-on="Verejny" data-off="Sukromny" data-onstyle="success" data-offstyle="danger" <?php if($this->user->privacy == "off") echo "checked"; ?>>
							</div>
						</div>
						<div class="mt-3" style="text-align: center;">
							<a><button type="submit" name="submit" id="btnUpdateProfile2"class="btn btn-success">Zmenit profil</button></a>              	
						</div>
				</form>
			</div>
		</div>
	</div>
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