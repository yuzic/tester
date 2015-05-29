<?php
$tester = new \Tester();
$tester->setUrl('spb.' . Config::get('allcafe'));
$tester->send('/', []);
//
$tester->seeText('Новости ресторанов');
$tester->seeResponseCode(200);

