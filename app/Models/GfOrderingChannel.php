<?php

namespace App\Models;

class GfOrderingChannel extends \App\Models\Base\GfOrderingChannel
{
	protected $fillable = [
		'name',
		'code',
		'type',
		'create_time',
		'update_time'
	];
}
