<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Sep 2019 16:54:35 +0800.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GfDownloadTask
 * 
 * @property int $id
 * @property string $download_date
 * @property int $shop_id
 * @property int $ordering_channel_id
 * @property string $download_url
 * @property string $local_path
 * @property \Carbon\Carbon $create_time
 * @property \Carbon\Carbon $update_time
 *
 * @package App\Models\Base
 */
class GfDownloadTask extends Eloquent
{
	protected $table = 'gf_download_task';
	public $timestamps = false;

	protected $casts = [
		'shop_id' => 'int',
		'ordering_channel_id' => 'int'
	];

	protected $dates = [
		'create_time',
		'update_time'
	];
}
