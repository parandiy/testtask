<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecificationValue
	extends Model
{
	protected $table = 'specifications_values';

	public $timestamps = FALSE;


	public function specification_name()
	{
		return $this->belongsTo( 'App\Models\SpecificationName', 'specification_id' );
	}


	public function grades()
	{
		return $this->belongsToMany( 'App\Models\Grade',
		                             'grades_specifications',
		                             'value_id',
		                             'grade_id' );
	}
}
