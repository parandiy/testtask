<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecificationCategory extends Model
{
	protected $table = 'specifications_categories';

	public $timestamps = FALSE;


	public function names()
	{
		return $this->hasMany( 'App\Models\SpecificationName' );
	}
}
