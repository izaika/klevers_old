<?php

return [
	'default' => [
		'type'		=> 'PDO_MySQL',
		'connection' => [
			'dsn'		=> 'mysql:host=localhost;dbname=klevers;charset=utf8',
			'username'	=> 'klevers',
			'password'	=> 'I5iHzVYWAzsIdjED',
			'persistent'	=> false,
		],
		'table_prefix' => '',
		'charset'	=> 'utf8',
		'caching'	=> false,
		'profiling'	=> true,
	],
];
