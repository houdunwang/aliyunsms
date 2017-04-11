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
include_once __DIR__ . DIRECTORY_SEPARATOR . 'aliyun-php-sdk-core/Config.php';
use houdunwang\config\Config;
use Sms\Request\V20160927 as Sms;

/**
 * 阿里云短信处理
 * Class Base
 * @package houdunwang\aliyunsms\build
 */
class Base {
	protected $error;

	/**
	 * 发送短信
	 *
	 * @param array $data
	 * $data=[
	 *  'code'=>'模板code',
	 *  'mobile'=>'手机号',
	 *  //以下是模板中的变量
	 *  'vars'=>[
	 *      'code'=>333,
	 *  ]
	 * ]
	 *
	 * @return bool
	 */
	public function send( array $data ) {
		chdir( __DIR__ );
		$iClientProfile = \DefaultProfile::getProfile( "cn-hangzhou",
			Config::get( 'aliyunsms.accessKey' ),
			Config::get( 'aliyunsms.accessSecret' )
		);
		$client         = new \DefaultAcsClient( $iClientProfile );
		$request        = new Sms\SingleSendSmsRequest();

		/*签名名称*/
		$request->setSignName( Config::get( 'aliyunsms.sign' ) );
		/*模板code*/
		$request->setTemplateCode( $data['template_code'] );
		/*目标手机号*/
		$request->setRecNum( $data['mobile'] );
		$request->setParamString( json_encode( $data['vars'], JSON_UNESCAPED_UNICODE ) );

		chdir( dirname( $_SERVER['SCRIPT_FILENAME'] ) );
		try {
			$client->getAcsResponse( $request );

			return true;
		} catch ( \ClientException  $e ) {
//			print_r( $e->getErrorCode() );
//			print_r( $e->getErrorMessage() );
			$this->error = $e->getErrorMessage();

			return false;
		} catch ( \ServerException  $e ) {
//			print_r( $e->getErrorCode() );
//			print_r( $e->getErrorMessage() );
			$this->error = $e->getErrorMessage();

			return false;
		}
	}

	/**
	 * 获取错误信息
	 * @return mixed
	 */
	public function getError() {
		return $this->error;
	}
}