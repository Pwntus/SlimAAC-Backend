<?php

namespace SlimAAC\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model {
	
	public $timestamps = false;
	
	protected $guarded = ['id'];
}
