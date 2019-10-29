<?php 
/**
 * Clase que permite la conexión con la base de datos 
 */
include_once 'constantes.php';
class Conection
{
	public $pdo;

	function __construct()
	{
		try {
		    $this->pdo = new PDO(DNS, USER_DB, PASS_DB);
		    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
		} catch (PDOException $e) {
		    echo 'Falló la conexión: ' . $e->getMessage();
		}

	}
	public function setPDO($pdo)
	{
		$this->pdo = $pdo;
	}
	public function getPDO()
	{
		return $this->pdo;
	}
}

?>