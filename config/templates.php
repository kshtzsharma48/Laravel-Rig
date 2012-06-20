<?php

return array(

	'models' 	=> array(

		'timestamp'		=> true,
		'orm'			=> 'eloquent',
		'relationships' => true,

	),


	'templates' => array(

		'model'			=> 'default.php.tpl',
		'controller'	=> 'default.php.tpl',
		'view'			=> 'default.php.tpl',
		'migration'		=> 'default.php.tpl',

		'package'		=> array(
			'admin'		=> 'default'
		),
	),


	'packages' => array(

		'admin' => array(

			'search_models' 	  => true,
			'build_relationships' => true,

		),

	),



);