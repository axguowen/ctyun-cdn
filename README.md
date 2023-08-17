# Ctyun CDN PHP SDK

PHP SDK包要求运行环境至少为PHP 5.6 版本(暂不支持PHP 8及以上版本)，如 5.6、7.0、7.1、7.2、7.3。


## 安装
~~~
composer require axguowen/ctyun-cdn
~~~

## 创建刷新URL任务
~~~php
use axguowen\ctyun\services\cdn\Auth;
use axguowen\ctyun\services\cdn\CdnClient;
// 实例化授权类
$ctyunAuth = new Auth('CTYUN_ACCESSID', 'CTYUN_ACCESSSECRET');
$cdnClient = new CdnClient($ctyunAuth);
// 刷新链接
$cdnClient->refreshManageCreate(['https://xxxx/xxxx.html', 'https://xxxx/ccccc.html']);
~~~