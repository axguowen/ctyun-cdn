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

use axguowen\HttpClient;
use axguowen\httpclient\Error;
use axguowen\ctyun\services\cdn\common\Auth;

abstract class BaseClient
{
    /**
     * 授权对象实例
     * @var Auth
     */
    protected $auth;

    /**
     * 请求接口根地址
     * @var string
     */
    protected $baseUrl = 'https://open.ctcdn.cn';

    /**
     * 架构函数
     * @access public
     * @param Auth $auth 授权对象实例
     */
    public function __construct(Auth $auth)
    {
        // 授权对象实例赋值
        $this->auth = $auth;
    }

    /**
     * 发送POST请求
     * @access protected
     * @param string $path 请求接口
     * @param array $body 请求参数
     * @return array
     */
    protected function post($path, $body = [])
    {
        // 通过请求接口获取授权请求头
        $headers = $this->auth->authorization($path);
        // 追加请求头
        $headers['Content-Type'] = 'application/json;charset=utf-8';
        // 如果请求体是数组
        if(is_array($body)){
            $body = json_encode($body);
        }
        // 发送请求
        $ret = HttpClient::post($this->baseUrl . $path, $body, $headers);
        if (!$ret->ok()) {
            return [null, new Error($path, $ret)];
        }
        $r = ($ret->body === null) ? [] : $ret->json();
        return [$r, null];
    }

    /**
     * 发送GET请求
     * @access protected
     * @param string $path 请求接口
     * @param array $query 请求参数
     * @return array
     */
    protected function get($path, $query = [])
    {
        // 如果请求参数不为空
        if(!empty($query)){
            // 拼接请求参数
            $path .= (false === strpos($path, '?') ? '?' : '&') . http_build_query($query);
        }
        // 通过请求接口获取授权请求头
        $headers = $this->auth->authorization($path);
        // 发送请求
        $ret = HttpClient::get($this->baseUrl . $path, $headers);
        if (!$ret->ok()) {
            return [null, new Error($path, $ret)];
        }
        $r = ($ret->body === null) ? [] : $ret->json();
        return [$r, null];
    }
}
