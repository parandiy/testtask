<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade
	extends Model
{
	public $timestamps = FALSE;

	public function features()
	{
		return $this->belongsToMany( 'App\Models\Feature', 'grades_features' );
	}

	public function colors()
	{
		return $this->belongsToMany( 'App\Models\Color', 'grades_colors' );
	}

	public function specifications()
	{
		return $this->belongsToMany( 'App\Models\SpecificationValue',
		                             'grades_specifications',
		                             'grade_id',
		                             'value_id' );
	}
}
