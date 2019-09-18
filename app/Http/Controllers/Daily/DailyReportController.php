<?php
/**
 *
 * <b>DailyReportController.php</b></br>
 * <pre>TODO(这里用一句话描述这个类的作用)</pre>
 *
 * @author xqyjjq  walk_code@163.com
 * @date 2019/9/18 15:43
 *
 */

namespace App\Http\Controllers\Daily;


use App\Http\Services\DailyReportService;

class DailyReportController {

    public function cashDailyReport(DailyReportService $dailyReportService) {
        return $dailyReportService->getCashDailyReport('','',1);
    }


    public function productDailyReport(){

    }
    
}