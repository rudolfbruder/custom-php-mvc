<?php
	class Bootstrap
	{
		private $_url = null;
		private $_controller = null;

		public function init()
		{

			$this->_getUrl();

			if (empty($this->_url[0])) {
				$this->_loadDefaultController();
			}

			$this->_loadExistingController();
			$this->_loadControllerMethods();

		}
		/**
		 * Loads 404 page when link does not exists
		 */
		private function _loadNotFound()
		{
			require_once 'controllers/errors.php';
			$this->_controller = new Errors();
			$this->_controller->index();
			return false;
		}

		/**
		 * Loads default controller - homepage
		 */
		private function _loadDefaultController()
		{
			require_once 'controllers/index.php';
			$this->_controller = new Index();
			$this->_controller->index();
			return false;
		}

		/**
		 * Splits url from browser
		 	[0] = controller
		 	[1] = model
		 	[2-x] = parameters
		 */
		private function _getUrl()
		{
			$this->_url = isset($_GET['url']) ? $_GET['url'] : null;
			$this->_url = rtrim($this->_url, '/');
			$this->_url = explode("/", $this->_url);
		}
		/**
		 * Loads existing controller, needed to run before _loadControllerMethods()
		 */
		private function _loadExistingController()
		{
			$file = 'controllers/' . $this->_url[0] . '.php';

			if (file_exists($file)) {
				require $file;
				$this->_controller = new $this->_url[0];
				$this->_controller->loadModel($this->_url[0]);
			}else{
				$this->_loadNotFound();
				return false;
			}
		}
		/**
		 * Loads controller and methods based on the number of items in url separated by / from _getUrl()
		 */
		private function _loadControllerMethods()
		{
			$lenght = count($this->_url);
			if ($lenght > 1) {
				if (!method_exists($this->_controller, $this->_url[1])) {
					$this->_loadNotFound();
				}
			}

			switch ($lenght) {
				case 5:
					$this->_controller->{$this->_url[1]}($this->_url[2],$this->_url[3],$this->_url[4],$this->_url[5]);
					break;
				case 4:
					$this->_controller->{$this->_url[1]}($this->_url[2],$this->_url[3],$this->_url[4]);
					break;
				case 3:
					$this->_controller->{$this->_url[1]}($this->_url[2],$this->_url[3]);
					break;
				case 2:
					$this->_controller->{$this->_url[1]}($this->_url[2]);
					break;
				default:
					$this->_controller->index();
					break;
			}
		}
	}
?>