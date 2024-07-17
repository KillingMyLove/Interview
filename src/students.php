<?php

$data = [
    ['Иванов', 'Математика', 5],
    ['Иванов', 'Математика', 4],
    ['Иванов', 'Математика', 5],
    ['Петров', 'Математика', 5],
    ['Сидоров', 'Физика', 4],
    ['Иванов', 'Физика', 4],
    ['Петров', 'ОБЖ', 4],
];

$newData = []; //массив с новыми данными (в правильном виде)

foreach ($data as $value) {
    $name = $value[0];
    $subject = $value[1];
    $mark = $value[2];

    if (!isset($newData[$name][$subject])){ //если ещё нет поля со отметкой за предмет у человека, то делаём её пустой
        $newData[$name][$subject] = 0;
    }
    $newData[$name][$subject] += $mark; //считаем сумму по предмету у человека
}
arsort($newData); // сортируеми в алфавитном порядке учеников

