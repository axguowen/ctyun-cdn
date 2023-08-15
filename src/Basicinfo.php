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

class Basicinfo extends BaseClient
{
    /**
     * 查询所有的地区信息
     * @access public
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014773/common/10014781
     */
    public function area()
    {
        // 发送请求
        return $this->get('/api/v1/basicinfo/area');
    }

    /**
     * 查询所有的运营商信息
     * @access public
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014773/common/10014782
     */
    public function isp()
    {
        // 发送请求
        return $this->get('/api/v1/basicinfo/isp');
    }
}
