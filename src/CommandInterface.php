<?php

namespace Mderrdx5341\Console;

/*
 * Интерфейс для комманд
 */
interface CommandInterface
{
	/*
	 * Метод для запуска комманды
	 *
	 * @param Array массив с аргументами и параметрами вида ['args'=>[], 'params=>['name'=>['value', 'value2]]]
	 */
	public function run(Array $args);

	/*
	 * Имя команды
	 */
	public function name() : string;
	/*
	 * Описание комманды
	 */
	public function description() : string;
}
