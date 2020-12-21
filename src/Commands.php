<?php

namespace Mderrdx5341\Console;

/*
 * Класс для регистрации и запуска команд
 */
class Commands
{
	protected $commands = [];

	/*
	 * Конструктор принимает на вход директорию для поиска команд реализуемых вне библиотеки
	 */
	public function __construct($dir = '')
	{
		$c = new \ReflectionClass($this);
		$libDir = str_replace($c->getShortName() . '.php', '', $c->getFileName());

		$this->includeFiles($this->getFiles($libDir . 'Commands/' ));
		$this->includeFiles($this->getFiles($dir));

		$this->registerCommands();
	}

	/*
	 * Метод запускае выполнение комманд
	 */
	public function run($args)
	{
		if (count($args) === 1) {
			$this->printCommandList();
		}

		if (count($args) > 1) {
			$command = $args[1];
			array_splice($args, 0, 2);
			$parser = new ParserCommandLineArgs($args);

			if(count($parser->getArgs()) > 0 && $parser->getArgs()[0] === 'help') {
				echo $this->commands[$command]->description();
			} else {
				$this->commands[$command]->run($parser->getArgsAndParams());
			}
		}
	}

	/*
	 * Выводит список зарегистрированных комманд
	 */
	protected function printCommandList()
	{
		echo "Commands:\n";
		foreach($this->commands as $command) {
			echo "\t{$command->name()} - {$command->description()}\n";
		}
	}

	/*
	 * Регистрация найденых команд, комманды регистрируются если реализуют интерфейс Mderrdx5341\Console\CommandInterface
	 */
	protected function registerCommands()
	{
		foreach(get_declared_classes() as $class) {
			$c = new \ReflectionClass($class);
			if ($c->implementsInterface('Mderrdx5341\Console\CommandInterface')) {
				$command = new $class();
				$this->commands[$command->name()] = $command;
			}
		}
	}

	/*
	 * Подключение найденых файлов в указаной директории
	 */
	protected function includeFiles($files)
	{
		foreach ($files as $file) {
			include($file);
		}
	}

	/*
	 * Поиск файлов в указаной директории
	 */
	protected function getFiles($dir)
	{
		if(!file_exists($dir)) {
			return [];
		}
		$commands = [];
		foreach (scandir($dir) as $file) {
			if(!is_dir($dir . $file))
			{
				$commands[] = $dir . $file;
			}
		}

		return $commands;
	}
}
