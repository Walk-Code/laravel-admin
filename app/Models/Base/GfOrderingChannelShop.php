<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Sep 2019 16:54:35 +0800.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GfOrderingChannelShop
 * 
 * @property int $id
 * @property int $ordering_channel_id
 * @property int $shop_id
 * @property string $shop_short_name
 * @property int $hangqun_shop_code
 * @property string $address
 * @property string $address_pinxin
 * @property \Carbon\Carbon $create_time
 * @property \Carbon\Carbon $update_time
 * @property int $hangqun_shop_id
 *
 * @package App\Models\Base
 */
class GfOrderingChannelShop extends Eloquent
{
	protected $table = 'gf_ordering_channel_shop';
	public $timestamps = false;

	protected $casts = [
		'ordering_channel_id' => 'int',
		'shop_id' => 'int',
		'hangqun_shop_code' => 'int',
		'hangqun_shop_id' => 'int'
	];

	protected $dates = [
		'create_time',
		'update_time'
	];
}
