<?php

Autoloader::namespaces(array(
    'Rig' => Bundle::path('rig').'classes',
));

Autoloader::map(array(
	'Rig' 	=> __DIR__ . '/classes/Rig.php'
));