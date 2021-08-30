<?php
	class Index extends Controller {

		function __construct() {
			parent::__construct();
		}

		function index(){
			$this->view->render('index/index',false);
		}

		function aboutus(){
			$this->view->render('index/about_us',false);
		}

		function about(){
			$this->view->render('index/about',false);
		}

		function contact()
		{
			$this->view->render('index/contact',false);
		}

		function sendMail(){

			$this->model->sendEmail();
		}

		function unauthorized()
		{
			$this->view->render('index/unauthorized_access',false);
		}
		
	}
?>