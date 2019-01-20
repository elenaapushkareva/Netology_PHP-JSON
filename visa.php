<?php
if ($argv[1] == NULL) {
    echo "Ошибка! Укажите название страны для получения информации";
    exit;
}
// Получаем данные с внешнего ресурса
$resource = fopen('https://data.gov.ru/opendata/7704206201-country/data-20180609T0649-structure-20180609T0649.csv?encoding=UTF-8', r);
$row = 0;
while ($data = fgetcsv($resource, 0, ',')){ 
    $row++;
    foreach ($data as $key => $value) {
        // Если значение обрабатываемого элемента равно значению введенной пользователем страны
        if ($data[$key] == $argv[1]) {
            echo "{$data[$key]} : {$data[4]}";
        }
    }
}
?>