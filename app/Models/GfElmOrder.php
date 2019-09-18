<?php

namespace App\Models;

class GfElmOrder extends \App\Models\Base\GfElmOrder
{
	protected $hidden = [
		'secret_phone_expire_time'
	];

	protected $fillable = [
		'order_id',
		'address',
		'active_at',
		'deliver_fee',
		'merchant_delivery_subsidy',
		'vip_delivery_fee_discount',
		'deliver_time',
		'description',
		'groups',
		'invoice',
		'book',
		'online_paid',
		'phone_list',
		'shop_id',
		'open_id',
		'shop_name',
		'day_sn',
		'status',
		'refund_status',
		'user_id',
		'total_price',
		'original_price',
		'consignee',
		'delivery_geo',
		'delivery_poi_address',
		'invoiced',
		'income',
		'service_rate',
		'service_fee',
		'hongbao',
		'package_fee',
		'activity_total',
		'shop_part',
		'eleme_part',
		'downgraded',
		'secret_phone_expire_time',
		'order_activities',
		'invoice_type',
		'taxpayer_id',
		'cold_box_fee',
		'cancel_order_description',
		'cancel_order_created_at',
		'order_commissions',
		'baidu_waimai',
		'consignee_phones',
		'user_extra_info',
		'super_vip',
		'confirm_cooking_time',
		'order_business_type',
		'pick_up_time',
		'pick_up_number',
		'spec_user_part',
		'is_business_order',
		'pin_tuan_order',
		'extra_json',
		'order_source_tag',
		'create_time',
		'update_time'
	];
}
