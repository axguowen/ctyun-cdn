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

namespace axguowen\ctyun\services\cdn\common;

class Auth
{
    /**
     * 授权ID
     * @var string
     */
    protected $accessId;

    /**
     * 授权密钥
     * @var string
     */
    protected $accessSecret;

    /**
     * 架构函数
     * @access public
     * @param string $accessId 授权ID
     * @param string $accessSecret 授权密钥
     * @link https://vip.ctcdn.cn/h5/iam/?#/profile/accessKey
     */
    public function __construct($accessId, $accessSecret)
    {
        // 授权ID赋值
        $this->accessId = $accessId;
        // 授权密钥赋值
        $this->accessSecret = $accessSecret;
    }

    /**
     * 获取授权密钥
     * @access public
     * @return string
     */
    public function getAccessSecret()
    {
        return $this->accessSecret;
    }

    /**
     * 获取授权请求头参数
     * @access public
     * @param string $url 要请求的接口地址
     * @return string
     */
    public function authorization($url)
    {
        // 获取当前时间戳
        $nowtime = time() * 1000;
        // 拼接签名密钥字符串
        $signKeyStr =  $this->accessId . ':' . floor($nowtime / 86400000);
        // 构造签名密钥
        $signKey = $this->buildSignature($signKeyStr, $this->accessSecret);
        // 根据请求URL拼接待签名的字符串
        $stringToSign = $this->accessId . "\n" . $nowtime . "\n" . $url;
        // 构建签名
        $signature = $this->buildSignature($stringToSign, $signKey);
        // 构建请求头数组
        $header = [
			'x-alogic-now' => $nowtime,
			'x-alogic-app' => $this->accessId,
			'x-alogic-signature' => $signature,
			'x-alogic-ac' => 'app',
        ];
        // 返回
        return $header;
    }

    /**
     * 对提供的数据进行urlsafe的base64编码
     * @access protected
     * @param string $data 待编码的字符串
     * @return string
     */
    protected function base64UrlSafeEncode($data)
    {
        // 要查找的字符串
        $find = ['+', '/'];
        // 替换的字符串
        $replace = ['-', '_'];
        // base64编码并替换
        $result = str_replace($find, $replace, base64_encode($data));
        // 去掉结尾的等号
        $result = rtrim($result, '=');
        // 返回
        return $result;
    }

    /**
     * 对提供的urlsafe的base64编码的数据进行解码
     * @access protected
     * @param string $data 待解码的字符串
     * @return string
     */
    protected function base64UrlSafeDecode($data)
    {
        // 要查找的字符串
        $find = ['-', '_'];
        // 替换的字符串
        $replace = ['+', '/'];
        // 补齐结尾的等号
        $data = str_pad($data, strlen($data) % 4, '=', STR_PAD_RIGHT);
        // 替换字符串并base64解码
        $result = base64_decode(str_replace($find, $replace, $data));
        // 返回
        return $result;
    }

    /**
     * 构造签名串
     * @access protected
     * @param string $stringToSign 待签名的字符串
     * @param string $key 签名密钥
     * @return string
     */
    protected function buildSignature($stringToSign, $key)
    {
        // sha256加密
        $hashdata = hash_hmac('sha256', $stringToSign, $this->base64UrlSafeDecode($key), true);
        // urlsafe的base64编码
        $data = $this->base64UrlSafeEncode($hashdata);
        // 返回
        return $data;
    }
}
