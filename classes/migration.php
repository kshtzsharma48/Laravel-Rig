<?php

namespace Rig;

class Migration{

	public static $template;
	public static $engine;

	public static function generate($model_name, $arguments)
	{

		self::$engine 	= \Config::get('rig::model.mysql-engine');

		// We first need to get the template;
		if(self::template() === false) return false;

		$table_name = \Str::plural($model_name);

		$schema	= 'Schema::create("' . $table_name . '", function($table){';
		$column = "\n\n";
		$column .= "\t\t\t" . '$table->engine = "' . self::$engine . '";'. "\n";
		$column .= "\t\t\t" . '$table->increments("id");' . "\n";

		foreach($arguments as $a)
		{
			// Let's split the arguments with :
			$array = explode(':', $a);

			$name  = $array[0];
			$type  = (isset($array[1])) ? $array[1] : 'string';

			if($type[strlen($type)-1] == "]")
			{
				// Now let's check if theres a length delimeter.
				$length = explode('[', $type);
				// Now let's reassign the type back;
				$type   = $length[0];
				// Now let's strip the last bracket.
				$length = str_replace(']', '', $length[1]);
			}
			$column .= "\n\t\t\t";
			switch($type)
			{
				case "string":
					if(isset($length))
						$column .= '$table->string("' . $name . '", '.$length.');';
					else
						$column .= '$table->string("' . $name . '", 100);';
				break;

				case "integer":
				case "int":
					$column .= '$table->integer("' . $name . '");';
				break;

				case "bool":
				case "boolean":
					$column .= '$table->boolean("' . $name . '");';
				break;

				case "timestamp":
				case "time":
					$column .= '$table->timestamp("' . $name . '");';
				break;

				case "text":
					$column .= '$table->text("' . $name . '");';
				break;

				case "blob":
					$column .= '$table->blob("' . $name . '");';
				break;

				case "float":
					$column .= '$table->float("' . $name . '");';
				break;

				case "date":
					$column .= '$table->date("' . $name . '");';
				break;
			}

		}


		$schema .= $column;
		$schema .= "\n\n\t\t}";

		// Let's create the down version;
		$down 	= 'Schema::drop("' . $table_name . '");';

		// Now let's change the template.
		self::replace('{{MIGRATION_NAME}}', 'Create_' . \Str::plural(ucfirst($model_name)) . '_Table');
		self::replace('{{UP}}', $schema);
		self::replace('{{DOWN}}', $down);

		// Let's generate the new file path & name;
		$path = realpath(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

		$file_name = date('Y_m_d_His') . '_create_' . strtolower($table_name) . '_table.php';

		$full_path = $path . $file_name;
		file_put_contents($full_path, self::$template);
	}

	public static function replace($key, $value)
	{
		self::$template = str_replace($key, $value, self::$template);
	}

	public static function template()
	{
		// Get the template file.
		$file 	= \Config::get('rig::migration.template');
		// Get the path of the template and append the file name at the end.
		$path 	= \Bundle::path('rig') . 'templates/migrations/' . $file;
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

	public static function run($arguments)
	{


	}



}