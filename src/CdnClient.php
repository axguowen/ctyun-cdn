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

class CdnClient extends BaseClient
{
    /**
     * 查询域名的IP地址，及ip对应的区域，运营商信息
     * @access public
     * @param string|array $domains 待查询的域名列表
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014773/common/10014774
     */
    public function areaVipCoverDetails($domains)
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
    public function areaSearch($ip)
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
    
    /**
     * 查询所有的地区信息
     * @access public
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014773/common/10014781
     */
    public function basicinfoArea()
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
    public function basicinfoIsp()
    {
        // 发送请求
        return $this->get('/api/v1/basicinfo/isp');
    }

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
    public function orderFlowPacket($options = [])
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
    public function flowAndBandWidthDomainBilling($startTime, $endTime, $isp = null)
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

    /**
     * 创建证书
     * @access public
     * @param string $name 证书备注名
     * @param string $key 证书私钥
     * @param string $certs 证书公钥
     * @param string $email 用户邮箱
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014505/common/10014506
     */
    public function certCreate($name, $key, $certs, $email = '')
    {
        // 请求体
        $body = [
            'name' => $name,
            'key' => $key,
            'certs' => $certs,
            'email' => $email,
        ];
        // 发送请求
        return $this->post('/api/v1/cert/create', $body);
    }

    /**
     * 删除证书
     * @access public
     * @param string $name 证书备注名
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014505/common/10014742
     */
    public function certDelete($name)
    {
        // 请求体
        $body = [
            'name' => $name,
        ];
        // 发送请求
        return $this->post('/api/v1/cert/delete', $body);
    }

    /**
     * 查询证书详情
     * @access public
     * @param int $id 证书ID
     * @param string $name 证书备注名
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014505/common/10014508
     */
    public function certQuery($id, $name = null)
    {
        // 请求体
        $body = [];
        // 如果指定名称
        if(!is_null($name)){
            $body['name'] = $name;
        }
        // 未指定名称则使用ID
        else{
            $body['id'] = $id;
        }
        // 发送请求
        return $this->get('/api/v1/cert/query', $body);
    }

    /**
     * 查询证书列表
     * @access public
     * @param int $page 当前页数
     * @param int $per_page 每页显示的记录条数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014505/common/10014704
     */
    public function certList($page = 1, $per_page = 1000)
    {
        // 请求体
        $body = [
            'page' => $page,
            'per_page' => $per_page,
        ];
        // 发送请求
        return $this->get('/api/v1/cert/list', $body);
    }

    /**
     * 查询绑定某证书的域名列表
     * @access public
     * @param string $name 证书备注名
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014505/common/10014507
     */
    public function certListDomainByCert($name)
    {
        // 请求体
        $body = [
            'name' => $name,
        ];
        // 发送请求
        return $this->get('/api/v1/cert/list_domain_by_cert', $body);
    }

    /**
     * 检测域名CNAME配置状态
     * @access public
     * @param string $domains 待查询的域名
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014773/common/10015872
     */
    public function getCnameStatus($domains)
    {
        // 如果域名是数组
        if(!is_array($domains)){
            $domains = implode(',', $domains);
        }
        // 请求体
        $body = [
            'domain' => $domains,
        ];
        // 发送请求
        return $this->post('/api/v1/cname/cname_status', $body);
    }

    /**
     * 获取域名归属权校验信息
     * @access public
     * @param string $domain 域名
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014785/common/10016169
     */
    public function howToVerify($domain)
    {
        // 请求体
        $body = [
            'domain' => $domain,
        ];
        // 发送请求
        return $this->get('/api/v1/verify_domain_ownership/verify_content', $body);
    }

    /**
     * 域名归属权校验
     * @access public
     * @param string $domain 域名
     * @param int $verifyType 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014785/common/10014787
     */
    public function verifyDomainOwnership($domain, $verifyType = 1)
    {
        // 请求体
        $body = [
            'domain' => $domain,
            'verify_type' => $verifyType,
        ];
        // 发送请求
        return $this->get('/api/v1/verify_domain_ownership', $body);
    }

    /**
     * 查询当前域名已配置的产品及可新增的产品
     * @access public
     * @param string $domain 域名
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014785/common/10016160
     */
    public function domainConfiguredProductQuery($domain)
    {
        // 请求体
        $body = [
            'domain' => $domain,
        ];
        // 发送请求
        return $this->get('/api/v1/domain/configured_product_query', $body);
    }

    /**
     * 查询域名是否存在在途工单
     * @access public
     * @param string $domain 域名
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014785/common/10020372
     */
    public function domainIsExistOnwayOrder($domain)
    {
        // 请求体
        $body = [
            'domain' => $domain,
        ];
        // 发送请求
        return $this->get('/api/v1/domain/is_exist_onway_order', $body);
    }

    /**
     * 查询域名列表及域名的基础信息
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014785/common/10014801
     */
    public function domainQuery($options = [])
    {
        // 请求体
        $body = [];
        // 如果指定域名
        if(isset($options['domain'])){
            $body['domain'] = $options['domain'];
        }
        // 如果指定产品类型
        if(isset($options['product_code'])){
            $body['product_code'] = $options['product_code'];
        }
        // 如果指定域名状态
        if(isset($options['status'])){
            $body['status'] = $options['status'];
        }
        // 如果指定加速范围
        if(isset($options['area_scope'])){
            $body['area_scope'] = $options['area_scope'];
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
        return $this->get('/api/v2/domain/query', $body);
    }

    /**
     * 新增加速域名
     * @access public
     * @param string $domain 要新增的域名
     * @param array $origin 源站信息
     * @param string $productCode 产品类型
     * @param int $wafEnable 是否开启安全WAF防护
     * @param int $areaScope 加速范围
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014785/common/10014776
     */
    public function domainManage($domain, $origin, $productCode = '008', $wafEnable = null, $areaScope = null)
    {
        // 请求体
        $body = [
            'action' => 1,
            'domain' => $domain,
            'origin' => $origin,
            'product_code' => $productCode,
        ];

        // 如果指定是否开启安全WAF防护
        if(!is_null($wafEnable)){
            $body['waf_enable'] = $wafEnable;
        }
        // 如果指定加速范围
        if(!is_null($areaScope)){
            $body['area_scope'] = $areaScope;
        }
        // 发送请求
        return $this->post('/api/v1/domain/manage', $body);
    }

    /**
     * 增量修改加速域名配置信息
     * @access public
     * @param string $domain 域名
     * @param array $options 配置参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014785/common/10015873
     */
    public function domainIncreUpdate($domain, $options = [])
    {
        // 请求体
        $body = [
            'domain' => $domain,
        ];
        // 合并配置参数
        $body = array_merge($body, $options);
        // 发送请求
        return $this->post('/api/v1/domain/incre_update', $body);
    }

    /**
     * 查询域名配置信息详情
     * @access public
     * @param string $domain 域名
     * @param string $productCode 产品类型
     * @param string $functionNames 功能函数名称
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014785/common/10014786
     */
    public function domainInfo($domain, $productCode = null, $functionNames = null)
    {
        // 请求体
        $body = [
            'domain' => $domain,
        ];
        // 如果指定产品类型
        if(!is_null($productCode)){
            $body['product_code'] = $productCode;
        }
        // 功能函数名称
        if(!is_null($functionNames)){
            $body['function_names'] = $functionNames;
        }
        // 发送请求
        return $this->get('/api/v1/domain/info', $body);
    }

    /**
     * 复制域名配置信息(创建新域名并将某域名配置信息复制给新域名)
     * @access public
     * @param string $oldDomain 老域名
     * @param string $newDomain 新域名
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014785/common/10014804
     */
    public function domainCopy($oldDomain, $newDomain)
    {
        // 请求体
        $body = [
            'old_domain' => $oldDomain,
            'new_domain' => $newDomain,
        ];
        // 发送请求
        return $this->post('/api/v1/domain/copy', $body);
    }

    /**
     * 根据源站查询域名基础信息
     * @access public
     * @param string|array $origins 源站ip或域名
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014785/common/10014777
     */
    public function domainQueryByOrigins($origins)
    {
        // 如果是数组
        if(is_array($origins)){
            $origins = implode(',', $origins);
        }
        // 请求体
        $body = [
            'origins' => $origins,
        ];
        // 发送请求
        return $this->get('/api/v2/domain/query_by_origins', $body);
    }

    /**
     * 查询指定加速域名证书详情
     * @access public
     * @param string $domain 域名
     * @param string $productCode 产品类型
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014785/common/10015631
     */
    public function domainQueryDomainCertInfo($domain, $productCode = '008')
    {
        // 请求体
        $body = [
            'domain' => $domain,
            'product_code' => $productCode,
        ];
        // 发送请求
        return $this->post('/api/v1/domain/query_domain_cert_info', $body);
    }

    /**
     * 批量新增加速域名
     * @access public
     * @param string|array $domain 要新增的域名
     * @param array $origin 源站信息
     * @param string $productCode 产品类型
     * @param int $wafEnable 是否开启安全WAF防护
     * @param int $areaScope 加速范围
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014785/common/10015605
     */
    public function domainBatchManage($domain, $origin, $productCode = '008', $wafEnable = null, $areaScope = null)
    {
        // 如果域名不是数组
        if(!is_array($domain)){
            $domain = explode(',', $domain);
        }
        // 请求体
        $body = [
            'domain' => $domain,
            'origin' => $origin,
            'product_code' => $productCode,
        ];

        // 如果指定是否开启安全WAF防护
        if(!is_null($wafEnable)){
            $body['waf_enable'] = $wafEnable;
        }
        // 如果指定加速范围
        if(!is_null($areaScope)){
            $body['area_scope'] = $areaScope;
        }
        // 发送请求
        return $this->post('/api/v1/domain/batch_manage', $body);
    }

    /**
     * 批量更新域名配置
     * @access public
     * @param string|array $domain 域名
     * @param array $options 配置参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014785/common/10015632
     */
    public function domainBatchUpdateConfigurationInformation($domain, $options = [])
    {
        // 如果域名不是数组
        if(!is_array($domain)){
            $domain = explode(',', $domain);
        }
        // 请求体
        $body = [
            'domain' => $domain,
        ];
        // 合并配置参数
        $body = array_merge($body, $options);
        // 发送请求
        return $this->post('/api/v1/domain/batch_update_configuration_information', $body);
    }

    /**
     * 删除/启用/停用域名
     * @access public
     * @param string|array $domain 域名
     * @param int $status 状态操作类型
     * @param string $productCode 产品类型
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014785/common/10014803
     */
    public function domainChangeStatus($domain, $status = 3, $productCode = '008')
    {
        // 请求体
        $body = [
            'domain' => $domain,
            'status' => $status,
            'product_code' => $productCode,
        ];
        // 发送请求
        return $this->post('/api/v1/domain/change_status', $body);
    }

    /**
     * 批量启用/停用域名
     * @access public
     * @param string|array $domain 域名
     * @param int $status 状态操作类型
     * @param string $productCode 产品类型
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014785/common/10015633
     */
    public function domainBatchChangeStatus($domain, $status = 3, $productCode = '008')
    {
        // 如果域名不是数组
        if(!is_array($domain)){
            $domain = explode(',', $domain);
        }
        // 请求体
        $body = [
            'domain' => $domain,
            'status' => $status,
            'product_code' => $productCode,
        ];
        // 发送请求
        return $this->post('/api/v1/domain/batch_change_status', $body);
    }

    /**
     * 创建封禁任务
     * @access public
     * @param array $urls 待封禁URL数组
     * @param int $forbidType 封禁类型
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014509/common/10014743
     */
    public function forbidCreate($urls, $forbidType = 14)
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
    public function forbidQuery($options = [])
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

    /**
     * 创建刷新任务
     * @access public
     * @param array $urls 待刷新的文件链接数组
     * @param int $taskType 刷新类型, 1(url);2(目录dir);3(正则匹配re)
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014747/common/10014709
     */
    public function refreshManageCreate($urls, $taskType = 1)
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
    public function refreshManageQuery($options = [])
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
    public function refreshManageQuota()
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
    public function preloadManageCreate($urls)
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
    public function preloadManageQuota()
    {
        // 发送请求
        return $this->get('/api/v2/preloadmanage/quota');
    }

    /**
     * 新增报告订阅
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10015862/common/10015863
     */
    public function cdnPlusReportManageNewReport($options = [])
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
    public function cdnPlusReportManageUpdateReport($options = [])
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
    public function cdnPlusReportManageDeleteReport($reportTemplateId)
    {
        // 请求体
        $body = [
            'reportTemplateId' => $reportTemplateId,
        ];
        // 发送请求
        return $this->post('/api/v3/cdnplus/reportManage/deleteReport', $body);
    }

    /**
     * 查询报告订阅详情
     * @access public
     * @param int $reportTemplateId 报告订阅ID
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10015862/common/10015865
     */
    public function cdnPlusReportManageGetReportInfoById($reportTemplateId)
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
    public function cdnPlusReportManageTemplateList($options = [])
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
    public function cdnPlusReportManageReportList($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v3/cdnplus/reportManage/reportList', $body);
    }

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
    public function statisticsanalysisQueryPeakBandwidthData($productType, $domain = null, $time = null, $cycle = null, $abroad = null)
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
    public function statisticsanalysisQuerySummaryData($options = [])
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
    public function statisticsanalysisQueryHitFlowRateDataByDomain($options = [])
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
    public function statisticsanalysisQueryBandwidthData($options = [])
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
    public function statisticsanalysisQueryMissBandwidthData($options = [])
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
    public function statisticsanalysisQueryRequestNumData($options = [])
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
    public function statisticsanalysisQueryHttpStatusCodeData($options = [])
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
    public function statisticsanalysisQueryMissRequestNumData($options = [])
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
    public function statisticsanalysisQueryMissHttpStatusCodeData($options = [])
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
    public function statisticsanalysisQueryMissRequestFailureRateDataByDomain($options = [])
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
    public function statisticsanalysisQueryQpsData($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v2/statisticsanalysis/query_qps_data', $body);
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
    public function statisticsanalysisQueryRequestFailureRateDataByDomain($options = [])
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
    public function statisticsanalysisQueryRequestSuccessRateDataByDomain($options = [])
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
    public function statisticsanalysisQueryMissRequestSuccessRateDataByDomain($options = [])
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
    public function statisticsanalysisQueryResponseTimeData($options = [])
    {
        // 请求体
        $body = $options;
        // 发送请求
        return $this->post('/api/v2/statisticsanalysis/query_response_time_data', $body);
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
}
