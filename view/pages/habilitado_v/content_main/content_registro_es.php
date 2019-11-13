
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Entrada y Salida de Vehículos.</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
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
                    <ul class="nav nav-tabs">
                    	<li class="active"><a data-toggle="tab" href="#home">Hoy <?=date('Y-m-d')?> </a></li>
                    	<li class=""><a data-toggle="tab" href="#menu1">Historico</a></li>
                    </ul>
                    
                    <div class="tab-content">
                      <div id="home" class="tab-pane fade in active">
                        <h3 class="text-center">Registros del día.</h3>
                        <div class="row">
                        	<div class="col-md-12">
                        		<div class="table-responsive">
                        		    <div id="es_today"></div>
                        		</div>
                        	</div>
                        </div>
                      </div>
                      <div id="menu1" class="tab-pane fade">
                        <h3>Historico de entradas y salidas</h3>
                        <form id="frm_historico_es" class="form-inline" action="#" method="post">
                        	<div class="row">
                        		<div class="col-md-12">
                        			<div class="form-group">
                        				<label>Fecha de Inicio:</label>
                        				<input type="date" id="f_inicio" name="f_inicio" class="form-control" value="" required autofocus>
                        			</div>
                        			<div class="form-group">
                        				<label>Fecha de Fin:</label>
                        				<input type="date" id="f_fin" name="f_fin" class="form-control" value="" required>
                        			</div>
                        			<button type="submit" class="btn btn-success btn-flat ">
                        				<i class="fa fa-search"></i> Buscar
                        			</button>
                        		</div>
                        		
                        	</div>	
                        </form>
                        <div class="row">
                        	<div class="col-md-12">
                        		<div class="table-responsive">
                        		    <div id="historico"></div>
                        		</div>
                        	</div>
                        </div>
                      </div>
                      
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</section>