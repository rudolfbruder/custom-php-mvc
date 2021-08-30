<?php
	$url = isset($_GET['url']) ? $_GET['url'] : null;
	$url = rtrim($url, '/');
	$url = explode("/", $url);
	$selector = $url[2];
	$validator = $url[3];

	if (empty($selector) || empty($validator)) {
		echo "Nemozem vam zresetovat heslo";
	}else{
		if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false ) {
			?>
				<body>
					<div class="container mt-5">
						<div class="row">
							<div class="col-md-4 offset-md-4">
								<form action="/account/setPassword/<?=$selector?>/<?=$validator?>" method="post" class="needs-validation"novalidate>
									<div class="col-md-10 offset-md-1 mb-3 mt-2">
									<input type="hidden" name="selector" value="<?php echo $selector?>">
									<input type="hidden" name="validator" value="<?php echo $validator?>">
					                <label for="newPwd" class="mt-2">Vaše heslo</label>
					                <input type="password" name="newPwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control" id="newPwd" placeholder="Heslo" required>
					                  <div class="invalid-tooltip">
					                    Zadajte nové heslo.
					                  </div>
					                 </div>
					                 <div class="col-md-10 offset-md-1 mb-3 mt-2">
					                <label for="newPwdVerif" class="mt-2">Vaše heslo</label>
					                <input type="password" name="newPwdVerif" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control" id="newPwdVerif" placeholder="Heslo znova" required>
					                  <div class="invalid-tooltip">
					                    Zadajte znova nové heslo.
					                  </div> 
					              </div>
									<div class="text-center mt-3">
										<a href="/account/setPassword/<?=$selector?>/<?=$validator?>"><button type="submit" name="pwdsubmit" class="btn btn-success">Zmeniť heslo</button></a>
									</div>
								</form>
							</div>
						</div>
					</div>
			<?php
		}
		else{
			echo "error";
		}
	}
?>