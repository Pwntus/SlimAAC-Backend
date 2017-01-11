<?php

namespace SlimAAC\Middleware;

class Cors extends Middleware {
	
	public function __invoke($request, $response, $next) {
		$response = $next($request, $response);
		return $response
			->withHeader('Access-Control-Allow-Origin', CORS_ALLOW_ORIGIN)
			->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
			->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
	}
}
