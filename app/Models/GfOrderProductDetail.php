<?php

namespace App\Models;

class GfOrderProductDetail extends \App\Models\Base\GfOrderProductDetail
{
	protected $fillable = [
		'third_order_id',
		'hangqun_order_id',
		'ordering_channel_id',
		'shop_id',
		'product_name',
		'quantity',
		'price',
		'box_quantity',
		'box_price',
		'pay_type',
		'create_time',
		'update_time'
	];
}
