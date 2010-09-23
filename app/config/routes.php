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
	SuperRouter::connect('/pages/:slug', array('controller' => 'pages', 'action' => 'view')); 
	SuperRouter::connect('/contacto', array('controller' => 'pages', 'action' => 'contact'));
    SuperRouter::connect('/proyecto', array('controller' => 'pages', 'action' => 'view', 'proyecto'));
    SuperRouter::connect('/prensa', array('controller' => 'pages', 'action' => 'view', 'prensa'));
    SuperRouter::connect('/difunde', array('controller' => 'pages', 'action' => 'view', 'difunde'));
    SuperRouter::connect('/plazas', array('controller' => 'plazas', 'action' => 'index')); 
    SuperRouter::connect('/como', array('controller' => 'pages', 'action' => 'view', 'como'));
	
    // Users
	SuperRouter::connect('/register', array('controller' => 'users', 'action' => 'register'));
	SuperRouter::connect('/login', array('controller' => 'users', 'action' => 'login'));
	SuperRouter::connect('/recover', array('controller' => 'users', 'action' => 'recover'));
	
	Router::parseExtensions('xml','json', 'csv');




