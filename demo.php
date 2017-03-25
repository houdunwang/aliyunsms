<?php
require 'vendor/autoload.php';
\houdunwang\config\Config::set( 'aliyunsms', [
	'accessKey'    => 'LTAIPSSlOmIqFeo3',
	'accessSecret' => 'VA5HVmet9ioRRIxs9muZ2qQrpD1c6M'
] );
$data['sign']   = '后盾人';
$data['mobile'] = '18600276067';
$data['code']   = 'SMS_57925178';
$data['vars']   = [
	'code' => '333abc',
	'tel'  => '13910959565'
];
\houdunwang\aliyunsms\Sms::send( $data );