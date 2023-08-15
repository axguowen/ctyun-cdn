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

class Area extends BaseClient
{
    /**
     * 查询域名的IP地址，及ip对应的区域，运营商信息
     * @access public
     * @param string|array $domains 待查询的域名列表
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014773/common/10014774
     */
    public function vipCoverDetails($domains)
    {
        // 如果域名是字符串
        if(is_string($domains)){
            $domains = [$domains];
        }
        // 请求体
        $body = [
            'domain' => $domains,
        ];
        // 发送请求
        return $this->post('/api/v1/area/vip_cover_details', $body);
    }

    /**
     * 查询IP地址详情信息
     * @access public
     * @param string $ip 查询IP
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014773/common/10014780
     */
    public function search($ip)
    {
        // IP类型
        $type = 'ipv4';
        // 如果是IPV6
        if(boolval(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6))) {
            $type = 'ipv6';
        }
        // 查询方式
        $body[$type] = $ip;
        // 发送请求
        return $this->get('/api/v3/area/search', $body);
    }
}
