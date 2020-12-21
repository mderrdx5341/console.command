<?php

namespace Mderrdx5341\Console;

class ParserCommandLineArgs
{
	protected $args = [];
	protected $params = [];

	public function __construct($args)
	{
		foreach($args as $arg) {
			if (stripos($arg , '[') === 0) {
				$param = str_replace(['[',']'], '', $arg);
				list($param, $value) = explode('=', $param);
				$this->params[$param][] = $value;
			} else {
				$arg = str_replace(['{','}'], '', $arg);
				$this->args[] = $arg;
			}
		}
	}

	public function getArgsAndParams()
	{
		return [
			'args' => $this->getArgs(),
			'params' => $this->getParams()
		];
	}

	public function getArgs() : Array
	{
		return $this->args;
	}

	public function getParams() : Array
	{
		return $this->params;
	}
}
