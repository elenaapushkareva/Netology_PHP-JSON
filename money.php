<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if (empty($argv[1])) {
    exit('Ошибка! Укажите флаг --today или запустите скрипт с аргументами {цена} и {описание покупки}');
}

date_default_timezone_set('GMT');
$a = date('Y-m-d');
// Открываем / создаем для записи файл money.csv
$resource = fopen(__DIR__ . DIRECTORY_SEPARATOR . 'money.csv', 'a+');
if (!$resource) {
    echo 'Cant read the file';
    exit;
}


// Если НЕ введен флаг --today
if ($argv[1] != '--today') {
    $b = array($a, implode(';',array_slice($argv, 1, 1)), implode(';',array_slice($argv, 2)));
    $fp = fputcsv($resource, $b, ';');
    echo 'Добавлена строка:'. $a .' '. $argv['1'] . ' ' . $argv['2'];
}else{ //Если введен флаг --today суммируем расходы за день
    $c = array();
    $row = 0;
    $total = 0;
    while ($data = fgetcsv($resource, 0, ';')){ 
        $row++;
        if($data[0] == date('Y-m-d')) {
            $total = $total + $data[1];
        }
        echo PHP_EOL;
    }
    echo 'Сегодня ' . $a . ' Вы потратили ' . $total . ' рублей';
}

if (!empty($resource)) fclose($resource);
?>