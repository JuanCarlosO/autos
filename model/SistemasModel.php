<?php 
/**
 * Clase Modelo del vehiculo.
 */
include_once 'conection.php';
include_once 'anexgrid.php';
class SistemasModel extends Conection
{
	public $sql;
	public $stmt;
	public $result;

	public function generateUser()
	{
		try {
			$user 			= $_POST['sp_id'];
			$perfil 		= $_POST['perfil'];
			$trabajador 	= $_POST['trabajador'];
			#Recuperar el area del usuario
			$this->sql = "SELECT * FROM personal WHERE id = ? ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute( array($user) );
			$persona = $this->stmt->fetch(PDO::FETCH_OBJ);
			#actualizar status de la persona
			$this->sql = "UPDATE personal SET status = 1 WHERE id = ? ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute( array($user) );
			#Generar el nickname
			$nombre = explode(' ',$persona->nombre);
			$nickname 	= "";
			$pass 		= "";
			$data = array();
			if(count($nombre) == 1){
				$nickname = $nombre[0].substr($persona->ap_pat,0,1).substr($persona->ap_mat,0,1);
			}else{
				$nickname = $nombre[0].substr($nombre[1],0,1).substr($persona->ap_pat,0,1).substr($persona->ap_mat,0,1);
			}
			$pass = strtolower($nickname).date('Y');
			array_push($data,strtolower($nickname));
			array_push($data,strtolower($pass));
			array_push($data,strtolower($user));
			array_push($data,strtolower($persona->area_id));
			array_push($data,strtolower($perfil));
			array_push($data,$pass);
			array_push($data,$trabajador);

			return $data;
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage() ) );
		}
	}
	public function InsertAccount()
	{
		try {
			$nick 				= $_POST['nick'];
			$pass_encrypt 		= $_POST['pass_encrypt'];
			$person_id 			= $_POST['person_id'];
			$area_id 			= $_POST['area_id'];
			$perfil_id 		= $_POST['perfil_id'];
			$trabjador_id 	= $_POST['trabjador_id'];
			#Recuperar el area del usuario
			$this->sql = "INSERT INTO usuario(id,nick,pass,person_id,area_id,perfil,status) 
			VALUES (
				'',
				?,
				?,
				?,
				?,
				?,
				1
			);";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$nick);
			$this->stmt->bindParam(2,$pass_encrypt);
			$this->stmt->bindParam(3,$person_id);
			$this->stmt->bindParam(4,$area_id);
			$this->stmt->bindParam(5,$perfil_id);
			$this->stmt->execute();
			return json_encode( array('status'=>'success','message'=>'CUENTA DE USUARIO CREADO EXITOSAMENTE' ) );
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage() ) );
		}
	}

	
}
?>