<?php 

session_start();

	class Conexion{
		protected $dbh;
		protected function Conectar(){

			try {

				$conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=mydb","root","root");
				return $conectar;

			}catch (Exception $e) {

				print "Error: ".$e->getMessage()."<br/>";
				die();

			}
		}//cierra funcion conexion

		public function set_names(){

			return $this->dbh->query("SET NAMES 'utf8'");
		}
		public function ruta(){

			return "http://proyecto_pv1-3.test/";
		}
	}//cierre class conectar
 ?>