<body id="body" class="d-none">
<div class="container" id="content">
	<div class="row">
		<div class="col-md-10 offset-md-1">
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb pl-0 pb-0" style="background-color: white!important;">
			    <li class="breadcrumb-item"><a href="/dashboard" class="mytoplink">Moje menu</a></li>
			    <li class="breadcrumb-item"><a href="/article" class="mytoplink">Clanky</a></li>
			  </ol>
			</nav>
			<div class="card text-center">
			  <div class="card-header text-left text-muted">
			  	<small>Clanok od pozuzivatela <?=$this->article->userId?></small>
			  </div>
			  <div class="card-body">
			    <h5 class="card-title"><?=$this->article->title?></h5>
			    <p class="card-text"><?=$this->article->content?></p>
			    <a href="#" class="btn btn-primary">Go somewhere</a>
			  </div>
			  <div class="card-footer text-muted text-right">
			  	<small>Posledna zmena: <?=$this->article->dateOfModification?></small>
			  </div>
			</div>
			<div class="text-center mt-2">
				<a href="/article/create/<?=$this->article->id?>" class="btn btn-success">Nahrat</a>
			</div>
			
		</div>
	</div>		
</div>
	<script>
	  
	  $(document).ready(function() {
	   document.getElementById('body').classList.remove('d-none');
	   document.getElementById('body').classList.add('animated');
	   document.getElementById('body').classList.add('fadeIn');
	  });
	</script>