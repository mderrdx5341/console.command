Загрузка библиотеки `composer.json`

```json
{
    "require": {
        "mderrdx5341/mderrdx5341-console.command": "dev-master"
    },
	"repositories": [
        {
            "type": "git",
            "url": "https://github.com/mderrdx5341/mderrdx5341-console.command.git"
        }
    ]
}
```

Подключение и использование


```php
<?php
include(__DIR__ . '/vendor/autoload.php');

use Mderrdx5341\Console\Commands;

$commands = new Commands(__DIR__ . '/Commands/'); //указание директории с классами комманды
$commands->run($GLOBALS['argv']); //Запуск обработки консольных команд
```

Класс команды должен реализовывать интерфейс 
`use Mderrdx5341\Console\CommandInterface;`
