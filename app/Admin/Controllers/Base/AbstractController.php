<?php

namespace App\Admin\Controllers\Base;
use App\Http\Controllers\Controller;
/**
 *
 * <b>AbstractController.php</b></br>
 * <pre>抽象控制器</pre>
 *
 * @author xqyjjq  walk_code@163.com
 * @date 2019/9/18 12:28
 *
 */
abstract class AbstractController extends Controller {
    /**
     * @Author walk-code
     * @Description 获取header参数
     * 所有在header中自定义的参数 例如:自定义参数名:accessToken  那么 获取方法 $_SERVER['HTTP_ACCESSTOKEN']  所有均是大写
     * @Date 2019/7/7 22:05
     * @Param
     * @return
     **/
    function getHeader($headerKey) {
        $headers = [];
        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) <> 'HTTP_') {
                continue;
            }
            $header = str_replace(' ', '-', str_replace('_', ' ', strtolower(substr($key, 5))));
            // 设置header中key得值为小写
            $headers[$header] = $value;
        }
        $headerKey = strtolower($headerKey); // 转小写

        return isset($headers[$headerKey]) ? $headers[$headerKey] : '';
    }

    /**
     * @Author walk-code
     * @Description 获取用户ip
     * @Date 2019/7/27 20:22
     * @Param
     * @return
     **/
    function getIp() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //to check ip passed from proxy
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    /**
     * @Author walk-code
     * @Description 获取UA信息
     * @Date 2019/7/27 20:22
     * @Param
     * @return
     **/
    function getUserAgent() {
        return $this->getHeader('user-agent');
    }

    /**
     * @param $paramName
     *<pre>通过参数获取值</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    function getParam($paramName) {
        $paramValue = "";
        if (isset($_GET[$paramName])) {
            $paramValue = $_GET[$paramName];
        } else if (isset($_POST[$paramName])) {
            $paramValue = $_POST[$paramName];
        }

        $requestPayLoad = $this->getRequestPayload();
        $contentType = $this->getHeader('Content-Type');
        if (strpos($contentType, 'application/json') !== false) {
            if (empty($requestPayLoad)) {
                return null;
            }

            $rawBody = json_decode($requestPayLoad, true);

            return isset($rawBody[$paramName]) ? $rawBody[$paramName] : null;
        }

        return $paramValue;
    }


    /**
     *<pre>获取参数的值，当值不存在设置默认值</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    function getParamDefaultValue($paramName, $defaultValue) {
        $paramValue = $this->getParam($paramName);
        if (empty($paramValue)) {
            return $defaultValue;
        }

        return $paramValue;
    }


    /**
     *<pre>通过流获取request body里面的内容</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    function getRequestPayload() {
        $rawInput = fopen('php://input', 'r');
        $tempStream = fopen('php://temp', 'r+');
        stream_copy_to_stream($rawInput, $tempStream);
        rewind($tempStream);

        return stream_get_contents($tempStream);
    }
}