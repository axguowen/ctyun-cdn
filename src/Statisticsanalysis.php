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

class Statisticsanalysis extends BaseClient
{
    /**
     * 查询峰值带宽数据
     * @access public
     * @param string $productType 产品类型
     * @param string $domain 域名
     * @param int $time 时间戳
     * @param string $cycle 峰值周期
     * @param int $abroad 国内外区域
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014167/common/10016411
     */
    public function queryPeakBandwidthData($productType, $domain = null, $time = null, $cycle = null, $abroad = null)
    {
        // 请求体
        $body = [
            'product_type' => $productType,
        ];
        // 如果指定域名
        if(isset($domain)){
            $body['domain'] = $domain;
        }
        // 如果指定时间戳
        if(isset($time)){
            $body['time'] = $time;
        }
        // 如果指定峰值周期
        if(isset($cycle)){
            $body['cycle'] = $cycle;
        }
        // 如果指定国内外区域
        if(isset($abroad)){
            $body['abroad'] = $abroad;
        }
        // 发送请求
        return $this->post('/api/v2/statisticsanalysis/query_peak_bandwidth_data', $body);
    }

    /**
     * 查询整体统计数据(可同时查询多个统计指标，包含请求数，请求命中率，QPS，流量，命中流量，流量命中率，带宽)
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014167/common/10015602
     */
    public function querySummaryData($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v2/statisticsanalysis/query_summary_data', $body);
    }

    /**
     * 查询流量，命中流量，流量命中率，回源流量数据
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014167/common/10014142
     */
    public function queryHitFlowRateDataByDomain($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v2/statisticsanalysis/query_hit_flow_rate_data_by_domain', $body);
    }

    /**
     * 查询带宽数据
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014167/common/10014156
     */
    public function queryBandwidthData($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v2/statisticsanalysis/query_bandwidth_data', $body);
    }

    /**
     * 查询回源带宽数据
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014167/common/10014157
     */
    public function queryMissBandwidthData($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v2/statisticsanalysis/query_miss_bandwidth_data', $body);
    }

    /**
     * 查询请求数,回源请求数,请求命中率数据
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014167/common/10014143
     */
    public function queryRequestNumData($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v2/statisticsanalysis/query_request_num_data', $body);
    }

    /**
     * 查询状态码请求数,请求状态码占比数据
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014167/common/10014144
     */
    public function queryHttpStatusCodeData($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v2/statisticsanalysis/query_http_status_code_data', $body);
    }

    /**
     * 查询回源请求数数据
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014167/common/10014145
     */
    public function queryMissRequestNumData($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v2/statisticsanalysis/query_miss_request_num_data', $body);
    }

    /**
     * 查询回源状态码请求数,回源状态码请求数占比数据
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014167/common/10014168
     */
    public function queryMissHttpStatusCodeData($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v2/statisticsanalysis/query_miss_http_status_code_data', $body);
    }

    /**
     * 查询回源请求失败率数据
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014167/common/10014169
     */
    public function queryMissRequestFailureRateDataByDomain($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v2/statisticsanalysis/query_miss_request_failure_rate_data_by_domain', $body);
    }

    /**
     * 查询QPS,回源QPS数据
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014167/common/10014741
     */
    public function queryQpsData($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v2/statisticsanalysis/query_qps_data', $body);
    }

    /**
     * 查询PV数据
     * @access public
     * @param int $startTime 开始时间戳
     * @param int $endTime 结束时间戳
     * @param array $domain 域名列表
     * @param int $httpProtocol 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014167/common/10014158
     */
    public function pv($startTime, $endTime, $domain = [], $httpProtocol = null)
    {
        // 请求体
        $body = [
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
        // 如果指定域名
        if(!empty($domain)){
            $body['domain'] = $domain;
        }
        // 如果指定协议
        if(!is_null($httpProtocol)){
            $body['httpProtocol'] = $httpProtocol;
        }
        // 发送请求
        return $this->post('/api/v1/pv', $body);
    }

    /**
     * 查询UV数据
     * @access public
     * @param int $startTime 开始时间戳
     * @param int $endTime 结束时间戳
     * @param array $domain 域名列表
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014167/common/10014146
     */
    public function uv($startTime, $endTime, $domain = [])
    {
        // 请求体
        $body = [
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
        // 如果指定域名
        if(!empty($domain)){
            $body['domain'] = $domain;
        }
        // 发送请求
        return $this->post('/api/v1/uv', $body);
    }

    /**
     * 查询TOP_URL排行
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014167/common/10014500
     */
    public function topUrl($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v1/top_url', $body);
    }

    /**
     * 查询TOP_IP排行
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014167/common/10014783
     */
    public function topIp($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v1/top_ip', $body);
    }

    /**
     * 按域名查询请求失败率数据
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014167/common/10016152
     */
    public function queryRequestFailureRateDataByDomain($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v2/statisticsanalysis/query_request_failure_rate_data_by_domain', $body);
    }

    /**
     * 按域名查询请求成功率数据
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014167/common/10016161
     */
    public function queryRequestSuccessRateDataByDomain($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v2/statisticsanalysis/query_request_success_rate_data_by_domain', $body);
    }

    /**
     * 按域名查询回源请求成功率数据
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014167/common/10016162
     */
    public function queryMissRequestSuccessRateDataByDomain($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v2/statisticsanalysis/query_miss_request_success_rate_data_by_domain', $body);
    }

    /**
     * 查询平均响应时间
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014167/common/10016154
     */
    public function queryResponseTimeData($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v2/statisticsanalysis/query_response_time_data', $body);
    }
}
