<?php
require_once 'Zend/Controller/Action.php';
class AccountController extends Zend_Controller_Action{
	public function newAction(){
		$form = new Zend_Form();
		$form->setAction('success');
		$form->setMethod('post');
		$this->view->form = $form;	
	}	
}
?>