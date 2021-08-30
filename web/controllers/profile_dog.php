<?php
	class Profile_Dog extends Controller {

		function __construct() 
		{
			parent::__construct();
		}

		function index($id)
		{
			$this->view->exists = $this->model->profileExists($id);
			if (isset($this->view->exists)) {
				$this->view->awards = $this->model->getProfileAwards($id);
				$this->view->compCount = $this->model->getCompetitionsCount($id);
				$this->view->points = $this->model->getPointsCount($id);
				$this->view->details = $this->model->getProfileInfo($id);
				$this->view->render('profile_dog/index');
			}else{
				$this->view->render('profile_dog/not_found');
			}
		}
	}
?>