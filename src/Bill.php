<?php
// +----------------------------------------------------------------------
// | CtyunSDK [Ctyun SDK for PHP]
// +----------------------------------------------------------------------
// | 天翼云PHPSDK
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: axguowen <axguowen@qq.com>
// +----------------------------------------------------------------------

namespace axguowen\ctyun\services\cdn;

class Bill extends BaseClient
{
    /**
     * 查询计费账单详情
     * @access public
     * @param string $startMonth 开始月份2023-03
     * @param string $endMonth 结束月份2023-05
     * @param string $productCode 产品类型编码
     * @param int $pageNum 当前页码
     * @param int $pageSize 每页数量
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014775/common/10014800
     */
    public function billDetail($startMonth, $endMonth, $productCode = '008', $pageNum = null, $pageSize = null)
    {
        // 请求体
        $body = [
            'start_month' => $startMonth,
            'end_month' => $endMonth,
            'product_code' => $productCode,
        ];
        // 如果指定当前页码
        if(!is_null($pageNum)){
            $body['page_num'] = $pageNum;
        }
        // 如果指定每页数量
        if(!is_null($pageSize)){
            $body['page_size'] = $pageSize;
        }
        // 发送请求
        return $this->get('/api/v1/bill_detail', $body);
    }

    /**
     * 查询资源包详情
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014775/common/10014784
     */
    public function flowPacket($options = [])
    {
        // 请求体
        $body = [];
        // 如果指定产品类型
        if(isset($options['product_code'])){
            $body['product_code'] = $options['product_code'];
        }
        // 如果指定开通时间
        if(isset($options['start_date'])){
            $body['start_date'] = $options['start_date'];
        }
        // 如果指定到期时间
        if(isset($options['end_date'])){
            $body['end_date'] = $options['end_date'];
        }
        // 如果指定当前页码
        if(isset($options['page'])){
            $body['page'] = $options['page'];
        }
        // 如果指定每页数量
        if(isset($options['page_size'])){
            $body['page_size'] = $options['page_size'];
        }
        // 如果指定时间排序方式
        if(isset($options['field_sort'])){
            $body['field_sort'] = $options['field_sort'];
        }
        // 如果指定排序规则
        if(isset($options['order_sort'])){
            $body['order_sort'] = $options['order_sort'];
        }
        // 发送请求
        return $this->get('/api/v1/order/flow-packet', $body);
    }

    /**
     * 查询不同运营商的计费详情
     * @access public
     * @param int $startTime 开始时间戳
     * @param int $endTime 结束时间戳
     * @param array $isp 运营商编码列表
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014775/common/10014788
     */
    public function domainbilling($startTime, $endTime, $isp = null)
    {
        // 请求体
        $body = [
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
        // 如果指定运营商编码列表
        if(!is_null($isp)){
            $body['isp'] = $isp;
        }
        // 发送请求
        return $this->post('/api/v1/flowandbandwidth/domainbilling', $body);
    }

    /**
     * 查询账号下开通的服务基本信息
     * @access public
     * @param array $productCode 产品类型列表
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014775/common/10015603
     */
    public function seviceDetail($productCode = null)
    {
        // 请求体
        $body = [];
        // 如果指定产品类型列表
        if(!is_null($productCode)){
            $body['product_code'] = $productCode;
        }
        // 发送请求
        return $this->post('/api/v1/sevice_detail', $body);
    }
}
