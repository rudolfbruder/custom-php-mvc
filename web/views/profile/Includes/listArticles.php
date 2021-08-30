<?php 
if (isset($this->articles)) {
	$count = 1;
		foreach ($this->articles as $article) {
			if ($count <4) {
				# code...
			
			?>
				<div class="card mt-2">
					<div class="card-body">
						<div class="card-title">
							<h4><?=$article->title?></h4>
						</div>
						<div class="card-text text-justify">
							<small><?=substr(strip_tags($article->content),0,200)?>...</small>
							<br>
							<a href="" class="btn btn-success mt-2">Citaj viac</a>
							<p class="card-text mt-2"><small class="text-muted">Posledny update <?=$article->dateOfModification?></small></p>
						</div>
					</div>
				</div>
			<?php
			$count +=1;
		}else{
			?>
			<div class="text-center">
				<a class="mytoplink" href="">Zobrazit vsetky prispevky</a>
			</div>
			
			<?php
			break;
		}
		}
}else{
	echo "not set";
			}
 ?>

