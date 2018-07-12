<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecificationName
	extends Model
{
	protected $table = 'specifications_names';

	public $timestamps = FALSE;


	public function category()
	{
		return $this->belongsTo( 'App\Models\SpecificationCategory' );
	}


	public function values()
	{
		return $this->hasMany( 'App\Models\SpecificationValue' );
	}
}
