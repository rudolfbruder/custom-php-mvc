	<?php
	class Dashboard extends Controller {

		function __construct() {
			parent::__construct();
		}

		function index(){
			$this->view->competitions = $this->model->getCountOfCompetitions();
			$this->view->score = $this->model->getScore();
			$this->view->points = $this->model->getPoints();
			$this->view->render('dashboard/index');


		}

		function getPoints(){
			$this->model->getPoints();
		}

		function search()
		{
			$searchResults = $this->model->search();
			if (isset($searchResults) && count($searchResults)>0) {
				foreach ($searchResults as $object) {
					if ($object->type == 'Person') {
						echo " <option class='opt' data-value=".URL."profile/index/".$object->id.">" .$object->name."</option>"; 
					}elseif ($object->type == 'Dog') {
						echo " <option class='opt' data-value=".URL."profile_dog/index/".$object->id.">" .$object->name."</option>"; 
					}else{
						echo " <option class='opt' data-value=".URL."competition/index/".$object->id.">" .$object->name."</option>"; 
					}

				}
			}

		}
	}
?>
