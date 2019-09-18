<?php
/**
 *
 * <b>DailyReportServiceImplImpl.php</b></br>
 * <pre>日报服务类</pre>
 *
 * @author xqyjjq  walk_code@163.com
 * @date 2019/9/18 15:45
 *
 */

namespace App\Http\Services;


interface DailyReportService {

    /**
     * @param $startDate 示例：2019-09-09
     * @param $endDate 示例：2019-09-09
     * @param $shopId 示例： 2
     * @return array
     *<pre>获取现金日报数据</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    function getCashDailyReport($startDate, $endDate, $shopId);


    /**
     * @param $startDate
     * @param $endDate
     * @param $shopId
     * @param $channelId
     * @return mixed
     *<pre>获取产品分类日报数据</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    function getProductDailyReport($startDate, $endDate, $shopId, $channelId);
}