<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
	public $timestamps = FALSE;

	public function grades()
	{
		return $this->belongsToMany('App\Models\Grade', 'grades_features');
	}
}
