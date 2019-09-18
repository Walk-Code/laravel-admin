<?php

namespace App\Models;

class GfUser extends \App\Models\Base\GfUser
{
	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'username',
		'password',
		'qq',
		'email',
		'phone',
		'remark',
		'login_num',
		'login_at',
		'status',
		'system_user_group_id',
		'is_deleted',
		'create_by',
		'create_time',
		'update_time'
	];
}
