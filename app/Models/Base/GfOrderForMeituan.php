<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Sep 2019 16:54:35 +0800.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GfOrderForMeituan
 * 
 * @property int $id
 * @property int $order_id
 * @property \Carbon\Carbon $order_send_time
 * @property string $activity_at
 * @property string $shop_name
 * @property int $shop_id
 * @property string $city_name
 * @property string $pay_type
 * @property string $order_status
 * @property string $order_delivery_status
 * @property string $booking_form
 * @property float $original_price
 * @property float $order_discount_amount
 * @property float $order_meituan_activity_price
 * @property float $order_merchant_activity_price
 * @property string $dishes_information
 * @property float $shipping_fee
 * @property string $activity_order
 * @property string $promotions
 * @property string $reminders
 * @property string $reply_status
 * @property string $merchant_reply_content
 * @property string $delivery_time
 * @property float $box_fee
 * @property int $box_sum
 * @property \Carbon\Carbon $order_completion_time
 * @property string $order_completion_reason
 * @property \Carbon\Carbon $create_time
 * @property \Carbon\Carbon $update_time
 *
 * @package App\Models\Base
 */
class GfOrderForMeituan extends Eloquent
{
	protected $table = 'gf_order_for_meituan';
	public $timestamps = false;

	protected $casts = [
		'order_id' => 'int',
		'shop_id' => 'int',
		'original_price' => 'float',
		'order_discount_amount' => 'float',
		'order_meituan_activity_price' => 'float',
		'order_merchant_activity_price' => 'float',
		'shipping_fee' => 'float',
		'box_fee' => 'float',
		'box_sum' => 'int'
	];

	protected $dates = [
		'order_send_time',
		'order_completion_time',
		'create_time',
		'update_time'
	];
}
