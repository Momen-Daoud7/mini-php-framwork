<?php
	class Database {
		private $dbHost = DB_HOST;
		private $dbUser = DB_USER;
		private $dbPass = DB_PASS;
		private $dbName = DB_NAME;

		private $error, $dbHandler ,$statement;

		public function __construct() {
			$connection = "mysql:host=".$this->dbHost.";dbname=".$this->dbName;
			$options = array(
				PDO::ATTR_PERSISTENT => true,
				PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION
			);

			try {
				$this->dbHandler = new PDO($connection,$this->dbUser , $this->dbPass ,$options);

			}catch(PDOException $e) {
				$this->error = $e->getMessage();
				echo $this->error;
			}
		}

		// sql query method
		public function query($sql) {
			$this->statement = $this->dbHandler->prepare($sql);
		}

		// Bind values
		public function bindValue($parameter , $value , $type=null) {
			if(is_null($type)) {
				case is_int($value):
					$type =PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type =PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type =PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
					break;
			}
			 $this->statement->bindValues($parameter , $value , $type);
		}

		//execute 
		public function execute() {
			return $this->statment->execute();
		}
		// get results
		public function resultSet() {
			$this->execute();
			return $this->statement->fetchAll(PDO::FETCH_OBJ);
		}
		// get single result
		public function single() {
			$this->execute();
			return $this->statement->fetch(PDO::FETCH_OBJ);
		}
		// get rowcount
		public function resultRow() {
			$this->statement->rowCount();
		}


	}