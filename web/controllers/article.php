<?php
	class Article extends Controller {

		function __construct() {
			parent::__construct();
		}

		function index()
		{
			$this->view->newestArticles = $this->model->loadNewestArticles(1);
			$this->view->pageInfo = $this->model->getPageNumber();
			$this->view->totalCount = $this->model->getTotalArticlesCount();
			$this->view->myPreviewsCount = $this->model->getMyPreviewsCount();
			$this->view->myArticleCount = $this->model->getMyArticleCount();
			$this->view->myFavouritesCount = $this->model->getMyFavouritesCount();
			$this->view->render('article/index');
		}

		function showPage($id)
		{
			$this->view->newestArticles = $this->model->loadNewestArticles($id);
			$this->view->pageInfo = $this->model->getPageNumber();
			$this->view->totalCount = $this->model->getTotalArticlesCount();
			$this->view->myPreviewsCount = $this->model->getMyPreviewsCount();
			$this->view->myArticleCount = $this->model->getMyArticleCount();
			$this->view->myFavouritesCount = $this->model->getMyFavouritesCount();
			$this->view->render('article/index');
		}

		function new()
		{
			$this->view->render('article/new');
		}

		function myArticles()
		{
			$this->view->myArticles = $this->model->listMyArticles();
			$this->view->render('article/my_articles');
		}

		function loadArticle($id)
		{
			$this->view->article = $this->model->loadArticle($id);
			$this->view->render('article/article');
		}

		function preview($id)
		{
			$this->view->article = $this->model->loadArticlePreview($id);
			$this->view->render('article/preview_article');
		}
		/* Methods */
		function createPreview()
		{
			$this->model->createPreview();
		}

		function updatePreview()
		{

		}

		function deletePreview()
		{

		}

		function create($id)
		{
			$this->model->create($id);
		}

		function update()
		{

		}

		function delete($id)
		{
			$this->model->delete($id);
		}
		

		function uploadImage()
		{
			$this->model->uploadImage();
		}

	}
?>
