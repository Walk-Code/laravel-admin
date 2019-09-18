<?php

namespace App\Models;

class GfOrderForYouFan extends \App\Models\Base\GfOrderForYouFan
{
	protected $fillable = [
		'statistics_date',
		'company_name',
		'child_company_name',
		'child_company_id',
		'time_division',
		'order_id',
		'total_price',
		'price',
		'product_name',
		'shop_id',
		'number_of_order',
		'create_time',
		'update_time'
	];
}
