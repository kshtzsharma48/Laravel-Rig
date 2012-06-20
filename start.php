<?php

Autoloader::namespaces(array(
    'Rig' => Bundle::path('rig').'classes',
));

Autoloader::map(array(
	//'Rig' 	=> __DIR__ . '/classes/Rig.php',
	'Help'  => __DIR__ . '/classes/help.php',

	'Model'			=> __DIR__ . '/classes/model.php',
	'Controller'	=> __DIR__ . '/classes/controller.php',
	'View'			=> __DIR__ . '/classes/view.php',

	'Generate' => __DIR__ . '/tasks/generate.php'
));