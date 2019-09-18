<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Sep 2019 16:54:35 +0800.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GfOrderingChannelDailyReportDetail
 * 
 * @property int $id
 * @property string $statistics_time
 * @property int $ordering_channel_daily_report_id
 * @property string $three_way_user
 * @property int $shop_id
 * @property float $turnover
 * @property int $number_of_order
 * @property float $customer_price
 * @property float $shipping_fee
 * @property float $box_fee
 * @property float $actual_harvest
 * @property float $other_fee
 * @property \Carbon\Carbon $create_time
 * @property \Carbon\Carbon $update_time
 *
 * @package App\Models\Base
 */
class GfOrderingChannelDailyReportDetail extends Eloquent
{
	protected $table = 'gf_ordering_channel_daily_report_detail';
	public $timestamps = false;

	protected $casts = [
		'ordering_channel_daily_report_id' => 'int',
		'shop_id' => 'int',
		'turnover' => 'float',
		'number_of_order' => 'int',
		'customer_price' => 'float',
		'shipping_fee' => 'float',
		'box_fee' => 'float',
		'actual_harvest' => 'float',
		'other_fee' => 'float'
	];

	protected $dates = [
		'create_time',
		'update_time'
	];
}
