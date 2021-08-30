<link rel="stylesheet" href="<?="//" .URL. 'views/index/css/styles.css';?>">
<script src="<?="//" .URL. 'views/index/js/scripts.js';?>"></script>
<body>
<div class="container" id="content">
	<div class="row">
		<div class="col-md-9 offset-md-1 mt-4 animated fadeInLeft text-center">
			<h4>Chcete nás kontaktovať?</h4>
		</div>
		<div class="col-md-9 offset-md-1">
			<form id="contactform" method="post" class="needs-validation"novalidate>
				<div class="row">
	                <div class="col-md-5 offset-md-1 mb-3 mt-2 animated fadeInLeft">
	                  <label  for="fullName">Vaše meno</label>
	                  <input type="text" name="name" class="form-control" id="fullName" placeholder="Vaše meno" required>
	                    <div class="invalid-tooltip">
	                      Zadajte vaše meno.
	                    </div>
	                </div>
	                <div class="col-md-5 offset-md-1 mb-3 mt-2 animated fadeInRight">
	                  <label  for="email">Váš email</label>
	                  <input type="email" name="email" class="form-control" id="email" placeholder="Váš email" required>
	                    <div class="invalid-tooltip">
	                      Zadajte váš email.
	                    </div>
	                </div>
	                <div class="col-md-11 offset-md-1 animated fadeInLeft">
	                	<label for="subject">Predmet</label>
	                	<input type="subject" name="subject" class="form-control" id="subject" placeholder="Vložte predmet" required>
	                	<div class="invalid-tooltip">
	                		Zadajte predmet správy
	                	</div>
	                </div>
	                <div class="col-md-11 offset-md-1  mt-2 animated fadeInRight">
	                	<label for="message">Text správy</label>
	                	<textarea type="subject" name="messagetext" class="form-control" id="messagetext" placeholder="Vložte text vašej správy" required></textarea>
	                	<div class="invalid-tooltip">
	                		Zadajte text
	                	</div>
	                </div>
	              <div class="col-md-11 offset-md-1 text-center mt-3">
	                <a><button type="submit" id="contactUs2" name="submit" class="btn btn-success">Poslať správu</button></a>
	              </div>	                
				</div>
			</form>
			<div class="text-center result">
				<p id="resultContactUs" class="animated"></p>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).on('click','#contactUs2',function(e) {
	 e.preventDefault();
	   var data = $("#contactform").serialize();
	    
	 if ($('#contactform')[0].checkValidity() === false) {
	     event.stopPropagation();
	 } else {
	      $.ajax({
	             data: data,
	             type: "post",
	             url: "sendMail",
	             success: function(data){
	                  document.getElementById('resultContactUs').classList.add("heartBeat");
	                  document.getElementById('resultContactUs').innerHTML = "Ďakujeme za Vašu správu, čoskoro sa Vám ozveme.";
	             }

	    });
	 }
	 $('#contactform').addClass('was-validated');

	});
</script>