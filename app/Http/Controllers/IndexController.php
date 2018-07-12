<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Color;
use App\Models\Feature;
use App\Models\Grade;
use App\Models\SpecificationCategory;
use App\Models\SpecificationName;
use App\Models\SpecificationValue;

class IndexController
	extends Controller
{
	public function index()
	{
		$makes = Car::select( 'id', 'title' )
		            ->get();

		return view( 'index', [ 'makes' => $makes ] );
	}

	public function grades( $car_id )
	{
		$grades = Grade::select( 'id', 'title' )
		               ->where( 'car_id', $car_id )
		               ->get();

		return json_encode( $grades );
	}

	public function get_grade( $grade_id )
	{
		$grade = Grade::find( $grade_id );

		return view( 'details',
		             [
			             'grade' => $grade
		             ] );
	}

	public function push()
	{
		set_time_limit( 0 );

		$source_url = 'http://toyota-credit.360d.ru/cars/Models/all.json';

		$data   = file_get_contents( $source_url );
		$parsed = json_decode( $data, 1 );


		foreach ( $parsed as $k_model => $v_model )
		{
			$v_model = array_shift( $v_model );

			$car            = new Car();
			$car->remote_id = $v_model['id'];
			$car->title     = $v_model['title'];
			$car->sprite    = $v_model['sprite'];
			$car->image     = $v_model['image'];
			$car->link      = $v_model['link'];
			$car->save();


			foreach ( $v_model['grades'] as $k_grade => $v_grade )
			{
				$grade                = new Grade();
				$grade->car_id        = $car['id'];
				$grade->remote_id     = $v_grade['id'];
				$grade->title         = $v_grade['title'];
				$grade->engine_desc   = $v_grade['engine_desc'];
				$grade->wheeldrive    = $v_grade['wheeldrive'];
				$grade->price         = $v_grade['price'];
				$grade->pricediscount = $v_grade['pricediscount'];
				$grade->engine        = $v_grade['engine'];
				$grade->transmission  = $v_grade['transmission'];
				$grade->body          = $v_grade['body'];
				$grade->save();

				foreach ( $v_grade['features'] as $feature_name )
				{
					$feature = Feature::where( 'name', '=', $feature_name )
					                  ->first();
					if ( !$feature )
					{
						$feature       = new Feature();
						$feature->name = $feature_name;
						$feature->save();
					}
					$grade->features()
					      ->attach( $feature->id );

					$grade->save();
				}

				foreach ( $v_grade['colors'] as $v_color )
				{

					$color = Color::where( 'title', '=', $v_color['title'] )
					              ->where( 'type', '=', $v_color['type'] )
					              ->where( 'rgb', '=', $v_color['rgb'] )
					              ->where( 'code', '=', $v_color['code'] )
					              ->first();

					if ( !$color )
					{
						$color            = new Color();
						$color->remote_id = $v_color['id'];
						$color->rgb       = $v_color['rgb'];
						$color->code      = $v_color['code'];
						$color->title     = $v_color['title'];
						$color->type      = $v_color['type'];
						$color->price     = $v_color['price'];
						$color->swatch    = $v_color['swatch'];
						$color->image     = $v_color['image'];
						$color->save();
					}

					$grade->colors()
					      ->attach( $color->id );
				}

				foreach ( $v_grade['technicalSpecification'] as $v_specification )
				{
					$category = SpecificationCategory::where( 'name', $v_specification['type'] )
					                                 ->first();
					if ( !$category )
					{
						$category       = new SpecificationCategory();
						$category->name = $v_specification['type'];
						$category->save();
					}

					$specification_name = SpecificationName::where( 'name', $v_specification['title'] )
					                                       ->first();
					if ( !$specification_name )
					{
						$specification_name              = new SpecificationName();
						$specification_name->name        = $v_specification['title'];
						$specification_name->category_id = $category->id;
						$specification_name->save();
					}

					$specification_value = SpecificationValue::where( 'name', $v_specification['details'] )
					                                         ->where( 'specification_id', $specification_name->id )
					                                         ->first();
					if ( !$specification_value )
					{
						$specification_value                   = new SpecificationValue();
						$specification_value->name             = $v_specification['details'];
						$specification_value->specification_id = $specification_name->id;
						$specification_value->save();
					}

					$grade->specifications()
					      ->attach( $specification_value->id, [ 'name_id' => $specification_name->id ] );
				}
			}
		}

		echo 'Done!';
	}
}
