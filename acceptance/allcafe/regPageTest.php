<?php
$tester = new \Tester();
$tester->setUrl(Config::get('allcafe'));

$m = $tester->send('/community/reg', [
    'login' => 'zhenia.abramovich@mail.ru',
    'password' => '12345678',
    'password2' => '12345678',
    'email' => '12345678',
    'city' => 'Санкт-Петербург',
]);
//print_r($m);
$tester->seeText('Вы ввели неправильный код подтверждения');
$tester->seeResponseCode(200);

