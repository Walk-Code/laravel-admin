<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class GfOrderingChannelDailyReport extends \App\Models\Base\GfOrderingChannelDailyReport {
    protected $connection = 'mysql-daily';
    protected $fillable = [
        'statistics_time',
        'ordering_channel_id',
        'shop_id',
        'turnover',
        'number_of_order',
        'customer_price',
        'actual_harvest',
        'shipping_fee',
        'box_fee',
        'other_fee',
        'create_time',
        'update_time',
        'platform_subsidy',
        'merchant_subsidy'
    ];

    /**
     * @param $shopId
     * @param $channel
     * @param $statisticsTime
     * @param $data
     * @return OrderingChannelDailyReport
     *<pre>保存或者修改数据</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public static function saveOrUpdate($shopId, $channel, $statisticsTime, $data) {
        $orderingChannelDailyReport = GfOrderingChannelDailyReport::where('shop_id', '=', $shopId)
            ->where('ordering_channel_id', '=', $channel)
            ->where('statistics_time', '=', $statisticsTime)
            ->find();

        if (!$orderingChannelDailyReport) {
            $orderingChannelDailyReport = new GfOrderingChannelDailyReport();
        }

        $orderingChannelDailyReport->statistics_time = $statisticsTime;
        $orderingChannelDailyReport->ordering_channel_id = $channel;
        $orderingChannelDailyReport->shop_id = $shopId;
        $orderingChannelDailyReport->turnover = $data['original_price'];// 总营业额
        $orderingChannelDailyReport->number_of_order = $data['number_of_order']; // 总订单数
        $orderingChannelDailyReport->customer_price = $data['customer_price']; // 总客单价
        $orderingChannelDailyReport->shipping_fee = $data['shipping_fee']; // 总配送费
        $orderingChannelDailyReport->box_fee = $data['box_fee'];
        $orderingChannelDailyReport->actual_harvest = $data['actual_harvest'];
        $orderingChannelDailyReport->platform_subsidy = $data['platform_subsidy'];
        $orderingChannelDailyReport->merchant_subsidy = $data['merchant_subsidy'];
        $orderingChannelDailyReport->update_time = date('Y-m-d H:i:s');
        $orderingChannelDailyReport->save();

        return $orderingChannelDailyReport;
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $shopIds
     * @return mixed
     *<pre>>通过时间获取日报表数据</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public static function getDailyReportDataByDate($startDate, $endDate, $shopIds) {
        $sql = 'SELECT 
        IF(actual_harvest IS NULL, 0, actual_harvest) actual_harvest,      
        IF(number_of_order IS NULL, 0, number_of_order) number_of_order      
        FROM (
            SELECT 
            SUM(actual_harvest) actual_harvest,
            SUM(number_of_order) number_of_order
            FROM gf_ordering_channel_daily_report 
            WHERE id > 0 ';

        if (!empty($shopIds) && is_array($shopIds)) {
            // 聚合饿了么&美团订单数据
            $shops = $shopIds['meituanShopId'] . ',' . $shopIds['elmShopId'];
            $sql .= 'AND shop_id IN (' . $shops . ') ';
        }

        if (!empty($startDate)) {
            $sql .= 'AND statistics_time >= "' . $startDate . '" ';
        }

        if (!empty($endDate)) {
            $sql .= 'AND statistics_time <= "' . $endDate . '" ';
        }

        $sql .= ')T1 ';

        $data = Db::connection('mysql-daily')->select($sql);

        return $data[0];
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $shopId
     * @return mixed
     *<pre>通过日期获取美团相关数据</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public static function getMeiTuanDailyReportDataByDate($startDate, $endDate, $shopId) {
        $sql = '
        SELECT 
        IF(actual_harvest IS NULL, 0, actual_harvest) actual_harvest,      
        IF(number_of_order IS NULL, 0, number_of_order) number_of_order 
        FROM (
        SELECT 
        SUM(actual_harvest) actual_harvest,
        SUM(number_of_order) number_of_order
        FROM gf_ordering_channel_daily_report T1
        LEFT JOIN gf_ordering_channel T2 ON T1.ordering_channel_id = T2.id
        WHERE T1.id > 0
        AND T2.code = "meituan" 
        ';
        if (!empty($startDate)) {
            $sql .= 'AND T1.statistics_time >= "' . $startDate . '" ';
        }

        if (!empty($endDate)) {
            $sql .= 'AND T1.statistics_time <= "' . $endDate . '" ';
        }

        if (!empty($shopId)) {
            $sql .= 'AND T1.shop_id = "' . $shopId . '" ';
        }

        $sql .= ' )T1';

        $data = Db::connecton('mysql-daily')->select($sql);

        return $data[0];
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $shopId
     * @return mixed
     *<pre>通过日期获取饿了么日报表数据</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public static function getElmDailyReportDataByDate($startDate, $endDate, $shopId) {
        $sql = '
        SELECT 
        IF(actual_harvest IS NULL, 0, actual_harvest) actual_harvest,      
        IF(number_of_order IS NULL, 0, number_of_order) number_of_order 
        FROM (
        SELECT 
        SUM(actual_harvest) actual_harvest,
        SUM(number_of_order) number_of_order
        FROM gf_ordering_channel_daily_report T1
        LEFT JOIN gf_ordering_channel T2 ON T1.ordering_channel_id = T2.id
        WHERE T1.id > 0
        AND T2.code = "elm" 
        ';
        if (!empty($startDate)) {
            $sql .= 'AND T1.statistics_time >= "' . $startDate . '" ';
        }

        if (!empty($endDate)) {
            $sql .= 'AND T1.statistics_time <= "' . $endDate . '" ';
        }

        if (!empty($shopId)) {
            $sql .= 'AND T1.shop_id = "' . $shopId . '" ';
        }

        $sql .= ' )T1';

        $data = Db::connection('mysql-daily')->select($sql);

        return $data[0];
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $shopId
     * @return mixed
     *<pre>通过日期获取美餐日报表数据</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public static function getMeiCanDailyReportDataByDate($startDate, $endDate, $shopId) {
        $sql = '
        SELECT 
        IF(actual_harvest IS NULL, 0, actual_harvest) actual_harvest,      
        IF(number_of_order IS NULL, 0, number_of_order) number_of_order 
        FROM (
        SELECT 
        SUM(actual_harvest) actual_harvest,
        SUM(number_of_order) number_of_order
        FROM gf_ordering_channel_daily_report T1
        LEFT JOIN gf_ordering_channel T2 ON T1.ordering_channel_id = T2.id
        WHERE T1.id > 0
        AND T2.code = "meican" 
        ';
        if (!empty($startDate)) {
            $sql .= 'AND T1.statistics_time >= "' . $startDate . '" ';
        }

        if (!empty($endDate)) {
            $sql .= 'AND T1.statistics_time <= "' . $endDate . '" ';
        }

        if (!empty($shopId)) {
            $sql .= 'AND T1.shop_id = "' . $shopId . '" ';
        }

        $sql .= ' )T1';

        $data = Db::connection('mysql-daily')->select($sql);

        return $data[0];
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $shopId
     * @return mixed
     *<pre>通过日期获取有饭日报表数据</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public static function getYouFanDailyReportDataByDate($startDate, $endDate, $shopId) {
        $sql = '
        SELECT 
        IF(actual_harvest IS NULL, 0, actual_harvest) actual_harvest,       
        IF(number_of_order IS NULL, 0, number_of_order) number_of_order 
        FROM (
        SELECT 
        SUM(actual_harvest) actual_harvest,
        SUM(number_of_order) number_of_order
        FROM gf_ordering_channel_daily_report T1
        LEFT JOIN gf_ordering_channel T2 ON T1.ordering_channel_id = T2.id
        WHERE T1.id > 0
        AND T2.code = "youfan" 
        ';
        if (!empty($startDate)) {
            $sql .= 'AND T1.statistics_time >= "' . $startDate . '" ';
        }

        if (!empty($endDate)) {
            $sql .= 'AND T1.statistics_time <= "' . $endDate . '" ';
        }

        if (!empty($shopId)) {
            $sql .= 'AND T1.shop_id = "' . $shopId . '" ';
        }

        $sql .= ' )T1';

        $data = Db::connection('mysql-daily')->query($sql);

        return $data[0];
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $shopId
     * @return mixed
     *<pre>通过日期获取前置厨房日报表数据</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public static function getAppletsCompanDailyReportDataByDate($startDate, $endDate, $shopId) {
        $sql = '
        SELECT 
        IF(actual_harvest IS NULL, 0, actual_harvest) actual_harvest,      
        IF(number_of_order IS NULL, 0, number_of_order) number_of_order 
        FROM (
        SELECT 
        SUM(actual_harvest) actual_harvest,
        SUM(number_of_order) number_of_order
        FROM gf_ordering_channel_daily_report T1
        LEFT JOIN gf_ordering_channel T2 ON T1.ordering_channel_id = T2.id
        WHERE T1.id > 0
        AND T2.code = "company" 
        ';
        if (!empty($startDate)) {
            $sql .= 'AND T1.statistics_time >= "' . $startDate . '" ';
        }

        if (!empty($endDate)) {
            $sql .= 'AND T1.statistics_time <= "' . $endDate . '" ';
        }

        if (!empty($shopId)) {
            $sql .= 'AND T1.shop_id = "' . $shopId . '" ';
        }

        $sql .= ' )T1';

        $data = Db::connection('mysql-daily')->select($sql);

        return $data[0];
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $shopId
     * @return mixed
     *<pre>获取新版小程序企业版</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public static function getNewAppletsSchoolDailyReportDataByDate($startDate, $endDate, $shopId) {
        $sql = '
        SELECT 
        IF(actual_harvest IS NULL, 0, actual_harvest) actual_harvest,      
        IF(number_of_order IS NULL, 0, number_of_order) number_of_order 
        FROM (
        SELECT 
        SUM(actual_harvest) actual_harvest,
        SUM(number_of_order) number_of_order
        FROM gf_ordering_channel_daily_report T1
        LEFT JOIN gf_ordering_channel T2 ON T1.ordering_channel_id = T2.id
        WHERE T1.id > 0
        AND T2.code = "school-new" 
        ';
        if (!empty($startDate)) {
            $sql .= 'AND T1.statistics_time >= "' . $startDate . '" ';
        }

        if (!empty($endDate)) {
            $sql .= 'AND T1.statistics_time <= "' . $endDate . '" ';
        }

        if (!empty($shopId)) {
            $sql .= 'AND T1.shop_id = "' . $shopId . '" ';
        }

        $sql .= ' )T1';
        $data = Db::connection('mysql-daily')->select($sql);

        return $data[0];
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $shopId
     * @return mixed
     *<pre>获取旧版小程序企业版</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public static function getOldAppletsSchoolDailyReportDataByDate($startDate, $endDate, $shopId) {
        $sql = '
        SELECT 
        IF(actual_harvest IS NULL, 0, actual_harvest) actual_harvest,      
        IF(number_of_order IS NULL, 0, number_of_order) number_of_order 
        FROM (
        SELECT 
        SUM(actual_harvest) actual_harvest,
        SUM(number_of_order) number_of_order
        FROM gf_ordering_channel_daily_report T1
        LEFT JOIN gf_ordering_channel T2 ON T1.ordering_channel_id = T2.id
        WHERE T1.id > 0
        AND T2.code = "school-old" 
        ';
        if (!empty($startDate)) {
            $sql .= 'AND T1.statistics_time >= "' . $startDate . '" ';
        }

        if (!empty($endDate)) {
            $sql .= 'AND T1.statistics_time <= "' . $endDate . '" ';
        }

        if (!empty($shopId)) {
            $sql .= 'AND T1.shop_id = "' . $shopId . '" ';
        }

        $sql .= ' )T1';

        $data = Db::connection('mysql-daily')->select($sql);

        return $data[0];
    }
}
