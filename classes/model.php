<?php

namespace Rig;

class Model{

	public static $orm;
	public static $template;

	public static $model = array(
		'name' 			=> '',
		'orm'			=> '',
		'timestamp'	    => '',
		'relationships' => '',
	);

	public static function run($arguments)
	{
		// Let's get the orm;
		self::orm();

		// Let's load the template file;
		if(self::template() === false) return false;

		// Let's split the arguments up into a readable format.
		self::arguments($arguments);
	}

	public static function orm()
	{
		$tmp 	   = \Config::get('rig::model.orm');
		self::$orm = (!empty($tmp)) ?: 'eloquent';
	}

	public static function template()
	{
		// Get the template file.
		$file 	= \Config::get('rig::model.template');
		// Get the path of the template and append the file name at the end.
		$path 	= \Bundle::path('rig') . 'templates/models/' . $file;
		// Check if the template exists.
		if( file_exists($path) )
		{
			// Load the file into memory.
			self::$template = file_get_contents($path);
		}
		else
		{
			return false;
		}

	}

	public static function arguments($arguments)
	{
		// Get the name of the model;
		self::$model['name'] 	= $arguments[0];

		// Now let's split the first element from the array.
		array_splice($arguments, 0, 1);

		foreach($arguments as $name)
		{
			echo $name;
		}
	}



}