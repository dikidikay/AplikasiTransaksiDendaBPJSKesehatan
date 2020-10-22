<?php

class Default_Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initAutoload() 
	{
		$modelLoader = new Zend_Application_Module_Autoloader(array(
				'namespace' => '',
				'basePath' => APPLICATION_PATH.'/modules/default'));
		
	/*
		if(Zend_Auth::getInstance()->hasIdentity()) {
			Zend_Registry::set('role', Zend_Auth::getInstance()->getStorage()->read()->role);
		} else {
			Zend_Registry::set('role', 'guests');
		}
	
		$this->_acl = new Model_LibraryAcl;
		$this->_auth = Zend_Auth::getInstance();
	
		$fc = Zend_Controller_Front::getInstance();
		$fc->registerPlugin(new Plugin_AccessCheck($this->_acl));
	*/
		return $modelLoader;
	}
	
	protected function _initView()
	{
		// Initialize view
		$view = new Zend_View();
		$view->doctype('XHTML1_STRICT');
		$view->headTitle('MUP CLIENT');
	
		// Add it to the ViewRenderer
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
				'ViewRenderer'
		);
		$viewRenderer->setView($view);
	
		// Return it, so that it can be stored by the bootstrap
		return $view;
	}
	
	protected function _initPlugins()
	{
		// Access plugin
		$this->bootstrap('frontcontroller');
		$fc = $this->getResource('frontcontroller');
		$fc->registerPlugin(new Plugins_Layout());
	}
	
	
	protected function _initDB()    {
	    $db = $this->getPluginResource( 'db')->getDbAdapter();
	    Zend_Registry::set ('db', $db);
	}
	
	
	

	
	
}

