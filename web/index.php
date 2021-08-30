<?php

require_once'config/config.php';
require_once'libs/Session.php';
require_once'libs/Database.php';
require_once'libs/Model.php';
require_once'libs/Bootstrap.php';
require_once'libs/Controller.php';
require_once'libs/View.php';

$bootstrap = new Bootstrap();
$bootstrap->init();

?>