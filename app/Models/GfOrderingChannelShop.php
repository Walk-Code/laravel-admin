<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class GfOrderingChannelShop extends \App\Models\Base\GfOrderingChannelShop {
    protected $connection = 'mysql-daily';
    protected $fillable = [
        'ordering_channel_id',
        'shop_id',
        'shop_short_name',
        'hangqun_shop_code',
        'address',
        'address_pinxin',
        'create_time',
        'update_time',
        'hangqun_shop_id'
    ];

    /**
     * @param $code
     * @return mixed
     *<pre>获取所有店铺</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public static function getShopByChannel($code) {
        $data = Db::connection('mysql-daily')->select('
        SELECT T2.* FROM gf_ordering_channel T1 
        LEFT JOIN gf_ordering_channel_shop T2 ON T1.id = T2.ordering_channel_id
        WHERE T1.code = ?
        GROUP BY T2.shop_id
        ', [$code]);

        return $data;
    }

    /**
     * @param $hangqunCode
     * @return mixed
     *<pre>根据航群店铺code获取店铺id</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public static function getShop($hangqunCode) {
        $sql = 'SELECT * FROM gf_ordering_channel_shop WHERE hangqun_shop_code = ?';
        $data = Db::connection('mysql-daily')->select($sql, [$hangqunCode]);

        return $data;
    }

    /**
     * @param $channelId
     * @return mixed
     *<pre>通过渠道id获取门店信息</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public static function getShopByChannelId($channelId) {
        $data = GfOrderingChannelShop::where('id', '>' , 0);

        if(!empty($channelId)){
            $data->where('ordering_channel_id', '=', $channelId);
        }

        $data = $data->group('shop_id')->select();

        return $data;
    }

    /**
     * @return mixed
     *<pre>通过店铺base获取渠道</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public static function getOrderingChannelShopLocation(){
        $data = GfOrderingChannelShop::field(['address_pinxin', 'address'])->group('address')->select();

        return $data;
    }
}
