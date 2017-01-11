<?php

namespace SlimAAC\Controllers;

use SlimAAC\Models\Account;

class AccountController extends Controller {
	
	/* Register */
	public function post($request, $response) {
		$name = $request->getParam('name');
		$email = $request->getParam('email');
		$password = $request->getParam('password');
		
		/* Name */
		if (!filter_var($name, FILTER_VALIDATE_REGEXP, [
			'options' => ['regexp' => '/^[a-zA-Z0-9]{2,12}$/']	
		]))
			throw new \Exception('Account name must have 2-12 characters.', 400);
		/* Email */
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !getmxrr(explode('@', $email)[1], $trash_))
			throw new \Exception('Email address is not valid.', 400);
		/* Password */
		if (!filter_var($password, FILTER_VALIDATE_REGEXP, [
			'options' => ['regexp' => '/^(.{2,20}|.{40})$/']	
		]))
			throw new \Exception('Password must have 2-20 characters or be an SHA-1 hash (40 hexadecimal characters).', 400);
		/* Existing */
		$account = Account::where('name', $name)->first();
		if ($account)
			throw new \Exception('Account with this name already exists.', 400);
		
		$account = Account::create([
			'name' => $name,
			'email' => $email,
			'password' => $password,
			'creation' => time()
		]);
		
		return $response->withJson($account->toJson());
	}
}
