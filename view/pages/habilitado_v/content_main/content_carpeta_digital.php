
<section class="content container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Carpeta digital </h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form action="#" id="frm_carpeta_dig" method="post">
            <input type="hidden" name="option" value="53">
            <div class="row">
              <div class="col-md-3 text-right">
                <label>Buscar vehículo (Por número de placa): </label>
              </div>
              <div class="col-md-6">
                <div class="input-group">
                  <input type="text" id="placa" name="placa" value="" class="form-control" placeholder="Ej: LXP8690" required>
                  <input type="hidden" id="placa_h" name="placa_h" value="" class="form-control" required>
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-success btn-flat">
                      <i class="fa fa-safari"></i>
                    </button>
                  </span>
                </div>
              </div>
            </div>
          </form>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <form action="#" id="frm_get_evidencia" method="post">
                <input type="hidden" name="option" value="72">
                <div class="row">
                  <div class="col-md-3 text-right">
                    <label>Buscar evidencia de eventos programados: </label>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                        <label>Fecha inicio:</label>
                        <input type="date" name="f_ini" value="" class="form-control" required="">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <label>Fecha final:</label>
                      <div class="input-group">
                        <input type="date" name="f_fin" value="" class="form-control" required="">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-success btn-flat">
                            <i class="fa fa-calendar"></i>
                          </button>
                        </span>
                      </div>
                    </div>
                </div>
              </form>
            </div>
          </div>

          <hr>
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3 id="total_doc_veh"> 0 </h3>

                  <p>Documentos del vehículo</p>
                </div>
                <div class="icon">
                  <i class="fa fa-car"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="obtener_documentos();">
                  Ver archivos <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3 id="total_polizas"> 0 </h3>

                  <p>Ver polizas</p>
                </div>
                <div class="icon">
                  <i class="fa fa-file-o"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="obtener_polizas();">
                  Ver polizas <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3 id="total_bajas"> 0 </h3>

                  <p>Ver documentos de baja</p>
                </div>
                <div class="icon">
                  <i class="fa fa-file-o"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="obtener_bajas_docs();">
                  Ver docs <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3 id="total_cotizaciones"> 0 </h3>
                  <p>Ver cotizaciones</p>
                </div>
                <div class="icon">
                  <i class="fa fa-dollar"></i>
                </div>
                <a href="#" class="small-box-footer" onclick="obtener_cotizaciones();">
                  Mostrar cotizaciones <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-green">
                <div class="inner">
                  <h3 id="total_docs_sol"> 0 </h3>
                  <p>Ver documentos de solicitud</p>
                </div>
                <div class="icon">
                  <i class="fa fa-edit"></i>
                </div>
                <a href="#documentacion_vehicular" class="small-box-footer" onclick="obtener_solicitudes();">
                  Mostrar documentos <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-green">
                <div class="inner">
                  <h3 id="total_siniestros"> 0 </h3>
                  <p>Ver documentos de siniestros</p>
                </div>
                <div class="icon">
                  <i class="fa fa-file-o"></i>
                </div>
                <a href="#documentacion_vehicular" class="small-box-footer" onclick="obtener_siniestros();">
                  Mostrar documentos <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          </div>
          <!-- <div id="contadores_by_car"></div>
          <div id="contadores_by_folio"></div>
          <div id="contadores_by_date"></div> -->

          <div id="documentacion_vehicular"></div>
          <div id="carga_img" class="row">
            
          </div>


        </div>
      </div>
    </div>
  </div>
</section>
