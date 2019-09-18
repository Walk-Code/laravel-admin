<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Sep 2019 16:54:35 +0800.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GfElmOrder
 * 
 * @property int $id
 * @property int $order_id
 * @property string $address
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $active_at
 * @property float $deliver_fee
 * @property float $merchant_delivery_subsidy
 * @property float $vip_delivery_fee_discount
 * @property \Carbon\Carbon $deliver_time
 * @property string $description
 * @property string $groups
 * @property string $invoice
 * @property int $book
 * @property int $online_paid
 * @property string $phone_list
 * @property int $shop_id
 * @property string $open_id
 * @property string $shop_name
 * @property int $day_sn
 * @property string $status
 * @property string $refund_status
 * @property string $user_id
 * @property float $total_price
 * @property float $original_price
 * @property string $consignee
 * @property string $delivery_geo
 * @property string $delivery_poi_address
 * @property int $invoiced
 * @property float $income
 * @property float $service_rate
 * @property float $service_fee
 * @property float $hongbao
 * @property float $package_fee
 * @property float $activity_total
 * @property float $shop_part
 * @property float $eleme_part
 * @property int $downgraded
 * @property \Carbon\Carbon $secret_phone_expire_time
 * @property string $order_activities
 * @property string $invoice_type
 * @property string $taxpayer_id
 * @property float $cold_box_fee
 * @property string $cancel_order_description
 * @property \Carbon\Carbon $cancel_order_created_at
 * @property string $order_commissions
 * @property int $baidu_waimai
 * @property string $consignee_phones
 * @property string $user_extra_info
 * @property string $super_vip
 * @property \Carbon\Carbon $confirm_cooking_time
 * @property int $order_business_type
 * @property \Carbon\Carbon $pick_up_time
 * @property int $pick_up_number
 * @property float $spec_user_part
 * @property int $is_business_order
 * @property int $pin_tuan_order
 * @property array $extra_json
 * @property string $order_source_tag
 * @property \Carbon\Carbon $create_time
 * @property \Carbon\Carbon $update_time
 *
 * @package App\Models\Base
 */
class GfElmOrder extends Eloquent
{
	protected $table = 'gf_elm_order';
	public $timestamps = false;

	protected $casts = [
		'order_id' => 'int',
		'deliver_fee' => 'float',
		'merchant_delivery_subsidy' => 'float',
		'vip_delivery_fee_discount' => 'float',
		'book' => 'int',
		'online_paid' => 'int',
		'shop_id' => 'int',
		'day_sn' => 'int',
		'total_price' => 'float',
		'original_price' => 'float',
		'invoiced' => 'int',
		'income' => 'float',
		'service_rate' => 'float',
		'service_fee' => 'float',
		'hongbao' => 'float',
		'package_fee' => 'float',
		'activity_total' => 'float',
		'shop_part' => 'float',
		'eleme_part' => 'float',
		'downgraded' => 'int',
		'cold_box_fee' => 'float',
		'baidu_waimai' => 'int',
		'order_business_type' => 'int',
		'pick_up_number' => 'int',
		'spec_user_part' => 'float',
		'is_business_order' => 'int',
		'pin_tuan_order' => 'int',
		'extra_json' => 'json'
	];

	protected $dates = [
		'active_at',
		'deliver_time',
		'secret_phone_expire_time',
		'cancel_order_created_at',
		'confirm_cooking_time',
		'pick_up_time',
		'create_time',
		'update_time'
	];
}
