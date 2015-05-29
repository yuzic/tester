<?php
$tester = new \Tester();
$tester->setUrl(Config::get('allcafe'));

$m = $tester->send('/community/reg/', [
    'login' => 'zhenia@dws2323.ru',
    'password' => '12345678',
    'password2' => '12345678',
    'email' => 'zhenia.abramovich@mail.ru',
    'city' => 'Санкт-Петербург',
    'code' => 123456,
    'submit'    => 'Зарегистрироваться'
]);
$tester->seeText('неправильный код подтверждения');
$tester->seeResponseCode(200);
