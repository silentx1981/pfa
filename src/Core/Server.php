<?php

namespace Raffaelwyss\Pfa\Core;

class Server
{
	private $files = [];
	private $input = [];

	public function __construct()
	{
		$this->files = $_FILES ?? [];
		$this->input = json_decode(file_get_contents("php://input"), true);
	}

	public function getParameter($name, $default = null)
	{
		$result = $this->input[$name] ?? $default;
		if ($result === $default)
			$result = $this->files[$name] ?? $default;

		return $result;
	}

}
