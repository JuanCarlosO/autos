
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Personal autorizado para conducir vehículos oficiales</h3>
                    
                </div>
                <div class="box-body">
                    <div  class="row">
                        <div class="col-md-12">
                            <div id="alerta" class="alert alert-dismissible hidden">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> <label id="estado"></label> </h4>
                                <p id="message"></p>
                            </div>
                        </div>
                    </div>
                    <form action="#" method="post" id="frm_add_chofer" enctype="multipart/form-data">
                    	<input type="hidden" id="option" name="option" value="38">
                    	<div class="row">
                    		<div class="col-md-12">
                    			<div class="form-group">
                    				<label>Persona autorizada</label>
                    				<input type="text" id="sp" name="sp" value="" placeholder="Ej: Oscar" required class="form-control">
                    				<input type="hidden" id="sp_id" name="sp_id" value="">
                    			</div>
                    		</div>
                    	</div>
                    	<div class="row">
                    		<div class="col-md-4">
                    			<div class="form-group">
                    				<label>Fecha de expedición</label>
                    				<input type="date" id="f_exp" name="f_exp" value="<?=date('Y-m-d')?>"  class="form-control">
                    			</div>
                    		</div>
                    		<div class="col-md-4">
                    			<div class="form-group">
                    				<label>Fecha de vencimiento</label>
                    				<input type="date" id="f_ven" name="f_ven" value="<?=date('Y-m-d')?>"  class="form-control">
                    			</div>
                    		</div>
                    		<div class="col-md-4">
                    			<div class="form-group">
                    				<label>Tipo de licencia</label>
                    				<select id="tipo" name="tipo" class="form-control" required>
                    					<option value="" selected>...</option>
                    					<option value="1">A - Automovilista</option>
                                        <option value="4">B - Chofer</option>
                    					<option value="2">C - Chofer carga</option>
                                        <option value="5">D - Chofer turismo</option>
                    					<option value="3">E - Chofer de carga general y especifica </option>
                                        <option value="6">F - Chofer transporte de pasajeros</option>
                    				</select>
                    			</div>
                    		</div>
                    	</div>
                    	<div class="row">
                    		<div class="col-md-3">
                    			<div class="form-group">
                    				<label>Numero de licencia</label>
                    				<input type="text" id="num_lic" name="num_lic" value="" required class="form-control" maxlength="20">
                    			</div>
                    		</div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Vigencia de licencia</label>
                                    <select name="vigencia" class="form-control" required>
                                        <option value="" selected> ... </option>
                                        <option value="1">TEMPORAL</option>
                                        <option value="2">PERMANENTE</option>
                                    </select>
                                </div>
                            </div>
                    		<div class="col-md-6">
                    			<div class="form-group">
                    				<label>Subir escaneo de licencia</label>
                    				<input type="file" id="archivo" name="archivo" value="" accept="application/pdf">
                    			</div>
                    		</div>
                    	</div>
                    	<div class="row">
                    		<div class="col-md-4"></div>
                    		<div class="col-md-4">
                    			<button type="submit" class="btn btn-success btn-block btn-flat">
                    				<i class="fa fa-floppy-o " style="font-size: 20px;"></i> Guardar 
                    			</button>
                    		</div>
                    		<div class="col-md-4"></div>
                    	</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>