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
		$this->help($arguments);
	}

}