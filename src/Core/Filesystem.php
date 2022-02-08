<?php

namespace Raffaelwyss\Pfa\Core;

class Filesystem
{
	public static function scanDirectory($directory, $parameter = [])
	{
		$isDir = $parameter['isDir'] ?? false;
		$isFile = $parameter['isFile'] ?? false;

		if (!is_dir($directory))
			return [];

		$result = scandir($directory);
		if (!is_array($result))
			return [];

		$result = array_filter($result, function($value) use ($directory, $isDir, $isFile) {
			if ($value === '.' || $value === '..')
				return false;
			if ($isDir && !is_dir("$directory/$value"))
				return false;
			if ($isFile && !is_file("$directory/$value"))
				return false;

			return true;
		});
		$result = array_values($result);

		return $result;
	}

}
