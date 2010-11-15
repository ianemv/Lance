<?php

	require_once APP.'libs'.DS.'super_router.php';

	#SuperRouter::plugins();

	#if (!isInstalled()) {
	#	SuperRouter::connect('/', array('plugin' => 'install', 'controller' => 'wizard'));
	#}
	
	// Basic
	SuperRouter::connect('/admin', array('admin' => true, 'controller' => 'dashboard'));

	// Pages
	SuperRouter::connect('/', array('controller' => 'donations', 'action' => 'index', 'home'));
	SuperRouter::connect('/pages/:slug', array('controller' => 'pages', 'action' => 'view'), array('pass' => array('slug'))); 
	SuperRouter::connect('/contacto', array('controller' => 'pages', 'action' => 'contact'));
    SuperRouter::connect('/proyecto', array('controller' => 'pages', 'action' => 'view', 'proyecto'));
    SuperRouter::connect('/prensa', array('controller' => 'pages', 'action' => 'view', 'prensa'));
    SuperRouter::connect('/difunde', array('controller' => 'pages', 'action' => 'view', 'difunde'));
    SuperRouter::connect('/plazas', array('controller' => 'plazas', 'action' => 'index')); 
    SuperRouter::connect('/como', array('controller' => 'pages', 'action' => 'view', 'como'));
	
    // Users
	SuperRouter::connect('/register', array('controller' => 'users', 'action' => 'register'));
	SuperRouter::connect('/login', array('controller' => 'users', 'action' => 'login'));  
	SuperRouter::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
	SuperRouter::connect('/recover', array('controller' => 'users', 'action' => 'recover')); 
	
	SuperRouter::connect('/people/:username', array('controller' => 'accounts', 'action' => 'view'), array('pass' => array('username')));


    SuperRouter::connect('/plazas/count', array('controller' => 'plazas', 'action' => 'count', 'ext' => 'json'), array('pass' => array('id'), 'id' => '[0-9]+'));
	
	Router::parseExtensions('xml','json', 'csv');




