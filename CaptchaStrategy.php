<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('Captcha64Bits.php');
require_once('Captcha32Bits.php');

class CaptchaStrategy {

	public $initialize;
	public function __construct(){
		$this->indentifyServerArchitecture();
	}

	public function indentifyServerArchitecture()
	{

		$architecture = posix_uname();

		if ($architecture['machine'] == 'x86_64') 
		{
			$this->initialize = new captcha64bits();
		} else {
			$this->initialize =  new captcha32bits();
		}

		return $this->initialize;

	}
}