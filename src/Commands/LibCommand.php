<?php

namespace Mderrdx5341\Console\Commands;

use Mderrdx5341\Console\CommandInterface;
/*
 * Базовая команда библиотеки, принимает на вход неограниченное количество аргументов и параметров и выводит
	их на экран в читаемом виде
 */
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

	public function name() : string
	{
		return "lib_command";
	}

	public function description() : string
	{
		return "Команда принимает на вход неограниченное количество аргументов и параметров и выводит
		их на экран в читаемом виде.\n";
	}
}
