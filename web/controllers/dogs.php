<?php
	class Dogs extends Controller {

		function __construct()
		{
			parent::__construct();
		}

		function index()
		{
			$this->view->render('dogs/index');
		}

		function create()
		{
			$this->view->races = $this->model->getRaces();
			$this->view->render('dogs/create');
		}

		function createDog()
		{
			$this->model->createDog();
		}
		function update($id)
		{
			$this->model->update($id);
		}

		function myDogs()
		{
			$this->view->myDogs = $this->model->getMyDogs();
			$this->view->render('dogs/mydogs');
		}

		function edit($id)
		{
			$this->view->races = $this->model->getRaces();
			$this->view->dogDetails = $this->model->getDetails($id);
			$this->view->render('dogs/edit');
		}

		function deleteDog()
		{
			$this->model->deleteDog($id);
		}

		function success($id)
		{
			$this->view->exists = $this->model->successCheck($id);
			$this->view->render('dogs/success');
		}
	}
?>
