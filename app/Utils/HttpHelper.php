<?php
/**
 *
 * <b>HttpHelper.php</b></br>
 * <pre>TODO(这里用一句话描述这个类的作用)</pre>
 *
 * @author xqyjjq  walk_code@163.com
 * @date 2019/8/13 14:18
 *
 */

namespace app\utils;

use think\facade\Log;

/**
 *
 * <b>HttpHelper</b></br>
 * <pre>http请求辅助函数</pre>
 *
 * @author xqyjjq  walk_code@163.com
 * @date ${DATE} ${TIME}
 *
 */
class HttpHelper {

    /**
     * @param $url
     * @param $params
     * @param $headers
     * @return mixed
     *<pre>发送get请求</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public static function HttpGet($url, $params, $headers) {
        $paramData = '';
        foreach ($params as $k => $param) {
            $paramData .= $k . '=' . $param . '&';
        }
        $paramData = rtrim($paramData, '&');
        $curl = curl_init($url . '?' . $paramData);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $responBody = curl_exec($curl);
        curl_close($curl);

        return $responBody;
    }

    /**
     * @param $url
     * @param $params
     * @param $headers
     * @param string $type
     * @return mixed
     *<pre>发送post请求</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public static function HttpPost($url, $params, $headers, $type = 'x-www-form-urlencoded') {
        $paramData = '';
        foreach ($params as $k => $param) {
            $paramData .= $k . '=' . $param . '&';
        }
        $paramData = rtrim($paramData, '&');
        $curl = curl_init($url);
        // 返回内容自动解压，解决乱码问题
        curl_setopt($curl, CURLOPT_ENCODING, '');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        if ($type == 'json') {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
        } elseif ($type == 'xml') {
        } else {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $paramData);
        }
        $responBody = curl_exec($curl);
        curl_close($curl);

        return $responBody;
    }

    /**
     * @Author walk-code
     * @Description 发送post请求,且参数为json
     * @Date 2019/8/17 0:27
     * @Param
     * @return
     **/
    public static function HttpPostWithJson($url, $params, $headers) {
        $payload = json_encode($params, JSON_UNESCAPED_UNICODE);

        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Content-Length: ' . strlen($payload);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }
}