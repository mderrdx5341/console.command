<?php

namespace Mderrdx5341\Console\Commands;

use Mderrdx5341\Console\CommandInterface;

class CommandTest implements CommandInterface
{
	public function run()
	{
		echo "test command";
	}

	public function name()
	{
		return "lib_command";
	}
}
