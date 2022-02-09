<?php

namespace Raffaelwyss\Pfa\Core;

use Exception;

class App
	implements IApp
{
	private $routeName;
	private $template;

	public function getRouteName()
	{
		return $this->routeName;
	}

	public function run()
	{
		throw new Exception('Not Implemented');
	}

	protected function getAppName()
	{
		$class = explode('\\', get_class($this));
		$result = $class[2] ?? 'undefined';

		return $result;
	}

	protected function getTemplateName()
	{
		return $this->template;
	}

	public function setRouteName(string $name)
	{
		$this->routeName = $name;
	}

	protected function setTemplateName($name)
	{
		$this->template = $name;
	}

	protected function showTemplate()
	{
		$appName = $this->getAppName();
		$templateName = $this->getTemplateName();
		$markup = file_get_contents("../templates/Core/markup.html");
		$header = file_get_contents("../templates/Core/header.html");
		$footer = file_get_contents("../templates/Core/footer.html");
		$body = file_get_contents("../templates/$appName/$templateName");
		$markup = str_replace('%FOOTER%', $footer, $markup);
		$markup = str_replace('%HEADER%', $header, $markup);
		$markup = str_replace('%BODY%', $body, $markup);

		print_r($markup);
	}
}
