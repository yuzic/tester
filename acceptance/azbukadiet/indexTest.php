<?php
$tester = new \Tester();
$tester->setUrl(Config::get('azbukadiet'));
$mm =$tester->send('/', []);
$tester->seeText('Эффективные диеты для похудения');
$tester->seeResponseCode(200);

$mm =$tester->send('/soderzhanie-zhira-v-organizme#addcomment', [
    'solo-comment-subscribe' => 'solo-comment-subscribe',
    'postid' => '9149',
    'ref' => 'http%3A%2F%2Fwww.azbukadiet.ru%2Fsoderzhanie-zhira-v-organizme',
    'ref' => 'http%3A%2F%2Fwww.azbukadiet.ru%2Fsoderzhanie-zhira-v-organizme',
    'email' => 'dssd' . rand(100, 1000).'@mail.ru',
]);
$tester->seeText('Вы были успешно подписаны на комментарии к статье');