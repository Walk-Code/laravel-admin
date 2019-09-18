<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Sep 2019 16:54:35 +0800.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GfOrderForMeican
 * 
 * @property int $id
 * @property int $order_id
 * @property \Carbon\Carbon $close_time
 * @property \Carbon\Carbon $post_box_time
 * @property string $company_name
 * @property string $client_name
 * @property string $mobile_number
 * @property string $address
 * @property string $meal_name
 * @property int $number_of_copies
 * @property float $total_price
 * @property float $price
 * @property int $shop_id
 * @property \Carbon\Carbon $create_time
 * @property \Carbon\Carbon $update_time
 *
 * @package App\Models\Base
 */
class GfOrderForMeican extends Eloquent
{
	protected $table = 'gf_order_for_meican';
	public $timestamps = false;

	protected $casts = [
		'order_id' => 'int',
		'number_of_copies' => 'int',
		'total_price' => 'float',
		'price' => 'float',
		'shop_id' => 'int'
	];

	protected $dates = [
		'close_time',
		'post_box_time',
		'create_time',
		'update_time'
	];
}
