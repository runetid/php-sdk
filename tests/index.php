<?php
require '../vendor/autoload.php';

$c = new \runetid\sdk\Client('lhGPNuTMUj', 'TQldWBmWFb');

//$event  = $c->event()->getByAlias('Dtranskom19');
$user = $c->user()->search('fedor@support-p.org');
var_dump($user);