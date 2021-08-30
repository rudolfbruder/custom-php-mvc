<script type="text/javascript" src="<?="//" .URL. 'public/js/jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?="//" .URL. 'public/js/dataTables.bootstrap4.min.js';?>"></script>
<script type="text/javascript" src="<?="//" .URL. 'public/js/TablesConfig.js';?>"></script>
<link rel="stylesheet" href="<?="//" .URL. 'public/css/dataTables.bootstrap4.min.css';?>">
	<div class="container  animated fadeInRight mt-2" id="content">
		<div class="row">
			<div class="col-md-12">
				<nav aria-label="breadcrumb" >
				  <ol class="breadcrumb" style="background-color: white!important;">
				    <li class="breadcrumb-item"><a href="../dashboard" class="mytoplink">Moje menu</a></li>
				    <li class="breadcrumb-item"><a href="../dogs" class="mytoplink">Moje psy</a></li>
				    <li class="breadcrumb-item" aria-current="page">Zoznam mojich psov</li>
				  </ol>
				</nav>
			</div>
			<div class="col-md-12 center">
				<h2>Zoznam vašich psov</h2>
				<small>Všetci vaši psy pokope na jednom mieste</small>
			</div>
			<div class="col-md-12 mt-5 mb-1 text-center">
			  <a href="create"><button type="submit" name="submit" class="btn btn-success  btn-pill">Pridať psa</button></a>
			  <button type="submit" name="submit" class="btn btn-success btn-pill" onclick="UpdateSelectedDog2();">Upraviť psa</button>
			  <a><button type="submit" name="submit" class="btn btn-success btn-pill" onclick="DeleteDogSelection();"><span class="glyphicon glyphicon-trash"></span>Zmazať psa</button></a>
			</div>
			<div class="col-md-12 mt-4">
			  <table class="table table-striped table-bordered" id="tableDogs">
			    <thead>
			      <tr>
			        <th scope="col">#</th>
			        <th scope="col">ID psa</th>
			        <th scope="col">Celé meno</th>
			        <th scope="col">Prezývka</th>
			        <th scope="col">Rasa</th>
			      </tr>
			    </thead>
			    <tbody>
			    <?php include('Includes/listMyDogs.php');?>
			    </tbody>
			  </table>
			</div>
		</div>
	</div>
	<!-- Modal for deleting the dog -->
	<div class="modal fade" tabindex="-1" role="dialog" id="confirmDelete">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Portvrďiť zmazanie</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body text-center">
	        <p>Naozaj si želáte zmazať označeného psa? Táto akcia je nenávratná!</p>
	        <p>Zmažú sa nasledové údaje:</p>
	        <div>
	            <p>Údaje o psovi</p>
	            <p>Celý profil psa</p>
	            <p>Všetky fotky psa</p>
	            <p>Získané ocenenia</p>
	        </div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-success" data-dismiss="modal">Zrusit</button>
	        <button type="button" class="btn btn-danger" onclick="DeleteDog2();">Zmazat</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- End of modal -->
	<script>
		
		function DeleteDog2(){
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
		               dogId:id
		             },
		             type: "post",
		             url: "deleteDog",
		             success: function(data){
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
		function UpdateSelectedDog2(){
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

		      location.href="/dogs/edit/" + id;
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