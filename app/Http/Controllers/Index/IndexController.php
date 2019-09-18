<?php
/**
 *
 * <b>IndexController.php</b></br>
 * <pre>测试控制器</pre>
 *
 * @author xqyjjq  walk_code@163.com
 * @date 2019/9/18 12:26
 *
 */

namespace App\Http\Controllers\Index;
use App\Admin\Controllers\Base\AbstractAdminController;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

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
        $content->view('dashboard', ['data' => 'foo']);

        return $content;
       /* return $content
            ->title('Dashboard')
            ->description('Description...')
            ->row(Dashboard::title())
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });
            });*/
    }
}