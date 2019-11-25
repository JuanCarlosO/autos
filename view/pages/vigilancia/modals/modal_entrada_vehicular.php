
<form id="frm_entrada_vehicular" action="#" method="POST">
	<input type="hidden" id="option" name="option" value="40">
	<input type="hidden" id="registro" name="registro" value="40">
	<div class="modal fade " id="modal_entrada_vehicular">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	    	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
	        	<h4 class="modal-title"> <center>REGISTRO DE ENTRADA DEL VEHÍCULO</center> </h4>
	      	</div>
	      	<div class="modal-body">
		      	<div  class="row">
		      		<div class="col-md-12">
		      			<div id="alerta" class="alert alert-dismissible hidden">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                <h4><i class="icon fa fa-check"></i> <label id="estado"></label> </h4>
			            	<p id="message"></p>
			            </div>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-md-3">
		      			<div class="form-group">
		      				<label>Fecha de entrada</label>
		      				<input type="date" id="f_entrada" name="f_entrada" value="<?=date('Y-m-d')?>" class="form-control">
		      			</div>
		      		</div>
		      		<div class="col-md-3">
		      			<div class="form-group">
		      				<label>Hora de entrada</label>
		      				<div class="input-group">
			                    <input type="text" class="form-control timepicker" name="hora" id="hora">
			                    <div class="input-group-addon">
			                      <i class="fa fa-clock-o"></i>
			                    </div>
			                </div>
		      			</div>
		      		</div>
		      		<div class="col-md-3">
		      			<div class="form-group" class="text-center">
		      				<label>Elige el nivel de combustible</label>
		      				<input type="text" class="knob" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" value="30" data-width="120" data-height="120" data-fgColor="#00c0ef">
		      				<input type="hidden" id="nivel_gas" name="nivel_gas" value="">
		      			</div>
		      		</div>
		      		<div class="col-md-3">
		      			<div class="form-group">
		      				<label>Kilometraje de entrada</label>
		      				<input type="text" name="km" value="" class="form-control" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
		      			</div>
		      		</div>	
		      	</div>
		      	
	      	</div>
	      	<div class="modal-footer">
	      		<button type="button" class="btn btn-flat btn-danger pull-left" data-dismiss="modal">Cerrar</button>
	      		<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-floppy-o"></i> Guardar</button>
	      	</div>
	    </div>
	  </div>
	</div>
</form>