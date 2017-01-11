<?php

/* News */
$app->group(ROUTES_PREFIX . '/news', function () {
	
	$this->get('', 'SlimAAC\Controllers\NewsController');
});

/* OAuth */
$app->group(ROUTES_PREFIX . '/oauth', function () {
	$this->post('', 'SlimAAC\Controllers\OAuthController:post');
});

/* Accounts */
$app->group(ROUTES_PREFIX . '/account', function () {
	
	$this->get('', '');
	$this->post('', 'SlimAAC\Controllers\AccountController:post');
	
	$this->get('/my', '');
	$this->get('/my/players', '');
	$this->post('/my/lost', '');
	
	$this->get('/{id:[0-9]+}', '');
	$this->put('/{id:[0-9]+}', '');
	$this->delete('/{id:[0-9]+}', '');
	
	$this->get('/{id:[0-9]+}/ban', '');
	$this->post('/{id:[0-9]+}/ban', '');
	$this->put('/{id:[0-9]+}/ban', '');
	$this->delete('/{id:[0-9]+}/ban', '');
	$this->get('/{id:[0-9]+}/banHistory', '');
});
