<?php


namespace app\utils;


use think\facade\Log;

/**
 * @ClassName BuildTreeHelper
 * @Description 生成tree 结构data
 * @Author walk-code
 * @Date 2019/8/27 22:37
 * @Since php 7.2
 **/
class BuildTreeHelper {
    /**
     * @Author walk-code
     * @Description 根据数据id名生成树
     * @Date 2019/8/27 22:40
     * @Param
     * @return
     **/
    public static function buildTree(&$data = [], $pidValue = 0) {
        $tree = [];
        foreach ($data as $key=>$item) {
            if ($item['parent_code'] == $pidValue) {
                $children = self::buildTree($data, $item['code']);
                if ($children) {
                    $item['children'] = $children;
                }

                $tree[] = $item;
                unset($data[$item['code']]);
            }
        }

        return $tree;
    }
}