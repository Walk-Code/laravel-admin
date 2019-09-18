<?php


namespace app\utils;


/**
 * @ClassName AssertsHelper
 * @Description 异常断言辅助类
 * @Author walk-code
 * @Date 2019/7/3 23:11
 * @Since php 7.2
 **/
class AssertsHelper {
    /**
     * @Author walk-code
     * @Description 断言对象为true
     * @Date 2019/7/4 0:42
     * @Param $expression 布尔值  $message 断言信息
     * @return
     **/
    public static function isTrue($expression, $message) {
        if (!$expression) {
            ResponseHelper::validate($message);
        }
    }

    /**
     * @Author walk-code
     * @Description 断言对象为null
     * @Date 2019/7/4 0:42
     * @Date 2019/7/4 0:51
     * @Param
     * @return
     **/
    public static function isNull($agrs, $message) {
        $arr = (array)$agrs;
        if (!empty($arr)) {
            ResponseHelper::validate($message);
        }
    }

    /**
     * @Author walk-code
     * @Description /断言对象不为null
     * @Date 2019/7/4 0:51
     * @Param
     * @return
     **/
    public static function notNull($agrs, $message) {
        $arr = (array)$agrs;
        if (empty($arr)) {
            ResponseHelper::validate($message);
        }
    }

    /**
     * @param $agrs
     * @param $message
     *<pre>校验accessToken是否存在</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public static function isAuthorized($expression, $message){
        if (!$expression) {
            ResponseHelper::unauthorized($message);
        }
    }

}