<?php

namespace SlimAAC\Controllers;

use \Firebase\JWT\JWT;
use SlimAAC\Models\Account;

class OAuthController extends Controller {
	
	/* Generate token */
	public function post($request, $response) {
		$name = $request->getParam('name');
		$password = $request->getParam('password');
		
		/* Check credentials */
		$account = Account::where('name', $name)->where('password', $password)->first();
		if (!$account)
			throw new \Exception('Invalid credentials.', 401);
		
		$token = [
			'name' => $name,
		];
		
		$jwt = JWT::encode($token, $this->ci->get('settings')['oauth']['secret']);
		
		return $response->withJson([
			'name' => $account->name,
			'email' => $account->email,
			'token' => $jwt
		]);
	}
}
