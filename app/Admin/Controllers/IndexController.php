<?php
/**
 *
 * <b>IndexController.php</b></br>
 * <pre>TODO(这里用一句话描述这个类的作用)</pre>
 *
 * @author xqyjjq  walk_code@163.com
 * @date 2019/9/18 12:26
 *
 */

namespace App\Admin\Controllers;
use App\Admin\Controllers\Base\AbstractAdminController;
use Encore\Admin\Layout\Content;

class IndexController extends AbstractAdminController {
    public function index(Content $content) {
        $content->header('测试页面标题');
        $content->description('测试页面描述小标题');
        // 面包屑导航
        $content->breadcrumb(
            ['text' => '首页', 'url' => '/admin'],
            ['text' => '用户管理', 'url' => '/admin/users'],
            ['text' => '编辑用户']
        );


        $content->body('hello world');
        $content->body('foo bar');

    }
}