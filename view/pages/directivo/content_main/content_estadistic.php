<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Top 10 de vehiculos más reparados.</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <canvas id="myChart"></canvas>                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Gráfica anual de costos</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <form action="#" id="frm_estadistic_year" method="post">
                        <input type="hidden" id="option" name="option" value="50">
                        <div class="row">
                            <div class="col-md-2 text-right">
                                <label>Selecciona un año:</label>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select name="year" id="year" class="form-control">
                                        <option value=""></option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-success btn-flat">
                                    <i class="fa fa-bar-chart"></i> Generar
                                </button>
                            </div>
                        </div>
                    </form>
                    <canvas id="chart_costos"></canvas>                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
