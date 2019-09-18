<?php

namespace App\Models;

class GfDownloadTask extends \App\Models\Base\GfDownloadTask {
    protected $connection = 'mysql-daily';
    protected $fillable = [
        'download_date',
        'shop_id',
        'ordering_channel_id',
        'download_url',
        'local_path',
        'create_time',
        'update_time'
    ];

    /**
     *<pre>保存或者修改</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public static function saveOrUpdate($downLoadDate, $shopId, $orderingChannelId, $downloadUrl, $localPath){
        $downloadTasks = GfDownloadTask::where('download_date', '=', $downLoadDate)
            ->where('shop_id', '=', $shopId)
            ->where('ordering_channel_id', '=', $orderingChannelId)
            ->find();

        if (!$downloadTasks) {
            $downloadTasks = new GfDownloadTask();
        }

        $downloadTasks->download_date = $downLoadDate;
        $downloadTasks->shop_id = $shopId;
        $downloadTasks->ordering_channel_id = $orderingChannelId;
        $downloadTasks->download_url = $downloadUrl;
        $downloadTasks->local_path = $localPath;

        return $downloadTasks->save();
    }

    /**
     * @param $date
     * @return mixed
     *<pre>获取当天下载task</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public static function getCurrentDateTasks($date) {
        $data = GfDownloadTask::where('download_date', '=', $date)
            ->where('local_path', '<>', '')
            ->select();

        return $data;
    }
}
