<?php


namespace app\utils;


use think\facade\Env;
use think\facade\Log;

/**
 * @ClassName FileDownloadHelper
 * @Description 文件下載輔助類
 * @Author walk-code
 * @Date 2019/8/18 1:39
 * @Since php 7.2
 **/
class FileDownloadHelper {

    /**
     * @Author walk-code
     * @Description 下載文件到服務器
     * @Date 2019/8/18 1:42
     * @Param
     * @return bool
     **/
    public static function downloadFile($url, $downloadPath) {
        set_time_limit(0);
        Log::info('下载的url: ' . $url);
        // 提取文件后缀
        $ext = explode('?', pathinfo($url, PATHINFO_EXTENSION))[0];
        if (!file_exists($downloadPath)) {
            // 创建下载目录并且赋予777权限
            mkdir($downloadPath, 0777, true);
        }
        $filePath = $downloadPath . '.' . $ext;
        $fp       = fopen($filePath, 'w+');
        $ch       = curl_init(str_replace(' ', '%20', $url));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 50);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        return $filePath;
    }
}