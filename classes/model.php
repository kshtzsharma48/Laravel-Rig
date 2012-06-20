<?php

namespace Rig;

class Model{

	public static $template;

	public static $model = array(
		'flags'			=> array(),
		'name' 			=> null,
		'args'			=> array(),
		'orm'			=> null,
		'timestamp'	    => null,
		'relationships' => array(),
	);

	public static function run($arguments)
	{
		// Let's get the orm;
		self::orm();

		// Let's load the template file;
		if(self::template() === false) return false;

		// Let's split the arguments up into a readable format.
		self::arguments($arguments);

		// Next we need to generate the migrations.
		if(isset(self::$model['flags']['-c']))
		{
			Migration::generate(self::$model['name'], self::$model['flags']['-c']);
		}

		if(isset(self::$model['flags']['-r']))
		{
			self::relationships();
		}

	}

	public static function orm()
	{
		$tmp 	   		    = \Config::get('rig::model.orm');
		self::$model['orm'] = (!empty($tmp)) ?: 'eloquent';
		unset($tmp);
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

		self::$model['args']	= $arguments;

		foreach($arguments as $arg)
		{
			// We first need to check if there is a flag (i.e "-f")
			// If theres a flag we need to group the next set of arguments within that flag until theres a new flag.
			// -c = set some columns
			// -r = set some relationships.
			if(substr(trim($arg), 0, 1) === '-')
			{
				// Now that we have found a new flag we need to store it.
				if(isset(self::$model['flags'][$arg]))
				{
					// Instead of array_merge, we need to take that index and move it to the end so that any paramters within that flag
					// will be grouped together.
					$index = self::$model['flags'][$arg];
					// Next we want to delete that item;
					unset(self::$model['flags'][$arg]);
					// Next let's add the old index to the end of the newly normalized array.
					self::$model['flags'][$arg]	= $index;
					//self::$model['flags'][$arg] = array_merge($arg, self::$model['flags'][$arg]);
				}
				else
				{	
					self::$model['flags'][$arg] = array();
				}
			}
			else
			{
				end(self::$model['flags']);
				$key = key(self::$model['flags']);
				// Store the next set of arguments to the lastest flag found.
				if(isset(self::$model['flags'][$key]))
				{
					echo self::$model['flags'][$key][] = $arg;
				}
			}
		}

		print_r(self::$model['flags']);

	}


	public function relationships()
	{



	}

	public function model()
	{

	}



}