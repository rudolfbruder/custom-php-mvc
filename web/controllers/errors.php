<?php
	class Errors extends Controller {

		function __construct() {
			parent::__construct();
		}

		function index(){
			$this->view->render('errors/index',false);
		}

		function error()
		{
			$this->view->render('errors/error',false);
		}
	}
?>