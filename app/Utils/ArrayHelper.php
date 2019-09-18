<?php


namespace app\utils;


/**
 * @ClassName ArrayHelper
 * @Description 数组相关操作类
 * @Author walk-code
 * @Date 2019/7/31 23:41
 * @Since php 7.2
 **/
class ArrayHelper {
    /**
     * @Author walk-code
     * @Description 下划线转驼峰
     * @Date 2019/7/31 23:43
     * @Param
     * @return
     **/
    public static function convertUnderline($arr) {
        if (!is_array($arr)) {
            return $arr;
        }
        $tempArr = [];
        foreach ($arr as $key => $value) {
            $k = ucwords(str_replace(['-', '_'], ' ', $key));
            $k = str_replace(' ', '', lcfirst($k));
            $v = self::convertUnderline($value);
            $tempArr[$k] = $v;
        }

        return $tempArr;
    }


    /**
     * @param $arr
     *<pre>驼峰转下划线</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public static function humpDownline($arr, $separator = '_') {
        if (!is_array($arr)) {
            return $arr;
        }

        $tempArr = [];
        foreach ($arr as $key => $value) {
            $k = strtolower(preg_replace('/([a-z])([A-Z])/', "$1" . $separator . "$2", $key));
            $v = self::humpDownline($value, '_');
            $tempArr[$k] = $v;
        }

        return $tempArr;
    }
}