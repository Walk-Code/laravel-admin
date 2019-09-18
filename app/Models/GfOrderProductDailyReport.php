<?php

namespace App\Models;

class GfOrderProductDailyReport extends \App\Models\Base\GfOrderProductDailyReport
{
	protected $fillable = [
		'statistics_date',
		'shop_id',
		'ordering_channel_id',
		'product_name',
		'sales_number',
		'number_of_gifts',
		'number_of_refunds',
		'number_of_meals',
		'discard_number',
		'number_of_products',
		'create_time',
		'update_time'
	];
}
