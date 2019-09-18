<?php

namespace App\Models;

class GfOrderForMeican extends \App\Models\Base\GfOrderForMeican
{
	protected $fillable = [
		'order_id',
		'close_time',
		'post_box_time',
		'company_name',
		'client_name',
		'mobile_number',
		'address',
		'meal_name',
		'number_of_copies',
		'total_price',
		'price',
		'shop_id',
		'create_time',
		'update_time'
	];
}
