<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('CaptchaInterface.php');

class Captcha64bits implements CaptchaInterface{

	public function testMyCaptcha($inputHash,$inputCaptcha){

		return $this->captchaTest($inputHash,$inputCaptcha);

	}

	private function captchaTest($inputHash,$inputCaptcha)
	{
		$inputCaptcha = strtoupper($inputCaptcha);

		$hash = 5381;

		for($i = 0; $i < strlen($inputCaptcha); $i++)
		{
			$hash = ($this->leftShift32($hash, 5) + $hash) + ord(substr($inputCaptcha, $i)); 
		}

		if ($hash != $inputHash){
			return;
		}
		return true;
	}

	private function leftShift32($number, $steps)
	{ 
	    // convert to binary (string) 
	    $binary = decbin($number); 
	    // left-pad with 0's if necessary 
	    $binary = str_pad($binary, 32, "0", STR_PAD_LEFT); 
	    // left shift manually 
	    $binary = $binary.str_repeat("0", $steps); 
	    // get the last 32 bits 
	    $binary = substr($binary, strlen($binary) - 32); 
	    // if it's a positive number return it 
	    // otherwise return the 2's complement 
	    return ($binary{0} == "0" ? bindec($binary) : 
	        -(pow(2, 31) - bindec(substr($binary, 1)))); 
	}

}