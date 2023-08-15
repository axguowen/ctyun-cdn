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

class Cname extends BaseClient
{
    /**
     * 检测域名CNAME配置状态
     * @access public
     * @param string $domains 待查询的域名
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014773/common/10015872
     */
    public function cnameStatus($domains)
    {
        // 如果域名是数组
        if(is_array($domains)){
            $domains = implode(',', $domains);
        }
        // 请求体
        $body = [
            'domain' => $domains,
        ];
        // 发送请求
        return $this->post('/api/v1/cname/cname_status', $body);
    }
}
