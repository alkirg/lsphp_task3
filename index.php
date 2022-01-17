<?php
require_once 'src/functions.php';

$users = generateUsers();
saveUsers($users);
$users = getUsers(true);
dump($users);
$userNames = countNames($users);
dump($userNames);
echo 'Средний возраст: ' . countAverageAge($users);