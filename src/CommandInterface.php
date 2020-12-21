<?php

namespace Mderrdx5341\Console;

interface CommandInterface
{
	public function run(Array $args);
	public function name();
}
