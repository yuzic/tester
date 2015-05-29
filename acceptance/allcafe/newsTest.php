<?php
$tester = new \Tester();
$tester->setUrl('spb.' . Config::get('allcafe'));

$tester->send('/news', [], $idGet = true);
//
$tester->seeText('Новости и открыти');
$tester->seeResponseCode(200);