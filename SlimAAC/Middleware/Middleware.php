<?php

namespace SlimAAC\Middleware;

class Middleware {
	protected $ci;
	
	public function __construct($ci) {
		$this->ci = $ci;
	}
	
	public function __get($property) {
		if ($this->ci->{$property}) {
			return $this->ci->{$property};
		}
	}
}
