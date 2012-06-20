<?php

class Rig_Generate_Task{

	public function help($arguments)
	{
		// Run the help class.
		Rig\Help::run($arguments);
	}

	public function model($arguments)
	{
		Rig\Model::run($arguments);
	}

	public function controller($arguments)
	{
		Rig\Controller::run($arguments);
	}

	public function view($arguments)
	{
		Rig\View::run($arguments);
	}

	public function __call($name, $arguments)
	{
		// Let's check if a package has been set and enabled.
		foreach( Config::get('rig::packages') as $name => $config)
		{
			if($config['enabled'] === true)
			{
				$config['class']::run($arguments);
			}
		}

		$this->help($arguments);
	}

}