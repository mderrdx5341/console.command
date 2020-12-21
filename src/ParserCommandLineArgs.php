<?php

namespace Mderrdx5341\Console;

/*
 * Класс для парсинга консольных аргуметов и параметров
 */
class ParserCommandLineArgs
{
	protected $args = [];
	protected $params = [];

	public function __construct($args)
	{
		foreach($args as $arg) {
			if (stripos($arg , '[') === 0) { // заносим параметры в массив
				$param = str_replace(['[',']'], '', $arg);
				list($param, $value) = explode('=', $param);
				$this->params[$param][] = $value;
			} else { //заносим аргументы в массив
				$arg = str_replace(['{','}'], '', $arg);
				if ($arg === 'help') { //если аргумент help, то очищаем массивы параметров и аргументов и оставляем только один аргумент
					$this->args = [$arg];
					$this->params = [];
					break;
				}
				$this->args[] = $arg;
			}
		}
	}

	/*
	 * Возвращает массив аргументов и параметров
	 */
	public function getArgsAndParams() : Array
	{
		return [
			'args' => $this->getArgs(),
			'params' => $this->getParams()
		];
	}

	/*
	 * Возвращает массив аргументов
	 */
	public function getArgs() : Array
	{
		return $this->args;
	}

	/*
	 * Возвращает массив параметров
	 */
	public function getParams() : Array
	{
		return $this->params;
	}
}
