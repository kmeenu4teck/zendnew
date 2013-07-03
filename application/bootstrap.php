<?php
set_include_path('.' . PATH_SEPARATOR . '../library' . PATH_SEPARATOR . '../application/default/models' . PATH_SEPARATOR . get_include_path());
require_once 'Initializer.php';
require_once 'Zend/Loader.php';
Zend_Loader::registerAutoload();
$frontController = Zend_Controller_Front::getInstance();
$frontController->registerPlugin(new Initializer('development'));
$frontController->dispatch();
?>