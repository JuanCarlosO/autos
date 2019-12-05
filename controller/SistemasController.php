<?php  
/**
 * Clase del vehiculo
 */
include_once '../model/SistemasModel.php';
include_once 'Security.php';
class SistemasController 
{
	protected $model;
	function __construct()
	{
		$this->model = new SistemasModel();
	}

	public function generateUser()
	{
		$sec = new Security;
		$cuenta 	= $this->model->generateUser();
		$nick 		= $cuenta[0];
		$pass 		= $sec->encrypt_pass( $cuenta[1] ) ;
		$persona 	= $cuenta[2];
		$area 		= $cuenta[3];
		$perfil 	= $cuenta[4];
		$pass_sim 	= $cuenta[5];
		$trabajador	= $cuenta[6];
		$form = '';
		$form .= '';
		    $form .= '<input type="hidden" id="option" name="option" value="76">';
		    $form .= '<div class="row">';
		        $form .= '<div class="col-md-4">';
		            $form .= '<div class="form-group">';
		                $form .= '<label>Nickname</label>';
		                $form .= '<input type="text" name="nick" value="'.$nick.'" class="form-control" required>';
		            $form .= '</div>';
		        $form .= '</div>';
		        $form .= '<div class="col-md-4">';
		            $form .= '<div class="form-group">';
		                $form .= '<label>Contraseña</label>';
		                $form .= '<input type="text" name="pass" value="'.$pass_sim.'" class="form-control" required>';
		                $form .= '<input type="hidden" name="pass_encrypt" value="'.$pass.'" class="form-control" required>';
		            $form .= '</div>';
		        $form .= '</div>';
		        $form .= '<div class="col-md-4">';
		            $form .= '<div class="form-group">';
		                $form .= '<label>Persona ID</label>';
		                $form .= '<input type="text" name="person_id" value="'.$persona.'" class="form-control" required>';
		            $form .= '</div>';
		        $form .= '</div>';
		    $form .= '</div>';
		    $form .= '<div class="row">';
		        $form .= '<div class="col-md-4">';
		            $form .= '<div class="form-group">';
		                $form .= '<label>Area ID</label>';
		                $form .= '<input type="text" name="area_id" value="'.$area.'" class="form-control" required>';
		            $form .= '</div>';
		        $form .= '</div>';
		        $form .= '<div class="col-md-4">';
		            $form .= '<div class="form-group">';
		                $form .= '<label>Perfil ID</label>';
		                $form .= '<input type="text" name="perfil_id" value="'.$perfil.'" class="form-control" required>';
		            $form .= '</div>';
		        $form .= '</div>';
		        $form .= '<div class="col-md-4">';
		            $form .= '<div class="form-group">';
		                $form .= '<label>Tipo trabajador ID</label>';
		                $form .= '<input type="text" name="trabjador_id" value="'.$trabajador.'" class="form-control" required>';
		            $form .= '</div>';
		        $form .= '</div>';
		    $form .= '</div>';
		    $form .= '<div class="row">';
		        $form .= '<div class="col-md-4"></div>';
		        $form .= '<div class="col-md-4">';
		            $form .= '<button type="submit" class="btn btn-success btn-block btn-flat">';
		                $form .= '<i class="fa fa-floppy-o"></i> Insertar datos';
		            $form .= '</button>    ';
		        $form .= '</div>';
		        $form .= '<div class="col-md-4"></div>';
		    $form .= '</div>';
		$form .= '';
		return $form;
	}
	public function InsertAccount()
	{
		return $this->model->InsertAccount();
	}
	
	
	
}


?>