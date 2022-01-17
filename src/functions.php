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

function saveUsers($users): bool
{
    $users = json_encode($users);
    $file = fopen('users.json', 'w');
    if (!$file) {
        echo ERR_FILE_OPEN;
        return false;
    }
    if (!is_writable('users.json')) {
        echo ERR_FILE_WRITE;
        return false;
    }
    fwrite($file, $users);
    fclose($file);
    return true;
}

function getUsers($associative = false)
{
    $users = file_get_contents('users.json');
    if (!$users) {
        echo ERR_FILE_OPEN;
        return false;
    }
    return json_decode($users, $associative);
}

function countNames($users)
{
    $result = [];
    foreach ($users as $user) {
        $result[$user['name']]++;
    }
    return $result;
}

function countAverageAge($users)
{
    $result = 0;
    foreach ($users as $user) {
        $result += $user['age'];
    }
    return round($result / count($users));
}

function dump($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}