<?php

namespace Rig\Admin;

class Admin{

	public function run($arguments)
	{
		echo "Rig\\Admin\\Admin::run()";
	}

	public function __call($name, $arguments)
	{
		// Load the help module.
		Help::run($arguments);
	}

}