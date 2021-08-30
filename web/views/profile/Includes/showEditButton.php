<?php
	session_start();
	if(isset($_SESSION['u_id'])) {
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = explode("/", $url);
		$userId = $_SESSION['u_id'];
		$browseUserId = $url[2];
		if ($userId == $browseUserId) {
			?>
					<div class="col-md-1  text-center text-md-right">
						<a href="/profile/edit" class="btn btn-success">Upraviť</a>
					</div>
			<?php
		}
	}
?>