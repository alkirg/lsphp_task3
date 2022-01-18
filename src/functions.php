<?php
const NAMES = [
    'Сократ',
    'Платон',
    'Аристотель',
    'Эпикур',
    'Зенон',
];
const MIN_AGE = 18;
const MAX_AGE = 45;

const ERR_FILE_OPEN = 'Невозможно открыть файл';
const ERR_FILE_WRITE = 'Файл недоступен для записи';

/**
 * Создает 50 пользователей
 */
function generateUsers(): array
{
    $result = [];
    for ($i = 1; $i <= 50; $i++) {
        $result[] = [
            'id' => $i,
            'name' => NAMES[array_rand(NAMES)],
            'age' => mt_rand(MIN_AGE, MAX_AGE)
        ];
    }
    return $result;
}

/**
 * Преобразует пользователей в формат json и сохраняет в файл users.json
 */
function saveUsers($users): bool
{
    $users = json_encode($users);
    $file = file_put_contents('users.json', $users);
    if (!$file) {
        echo ERR_FILE_OPEN;
        return false;
    }
    return true;
}

/**
 * Берет пользователей из файла json и возвращает в виде массива или объекта
 */
function getUsers($associative = false)
{
    $users = file_get_contents('users.json');
    if (!$users) {
        echo ERR_FILE_OPEN;
        return false;
    }
    return json_decode($users, $associative);
}

/**
 * Считает количество имен и возвращает массив в виде пар "имя => количество"
 */
function countNames($users)
{
    $result = [];
    foreach ($users as $user) {
        $result[$user['name']]++;
    }
    return $result;
}

/**
 * Считает средний возраст пользователей
 */
function countAverageAge($users)
{
    $result = 0;
    foreach ($users as $user) {
        $result += $user['age'];
    }
    return round($result / count($users));
}

/**
 * Выводит дамп переменной в удобном виде 
 */
function dump($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}