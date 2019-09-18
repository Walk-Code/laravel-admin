<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Sep 2019 16:54:35 +0800.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GfOrderProductDailyReport
 * 
 * @property int $id
 * @property string $statistics_date
 * @property int $shop_id
 * @property int $ordering_channel_id
 * @property string $product_name
 * @property float $sales_number
 * @property float $number_of_gifts
 * @property float $number_of_refunds
 * @property float $number_of_meals
 * @property float $discard_number
 * @property float $number_of_products
 * @property \Carbon\Carbon $create_time
 * @property \Carbon\Carbon $update_time
 *
 * @package App\Models\Base
 */
class GfOrderProductDailyReport extends Eloquent
{
	protected $table = 'gf_order_product_daily_report';
	public $timestamps = false;

	protected $casts = [
		'shop_id' => 'int',
		'ordering_channel_id' => 'int',
		'sales_number' => 'float',
		'number_of_gifts' => 'float',
		'number_of_refunds' => 'float',
		'number_of_meals' => 'float',
		'discard_number' => 'float',
		'number_of_products' => 'float'
	];

	protected $dates = [
		'create_time',
		'update_time'
	];
}
