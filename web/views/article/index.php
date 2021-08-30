<div class="container" id="content">
	<div class="jumbotron mt-3">
	  <h1 class="display-4">Vitajte v sekcii článkov</h1>
	  <p class="lead">Tu si viete prečítať najnovšie príbehy, zážitky a skuseností ľudí a vystovateľov a vsetkých členov DogChamp</p>
	  <hr class="my-4">
	  <p class="lead">
	    <a class="btn btn-success btn-lg" href="/article/new" role="button">Pridať článok</a>
	  </p>
	</div>
	<div class="row">
		<div class="col-md-9 border-right">
			<?php Include('Includes/listNewestArticles.php');?>
		</div>
		<div class="col-md-3">
			<ul class="list-group">
			  <li class="list-group-item d-flex justify-content-between align-items-center">
			    Moje články
			    <span class="badge badge-success badge-pill"><?=$this->myArticleCount?></span>
			  </li>
			  <li class="list-group-item d-flex justify-content-between align-items-center">
			    Nezverejnené články
			    <span class="badge badge-success badge-pill"><?=$this->myPreviewsCount?></span>
			  </li>
			  <li class="list-group-item d-flex justify-content-between align-items-center">
			   Obľúbené
			    <span class="badge badge-success badge-pill"><?=$this->myFavouritesCount?></span>
			  </li>
			</ul>
		</div>
	</div>
</div>
