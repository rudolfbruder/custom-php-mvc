<?php
	class Awards extends Controller {

		function __construct() {
			parent::__construct();
		}

		function index(){
			$this->view->render('awards/index');
		}

		function new(){
			$this->view->awardsTypes = $this->model->getAwardsOptions();
			$this->view->competitions = $this->model->getCompetitions();
			$this->view->dogs = $this->model->getDogs();
			$this->view->render('awards/new');
		}

		function myAwards()
		{

			$this->view->competitions = $this->model->getCountOfCompetitions();
			$this->view->score = $this->model->getScore();
			$this->view->points = $this->model->getPoints();
			$this->view->myawards = $this->model->getMyAwards();
			$this->view->render('awards/myawards');
		}

		function leaderboard(){
			$this->view->awardCount = $this->model->getAwardCount();
			$this->view->usersCount = $this->model->getUserCount();
			$this->view->dogCount = $this->model->getDogCount();
			$this->view->bestDogs = $this->model->getLeaderboardBestDogs();
			$this->view->bestUsers = $this->model->getLeaderboardBestMembers();
			$this->view->render('awards/leaderboard');
		}

		function create()
		{
			$this->model->create();
		}

		function edit($id)
		{
			$this->view->awardsTypes = $this->model->getAwardsOptions();
			$this->view->competitions = $this->model->getCompetitions();
			$this->view->dogs = $this->model->getDogs();
			$this->view->awardDetails = $this->model->getDetails($id);
			$this->view->render('awards/edit');
		}

		function update($id)
		{
			$this->model->update($id);
		}

		function delete()
		{

			$this->model->delete();
		}
	}
?>