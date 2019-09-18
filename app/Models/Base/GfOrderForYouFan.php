<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Sep 2019 16:54:35 +0800.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GfOrderForYouFan
 * 
 * @property int $id
 * @property \Carbon\Carbon $statistics_date
 * @property string $company_name
 * @property string $child_company_name
 * @property int $child_company_id
 * @property int $time_division
 * @property int $order_id
 * @property float $total_price
 * @property float $price
 * @property string $product_name
 * @property int $shop_id
 * @property int $number_of_order
 * @property \Carbon\Carbon $create_time
 * @property \Carbon\Carbon $update_time
 *
 * @package App\Models\Base
 */
class GfOrderForYouFan extends Eloquent
{
	protected $table = 'gf_order_for_you_fan';
	public $timestamps = false;

	protected $casts = [
		'child_company_id' => 'int',
		'time_division' => 'int',
		'order_id' => 'int',
		'total_price' => 'float',
		'price' => 'float',
		'shop_id' => 'int',
		'number_of_order' => 'int'
	];

	protected $dates = [
		'statistics_date',
		'create_time',
		'update_time'
	];
}
