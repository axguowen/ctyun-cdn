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

class Log extends BaseClient
{
    /**
     * 下载离线日志
     * @access public
     * @param string $domain 域名
     * @param int $startTime 开始时间戳
     * @param int $endTime 结束时间戳
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014770/common/10014707
     */
    public function logBsstimeFiles($domain, $startTime, $endTime)
    {
        // 请求体
        $body = [
            'domain' => $domain,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
        // 发送请求
        return $this->get('/api/v1/log_bsstime_files', $body);
    }
}
