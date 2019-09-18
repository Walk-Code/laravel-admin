<?php
/**
 *
 * <b>DateHelper.php</b></br>
 * <pre>TODO(这里用一句话描述这个类的作用)</pre>
 *
 * @author xqyjjq  walk_code@163.com
 * @date 2019/8/6 12:23
 *
 */

namespace app\utils;

use DateInterval;
use DatePeriod;
use DateTime;


/**
 *
 * <b>DateHelper</b></br>
 * <pre>日期相关操作</pre>
 *
 * @author xqyjjq  walk_code@163.com
 * @date ${DATE} ${TIME}
 *
 */
class DateHelper {

    /**
     * @param $startDate //2019-07-01
     * @param $endDate // 2019-08-01
     * @param string $format
     *<pre>获取两个日期间所有的日期</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public static function getBetweenDate($startDate, $endDate, $format = 'Y-m-d') {
        $dates = [];
        $period = new DatePeriod(
            new DateTime($startDate),
            new DateInterval('P1D'),
            new DateTime($endDate)
        );

        foreach ($period as $key => $value) {
            $dates [] = $value->format($format);
        }

        if ($startDate == $endDate) {
            $dates[] = $startDate;
        }

        return $dates;
    }
}