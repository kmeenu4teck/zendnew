<?php
require_once 'Zend/Controller/Plugin/Abstract.php';
require_once 'Zend/Controller/Front.php';
require_once 'Zend/Controller/Request/Abstract.php';
require_once 'Zend/Controller/Action/HelperBroker.php';

class Initializer extends Zend_Controller_Plugin_Abstract{
		protected static $_config;
		protected $_env;
		protected $_front;
		protected $_root;
		public function __construct($env,$root=null){
			$this->_setEnv($env);
			if(null === $root){
				$root = realpath(dirname(__FILE__).'/../');
			}
			$this->_root = $root;
			$this->initPhpConfig();
			$this->_front = Zend_Controller_Front::getInstance();
			if($env == 'test'){
				error_reporting(E_ALL | E_STRICT);
				ini_set('display_startup_errors',1);
				ini_set('display_errors',1);
				$this->_front->throwExceptions(true);	
			}		
		}
		protected function _setEnv($env){
			$this->_env = $env;	
		}
		public function initPhpConfig(){}
		public function routeStartup(Zend_Controller_Request_Abstract $request){
			$this->initDb();	
			$this->initHelpers();
			$this->initView();
			$this->initPlugins();
			$this->initRoutes();
			$this->initControllers();
		}
		public function initDb(){}
		public function initHelpers(){
			Zend_Controller_Action_HelperBroker::addPath('../application/default/helpers','Zend_Controller_Action_Helper');	
		}
		public function initView(){
				Zend_Layout::startMvc(array(
					'layoutPath' => $this->_root.'/application/default/layouts',
					'layout' => 'main'				
				));
		}
		public function initPlugins(){}
		public function initRoutes(){}
		public function initControllers(){
			$this->_front->addControllerDirectory($this->_root.'/application/default/controllers','default');	
		}
}
?>