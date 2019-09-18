<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Sep 2019 16:54:35 +0800.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GfOrderingChannel
 * 
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $type
 * @property \Carbon\Carbon $create_time
 * @property \Carbon\Carbon $update_time
 *
 * @package App\Models\Base
 */
class GfOrderingChannel extends Eloquent
{
	protected $table = 'gf_ordering_channel';
	public $timestamps = false;

	protected $casts = [
		'type' => 'int'
	];

	protected $dates = [
		'create_time',
		'update_time'
	];
}
