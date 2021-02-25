<?php  

	class Pages extends Controller {
		public function __construct() {
			$this->userModel = $this->model("User");
		}
		public function index() {
			$user = $this->userModel;
			$data =  ["name" => "momen", "users" => $user];
			$this->view("pages/index" ,$data);
		}
		public function about() {
			$data = ["title" => "about"];
			$this->view("pages/about" , $data);
		}
	}