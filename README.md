#阿里云短信处理服务
使用阿里云短信平台发送短信，请先在阿里云开通短信服务后使用。

[TOC]
## 开始使用
安装组件 使用 composer 命令进行安装或下载源代码使用。

```
composer require houdunwang/aliyunsms
```

## 环境配置
```
\houdunwang\config\Config::set( 'aliyunsms',[
    /*
    |--------------------------------------------------------------------------
    | 访问MNS的接入地址，登陆MNS控制台 单击右上角 获取Endpoint 查看
    */
    'endPoint'       => 'https://297600.mns.cn-hangzhou.aliyuncs.com/',

    /*
    |--------------------------------------------------------------------------
    | 如果使用主账号访问，登陆阿里云 AccessKey 管理页面创建、查看
    | 如果使用子账号访问，请登录阿里云访问控制控制台查看
    */
    'accessId'           => '',

    /*
    |--------------------------------------------------------------------------
    | 如果使用主账号访问，登陆阿里云 AccessKey 管理页面创建、查看
    | 如果使用子账号访问，请登录阿里云访问控制控制台查看
    */
    'accessKey'  => '',

    /*
    |--------------------------------------------------------------------------
    | 短信专用主题
    |--------------------------------------------------------------------------
    | 进入控制台短信概览页，获取主题名称
    */
    'topic'  => 'sms.topic-cn-hangzhou'
]);
```

## 发送短信
```
$data = [
    //短信签名
	'sign'     => '后盾网',
	//短信模板
	'template' => 'SMS_12840363',
	//手机号
	'mobile'   => '手机号',
	//模板变量
	'vars'     => ["code" => "8888", "product" => "hdphp"],
];
$res    = Sms::send($data);
if($res['errcode']==0){
	echo '发送成功,短信编号'.$res['messageId'];
}else{
	echo $res['message'];
}
```