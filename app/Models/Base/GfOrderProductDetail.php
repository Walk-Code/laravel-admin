<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Sep 2019 16:54:35 +0800.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GfOrderProductDetail
 * 
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property int $third_order_id
 * @property string $hangqun_order_id
 * @property int $ordering_channel_id
 * @property int $shop_id
 * @property string $product_name
 * @property int $quantity
 * @property float $price
 * @property float $box_quantity
 * @property float $box_price
 * @property int $pay_type
 * @property \Carbon\Carbon $create_time
 * @property \Carbon\Carbon $update_time
 *
 * @package App\Models\Base
 */
class GfOrderProductDetail extends Eloquent
{
	protected $table = 'gf_order_product_detail';
	public $timestamps = false;

	protected $casts = [
		'third_order_id' => 'int',
		'ordering_channel_id' => 'int',
		'shop_id' => 'int',
		'quantity' => 'int',
		'price' => 'float',
		'box_quantity' => 'float',
		'box_price' => 'float',
		'pay_type' => 'int'
	];

	protected $dates = [
		'create_time',
		'update_time'
	];
}
