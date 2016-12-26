<?php defined('SYSPATH') or die('No direct script access.');


require_once __DIR__.'/library/Zend/Loader/StandardAutoloader.php';

$loader = new Zend\Loader\StandardAutoloader(array('autoregister_zf' => TRUE));
$loader->registerNamespace('ZendSearch', __DIR__.'/library/ZendSearch');
$loader->register();

