<?php

namespace Raffaelwyss\Pfa\Core;

class Server
{
	private $files = [];
	private $input = [];
	private $get = [];
	private $post = [];

	public function __construct()
	{
		$this->files = $_FILES ?? [];
		$this->get = $_GET ?? [];
		$this->input = json_decode(file_get_contents("php://input"), true);
		$this->post = $_POST ?? [];
	}

	public function getParameter($name, $default = null)
	{
		$result = $this->input[$name] ?? $default;
		if ($result === $default)
			$result = $this->get[$name] ?? $default;
		if ($result === $default)
			$result = $this->post[$name] ?? $default;
		if ($result === $default)
			$result = $this->files[$name] ?? $default;

		return $result;
	}

}
