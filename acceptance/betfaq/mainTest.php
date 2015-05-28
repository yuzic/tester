<?php
$tester = new \Tester();
$tester->setUrl('http://betfaq.re');
$tester->send('/profile/login/', [
    'email' => 'prototypenk@gmail.com',
    'password'  => 123456786,
]);
//
$tester->seeText('Ваш аккаунт');
echo $tester->seeResponseCode(200);

$tester->send('/dsdsd', []);
echo $tester->seeResponseCode(404);


$bb = $tester->send('/subscribe/save/', [
    'email' => 'dssd' . rand(100, 1000).'@mail.ru',
]);

$tester->seeText('{"model":{"error":false,"message"');
$res = preg_match('~\{(?:[^{}]|(?R))*\}~',  $bb[0], $responce);
print_r(json_decode($responce[0], true));