<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class GfOrderingChannelDailyReportDetail extends \App\Models\Base\GfOrderingChannelDailyReportDetail {
    protected $connection = 'mysql-daily';
    protected $fillable = [
        'statistics_time',
        'ordering_channel_daily_report_id',
        'three_way_user',
        'shop_id',
        'turnover',
        'number_of_order',
        'customer_price',
        'shipping_fee',
        'box_fee',
        'actual_harvest',
        'other_fee',
        'create_time',
        'update_time'
    ];

    /**
     * @param $threeWayUser
     * @param $orderingChannelDailyReportId
     * @param $statisticsDate
     * @param $data
     * @return bool
     *<pre>保存或者修改日报明细</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public static function svaeOrUpdate($threeWayUser, $orderingChannelDailyReportId, $statisticsDate, $data) {
        $orderingChannelDailyReportDetail = GfOrderingChannelDailyReportDetail::where('ordering_channel_daily_report_id', '=', $orderingChannelDailyReportId)
            ->where('three_way_user', '=', $threeWayUser)
            ->find();
        if (!$orderingChannelDailyReportDetail) {
            $orderingChannelDailyReportDetail = new GfOrderingChannelDailyReportDetail();
        }

        $orderingChannelDailyReportDetail->statistics_time = $statisticsDate;
        $orderingChannelDailyReportDetail->ordering_channel_daily_report_id = $orderingChannelDailyReportId;
        $orderingChannelDailyReportDetail->three_way_user = $threeWayUser;
        $orderingChannelDailyReportDetail->turnover = $data['original_price'];
        $orderingChannelDailyReportDetail->number_of_order = $data['number_of_order'];
        $orderingChannelDailyReportDetail->customer_price = $data['customer_price'];
        $orderingChannelDailyReportDetail->shipping_fee = $data['shipping_fee'];
        $orderingChannelDailyReportDetail->box_fee = $data['box_fee'];
        $orderingChannelDailyReportDetail->actual_harvest = $data['actual_harvest'];
        $orderingChannelDailyReportDetail->shop_id = $data['shop_id'];
        $orderingChannelDailyReportDetail->update_time = date('Y-m-d H:i:s');

        return $orderingChannelDailyReportDetail->save();
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $shopId
     * @param $channelCode
     * @return mixed
     *<pre>获取根据日报id获取日报详情数据</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public static function getDailyReportDetailByOrderingChannelDailyReportId($startDate, $endDate, $shopId, $channelCode) {
        $sql = '
            SELECT 
              IF(actual_harvest IS NULL, 0,  actual_harvest) actual_harvest,
	          IF(number_of_order IS NULL,0, number_of_order) number_of_order,
              IF(customer_price IS NULL,0,customer_price)customer_price,
              three_way_user
            FROM 
            (
            SELECT 
              T1.*
            FROM 
            gf_ordering_channel_daily_report_detail T1
            LEFT JOIN gf_ordering_channel_daily_report T2 ON T1.ordering_channel_daily_report_id = T2.id 
            LEFT JOIN gf_ordering_channel T3 ON T3.id = T2.ordering_channel_id
            WHERE T1.id > 0
            AND T2.id > 0
        ';
        if (!empty($startDate)) {
            $sql .= 'AND T2.statistics_time >= "' . $startDate . '" ';
        }

        if (!empty($endDate)) {
            $sql .= 'AND T2.statistics_time <= "' . $endDate . '" ';
        }

        if (!empty($shopId)) {
            $sql .= 'AND T2.shop_id = "' . $shopId . '" ';
        }

        $sql .= 'AND T3.code = "' . $channelCode . '" GROUP BY three_way_user  ORDER BY actual_harvest DESC )T1';

        $data = Db::connection('mysql-daily')->select($sql);

        return $data;
    }
}
