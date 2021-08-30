<script type="text/javascript" src="<?="//" .URL. 'public/js/jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?="//" .URL. 'public/js/dataTables.bootstrap4.min.js';?>"></script>
<script type="text/javascript" src="<?="//" .URL. 'public/js/TablesConfig.js';?>"></script>
<link rel="stylesheet" href="<?="//" .URL. 'public/css/dataTables.bootstrap4.min.css';?>">
<body>
	<div class="container" id="content">
		<div class="row">
			<div class="col-md-12 animated fadeInLeft">
				<nav aria-label="breadcrumb" >
				  <ol class="breadcrumb" style="background-color: white!important;">
				    <li class="breadcrumb-item"><a href="../dashboard" class="mytoplink">Moje menu</a></li>
				    <li class="breadcrumb-item"><a href="../awards" class="mytoplink">Moje Ocenenia a Tituly</a></li>
				    <li class="breadcrumb-item" aria-current="page">Celkovy  DogChamp rebricek</li>
				  </ol>
				</nav>
			</div>
			<div class="col-md-12 text-center mt-2 mb-1 animated fadeInRight">
				<h4>Rebricek najlepsich psov a ich majitelov na DogChamp!</h4>
				<small>Celkovy prehlad portalu DogChamp, najuspesnejsi majitelia a naujuspesnejsi psy!</small>
			</div>
				<div class="col-md-4 center mt-5 animated fadeInLeft">		  
				  <img src="/views/awards/img/people128.png" class="img-fluid mt-2" alt="MyDogs">
				  <h4>Pocet clenov</h4>
				  <p class="mt-2">Celkovy pocet uzivatelov: <?=$this->usersCount?></p>
				</div>
				<div class="col-md-4 center mt-5 animated fadeInLeft">			  
				  <img src="/views/awards/img/totalDogs128.png" class="img-fluid mt-2" alt="Competitions">
				  <h4>Pocet psov</h4>
				  <p class="mt-2">Celkovy pocet registrovanych psov: <?=$this->dogCount?></p>
				</div>
				<div class="col-md-4 center mt-5 animated fadeInLeft">			  
				  <img src="/views/awards/img/totalAwards128.png" class="img-fluid mt-2" alt="DogChampScore">
				  <h4>Pocet oceneni</h4>
				  <p class="mt-2">Celkovy pocet oceneni: <?=$this->awardCount?></p>
				</div>
	
			<div class="col-md-12 mt-4 animated fadeInRight">
			  <table class="table table-striped table-bordered" id="tableLeaders">
			    <thead>
			      <tr>
			        <th scope="col">#</th>
			        <th scope="col">Majitel</th>
			        <th scope="col">Celkovy pocet bodov</th>
			        <th scope="col">Top pes</th>
			      </tr>
			    </thead>
			    <tbody>
		    	<?php include('Includes/listBestUsers.php');?>
			    </tbody>
			  </table>
			</div>
			<div class="col-md-12 mt-4 animated fadeInLeft">
			  <table class="table table-striped table-bordered" id="tableBestDogs">
			    <thead>
			      <tr>
			        <th scope="col">#</th>
			        <th scope="col">Meno psa</th>
			        <th scope="col">Rasa</th>
			        <th scope="col">Pohlavie</th>
			        <th scope="col">Meno majitela</th>
			        <th scope="col">Pocet bodov</th>
			      </tr>
			    </thead>
			    <tbody>
			    <?php include('Includes/listBestDogs.php');?>
			    </tbody>
			  </table>
			</div>
		</div>
	</div>			

<script>
	    $(document).ready(function () {
    $('#tableLeaders').DataTable();

});
</script>
