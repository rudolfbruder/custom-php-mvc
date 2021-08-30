<?php
	class Account extends Controller {

		function __construct() 
		{
			parent::__construct();
		}

		function index()
		{
			$this->view->render('contact/index');
		}

		function login()
		{
			$this->model->login();
		}

		function logout()
		{
			$this->model->logout();
		}

		function register()
		{
			$this->model->registerNewUser();
		}

		function verify($vkey)
		{
			$this->model->verifyAccount($vkey);
		}

		function passwordreset()
		{
			$this->model->passwordReset();
		}

		function setPassword($validator,$selector)
		{
			$this->model->setPassword($validator,$selector);

		}

		function setNewPassword()
		{
			$this->view->render('account/set_password',false);
		}

		function verifySuccess()
		{
			$this->view->render('account/verif_success',false);
		}

		function resetinfo()
		{
			$this->view->render('account/resetinfo',false);
		}
	}
?>
