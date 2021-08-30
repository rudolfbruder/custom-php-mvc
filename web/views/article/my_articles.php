<div class="container" id="content">
	<div class="row-div col-md-12">
		<h3>Vitajte vo vasich clankoch!</h3>
		<?php 
		if (isset($this->myArticles)) {
				foreach ($this->myArticles as $article) {

					?>
						<div class="row">
							<div class="col-md-10 offset-md-1">
								<div class="card mt-2">
									<div class="card-body">
										<div class="card-title">
											<h4><?=$article->title?></h4>
										</div>
										<div class="card-text">
											<small><?=$article->content?></small>
											<a href="" class="btn btn-primary">Citaj viac</a>
											<p class="card-text mt-2"><small class="text-muted">Posledny update <?=$article->dateOfModification?></small></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php
				}
		}else{
			echo "not set";
					}
		 ?>

	</div>
</div>
