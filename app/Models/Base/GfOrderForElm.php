<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Sep 2019 16:54:35 +0800.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GfOrderForElm
 * 
 * @property int $id
 * @property int $order_id
 * @property string $shop_name
 * @property int $shop_id
 * @property string $city_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $order_created_at
 * @property \Carbon\Carbon $order_completed_time
 * @property int $active_at
 * @property string $pay_type
 * @property string $order_status
 * @property string $reason_for_invalid_order
 * @property string $booking_form
 * @property \Carbon\Carbon $scheduled_delivery_time
 * @property string $activity_at
 * @property string $product_information
 * @property float $original_price
 * @property float $product_price
 * @property float $package_fee
 * @property float $shipping_fee
 * @property float $merchant_activity_subsidy_amount
 * @property float $merchant_coupon_subsidy_amount
 * @property float $merchant_distribution_subsidy_amount
 * @property float $elm_subsidy_amount
 * @property float $user_payment_amount
 * @property \Carbon\Carbon $create_time
 * @property \Carbon\Carbon $update_time
 *
 * @package App\Models\Base
 */
class GfOrderForElm extends Eloquent
{
	protected $table = 'gf_order_for_elm';
	public $timestamps = false;

	protected $casts = [
		'order_id' => 'int',
		'shop_id' => 'int',
		'active_at' => 'int',
		'original_price' => 'float',
		'product_price' => 'float',
		'package_fee' => 'float',
		'shipping_fee' => 'float',
		'merchant_activity_subsidy_amount' => 'float',
		'merchant_coupon_subsidy_amount' => 'float',
		'merchant_distribution_subsidy_amount' => 'float',
		'elm_subsidy_amount' => 'float',
		'user_payment_amount' => 'float'
	];

	protected $dates = [
		'order_created_at',
		'order_completed_time',
		'scheduled_delivery_time',
		'create_time',
		'update_time'
	];
}
