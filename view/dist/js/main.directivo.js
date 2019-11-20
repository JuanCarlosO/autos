$(document).ready(function() {
	getURL();
});
/*Recuperar la pagina en la que se encuemntra*/
function getURL() {
	var url = window.location.search;
	if ( url == '?menu=general'  ) {
		$('#listado_sol').addClass('active');
		all_sol();
	}else if ( url == '?menu=historic' ){
		$('#tree_reports').addClass('active');
		$('#historic').addClass('active');
		all_es();
		frm_historico_es();
	}else if ( url == '?menu=estadistic' ){
		$('#tree_reports').addClass('active');
		$('#estadistic').addClass('active');
	}

	return false;
}