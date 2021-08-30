<?php

class View
{
	
	function __construct()
	{
		
	}

	public function render($name,$member = true,$noInclude = false){

		if ($noInclude == true) {
			if ($member == false) {
				
			}else{
				if (isset($_SESSION['u_id'])) {
					require_once 'views/' . $name . '.php';
				}else{
					require_once 'views/unauthorized_access.php';
				}
			}
			
		}else{
			require_once 'views/header.php';
			if ($member == false) {
				require_once 'views/' . $name . '.php';
			}else{

				if (isset($_SESSION['u_id'])) {
					require_once 'views/' . $name . '.php';
				}else{
					require_once 'views/index/unauthorized_access.php';
				}
			}
			require_once 'views/footer.php';
		}
	}
}
?>