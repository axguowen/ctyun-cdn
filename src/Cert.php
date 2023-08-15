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

class Cert extends BaseClient
{
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
    public function create($name, $key, $certs, $email = '')
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
    public function delete($name)
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
    public function query($id, $name = null)
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
    public function getList($page = 1, $per_page = 1000)
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
    public function listDomainByCert($name)
    {
        // 请求体
        $body = [
            'name' => $name,
        ];
        // 发送请求
        return $this->get('/api/v1/cert/list_domain_by_cert', $body);
    }
}
