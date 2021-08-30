			<body>
				<div class="container">
					<div class="row animated ">
						<div class="col-md-12 mt-5 mb-5 animated fadeInRight" style="text-align: center;"><h2>Vitajte vo vašom celkovom prehľade!</h2>
						  <small>Sumár všetkých vašich psov a ich výsledkov.</small>
						</div>
              <div class="col-md-12 animated fadeInLeft">
              <div class="card-deck">
                <div class="card border-dark mb-3 center" >
                  <div class="card-header">Moji psy</div>
                  <div class="card-body text-dark">
                    <h5 class="card-title">Spravovať psov</h5>
                    <img src="/views/dashboard/img/dogs128.png" class="img-fluid" alt="MyDogs">
                    <p class="card-text">V tejto sekcii si viete pridať nového psa a prezrieť prehľad všetkých vašich psov.</p>
                    <div class="center">
                      <a class="btn btn-success" href="dogs">Kliknite sem</a>
                    </div>
                  </div>
                </div>  
                <div class="card border-dark mb-3 center">
                  <div class="card-header">Moje ocenenia</div>
                  <div class="card-body text-dark">
                    <h5 class="card-title">Spravovať ocenenia</h5>
                    <img src="/views/dashboard/img/winner128.png" class="img-fluid" alt="MyAwards">
                    <p class="card-text">Ak máte na DogChamp registrovaného psa, môžete si vložiť nové ocenenie z výstav.</p>
                    <div class="center">
                      <a  href="awards" class="btn btn-success">Kliknite sem</a>
                    </div>
                  </div>
                </div>
                <div class="card border-dark mb-3 center">
                  <div class="card-header">Centrum článkov </div>
                  <div class="card-body text-dark">
                    <h5 class="card-title">Blog, články a príbehy</h5>
                    <img src="/views/dashboard/img/blog128.png" class="img-fluid" alt="MyDashboard">
                    <p class="card-text">Centrum pre vaše články a články ostatných členov DogChamp</p>
                    <div class="center">
                      <a class="btn btn-success" href="/article">Kliknite sem</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
            <div class="row animated fadeInRight mb-5">
              <div class="col-md-4 center mt-5">      
                <img src="/views/dashboard/img/score128.png" class="img-fluid mt-2" alt="MyDogs">
                <h4>Vás počet bodov</h4>
                <p>Počet získaných bodov: <?=$this->points?></p>
              </div>
              <div class="col-md-4 center mt-5">        
                <img src="/views/dashboard/img/competition128.png" class="img-fluid mt-2" alt="Competitions">
                <h4>Počet absolvovanej súťaži</h4>
                <p>Pocet súťaži bodov: <?=$this->competitions?></p>
              </div>
              <div class="col-md-4 center mt-5">        
                <img src="/views/dashboard/img/dogchampscore128.png" class="img-fluid mt-2" alt="DogChampScore">
                <h4>Vaše DogChamp skóre</h4>
                <p>Počet získaných bodov: <?=$this->score?></p>
              </div>
            </div>
          <hr>
          <div class="row">
             <div class="col-md-12 mb-2">
                <h4>Nadchádzajúce súťaže</h4>
             </div>
              <div class="col-md-4">
                <h6>Slovensko</h6>
                <small>Bratislava 22.01.2019</small>
                <br>
                <small>Nitra 18.07.2019</small>
                <br>
                <small>Kosice 13.03.2019</small>
                <br>
                <small>Trnava 25.09.2019</small>
              </div>
              <div class="col-md-4">
                <h6>Europa</h6>
                <small>Madrid 22.01.2019</small>
                <br>
                <small>Maribor 17.10.2019</small>
                <br>
                <small>Rim 27.01.2019</small>
              </div>
              <div class="col-md-4">
                <h6>Svet</h6>
                <small>New York 8.01.2019</small>
                <br>
                <small>Atlanta 14.01.2019</small>
                <br>
                <small>Peking 27.01.2019</small>
              </div>
          </div>


<!-- <script>
  document.getElementById("footer").classList.remove("fixed-bottom");
</script> -->

<script>
  $(function(){
    $.get('dashboard/test',function(o){
      $('#countCompetitions').append(o);
    })
  });
</script>