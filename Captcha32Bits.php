<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('CaptchaInterface.php');

class Captcha32bits implements CaptchaInterface{

	public function testMyCaptcha($inputHash,$inputCaptcha){

		return $this->captchaTest($inputHash,$inputCaptcha);

	}

	private function captchaTest($inputHash,$inputCaptcha)
	{
		$inputCaptcha = strtoupper($inputCaptcha);

		$hash = 5381;

		for($i = 0; $i < strlen($inputCaptcha); $i++)
		{
			$hash = (($hash << 5) + $hash) + ord(substr($inputCaptcha, $i));
		}

		if ($hash != $inputHash){
			return;
		}
		return true;
	}

}