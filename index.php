<?php
require_once 'src/functions.php';

// создать массив из 50 пользователей
$users = generateUsers();
// сохранить массив в файл
saveUsers($users);
// прочитать данные из файла и вывести в виде ассоциативного массива
$users = getUsers(true);
dump($users);
// посчитать количество пользователей с каждым именем
$userNames = countNames($users);
dump($userNames);
// посчитать средний возраст
echo 'Средний возраст: ' . countAverageAge($users);