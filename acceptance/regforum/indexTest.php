<?php
$tester = new \Tester();
// утсновка параметров из конфигурационного файла
$tester->setUrl(Config::get('regforum'));
// утсановка теcтируемого url
$tester->send('/', []);
// смотрим на текст на странице
$tester->seeText('Добро пожаловать на Регфорум');
$tester->seeText('Зарегистрироваться на Регфоруме');
$tester->seeText('Форум');
$tester->seeText('Публикации');
$tester->seeText('Лучшие');
$tester->seeResponseCode(200);