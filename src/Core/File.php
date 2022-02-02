<?php

namespace Raffaelwyss\Pfa\Core;

class File
{
	public static function scanDirectory($directory)
	{
		$result = scandir($directory);
		$result = array_filter($result, function($value) {
			if ($value === '.' || $value === '..')
				return false;

			return true;
		});
		$result = array_values($result);

		return $result;
	}

}
