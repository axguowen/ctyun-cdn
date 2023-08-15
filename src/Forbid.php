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

class Forbid extends BaseClient
{
    /**
     * 创建封禁任务
     * @access public
     * @param array $urls 待封禁URL数组
     * @param int $forbidType 封禁类型
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014509/common/10014743
     */
    public function create($urls, $forbidType = 14)
    {
        // 请求体
        $body = [
            'urls' => $urls,
            'forbid_type' => $forbidType,
        ];
        // 发送请求
        return $this->post('/api/v2/forbid/create', $body);
    }

    /**
     * 查询封禁任务
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014509/common/10014705
     */
    public function query($options = [])
    {
        // 请求体
        $body = [];
        // 查询方式
        $body['type'] = isset($options['type']) ? $options['type'] : 0;
        // 按照task_id查询
        if($body['type'] == 0){
            $body['ids'] = isset($options['ids']) ? $options['ids'] : [];
        }
        // 按照url查询
        elseif($body['type'] == 1){
            $body['urls'] = isset($options['urls']) ? $options['urls'] : [];
        }
        // 按照submit_id查询
        elseif($body['type'] == 2){
            $body['submit_ids'] = isset($options['submit_ids']) ? $options['submit_ids'] : [];
        }

        // 如果指定页码
        if(isset($options['page'])){
            $body['page'] = $options['page'];
        }
        // 如果指定每页条数
        if(isset($options['page_size'])){
            $body['page_size'] = $options['page_size'];
        }
        
        // 发送请求
        return $this->get('/api/v2/forbid/query', $body);
    }

    /**
     * 查询刷新任务额度
     * @access public
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014747/common/10014772
     */
    public function getRefreshQuota()
    {
        // 发送请求
        return $this->get('/api/v2/refreshmanage/quota');
    }

    /**
     * 创建预热任务
     * @access public
     * @param array $urls 待预取的文件链接数组
     * @return array 预取的响应和错误
     * @link https://vip.ctcdn.cn/help/10005260/10014747/common/10014708
     */
    public function preloadUrls($urls)
    {
        // 请求体
        $body = [
            'values' => $urls,
        ];
        // 发送请求
        return $this->post('/api/v1/preloadmanage/create', $body);
    }

    /**
     * 查询预热任务额度
     * @access public
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014747/common/10014748
     */
    public function getPreloadQuota()
    {
        // 发送请求
        return $this->get('/api/v2/preloadmanage/quota');
    }
}
