<?php
require 'vendor/autoload.php';
require 'SlimAAC/Helpers/functions.php';

/* Load TFS config */
$tfsConfig = parseTFSConfig();

/* Init app */
$app = new \Slim\App([
	'settings' => [
		'displayErrorDetails' => ENABLE_DEBUG,
		'addContentLengthHeader' => false,
		'db' => [
			'driver' => 'mysql',
			'host' => $tfsConfig['mysqlHost'],
			'database' => $tfsConfig['mysqlDatabase'],
			'username' => $tfsConfig['mysqlUser'],
			'password' => $tfsConfig['mysqlPass'],
			'charset' => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix' => ''
		],
		'oauth' => [
			'secret' => 'supersecret',
			'algorithm' => ['HS256']
		]
	]
]);

$ci = $app->getContainer();

/* Database */
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($ci->get('settings')['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$ci['db'] = function ($ci) {
	return $capsule;	
};

/* Error handler */
$ci['errorHandler'] = function ($ci) {
	return function ($request, $response, $e) use ($ci) {
		$code = $e->getCode() ? $e->getCode() : 500;
		
		return $ci['response']
			->withHeader('Access-Control-Allow-Origin', CORS_ALLOW_ORIGIN)
			->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
			->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
			->withStatus($code)
			->withJson([
				'status' => $code,
				'message' => $e->getMessage()
			]);
	};
};

/* Middleware */
$app->add(new \SlimAAC\Middleware\Cors($ci));
$app->add(new \SlimAAC\Middleware\OAuth($ci));

/* Routes */
require 'SlimAAC/routes.php';
