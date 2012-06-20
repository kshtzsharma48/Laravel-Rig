<?php

Autoloader::namespaces(array(
    'Rig' => Bundle::path('rig').'classes',
    'Rig\\Admin' => Bundle::path('rig') . 'classes/admin/',
));

Autoloader::map(array(
	//'Rig' 	=> __DIR__ . '/classes/Rig.php',
	'Help'  => __DIR__ . '/classes/help.php',

	'Model'			=> __DIR__ . '/classes/model.php',
	'Controller'	=> __DIR__ . '/classes/controller.php',
	'View'			=> __DIR__ . '/classes/view.php',
	'Migration'		=> __DIR__ . '/classes/migration.php',

	'Admin'			=> __DIR__ . '/classes/admin/admin.php',

	'Generate' => __DIR__ . '/tasks/generate.php'
));