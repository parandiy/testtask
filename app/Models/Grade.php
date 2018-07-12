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

	public function car()
	{
		return $this->belongsTo( 'App\Models\Car' );
	}

	public function specifications_list()
	{
		$specifications = $this->specifications()
		                       ->with( [ 'specification_name', 'specification_name.category' ] )
		                       ->get();


		$data = [];
		foreach ( $specifications as $specification )
		{
			$c_key = $specification->specification_name->category->id;
			if ( !array_key_exists( $c_key, $data ) )
			{
				$data[$c_key] = [
					'name'  => $specification->specification_name->category->name,
					'names' => []
				];
			}

			$n_key = $specification->specification_name->id;
			if ( !array_key_exists( $n_key, $data[$c_key]['names'] ) )
			{
				$data[$c_key]['names'][$n_key] = [
					'name'  => $specification->specification_name->name,
					'value' => $specification->name
				];
			}
		}

		return $data;
	}
}
