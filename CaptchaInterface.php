<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface CaptchaInterface{

	public function testMyCaptcha($inputHash,$inputCaptcha);

}