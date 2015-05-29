<?php
$tester = new \Tester();
$tester->setUrl(Config::get('prisnilos'));
$tester->send('/privoroti', []);
//
$tester->seeText('Как сделать приворот');
$tester->seeResponseCode(200);