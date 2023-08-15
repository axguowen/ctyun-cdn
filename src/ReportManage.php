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

class ReportManage extends BaseClient
{
    /**
     * 新增报告订阅
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10015862/common/10015863
     */
    public function newReport($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v3/cdnplus/reportManage/newReport', $body);
    }

    /**
     * 更新报告订阅信息
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10015862/common/10015864
     */
    public function updateReport($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v3/cdnplus/reportManage/updateReport', $body);
    }

    /**
     * 删除报告订阅
     * @access public
     * @param int $reportTemplateId 报告订阅ID
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10015862/common/10015870
     */
    public function deleteReport($reportTemplateId)
    {
        // 请求体
        $body = [
            'reportTemplateId' => $reportTemplateId,
        ];
        // 发送请求
        return $this->post('/api/v3/cdnplus/reportManage/updateReport', $body);
    }

    /**
     * 查询报告订阅详情
     * @access public
     * @param int $reportTemplateId 报告订阅ID
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10015862/common/10015865
     */
    public function getReportInfoById($reportTemplateId)
    {
        // 请求体
        $body = [
            'reportTemplateId' => $reportTemplateId,
        ];
        // 发送请求
        return $this->post('/api/v3/cdnplus/reportManage/getReportInfoById', $body);
    }

    /**
     * 查询报告订阅模板列表
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10015862/common/10015871
     */
    public function templateList($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v3/cdnplus/reportManage/templateList', $body);
    }

    /**
     * 查询报告发送记录列表
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10015862/common/10015866
     */
    public function reportList($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v3/cdnplus/reportManage/reportList', $body);
    }
}
