<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Sep 2019 16:54:35 +0800.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GfUser
 * 
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $qq
 * @property string $email
 * @property string $phone
 * @property string $remark
 * @property int $login_num
 * @property \Carbon\Carbon $login_at
 * @property int $status
 * @property string $system_user_group_id
 * @property bool $is_deleted
 * @property int $create_by
 * @property \Carbon\Carbon $create_time
 * @property \Carbon\Carbon $update_time
 *
 * @package App\Models\Base
 */
class GfUser extends Eloquent
{
	protected $table = 'gf_user';
	public $timestamps = false;

	protected $casts = [
		'login_num' => 'int',
		'status' => 'int',
		'is_deleted' => 'bool',
		'create_by' => 'int'
	];

	protected $dates = [
		'login_at',
		'create_time',
		'update_time'
	];
}
