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

class Domain extends BaseClient
{
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
    public function configuredProductQuery($domain)
    {
        // 请求体
        $body = [
            'domain' => $domain,
        ];
        // 发送请求
        return $this->get('/api/v1/domain/configured_product_query', $body);
    }

    /**
     * 查询域名列表及域名的基础信息
     * @access public
     * @param array $options 查询参数
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014785/common/10014801
     */
    public function query($options = [])
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
    public function manage($domain, $origin, $productCode = '008', $wafEnable = null, $areaScope = null)
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
    public function increUpdate($domain, $options = [])
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
    public function info($domain, $productCode = null, $functionNames = null)
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
    public function copy($oldDomain, $newDomain)
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
    public function queryByOrigins($origins)
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
    public function queryDomainCertInfo($domain, $productCode)
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
    public function batchManage($domain, $origin, $productCode = '008', $wafEnable = null, $areaScope = null)
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
    public function batchUpdateConfigurationInformation($domain, $options = [])
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
     * 批量启用/停用域名
     * @access public
     * @param string|array $domain 域名
     * @param int $status 状态操作类型
     * @param string $productCode 产品类型
     * @return array
     * @link https://vip.ctcdn.cn/help/10005260/10014785/common/10015633
     */
    public function batchChangeStatus($domain, $status = 3, $productCode = '008')
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
}
