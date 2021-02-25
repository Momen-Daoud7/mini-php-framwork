<?php
	// Core class
class Core {
	protected $currentController = "Pages";
	protected $currentMethod = "index";
	protected $params = [];

	public function __construct() {
		$url = $this->getUrl();
		//Looing in "controllers" for first value , ucword will capitalize the first letter
		if(file_exists("../app/controllers/").ucwords($url).".php") {
			//will set a new currentcontroller
			$this->currentController = ucwords($url[0]);
			unset($url[0]);
		}
		// Requireing new conroller
		require_once "../app/controllers/".$this->currentController."php";
		$this->currentController = new $this->currentController;

		//get the second part of the url
		if(isset($url[1])) {
			if(method_exists($this->currentController, $url[1])){
				$this->currentMethod = $url[1];
				unset($url[1]);
			}
		}
		//GEt parmeters
		$this->params = $url ? array_values($url) : [];

		//Call a callback with an array of params
		call_user_func_array([$this->currentController,$this->currentMethod], $this->params);
	}

	public function getUrl() {

		if($_GET['url']) {
			// remove the last / from url
			$url = rtrim($_GET['url'] , "/");
			// allows you ti filter variables as string/numbers
			$url = filter_var($url , FILTER_SANITIZE_URL);
			//Breaking it into an array
			$url = explode("/", $url);
			return $url;
		}
	}