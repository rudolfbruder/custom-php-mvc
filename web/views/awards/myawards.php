<script type="text/javascript" src="<?="//" .URL. 'public/js/jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?="//" .URL. 'public/js/dataTables.bootstrap4.min.js';?>"></script>
<script type="text/javascript" src="<?="//" .URL. 'public/js/TablesConfig.js';?>"></script>
<link rel="stylesheet" href="<?="//" .URL. 'public/css/dataTables.bootstrap4.min.css';?>">
	<div class="container  animated fadeInRight mt-2" id="content">
		<div class="row">
			<div class="col-md-12" >
				<nav aria-label="breadcrumb" >
				  <ol class="breadcrumb" style="background-color: white!important;">
				    <li class="breadcrumb-item"><a href="../dashboard" class="mytoplink">Moje menu</a></li>
				    <li class="breadcrumb-item"><a href="../awards" class="mytoplink">Moje Ocenenia a Tituly</a></li>
				    <li class="breadcrumb-item" aria-current="page">Prehlad oceneni a titulov</li>
				  </ol>
				</nav>
			</div>
			<div class="col-md-12 hidden" id="positiveAlert" style="display:none">
				<div class="alert alert-success" role="alert">
				  Uspesne ste zmazali ocenenie! <a href="#" class="alert-link">tu!</a>
				</div>
			</div>
			<div class="col-md-12 center">
				<h2>Zoznam vašich oceneni a titulov</h2>
				<small>Vsetky vase ocenenia na kope!</small>
			</div>
			<div class="col-md-4 center mt-5">		  
			  <img src="/views/awards/img/score128.png" class="img-fluid mt-2" alt="MyDogs">
			  <h4>Vas pocet bodov</h4>
			  <p class="mt-2">Ziskany pocet bodov: <?=$this->points?></p>
			</div>
			<div class="col-md-4 center mt-5">			  
			  <img src="/views/awards/img/competition128.png" class="img-fluid mt-2" alt="Competitions">
			  <h4>Pocet absolvovanych sutazi</h4>
			  <p class="mt-2">Pocet absolvovanych sutazi: <?=$this->competitions?></p>
			</div>
			<div class="col-md-4 center mt-5">			  
			  <img src="/views/awards/img/dogchampscore128.png" class="img-fluid mt-2" alt="DogChampScore">
			  <h4>Vase dogchamp skore</h4>
			  <p class="mt-2">Pocet DogChamp pointov: <?=$this->score?></p>
			</div>
			<div class="col-md-12 mt-5 mb-1 text-center">
			  <a href="new"><button type="submit" name="submit" class="btn btn-success  btn-pill">Pridať ocenenie</button></a>
			  <button type="submit" name="submit" class="btn btn-success btn-pill" onclick="UpdateSelectedAward2();">Upravit ocenenie</button>
			  <a><button type="submit" name="submit" class="btn btn-success btn-pill" onclick="DeleteAwardSelection();"><span class="glyphicon glyphicon-trash"></span>Zmazať ocenenie</button></a>
			</div>
			<div class="col-md-12 mt-5">
			  <table class="table table-striped table-bordered" id="tableAwards">
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
			    <?php Include('Includes/printmyawards.php');?>
			    </tbody>
			  </table>
			</div>
		</div>
	</div>
	<!-- Modal for deleting the award -->
	<div class="modal fade" tabindex="-1" role="dialog" id="confirmDelete">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Portvrdiť zmazanie</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body text-center">
	        <p>Naozaj si želáte zmazať označené ocenenie? Táto akcia je nenávratná!</p>
	        <p>Zmažú sa nasledové údaje:</p>
	        <div>
	            <p>Údaje o ocenení</p>
	            <p>Body z daného ocenenia</p>
	        </div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-success" data-dismiss="modal">Zrusit</button>
	        <button type="button" class="btn btn-danger" onclick="DeleteAward2();">Zmazat</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- End of modal -->
<script>
	function DeleteAward2(){
	  var id = null;
	  var exists = null;
	  exists =document.getElementsByClassName('activerow');
	  if ($(".activerow")[0]){
	  $(".activerow").each(function() {
	    if($(this).text().length > 0) {
	       id = $(this).find('td').eq(0).text();
	      /* alert("value: " + $(this).find('td').eq(0).text());*/
	     }
	  if (id != "") {
	    
	      $.ajax({
	             data: {
	               awardId:id
	             },
	             type: "post",
	             url: "delete",
	             success: function(data){
	                $('#confirmDelete').modal('hide');
	                location.reload();

	             }

	    });
	  }else{
	    alert("Oznacte najprv psa z tabulky stlacenim.");
	  }
	});
	}
	else{
	   alert("Oznacte najprv psa z tabulky stlacenim.");
	}
	}
</script>

<script>
	function UpdateSelectedAward2(){
	      var id = null;
	      var exists = null;
	      exists =document.getElementsByClassName('activerow');
	      if ($(".activerow")[0]){
	      $(".activerow").each(function() {
	        if($(this).text().length > 0) {
	           id = $(this).find('td').eq(0).text();
	          /* alert("value: " + $(this).find('td').eq(0).text());*/
	         }
	      if (id != "") {

	        location.href="edit/" + id;
	      }else{
	        alert("Oznacte najprv psa z tabulky stlacenim.");
	      }
	    });
	    }
	    else{
	       alert("Oznacte najprv psa z tabulky stlacenim.");
	    }  
	  }
</script>