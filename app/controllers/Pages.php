<?php  

	class Pages extends Controller {
		public function __construct() {
			$this->userModel = $this->model("User");
		}
		public function index() {
			$users = $this->userModel->getUsers();
			$data =  ["name" => "momen", "users" => $users];
			$this->view("pages/index" ,$data);
		}
		public function about() {
			$data = ["title" => "about"];
			$this->view("pages/about" , $data);
		}
	}