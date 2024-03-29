<?php
/*
 * App Core Class
 * Creates URL & loads core controller
 * URL FORMAT -/controller/method/params
 */
namespace App\Libraries;

class Core {

	protected $currentController = 'App\controllers\Pages';

	protected $currentMethod = 'index';

	protected $params = [];


	public function __construct()
	{
		//print_r($this->getUrl());
		$url = $this->getUrl();

		// Look in controllers for first value
		if(file_exists('../App/controllers/' . ucwords($url[0]) . '.php')){
			// If exists, set as controller
			$this->currentController = 'App\controllers\\' .  ucwords($url[0]);

			unset($url[0]);
		}

		// Instantiate controller class
		$this->currentController = new $this->currentController;

		// Check for second part of url
		if (isset($url[1])) {
			// Check to see if method exists in ControllerClass
			if (method_exists($this->currentController, $url[1])) {
				$this->currentMethod = $url[1];

				unset($url[1]);
			}
		}

		// Get params
		$this->params = $url ? array_values($url) : [];

		foreach ($url as $part)
			echo $part;

		// Call a callback with array of params
		call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
	}

	public function getUrl()
	{
		if (isset($_GET['url'])) {
			$url = rtrim($_GET['url'], '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/', $url);
			return $url;
		}
	}
}

