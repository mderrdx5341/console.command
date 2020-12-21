<?php

namespace Mderrdx5341\Console\Commands;

use Mderrdx5341\Console\CommandInterface;

class CommandTest implements CommandInterface
{
	public function run($args)
	{
		echo 'Called command: ' . $this->name() . "\n\n";

		echo "Arguments:\n";
		foreach ($args['args'] as $arg) {
			echo "\t- {$arg}\n";
		}

		echo "Options:\n";
		foreach ($args['params'] as $param => $values) {
			echo "\t- {$param}\n";
			foreach ($values as $value) {
				echo "\t\t - {$value}\n";
			}
		}
	}

	public function name()
	{
		return "lib_command";
	}
}
