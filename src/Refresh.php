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

class Refresh extends BaseClient
{
    /**
     * 创建刷新任务
     * @access public
     * @param array $urls 待刷新的文件链接数组
     * @param int $taskType 刷新类型, 1(url);2(目录dir);3(正则匹配re)
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014747/common/10014709
     */
    public function refreshUrls($urls, $taskType = 1)
    {
        // 请求体
        $body = [
            'task_type' => $taskType,
            'values' => $urls,
        ];
        // 发送请求
        return $this->post('/api/v1/refreshmanage/create', $body);
    }

    /**
     * 查询刷新记录
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014747/common/10014749
     */
    public function getRefreshList($options = [])
    {
        // 请求体
        $body = [];
        // 查询方式
        $body['type'] = isset($options['type']) ? $options['type'] : 0;
        // 按照时间查询
        if($body['type'] == 0){
            $body['start_time'] = isset($options['start_time']) ? $options['start_time'] : 0;
            $body['end_time'] = isset($options['end_time']) ? $options['end_time'] : time();
        }
        // 按照submit_id查询
        elseif($body['type'] == 1){
            $body['submit_id'] = isset($options['submit_id']) ? $options['submit_id'] : null;
        }
        // 按照task_id查询
        elseif($body['type'] == 2){
            $body['task_id'] = isset($options['task_id']) ? $options['task_id'] : null;
        }

        // 如果指定url
        if(isset($options['url'])){
            $body['url'] = $options['url'];
        }

        // 如果指定刷新类型
        if(isset($options['task_type'])){
            $body['task_type'] = $options['task_type'];
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
        return $this->get('/api/v1/refreshmanage/query', $body);
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
