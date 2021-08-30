<?php 
if (isset($this->newestArticles)) {
	$count = 1;
	$articles = 1;
		foreach ($this->newestArticles as $article) {
			if ($count <5) {
				$count +=1;
				$articles+=1;
			?>
				<div class="card mt-2">
					<div class="card-body">
						<div class="card-title">
							<div class="row">
								<div class="col-md-10">
									<h4><?=$article->title?></h4>
								</div>
								<div class="col-md-2 p-0 text-right">
									<a href="/"><img src="<?="//" .URL. '/views/article/img/star.png';?>" class="mr-1" alt="favourite"></a>
									<a href="/article/share/<?=$article->id?>"><img src="<?="//" .URL. '/views/article/img/share.png';?>" class="mr-1" alt="share"></a>
									<a href="/article/reportAticle/<?=$article->id?>"><img src="<?="//" .URL. '/views/article/img/report.png';?>"  class="mr-1"alt="report"></a>
								</div>
							</div>
							
						</div>
						<div class="card-text text-justify">
							<div class="row">
								<div class="col-md-3">
									<?php
									$fileDir = "../Images/ArticleImages/";
									$file = $fileDir . $article->picture;
									if (file_exists($file))
									{
									     $b64image = base64_encode(file_get_contents($file));
									     echo "<div class='text-center'><img id='profileimg'class='rounded img-fluid img-thumbnail pop'style='max-height: 244.500px;''  src = 'data:image/png;base64,$b64image'></div>";
									}
									?>
								</div>
								<div class="col-md-9">
									<small><?=substr(strip_tags($article->desc),0,300)?>... <a href="">Citajte viac</a></small>
									<br>
									<a href="/article/loadArticle/<?=$article->id?>" class="btn btn-success mt-2">Citaj viac</a>
								</div>
							</div>
						</div>
					</div>
				  	<div class="card-footer text-muted">
    					<p class="card-text text-right"><small class="text-muted">Posledny update <?=$article->dateOfModification?></small></p>
  					</div>
				</div>
			<?php
			}
		}
		?>
		<nav aria-label="Page navigation example" class="mt-3">
		  <ul class="pagination justify-content-center">
		    <li class="page-item <?php if($this->pageInfo[0]=="1") echo"d-none"?>">
		      <a class="page-link" href="/article/showPage/<?=$this->pageInfo[1]?>" tabindex="-1">Predošlý</a>
		    </li>
		    <li class="page-item"><a class="page-link <?php if($this->pageInfo[0]=="1") echo"d-none"?>" href="/article/showPage/<?=intval($this->pageInfo[0])-1?>"><?=intval($this->pageInfo[0])-1?></a></li>
		    <li class="page-item active"><a class="page-link" href="/article/showPage/<?=intval($this->pageInfo[0])?>"><?=$this->pageInfo[0]?></a></li>
		    <li class="page-item <?php if($articles<4 || (intval($this->totalCount))- (intval($this->pageInfo[0])*4)  <= 0) echo"d-none" ?>"><a class="page-link" href="/article/showPage/<?=intval($this->pageInfo[0]+1)?>"><?=intval($this->pageInfo[0])+1?></a></li>
		    <li class="page-item">
		      <a class="page-link <?php if($articles<4 || (intval($this->totalCount))- (intval($this->pageInfo[0])*4)  <= 0) echo"d-none" ?>" href="/article/showPage/<?=$this->pageInfo[2]?>">Ďalší</a>
		    </li>
		  </ul>
		</nav>
		<?php
}else{
	?>
	<div class="row">
		<div class="col-md-12">
			<p>Momentalne niesu dostupne ziadne clanky</p>
		</div>
	</div>
	<?php
}
?>

