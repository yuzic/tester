<?php
$tester = new \Tester();
$tester->setUrl(Config::get('betfaq'));
$tester->send('/profile/login/', [
    'email' => 'yuzic',
    'password'  => 123456786,
]);
//
$tester->seeText('Ваш аккаунт');
$tester->seeResponseCode(200);

$tester->send('/dsdsd', []);
$tester->seeResponseCode(404);

$bb = $tester->send('/subscribe/save/', [
    'email' => 'dssd' . rand(100, 1000).'@mail.ru',
]);

$tester->seeText('{"model":{"error":false,"message"');
