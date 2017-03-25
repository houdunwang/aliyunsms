#阿里云短信处理服务
使用阿里云短信平台发送短信，请先在阿里云开通短信服务后使用。

##发送短信
```
//accesskeys 登录 https://ak-console.aliyun.com/?spm=5176.2020520168.1001.d605.d9u6KJ#/ 查看
\houdunwang\config\Config::set( 'aliyunsms', [
	'accessKey'    => '',
	'accessSecret' => ''
] );
$data['sign']   = '签名名称';
$data['mobile'] = '手机号';
$data['code']   = '模板编号';
//以下是模板中的变量
$data['vars']   = [
	'code' => '',
	'tel'  => '13910959565'
];
\houdunwang\aliyunsms\Sms::send( $data );
```