<?php  
	//Load the mdoles and views
	class Controller {
		//Load the modles
		public function model($model) {
			if(file_exists("../app/models/").$model.".php") {
				require_once "./app/models/.$model.php";
			}
		}
		//Load the view
		public function view($view , $data = []) {
			if(file_exists("../app/views/").$view."php") {
				require_once "../app/views/$view.php";
			}
		}
	}