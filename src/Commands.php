<?php

namespace Mderrdx5341\Console;

class Commands
{
	protected $commands = [];

	public function __construct($dir = '')
	{
		$c = new \ReflectionClass($this);
		$libDir = str_replace($c->getShortName() . '.php', '', $c->getFileName());

		$this->includeFiles($this->getFiles($libDir . 'Commands/' ));
		$this->includeFiles($this->getFiles($dir));

		$this->registerCommands();
	}

	public function run($args)
	{
		if (count($args) === 1) {
			foreach($this->commands as $command) {
				echo $command->name() . "\n";
			}
		}

		if (count($args) > 1) {
			$this->commands[$args[1]]->run();
		}
	}

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

	protected function includeFiles($files)
	{
		foreach ($files as $file) {
			include($file);
		}
	}

	protected function getFiles($dir)
	{
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
