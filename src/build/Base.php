<?php
/** .-------------------------------------------------------------------
 * |  Software: [HDCMS framework]
 * |      Site: www.hdcms.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/
namespace houdunwang\aliyunsms\build;
include_once __DIR__.DIRECTORY_SEPARATOR.'aliyun-php-sdk-core/Config.php';
use houdunwang\config\Config;
use Sms\Request\V20160927 as Sms;

/**
 * 阿里云短信处理
 * Class Base
 * @package houdunwang\aliyunsms\build
 */
class Base {
	/**
	 * 发送短信
	 *
	 * @param array $data
	 * $data=[
	 *  'sign'=>'签名名称',
	 *  'code'=>'模板code',
	 *  'mobile'=>'手机号',
	 *  //以下是模板中的变量
	 *  'vars'=>[
	 *      'code'=>333,
	 *  ]
	 * ]
	 */
	public function send( array $data ) {
		chdir(__DIR__);
		$iClientProfile = \DefaultProfile::getProfile( "cn-hangzhou",
			Config::get( 'aliyunsms.accessKey' ), Config::get( 'aliyunsms.accessSecret' ) );
		$client         = new \DefaultAcsClient( $iClientProfile );
		$request        = new Sms\SingleSendSmsRequest();

		/*签名名称*/
		$request->setSignName( $data['sign'] );
		/*模板code*/
		$request->setTemplateCode( $data['code'] );
		/*目标手机号*/
		$request->setRecNum( $data['mobile'] );
		$request->setParamString( json_encode( $data['vars'], JSON_UNESCAPED_UNICODE ) );
//		$vars = [
//			'code'    => '9999',
//			'product' => '后盾人'
//		];
//		$request->setParamString( json_encode( $vars, JSON_UNESCAPED_UNICODE ) );
		try {
			$response = $client->getAcsResponse( $request );
			print_r( $response );
		} catch ( \ClientException  $e ) {
			print_r( $e->getErrorCode() );
			print_r( $e->getErrorMessage() );
		} catch ( \ServerException  $e ) {
			print_r( $e->getErrorCode() );
			print_r( $e->getErrorMessage() );
		}
	}
}