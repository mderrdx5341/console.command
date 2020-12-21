<?php

namespace Mderrdx5341\Console;

class Commands
{
	protected $dir;
	protected $commands = [];

	public function __construct($dir = '')
	{
		$this->dir = $dir;
		$this->includeFiles($this->getFiles());
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

	protected function getFiles()
	{
		$commands = [];
		foreach (scandir($this->dir) as $file) {
			if(!is_dir($this->dir . $file))
			{
				$commands[] = $this->dir . $file;
			}
		}

		return $commands;
	}
}
