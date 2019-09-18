<?php

namespace App\Models;

class GfOrderForElm extends \App\Models\Base\GfOrderForElm
{
	protected $fillable = [
		'order_id',
		'shop_name',
		'shop_id',
		'city_name',
		'order_created_at',
		'order_completed_time',
		'active_at',
		'pay_type',
		'order_status',
		'reason_for_invalid_order',
		'booking_form',
		'scheduled_delivery_time',
		'activity_at',
		'product_information',
		'original_price',
		'product_price',
		'package_fee',
		'shipping_fee',
		'merchant_activity_subsidy_amount',
		'merchant_coupon_subsidy_amount',
		'merchant_distribution_subsidy_amount',
		'elm_subsidy_amount',
		'user_payment_amount',
		'create_time',
		'update_time'
	];
}
