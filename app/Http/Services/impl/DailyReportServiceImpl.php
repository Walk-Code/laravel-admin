<?php
/**
 *
 * <b>DailyReportServiceImplImpl.php</b></br>
 * <pre>日报服务实现类</pre>
 *
 * @author xqyjjq  walk_code@163.com
 * @date 2019/9/18 15:49
 *
 */

namespace app\Http\Services\impl;


use App\Http\Services\DailyReportService;
use App\Models\GfOrderingChannelDailyReport;
use App\Models\GfOrderingChannelDailyReportDetail;
use App\Models\GfOrderingChannelShop;

class DailyReportServiceImpl implements DailyReportService {

    /**
     * @param $startDate 示例：2019-09-09
     * @param $endDate 示例：2019-09-09
     * @param $shopId 示例： 2
     * @return array
     *<pre>获取现金日报数据</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    function getCashDailyReport($startDate, $endDate, $shopId) {
        if (!empty($shopId)) {
            $shops = GfOrderingChannelShop::getShop($shopId);
            if (empty($shops[1])) {
                $responsData['status'] = [
                    'Code' => 500,
                    'Msg' => '未找到店铺信息。'

                ];
                return $responsData;
            }
        }

        // 店铺配置信息数组
        $shops = $this->replaceShopId($shopId);
        $data = GfOrderingChannelDailyReport::getDailyReportDataByDate($startDate, $endDate, $shops);
        // 计算客单价
        $data['customer_price'] = empty($data['number_of_order']) ? 0 : $data['actual_harvest'] / $data['number_of_order'];
        $data['customer_price'] = ArithmeticHelper::setScale($data['customer_price'], 2);

        $meituanShopId = isset($shops['meituanShopId']) ? $shops['meituanShopId'] : '';
        $meiTuanData = $this->getMeiTuanData($startDate, $endDate, $meituanShopId);

        $elmShopId = isset($shops['elmShopId']) ? $shops['elmShopId'] : '';
        $elmData = $this->getElmData($startDate, $endDate, $elmShopId);

        $meicanShopId = isset($shops['meicanShopId']) ? $shops['meicanShopId'] : '';
        $meicanData = $this->getMeiCanData($startDate, $endDate, $meicanShopId);

        $youFanShopId = isset($shops['youfanShopId']) ? $shops['youfanShopId'] : '';
        $youFanData = $this->getYouFanData($startDate, $endDate, $youFanShopId);

        $appletsCompanyShopId = isset($shops['appletsCompanyShopId']) ? $shops['appletsCompanyShopId'] : '';
        $appletsCompanyData = $this->getAppletsCompanyData($startDate, $endDate, $appletsCompanyShopId);

        $newAppletsSchoolShopId = isset($shops['newAppletsSchoolShopId']) ? $shops['newAppletsSchoolShopId'] : '';
        $newAppletsSchoolData = $this->getAppletsCompanyData($startDate, $endDate, $newAppletsSchoolShopId);

        $oldAppletsSchoolShopId = isset($shops['oldAppletsSchoolShopId']) ? $shops['oldAppletsSchoolShopId'] : '';
        $oldAppletsSchoolData = $this->getAppletsCompanyData($startDate, $endDate, $oldAppletsSchoolShopId);

        $orderOfNum = $this->calculateTheTotalNumberOfOrders($meiTuanData, $elmData, $meicanData, $youFanData, $appletsCompanyData, $newAppletsSchoolData, $oldAppletsSchoolData);

        // 添加美餐详情数据
        $meicanDataDetails = $this->getDayilyReportDetail($startDate, $endDate, $meicanShopId, '3.x', 'meican');

        // 添加悠饭详情数据
        $youFanDataDetails = $this->getDayilyReportDetail($startDate, $endDate, $youFanShopId, '4.x', 'youfan');

        $responsData['status'] = [
            'Code' => 200,
            'Msg' => '成功'

        ];
        $responsData['result'] = [
            'top' => [
                'date' => $startDate . '~' . $endDate,
                's' => $data['actual_harvest'], // 实收
                'tc' => $orderOfNum, // 订单数量
                'ac' => $data['customer_price'] // 客单价
            ],
            'list' => [
                [
                    'serialNumber' => '1.1',
                    'name' => '美团',
                    'index' => 10,
                    's' => $meiTuanData['actual_harvest'],
                    'tc' => $meiTuanData['number_of_order'],
                    'ac' => $meiTuanData['customer_price'],
                ],
                [
                    'serialNumber' => '1.2',
                    'name' => '饿了么',
                    'index' => 20,
                    's' => $elmData['actual_harvest'],
                    'tc' => $elmData['number_of_order'],
                    'ac' => $elmData['customer_price'],
                ],
                [
                    'serialNumber' => '2.1',
                    'name' => '美餐',
                    'index' => 300,
                    's' => $meicanData['actual_harvest'],
                    'tc' => $meicanData['number_of_order'],
                    'ac' => $meicanData['customer_price'],
                ],
                [
                    'serialNumber' => '2.2',
                    'name' => '有饭',
                    'index' => 400,
                    's' => $youFanData['actual_harvest'],
                    'tc' => $youFanData['number_of_order'],
                    'ac' => $youFanData['customer_price'],
                ],
                [
                    'serialNumber' => '3.1',
                    'name' => '小程序企业版',
                    'index' => 500,
                    's' => $appletsCompanyData['actual_harvest'],
                    'tc' => $appletsCompanyData['number_of_order'],
                    'ac' => $appletsCompanyData['customer_price'],
                ],
                [
                    'serialNumber' => '3.2',
                    'name' => '小程序校园版（新）',
                    'index' => 600,
                    's' => $newAppletsSchoolData['actual_harvest'],
                    'tc' => $newAppletsSchoolData['number_of_order'],
                    'ac' => $newAppletsSchoolData['customer_price'],
                ],
                [
                    'serialNumber' => '3.3',
                    'name' => '小程序校园版（旧）',
                    'index' => 700,
                    's' => $oldAppletsSchoolData['actual_harvest'],
                    'tc' => $oldAppletsSchoolData['number_of_order'],
                    'ac' => $oldAppletsSchoolData['customer_price'],
                ]
            ]
        ];

        $i = 1;
        foreach ($meicanDataDetails as $value) {
            $data = [];
            $data['serialNumber'] = '2.1.'.$i;
            $data['name'] = str_repeat(' |- ', 1).$value['three_way_user'];
            if ($i < 10){
                $i = '0'.$i;
            }
            $data['index'] = floatval('3' . $i);
            $data['s'] = $value['actual_harvest'];
            $data['tc'] = $value['number_of_order'];
            $data['ac'] = $value['customer_price'];
            $responsData['result']['list'][] = $data;

            $i++;
        }

        $i = 1;
        foreach ($youFanDataDetails as $value) {
            $data = [];
            $data['serialNumber'] = '2.2.'.$i;
            $data['name'] = str_repeat(' |- ', 1).$value['three_way_user'];
            if ($i < 10){
                $i = '0'.$i;
            }

            $data['index'] = '4' . $i;
            $data['s'] = $value['actual_harvest'];
            $data['tc'] = $value['number_of_order'];
            $data['ac'] = $value['customer_price'];
            $responsData['result']['list'][] = $data;

            $i++;
        }

        $data = self::sortData($responsData);

        return $data;
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $shopId
     * @param $channelId
     * @return mixed
     *<pre>获取产品分类日报数据</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    function getProductDailyReport($startDate, $endDate, $shopId, $channelId) {
        // TODO: Implement getProductDailyReport() method.
    }

    /**
     * @param $startDate 开始时间
     * @param $endDate 结束时间
     * @param $shopId 店铺id
     * @return mixed
     *<pre>获取美团数据</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public function getMeiTuanData($startDate, $endDate, $shopId) {
        $data = GfOrderingChannelDailyReport::getMeiTuanDailyReportDataByDate($startDate, $endDate, $shopId);

        return $this->calculateCustomerUnitPrice($data);
    }

    /**
     * @param $startDate 开始时间
     * @param $endDate  结束时间
     * @param $shopId   店铺id
     * @return mixed
     *<pre>获取饿了么数据</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public function getElmData($startDate, $endDate, $shopId) {
        // 航群系统的店铺id替换成美团饿了么的店铺id
        $data = GfOrderingChannelDailyReport::getElmDailyReportDataByDate($startDate, $endDate, $shopId);

        return $this->calculateCustomerUnitPrice($data);
    }

    /**
     * @param $data
     *<pre>计算客单价</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    private function calculateCustomerUnitPrice($data) {
        $data['customer_price'] = empty($data['number_of_order']) ? 0 : $data['actual_harvest'] / $data['number_of_order'];
        $data['customer_price'] = ArithmeticHelper::setScale($data['customer_price'], 2);

        return $data;
    }


    /**
     * @param $shopId
     * @return mixed|'' | array
     *<pre>航群系统店铺id转饿了么&美团店铺id</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    private function replaceShopId($shopId) {
        $shops = GfOrderingChannelShop::getShop($shopId);
        if (!empty($shopId)) {
            $shop = [];
            foreach ($shops as $value) {
                if ($value['ordering_channel_id'] == 1) {
                    // 美团
                    $shop['meituanShopId'] = $value['shop_id'];
                } else if ($value['ordering_channel_id'] == 2) {
                    // 饿了么
                    $shop['elmShopId'] = $value['shop_id'];
                } else if ($value['ordering_channel_id'] == 3) {
                    // 美餐
                    $shop['meicanShopId'] = $value['shop_id'];
                } else if ($value['ordering_channel_id'] == 4) {
                    // 有饭
                    $shop['youfanShopId'] = $value['shop_id'];
                } else if ($value['ordering_channel_id'] == 5) {

                } else if ($value['ordering_channel_id'] == 6) {
                    // 小程序企业版
                    $shop['appletsCompanyShopId'] = $value['shop_id'];
                } else if ($value['ordering_channel_id'] == 7) {
                    // 新小程序校园版
                    $shop['newAppletsSchoolShopId'] = $value['shop_id'];
                } else if ($value['ordering_channel_id'] == 8) {
                    // 旧小程序校园版
                    $shop['oldAppletsSchoolShopId'] = $value['shop_id'];
                }
            }

            return $shop;
        }

        return null;
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $shopId
     * @return mixed
     *<pre>获取美餐数据</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public function getMeiCanData($startDate, $endDate, $shopId) {
        // 航群系统的店铺id替换成美团饿了么的店铺id
        $data = GfOrderingChannelDailyReport::getMeiCanDailyReportDataByDate($startDate, $endDate, $shopId);

        return $this->calculateCustomerUnitPrice($data);
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $shopId
     *<pre>获取有饭数据</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public function getYouFanData($startDate, $endDate, $shopId) {
        $data = GfOrderingChannelDailyReport::getYouFanDailyReportDataByDate($startDate, $endDate, $shopId);

        return $this->calculateCustomerUnitPrice($data);
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $shopId
     * @return mixed
     *<pre>获取小程序企业版数据</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public function getAppletsCompanyData($startDate, $endDate, $shopId) {
        $data = GfOrderingChannelDailyReport::getAppletsCompanDailyReportDataByDate($startDate, $endDate, $shopId);

        return $this->calculateCustomerUnitPrice($data);
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $shopId
     * @return mixed
     *<pre>获取新版-小程序校园版数据</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public function getNewAppletsSchoolData($startDate, $endDate, $shopId) {
        $data = GfOrderingChannelDailyReport::getNewAppletsSchoolDailyReportDataByDate($startDate, $endDate, $shopId);

        return $this->calculateCustomerUnitPrice($data);
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $shopId
     * @return mixed
     *<pre>获取旧版-小程序校园版数据</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public function getOldAppletsSchoolData($startDate, $endDate, $shopId) {
        $data = GfOrderingChannelDailyReport::getOldAppletsSchoolDailyReportDataByDate($startDate, $endDate, $shopId);

        return $this->calculateCustomerUnitPrice($data);
    }


    /**
     * @param $meiTuanData
     * @param $elmData
     * @param $meicanData
     * @param $youFanData
     * @param $appletsCompanyData
     * @param $newAppletsSchoolData
     * @param $oldAppletsSchoolData
     *<pre>订单数汇总</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    private function calculateTheTotalNumberOfOrders($meiTuanData, $elmData, $meicanData, $youFanData, $appletsCompanyData, $newAppletsSchoolData, $oldAppletsSchoolData) {
        return $meiTuanData['number_of_order'] + $elmData['number_of_order'] + $meicanData['number_of_order'] + $youFanData['number_of_order'] + $appletsCompanyData['number_of_order'] + $newAppletsSchoolData['number_of_order'] + $oldAppletsSchoolData['number_of_order'];
    }

    /**
     * @param $startData
     * @param $endData
     * @param $shopId 门店id
     *<pre>获取美餐日报详情信息</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    public function getDayilyReportDetail($startDate, $endDate, $shopId, $label, $channelCode) {
        $data = GfOrderingChannelDailyReportDetail::getDailyReportDetailByOrderingChannelDailyReportId($startDate, $endDate, $shopId, $channelCode);
        foreach ($data as $key => $value) {
            $data[$key]['three_way_user'] = trim(preg_replace('/\t+/', '', $value['three_way_user']));
        }

        return $data;
    }

    /**
     * @param $data
     *<pre>按照需要排序</pre>
     * @author xqyjjq  walk_code@163.com
     * @date ${DATE}
     */
    private function sortData($data) {
        usort($data['result']['list'], function ($a, $b) {
            return bccomp($a['index'], $b['index'], 3);
        });

        return $data;
    }

}