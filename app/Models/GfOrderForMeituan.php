<?php

namespace App\Models;

class GfOrderForMeituan extends \App\Models\Base\GfOrderForMeituan
{
	protected $fillable = [
		'order_id',
		'order_send_time',
		'activity_at',
		'shop_name',
		'shop_id',
		'city_name',
		'pay_type',
		'order_status',
		'order_delivery_status',
		'booking_form',
		'original_price',
		'order_discount_amount',
		'order_meituan_activity_price',
		'order_merchant_activity_price',
		'dishes_information',
		'shipping_fee',
		'activity_order',
		'promotions',
		'reminders',
		'reply_status',
		'merchant_reply_content',
		'delivery_time',
		'box_fee',
		'box_sum',
		'order_completion_time',
		'order_completion_reason',
		'create_time',
		'update_time'
	];
}
