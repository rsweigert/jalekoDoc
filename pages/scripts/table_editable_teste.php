<?php session_start(); ?>
<!DOCTYPE html>
<?php
if ($con){mysql_close($con);}
include "configura.php";
include $P_js."funcoes_bd.php";
include "formataValor.php";
//include "obterSO.php";
//$obSO = Obter_SO();
//$estiloSO = substr(0,3);

if ($con=conexao($servidor,$usuario,$senha))
{
if (isset($_REQUEST['pg']))                { $pg = $_REQUEST['pg'];}                 else {$pg = "";}
if (isset($_REQUEST['PB']))                { $var_pb = $_REQUEST['PB'];}             else {$var_pb = "0";}
if (isset($_REQUEST["co_usuario"]))        { $co_usuario = $_REQUEST['co_usuario'];} else {$co_usuario = ""; }
if (isset($_REQUEST["co_perfil_usuario"])) { $co_perfil_usuario = $_REQUEST['co_perfil_usuario'];} else {$co_perfil_usuario = ""; }
if (isset($_REQUEST['no_usuario']))        { $no_usuario = $_REQUEST['no_usuario'];} else {$no_usuario = ""; }
if (isset($_REQUEST['area']))              { $area = $_REQUEST['area'];}             else {$area = "0"; }
if (isset($_SESSION['st_menu']))           { $st_menu = $_SESSION['st_menu'];}
if (isset($_REQUEST['id']))                { $id = $_REQUEST['id'];}                 else {$id = "";}
//echo "pag:". $pg;
if ($id == "99")
{
include("limpaSessao.php");

}
else
{
if (isset($_SESSION['logado'])) {
$id = $_SESSION['logado'];
}
else
{
$id = "99";
}
}

//echo "id:".$id;
switch ($id)
{
case 0:
$_SESSION['administrador'] = 0;
include("Verifica_login.php");
$administrador = $_SESSION['administrador'];
$area = "98";
break;
case 99:
$VAR_MEIO = "0";
$st_menu = "0";
$administrador = 0;
$_SESSION['logado'] = 0;
$_SESSION['administrador'] = 0;
break;
default:
include("Verifica_perfil.php");
if ($_SESSION['logado'] = 1){
if ($area == "0"){
$area = "98";
}
else
{
$area = $area;
}
}
break;
}
//echo "usuario".$_SESSION['CO_USUARIO_F'];
switch($_SESSION['logado']){
case 0: include("login_soft.html");break;
case 1: 

$data_hj = date("d/m/Y");			
$data_30d = date('d/m/Y', strtotime("-360 days"));				
?>

<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.1
Version: 3.5.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Concursos - Jaleko Admin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="Regina Weigert"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="./global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="./global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="./global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="./global/plugins/bootstrap-lightbox/bootstrap-lightbox.css"/>
<link href="./global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="./global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<link href="./global/plugins/footable/css/footable.core.css?v=2-0-1" rel="stylesheet" type="text/css"/>
<link href="./global/plugins/footable/demos/css/footable-demos.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="./global/plugins/typeahead/typeahead.css">
<!-- END GLOBAL MANDATORY STYLES -->
<link href="./global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="./global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="./global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link href="./global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
<link href="./global/plugins/dropzone/css/dropzone.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="./global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<link href="./global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
<link href="./global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
<!--<link rel="stylesheet" type="text/css" href="./global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
<link rel="stylesheet" type="text/css" href="./global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">-->
<link rel="stylesheet" type="text/css" href="./global/plugins/bootstrap-summernote/summernote.css">
<?php 
$varSo = array();
$estiloSO = $_SERVER["HTTP_USER_AGENT"];
$varSo = explode("(",$estiloSO);
$vartpSO = substr($varSo[1],0,3);
//echo "Estilo:".$vartpSO;
?>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="./global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="./global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="./css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="./css/themes/default.css" rel="stylesheet" type="text/css"/>
<link href="./css/custom.css" rel="stylesheet" type="text/css"/>
<?php
switch($vartpSO){
    case "Mac":
?>
<link href="./css/estilo.css" rel="stylesheet" type="text/css"/>
<?php
	break;
	case "Winc":
?>
<link href="./css/estilow.css" rel="stylesheet" type="text/css"/>
<?php
	break;
	default:
?>
<link href="./css/estilow.css" rel="stylesheet" type="text/css"/>
<?php
	break;
}
?>
<!-- jQuery UI CSS -->
<link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" type="text/css" rel="stylesheet">
    <!-- Bootstrap styling for Typeahead -->
    <link href="./global/plugins/bootstrap-tokenfield-master/dist/css/tokenfield-typeahead.css" type="text/css" rel="stylesheet">
    <!-- Tokenfield CSS -->
    <link href="./global/plugins/bootstrap-tokenfield-master/dist/css/bootstrap-tokenfield.css" type="text/css" rel="stylesheet">
    <!-- Docs CSS -->
    <link href="./global/plugins/bootstrap-tokenfield-master/docs-assets/css/pygments-manni.css" type="text/css" rel="stylesheet">
    <link href="./global/plugins/bootstrap-tokenfield-master/docs-assets/css/docs.css" type="text/css" rel="stylesheet">	



<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>



</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-quick-sidebar-over-content ">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="index.html">
			<img src="./img/logo.png" alt="logo" class="logo-default"/>
			</a>
			<div class="menu-toggler sidebar-toggler hide">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<?php
				include("top-nav-bar.php");
			?>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<?php
			$mn_importacao  = 'class= "start active open"';
			include("menu-side-bar.php");
			?>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	<?php
			if (isset($_REQUEST['cd_usuario'])) { $cd_usuario = $_REQUEST['cd_usuario'];} else {$cd_usuario = "0"; }
			
			
			
			
	?>
	<!-- BEGIN CONTENT -->
	<div id="miolo">
	
		<div class="page-content-wrapper">
			<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Confirmar Gravação</h4>
						</div>
						<div class="modal-body">
							 
						</div>
						<div class="modal-footer">
							<button type="button" id="grav-import" class="btn blue">Confirma</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Home <small>Curso</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="default.php">Dashboard</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="table_editable_teste.php">Testes</a>
						<i class="fa fa-angle-right"></i>
					</li>
					
				</ul>
				
			</div>
			<div id="note-message" ></div>
			<!-- END PAGE HEADER-->
			
			<div class="portlet box jaleko">
				<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-edit"></i>Importação de Dados
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								
							</div>
				</div>
				<div class="portlet-body">
					<div class="table-toolbar">
								<div class="row">
								<div class="col-md-12">
									<div class="col-md-8">
										<h5>O nome do arquivo selecionado deve ter um formato padrão. Exemplo: SMS_CTI_ACB_2016.json (onde, "SMS"=concurso "CTI"=modalidade "ACB"=publico-alvo "2016"=ano e a extensão .json) </h5>
                                        <div class="form-group">
                                          <div class="col-md-6">
                                          	     <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="input-group input-large">
                                                            <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                                <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                                <span class="fileinput-filename"> </span>
                                                            </div>
                                                            <span class="input-group-addon btn default btn-file">
                                                                <span class="fileinput-new"> Selecionar </span>
                                                                <span class="fileinput-exists"> Mudar </span>
                                                                <input type="file" name="arq" id="arq" /> </span>
                                                           <!-- <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
										<div class="col-md-3 btn-group">
											
											<a class="btn green" id="sample_editable_1_novo" href="javascript:void(0);">	Incluir  <i class="fa fa-plus"></i></a>
											
										</div>
										<div class="col-md-3 btn-group">
											
											<a class="btn gray-customer" disabled id="confirm-import"  data-toggle="modal" href="#draggable">	Gravar Dados  <i class="fa fa-floppy-o"></i></a>
											
										</div>
									</div>
									<div class="form-group col-md-1 pull-right">
										<?php
												if ($_SESSION['CO_PERFIL_USUARIO_F'] < 3){
													$varclass = "";
												}else{$varclass = "inibe";}
										?>
										<button class="btn dropdown-toggle <?php echo $varclass; ?>" data-toggle="dropdown">Ações <i class="fa fa-angle-down"></i></button>
										
											<ul class="dropdown-menu">
												
												<li class="inibe"> 
													<a href="javascript:void(0);" id="email-confirmacao" data-toggle="modal" data-target="#modal-imprimir"> Enviar email Confirmação  </a>
													
												</li>
												<li class="inibe"> 
													<a href="javascript:void(0);" id="reenviar-email-confirmacao" data-toggle="modal" data-target="#modal-imprimir"> Reenviar email Confirmação  </a>
													
												</li>
												<li class="inibe"> 
													<a href="javascript:void(0);" id="mensagem-confirmacao" data-toggle="modal" data-target="#modal-visual"> Mensagem  </a>
													
												</li>
												<li class="inibe"> 
													<a href="javascript:void(0);" id="dialogo-usuario" data-toggle="modal" data-target="#modal-visual-inscricao"> Mensagem  </a>
													
												</li>
											
											</ul>
											
										</div>
										</div>
										
										
									
								</div>
					</div>
					
					
					
						<form class="form-inline" role="form" method="post" name="formTab1" id="formTab1" action="table_editable_usuario.php">
											<input name="mdluserId" id="mdluserId" type="hidden" value="<?php echo $_SESSION['CO_USUARIO_F']; ?>" />
						</form>
					<div id="lista-tabela">
					
					</div>
					<div id="gravacao">
					
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
	<!-- END CONTENT -->
	<!-- BEGIN QUICK SIDEBAR -->
	<?php
		 include("sidebar-left.php");  
	?>
	<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 2014 &copy; Jaleko Acadêmicos.
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="./global/plugins/respond.min.js"></script>
<script src="./global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

<script src="./global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="./global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
 <script src="./global/plugins/footable/js/footable.js?v=2-0-1" type="text/javascript"></script>
<script src="./global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="./global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="./global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="./global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="./global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="./global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="./global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script type="text/javascript" src="./global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
 


<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="./global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="./global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="./global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<!--<script src="./global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
<script src="./global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>-->
<script src="./global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script src="./global/plugins/dropzone/dropzone.js"></script>
<script src="./global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
<script src="./global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
<script type="text/javascript" src="./global/plugins/jquery.printelement.min.js"></script>	
<script src="./global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="./global/plugins/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
<script src="./global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
 <script src="./global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="./pages/scripts/ui-modals.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="./global/scripts/metronic.js" type="text/javascript"></script>
<script src="./scripts/layout.js" type="text/javascript"></script>
<script src="./scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="./scripts/demo.js" type="text/javascript"></script>
<script src="./pages/scripts/form-dropzone.js"></script>
<script src="./pages/scripts/table-editable.js"></script>
<script src="./pages/scripts/components-mask.js"></script>
<script src="./pages/scripts/ui-modals.min.js" type="text/javascript"></script>
<script src="./pages/scripts/components-multi-select.min.js" type="text/javascript"></script>
<!--<script src="./global/plugins/footable/demos/js/demos.js" type="text/javascript"></script>-->

<script type="text/javascript">
jQuery(document).ready(function() {  

Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
FormDropzone.init();
TableEditable.init();


//$('#multiselect').multiselect();

$('#ds_concursou').summernote({height: 200});
$('#ds_editaisu').summernote({height: 200});
$('#ds_resultadosu').summernote({height: 200});
$('.note-editor').css("width","400px");

 

$('.date-picker').datepicker({
				format: 'dd/mm/yyyy',
				dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
	    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
	    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
	    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
	    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
	    nextText: 'Próximo',
	    prevText: 'Anterior',
				orientation: 'bottom',
                rtl: Metronic.isRTL(),
				language: 'pt-BR',
                autoclose: true
 });
            
$('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
	dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
	    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
	    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
	    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
	    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
	    nextText: 'Próximo',
	    prevText: 'Anterior',
	orientation: 'bottom',
    startDate: '-3d'
});
 ncurso = '<?php echo $v_cd_curso; ?>';
 nacao = "1";
 $.post('function_curso_inscricao_combo.php',{acao:nacao,cd_curso:ncurso}, function(data_conc){
	
			$('#cd_curso').html(data_conc);				
						
	}); 
$(document).on("click", ".fileinput-exists", function() {
			$("#grav-import").attr("disabled", "disabled");
			$("#grav-import").removeClass("blue").addClass("gray-customer");
			$("#grav-import1").attr("disabled", "disabled");
			$("#grav-import1").removeClass("blue").addClass("gray-customer");
			$('#lista-tabela').html('');
});	
$(document).on("click", "#sample_editable_1_novo", function() {
	var narq = $('.fileinput-filename').html();
	var strval = narq.indexOf('.json');
	if (strval > 0) {
			console.log('Arquivo: '+ narq);
			var urljson = narq;
			$.getJSON(urljson, function(data) {
				var myarray = urljson.split("_");
				var tamanho = myarray.length;
				if (tamanho == 4){
				var nano = myarray[3].substr(0,4);
				var nconcurso = myarray[0];
				var nmodalid = myarray[1]+"-"+myarray[2];
				var tabResultado = '<table class="bg-red-soft table table-striped table-hover table-bordered" id="tabelaResultado">';
				tabResultado = tabResultado+ '<thead>';
				tabResultado = tabResultado+ '<tr>';
				tabResultado = tabResultado+ '<th>N&ordm; Questão</th>';
				tabResultado = tabResultado+ '<th>Concurso</th>';
				tabResultado = tabResultado+ '<th>Modalidade</th>';
				tabResultado = tabResultado+ '<th>Ano</th>';
				tabResultado = tabResultado+ '<th>Título da Questão</th>';
				tabResultado = tabResultado+ '<th>Enunciado da Questão</th>';
				tabResultado = tabResultado+ '<th>Resposta1</th>';
				tabResultado = tabResultado+ '<th>Resposta2</th>';
				tabResultado = tabResultado+ '<th>Resposta3</th>';
				tabResultado = tabResultado+ '<th>Resposta4</th>';
				tabResultado = tabResultado+ '</tr>';
				tabResultado = tabResultado+ '</thead>';
				tabResultado = tabResultado+ '<tbody>';
				var nusu = $('#mdluserId').val();
				for(var i = 0; i < data.length; i++){
					var nreg = data[i].number;
					if (nreg < 10){var questao = '0'+nreg;}else{var questao = nreg;}
					console.log('Questao: '+ questao);
					
					var ntit = myarray[0]+"-"+myarray[1]+"-"+myarray[2]+"-"+nano+"-Q"+questao;
               		var txquestao =  data[i].title;
               		var resp1 =  data[i].a;
               		var resp2 =  data[i].b;
               		var resp3 =  data[i].c;
               		var resp4 =  data[i].d;
               		var resp5 =  '';
               	/*	$.post('importaquestoes.php',{tx_titulo:ntit,tx_questao:txquestao,tx_resposta1:resp1,tx_resposta2:resp2,tx_resposta3:resp3,tx_resposta4:resp4,tx_resposta5:resp5,tx_nome_concurso:nconcurso,ds_modalidade_concurso:nmodalid,ds_ano:nano,ds_num_questao:questao,cd_usuario:nusu}, function(data_conc){
							console.log('Questao'+questao+': '+ data_conc);
					});
				*/	
                tabResultado = tabResultado+ '<tr style="color:#333333;">';
                tabResultado = tabResultado+ '<td>'+questao+'</td>';
                tabResultado = tabResultado+ '<td>'+nconcurso+'</td>';
                tabResultado = tabResultado+ '<td>'+nmodalid+'</td>';
                tabResultado = tabResultado+ '<td>'+nano+'</td>';
                tabResultado = tabResultado+ '<td>'+ntit+'</td>';
                tabResultado = tabResultado+ '<td>'+txquestao+'</td>';
                tabResultado = tabResultado+ '<td>'+resp1+'</td>';
                tabResultado = tabResultado+ '<td>'+resp2+'</td>';
                tabResultado = tabResultado+ '<td>'+resp3+'</td>';
                tabResultado = tabResultado+ '<td>'+resp4+'</td>';
                tabResultado = tabResultado+ '</tr>';
           	}
           	tabResultado = tabResultado+ '</tbody></table>';
           	tabResultado = tabResultado+ '<div class="row><div class="col-md-12 btn-group"><a class="btn blue" id="grav-import1" href="javascript:void(0);">Gravar Dados  <i class="fa fa-floppy-o"></i></a></div></div>';
           	$('#lista-tabela').html('<h4>Arquivo de questões SES_R3CM_2016.json</h4>'+tabResultado);
           }
           else{
           		var meucss = $("#note-message").attr("class");
						$("#note-message").removeClass(meucss).addClass("note note-danger note-bordered");
						$("#note-message").html('O Arquivo não possui os dados necessários para importar questões. É necessario que no nome do arquivo tenha as siglas Concurso_Modalidade_publico_ano.json!');
						$('html, body').animate({
							scrollTop: $(".page-container").offset().top
						}, 1000);
		window.setTimeout(function () {
			$("#note-message").html("");
			var mycss = $("#note-message").attr("class");
			$("#note-message").removeClass(mycss);
               			$('html, body').animate({
							scrollTop: $(".page-container").offset().top
						}, 1000);

		}, 8000);
           }
         });
			$("#grav-import").removeAttr("disabled");
			$("#grav-import").removeClass("gray-customer").addClass("blue");
	}else{
		var meucss = $("#note-message").attr("class");
						$("#note-message").removeClass(meucss).addClass("note note-danger note-bordered");
						$("#note-message").html('Arquivo de formato inválido!');
						$('html, body').animate({
							scrollTop: $(".page-container").offset().top
						}, 1000);
		window.setTimeout(function () {
			$("#note-message").html("");
			var mycss = $("#note-message").attr("class");
			$("#note-message").removeClass(mycss);
               			$('html, body').animate({
							scrollTop: $(".page-container").offset().top
						}, 1000);

		}, 8000);

	}	
});
$(document).on("click", "#confirm-import", function() {
			
});	
$(document).on("click", "#grav-import", function() {
			$("#grav-import").attr("disabled", "disabled");
			$("#grav-import").removeClass("blue").addClass("gray-customer");
			$("#grav-import1").attr("disabled", "disabled");
			$("#grav-import1").removeClass("blue").addClass("gray-customer");
			var nusu = $('#mdluserId').val();
			var narq = $('.fileinput-filename').html();
			console.log('Arquivo: '+ narq);
			var urljson = narq;
			$.getJSON(urljson, function(data) {
				$.ajax({
              		type: 'POST',
              		url: 'importaquestoesJson.php',
              		data: {'rel':data, 'nome':narq,'cd_usuario':nusu},
              		success: function(retorno) {
                		$('#gravacao').append(retorno);
                		var meucss = $("#note-message").attr("class");
						$("#note-message").removeClass(meucss).addClass("note note-success note-bordered");
						$("#note-message").html('Dados enviados para gravação');
						$('html, body').animate({
							scrollTop: $(".page-container").offset().top
						}, 1000);
              		}
            	});
			 });	
		window.setTimeout(function () {
			$("#note-message").html("");
			var mycss = $("#note-message").attr("class");
			$("#note-message").removeClass(mycss);
               			$('html, body').animate({
							scrollTop: $(".page-container").offset().top
						}, 1000);

		}, 3000);	

});
$(document).on("click", "#grav-import1", function() {
			$("#grav-import").attr("disabled", "disabled");
			$("#grav-import").removeClass("blue").addClass("gray-customer");
			$("#grav-import1").attr("disabled", "disabled");
			$("#grav-import1").removeClass("blue").addClass("gray-customer");
			var nusu = $('#mdluserId').val();
			var narq = $('.fileinput-filename').html();
			console.log('Arquivo: '+ narq);
			var urljson = narq;
			$.getJSON(urljson, function(data) {
				$.ajax({
              		type: 'POST',
              		url: 'importaquestoesJson.php',
              		data: {'rel':data, 'nome':narq,'cd_usuario':nusu},
              		success: function(retorno) {
                		$('#gravacao').append(retorno);
                		var meucss = $("#note-message").attr("class");
						$("#note-message").removeClass(meucss).addClass("note note-success note-bordered");
						$("#note-message").html('Dados enviados para gravação');
						$('html, body').animate({
							scrollTop: $(".page-container").offset().top
						}, 1000);
              		}
            	});
			 });	
		window.setTimeout(function () {
			$("#note-message").html("");
			var mycss = $("#note-message").attr("class");
			$("#note-message").removeClass(mycss);
               			$('html, body').animate({
							scrollTop: $(".page-container").offset().top
						}, 1000);

		}, 3000);	

});
cupons = "";


//FormEditable.init();

		

});
</script>
</body>
<!-- END BODY -->
</html>
<?php
break;
}
} 
mysql_close($con);
?>