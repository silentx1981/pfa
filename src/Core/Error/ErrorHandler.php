<?php

namespace Raffaelwyss\Pfa\Core\Error;

class ErrorHandler
{
	public static function activate()
	{
		ini_set('display_errors', 'Off');
		register_shutdown_function([new ErrorHandler(), 'errorHandle']);
	}

	public function errorHandle()
	{
		$error = error_get_last();

		if ($error !== NULL) {
			$errno   = $error["type"];
			$errfile = $error["file"];
			$errline = $error["line"];
			$errstr  = $error["message"];

			echo '<pre>';
			print_r('FatalError');
			print_r($error);
		}

		return true;
	}
}
