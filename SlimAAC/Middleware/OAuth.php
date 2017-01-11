<?php

namespace SlimAAC\Middleware;

use \Firebase\JWT\JWT;

class OAuth extends Middleware {
	
	public function __invoke($request, $response, $next) {
		$this->authUser = NULL;
		
		if (false === $token = $this->fetchToken($request)) {
			return $next($request, $response);
		}
		
		if (false === $decoded = $this->decodeToken($token)) {
			throw new \Exception('Unauthorized.', 401);
		}
		
		$this->ci->authUser = \SlimAAC\Models\Account::where('name', $decoded->name)->first();
		return $next($request, $response);
	}
	
	private function fetchToken($request) {
		$header = $request->getHeader('Authorization');
		$header = isset($header[0]) ? $header[0] : NULL;
		
		if (preg_match('/Bearer\s+(.*)$/i', $header, $matches)) {
			return $matches[1];
		}
		
		return false;
	}
	
	private function decodeToken($token) {
		try {
			return JWT::decode(
				$token,
				$this->ci->get('settings')['oauth']['secret'],
				$this->ci->get('settings')['oauth']['algorithm']
			);
		} catch (Exception $e) {
			return false;
		}
	}
}
