<?php
	class Profile extends Controller {

		function __construct() {
			parent::__construct();
		}

		function index($id){
			$this->view->exists = $this->model->profileExists($id);
			if (isset($this->view->exists)) {
				$this->view->awards = $this->model->getProfileAwards($id);
				$this->view->myDogs = $this->model->getProfileDogs($id);
				$this->view->compCount = $this->model->getCompetitionsCount($id);
				$this->view->pointsCount = $this->model->getPointsCount($id);
				$this->view->profileInfo = $this->model->getProfileInfo($id);
				$this->view->articles = $this->model->getArticles($id);
				$this->view->profileId = $id;
				$this->view->render('profile/index');
			}else{
				$this->view->render('profile/not_found');
			}

		}

		function edit()
		{
			$this->view->user = $this->model->getDetails();
			$this->view->render('profile/edit');
		}

		function updateProfile()
		{
			$this->model->updateProfile();
		}

	}
?>