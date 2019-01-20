<?php
if ($argv[1] == NULL) {
    echo "Ошибка! Укажите флаг --today или запустите скрипт с аргументами {цена} и {описание покупки}";
    exit;
}
date_default_timezone_set(GMT);
$a = date('Y-m-d');
// Открываем / создаем для записи файл money.csv
$resource = fopen(__DIR__ . DIRECTORY_SEPARATOR . 'money.csv', 'a+');
print_r($argv);
if (!$resource) {
    echo "Can't read the file";
    exit;
}
// Если НЕ введен флаг --today
if ($argv[1] != "--today") {
    $b = array($a, implode(';',array_slice($argv, 1, 1)), implode(';',array_slice($argv, 2)));
    $fp = fputcsv($resource, $b, ';');
    $fp = file(__DIR__ . DIRECTORY_SEPARATOR . 'money.csv');
    print_r($fp);
}else{ //Если введен флаг --today суммируем расходы за день
    $c = array();
    $row = 0;
    while ($data = fgetcsv($resource, 0, ';')){ 
        $row++;
        if($data[0] == date('Y-m-d')) {
            $total = $total + $data[1];
        }
        echo PHP_EOL;
    }
    echo "Сегодня " . $a . " Вы потратили " . $total . " рублей";
}
?>