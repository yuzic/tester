<?php
$tester = new \Tester();
$tester->setUrl(Config::get('regforum'));
$tester->send('/', []);
//
$tester->seeText('Добро пожаловать на Регфорум');
$tester->seeText('Зарегистрироваться на Регфоруме');
$tester->seeText('Форум');
$tester->seeText('Публикации');
$tester->seeText('Лучшие');
$tester->seeResponseCode(200);