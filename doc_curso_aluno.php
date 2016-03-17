<?php session_start(); ?>
<?php
if ($con){mysql_close($con);}
include "configura.php";
include $P_js."funcoes_bd.php";
if ($con=conexao($servidor,$usuario,$senha))
{
if (isset($_REQUEST['pg']))                { $pg = $_REQUEST['pg'];}                 else {$pg = "";}
if (isset($_REQUEST['PB']))                { $var_pb = $_REQUEST['PB'];}             else {$var_pb = "0";}
if (isset($_REQUEST["co_usuario"]))        { $co_usuario = $_REQUEST['co_usuario'];} else {$co_usuario = ""; }
if (isset($_REQUEST["co_perfil_usuario"])) { $co_perfil_usuario = $_REQUEST['co_perfil_usuario'];} else {$co_perfil_usuario = ""; }
if (isset($_REQUEST['no_usuario']))        { $no_usuario = $_REQUEST['no_usuario'];} else {$no_usuario = ""; }
if (isset($_REQUEST['area']))              { $area = $_REQUEST['area'];}             else {$area = "0"; }
if (isset($_SESSION['st_menu']))           { $st_menu = $_SESSION['st_menu'];}
if (isset($_REQUEST['page']))      { $page      = $_REQUEST['page'];}      else {$page = "1"; }
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
case 0: include("loginjalekoDoc.html");break;
case 1: 
?>
<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.1
Version: 3.5.1
Author: KeenThemes
Licence:
Customização e programação: Regina Weigert
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="pt-br" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>

<title>Jaleko</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="./global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="./global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="./global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="./global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>



<!-- BEGIN THEME STYLES -->
<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
<link href="./global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="./global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="./css/layout.css" rel="stylesheet" type="text/css"/>
<link href="./css/themes/default1.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="./css/custom.css" rel="stylesheet" type="text/css"/>
<link href="./css/style.css" rel="stylesheet">
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>

<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>


<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.3/jquery.mobile.structure-1.4.3.min.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.3/jquery.mobile-1.4.3.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
<script>
jQuery(document).ready(function() {   
	$('.scroll-to-top').click(function(e) {
            e.preventDefault();
            $('html, body').animate({scrollTop: 0}, 2000);
            return false;
        }); 
  $( document ).on( "click", ".apostila-curso", function() {
	  			var cod = $(this).attr("id");
				var tam = cod.length - 2; 
				var id = cod.substr(2,tam);
				var ncurso = id;
				$('#cd_curso').val(ncurso);
				$('.breadcrumb').html('<li><a href="#" id="logout" rel="external" data-transition="slide">Logout</a></li><li><a href="#" id="voltar-cursos">Meus Cursos</a></li><li class="active">Apostila Curso</li>');
				$('.pagination').hide();
				$('#relacao-cursos').hide();
				$('#campoPesquisa').removeClass("inibe");
				var npage = "apostilameuscursos.php?cd_curso="+ncurso;
					$('#lista-apostila-cursos').load(npage,function(){
						$('#lista-apostila-cursos').trigger('create');
					});
				
				  
  });	 
  $( document ).on( "click", "#logout", function(){
	  			
			$("#formExec").submit();	 
				  
			});	
  $( document ).on( "click", "#voltar-cursos", function(){
	  			$('#relacao-cursos').show();
				$('#lista-apostila-cursos').html(""); 
				$('#campoPesquisa').addClass("inibe");  
				$('.pagination').show();
				$('.breadcrumb').html('<li><a href="#" id="logout" rel="external" data-transition="slide">Logout</a></li><li class="active">Meus Cursos</li>');
				
			});	
   $( document ).on( "click", "#busca-conteudo", function(){
	  			var nbusca = $('#cbusca').val();
	  			var ncurso = $('#cd_curso').val();
	  			$.post('buscaconteudoapostila.php',{texto:nbusca,cd_curso:ncurso}, function(data_idi){
	  				console.log('Retorno: ' + data_idi);
					$("#capitulo-curso").html(data_idi);
					$('#cbusca').val("");		
				});	
	  			
				
			});	 
   $( document ).on( "click", ".ver-capitulo", function(){
	  			var cod = $(this).attr("id");
				var tam = cod.length - 3; 
				var id = cod.substr(3,tam);
				var napostila = id;
				console.log('Capitulo: ' + napostila);	
				var meucss = $('#sub'+id+' i').attr("class");
				if (meucss == 'fa fa-plus'){
					console.log('css: ' + meucss);	
					$('#sub'+id+' i').removeClass('fa fa-plus').addClass('fa fa-minus');
					$('#apo'+id).show();
				}else{
					$('#sub'+id+' i').removeClass('fa fa-minus').addClass('fa fa-plus');
					$('#apo'+id).hide();
				}
				var npage = "conteudoapostilameuscursos.php?tp=1&co_curso_apostila="+napostila;
					$('#capitulo-curso').load(npage,function(){
						$('#capitulo-curso').trigger('create');
					});
				 
				  
			});	
			$( document ).on( "click", ".ant-capitulo", function(){
	  			var cod = $(this).attr("id");
				var tam = cod.length - 3; 
				var id = cod.substr(3,tam);
				var napostila = id;
				console.log('Capitulo: ' + napostila);	
				
				var npage = "conteudoapostilameuscursos.php?tp=1&co_curso_apostila="+napostila;
					$('#capitulo-curso').load(npage,function(){
						$('#capitulo-curso').trigger('create');
					});
				 
				  
			});	 
	 $( document ).on( "click", ".ver-maiorcapitulo", function(){
	  			var cod = $(this).attr("id");
				var tam = cod.length - 3; 
				var id = cod.substr(3,tam);
				console.log('Id: ' + cod);	
				var ncapostila = id;
				var meucss = $('#cap'+id+' i').attr("class");
				if (meucss == 'fa fa-plus'){
					console.log('css: ' + meucss);	
					$('#cap'+id+' i').removeClass('fa fa-plus').addClass('fa fa-minus');
					$('#cpo'+id).show();
				}else{
					$('#cap'+id+' i').removeClass('fa fa-minus').addClass('fa fa-plus');
					$('#cpo'+id).hide();
				}
				var npage = "conteudoapostilameuscursos.php?tp=0&co_capitulo_apostila="+id;
					$('#capitulo-curso').load(npage,function(){
						$('#capitulo-curso').trigger('create');
					});
				 
				  
	});	 
$( document ).on( "click", ".ant-maiorcapitulo", function(){
	  			var cod = $(this).attr("id");
				var tam = cod.length - 3; 
				var id = cod.substr(3,tam);
				console.log('Id: ' + cod);	
				var ncapostila = id;
				var cssgeral = $('.ver-maiorcapitulo').attr("class");
				if (cssgeral == 'fa fa-minus'){
					$('.ver-maiorcapitulo').removeClass('fa fa-minus').addClass('fa fa-plus');
					$('.submenu-col2').hide();
				}else{
					$('.submenu-col2').hide();	
				}
				var meucss = $('#cap'+id+' i').attr("class");
				if (meucss != 'fa fa-plus'){
					$('#cap'+id+' i').removeClass('fa fa-plus').addClass('fa fa-minus');
					$('#cpo'+id).show();
				}
				var npage = "conteudoapostilameuscursos.php?tp=0&co_capitulo_apostila="+id;
					$('#capitulo-curso').load(npage,function(){
					$('#capitulo-curso').trigger('create');
				});
				 
				  
	});		 
   	$( document ).on( "click", ".ver-topico-capitulo", function(){
   				var cod = $(this).attr("id");
				var tam = cod.length - 3; 
				var id = cod.substr(3,tam);
				var myarray = id.split("-");
				var ncd_topico = myarray[0];
				var napostila = myarray[1];
				var cssgeral = $('.ver-capitulo').attr("class");
				if (cssgeral == 'fa fa-minus'){
					$('.ver-maiorcapitulo').removeClass('fa fa-minus').addClass('fa fa-plus');
					$('.submenu-col1').hide();
				}else{
					$('.submenu-col1').hide();	
				}

				console.log('Apostila: ' + napostila);
				var npage = "conteudoapostilameuscursos.php?tp=2&cd_topico="+ncd_topico+"&co_curso_apostila="+napostila;
					$('#capitulo-curso').load(npage,function(){
						$('#capitulo-curso').trigger('create');
					});
				 
				  
			});	 
	$( document ).on( "click", ".ant-topico-capitulo", function(){
   				var cod = $(this).attr("id");
				var tam = cod.length - 3; 
				var id = cod.substr(3,tam);
				var myarray = id.split("-");
				var ncd_topico = myarray[0];
				var napostila = myarray[1];
				console.log('Apostila: ' + napostila);
				console.log('Topico: ' + ncd_topico);
				var npage = "conteudoapostilameuscursos.php?tp=2&cd_topico="+ncd_topico+"&co_curso_apostila="+napostila;
					$('#capitulo-curso').load(npage,function(){
						$('#capitulo-curso').trigger('create');
					});
				$('html, body').animate({scrollTop: 0}, 2000);
 
				  
			});	
});
</script>
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
<body class="page-header-fixed1 page-quick-sidebar-over-content page-style-square"> 
<form name="formExec" id="formExec" action="loginjalekoDoc.html" method="post" data-ajax="false">
						 <input type="hidden" name="cd_usuario" id="cd_usuario" value="<?php echo $_SESSION['CO_USUARIO_S'] ; ?>" />
</form>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	
	<!-- BEGIN CONTENT -->
	<div id="miolo">
	<div class="page-content-wrapper1">
		<div class="page-content">
    	
        <div class="container">
        	<div class="col-md-6">
        		<div class="col-md-12 pull-left">&nbsp;</div>
        		<div class="col-md-12 pull-left">
         		<ol class="breadcrumb">
          			<li><a href="#" id="logout" rel="external" data-transition="slide">Logout</a></li>
          			<li class="active">Meus Cursos</li>
        		</ol>
        		</div>
    		</div>
    		
        <div class="row">
       		<?php
			$start = ($page-1)*6;
 			$prox = $page + 1;
 			$ant = $page - 1;
 if ($ant == 0){$ant = 1;}
				$qry_count_curso = "SELECT count( cd_curso ) AS qt FROM java_curso WHERE cd_modelo_curso > 0 and cd_curso in (select cd_curso from java_inscricao where cd_usuario = ".$co_usuario." )";
				$query1 = executa_query($qry_count_curso);
				if (num_recs($query1) > 0)
				{ 
				
					for ($r=0; $r < num_recs($query1); $r++)
					{
						
						
							$qttot = coluna($query1,$r,"qt");
							
					}
						
				}
				$countpage = ceil($qttot / 6);	
					
					
			
				if ($prox > $countpage){$prox = $page;}
				
				?>
				
          
        <div class="col-md-12">
        	<div id="relacao-cursos">
            <div class="row">
			<?php
			$qry ="SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'";
					executa_query($qry);
			 $qry_dados_curso = "SELECT * FROM java_curso where cd_curso in (select cd_curso from java_inscricao where cd_usuario = ".$co_usuario." and st_transacao < 5)";
			 $qry_dados_curso = $qry_dados_curso . " order by dt_inicio desc limit ".$start.",6";
				$query_dados1 = executa_query($qry_dados_curso);
				if (num_recs($query1) > 0)
				{ 
					$cont = 0;
					for ($r1=0; $r1 < num_recs($query_dados1); $r1++)
					{
						$cont = $cont + 1;
						$cd_curso = coluna($query_dados1,$r1,"cd_curso");
						
						$qry_maior_niv =	"SELECT max( a.st_nivel ) as item FROM (SELECT '1' AS st_nivel FROM tb_niveis WHERE st_nivel1 =1 AND cd_curso = ".$cd_curso." UNION SELECT '2' AS st_nivel FROM tb_niveis WHERE st_nivel2 =1 AND cd_curso = ".$cd_curso." UNION SELECT '3' AS st_nivel FROM tb_niveis WHERE st_nivel3 =1 AND cd_curso = ".$cd_curso." ) a";
				
						$query_maior_niv = executa_query($qry_maior_niv);
						if (num_recs($query_maior_niv) > 0)
						{ 
						   
							for ($n1=0; $n1 < num_recs($query_maior_niv); $n1++)
							{
								$v_maior_nivel  = coluna($query_maior_niv,$n1,"item");
								
							}
						}
						$dt_inicio_curso = coluna($query_dados1,$r1,"dt_inicio");
						$tx_descricao = coluna($query_dados1,$r1,"tx_descricao");
						$tx_nome = coluna($query_dados1,$r1,"tx_nome");
						$tx_nome = str_replace("<br />"," - ",$tx_nome);
						$tx_nome = str_replace("<br>"," - ",$tx_nome);
						$ds_img_apresentacao = coluna($query_dados1,$r1,"ds_img_apresentacao");
						$v_cd_modelo_curso = coluna($query_dados1,$r1,"cd_modelo_curso");
						switch($v_cd_modelo_curso){case "1":$ds_modelo = "Preparat&oacute;rio";break;case "2":$ds_modelo = "Pr&aacute;tico";break;case "3":$ds_modelo = "Atualiza&ccedil;&atilde;o";break;}
						$st_modo_curso = coluna($query_dados1,$r1,"st_modo_curso");
						switch($st_modo_curso){case "1":$ds_modo = "ONLINE";break;case "2":$ds_modo = "PRESENCIAL";break;case "3":$ds_modo = "ONLINE + PRESENCIAL";break;}
						$tx_descricao = coluna($query_dados1,$r1,"tx_descricao");
						
						
				
			?>
        		<div class="col-md-4"> 
                            <div class="col-item">
                                <div class="photo">
                                    <a href="#"><img src="http://www.cursojaleko.com.br/jalekoadmin/foto/<?php echo $ds_img_apresentacao; ?>" alt="<?php echo $tx_nome; ?>" /></a>
                                  <!--  <div class="cat_row"><a href="#"><?php echo $ds_modo." (".$ds_modelo.")"; ?></a><span class="pull-right"><i class=" icon-clock"></i>2 dias</span></div>-->
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="course_info col-md-12 col-sm-12">
                                        
                                            <h4><?php echo $tx_nome; ?></h4>
                                          <!--  <div class="rating">
                                            <i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class=" icon-star-empty"></i>
                                        	</div>
                                            <div class="price pull-right"></div>-->
										</div>
                                    </div>
                                    <div class="separator clearfix">
									<?php
										$sqlLmt = "select * from tb_limite_acesso_nivel where cd_curso = $cd_curso and st_nivel = '$v_ck'";
										
										$queryLmt = executa_query($sqlLmt);
										
										if (num_recs($queryLmt) > 0)
										{
											for ($r=0; $r < num_recs($queryLmt); $r++)
											{
												$v_st_tp_limite_acesso = coluna($queryLmt,$r,"st_tipo_limite_acesso");
												$v_dt_fim_acesso = coluna($queryLmt,$r,"dt_fim_acesso");
												$v_qt_dias_acesso = coluna($queryLmt,$r,"qt_dias_acesso");
												
												
											}
										
										}
									if ($v_ck < $v_maior_nivel){
										$habilitaUpgrade = ' class="faca-upgrade"';
									
									}else{
										$habilitaUpgrade = ' class="tooltip-1"';
									}
									
									switch($v_st_transacao){
										case "3":
										case "4":
											if($v_dt_pagto_inscricao < $dt_inicio_curso){
												$v_dt_pagto = $dt_inicio_curso;
											}else{
												$v_dt_pagto = $v_dt_pagto_inscricao;
											}
											
											$ret_valida = validarPermissaoCurso($v_st_tp_limite_acesso,$v_st_transacao, $v_dt_pagto, $v_qt_dias_acesso, $v_dt_fim_acesso, $dt_inicio_curso);
											if($ret_valida ==""){
												$habilitaEntrar = ' class="apostila-curso"'; 
												$statusCurso = 'Ativo'; 
												$statusicon = '<i class="icon-list"></i>'; 
												$habilitaModal = '';break;
											}else{
												$statusicon = '<i class="icon-thumbs-down"></i>'; 
												$statusCurso = 'Encerrado'; 	
												break;
											}
											
										default: 
											$habilitaEntrar = ' class="apostila-curso"'; 
											$statusicon = '<i class="icon-thumbs-down"></i>'; 
											$statusCurso = 'Encerrado'; 
										break;
											
									}
				?>
                                        <p class="btn-add"> <a href="#" id="cd<?php echo $cd_curso; ?>" <?php echo $habilitaEntrar; ?>><i class="icon-export-4"></i> Ver Apostila</a></p>
                                        <p class="btn-details"> <a href="#" id="statuscurso"  title="Status" > <?php echo $statusicon." ".$statusCurso; ?></a></p>
										
                                    </div>
                                </div>
                            </div>
                        </div>
                   <?php
				          if ($cont == 3){echo "</div><div class='row'>";$cont = 0;}
						}
						}
				  ?>
       		</div><!-- End row -->
            </div><!-- End row -->
            
        </div><!-- End col-lg-9-->
        
        <div id="lista-apostila-select">
        	<div id="campoPesquisa" class="col-md-12 inibe">
         		
							<input type="text" name="cbusca" id="cbusca"  value="" class="form-control input-medium" placeholder="bustar texto">
							<input type="hidden" name="cd_curso" id="cd_curso" value="">
				
						<button type="button" id="busca-conteudo" class="btn jaleko"><i class="fa fa-search"></i></button>
			
        		
    		</div>
    		<div id="lista-apostila-cursos"></div>
        </div>    			
                        
        </div><!-- End row -->
        
        <hr>
        <div  class="row">
        	<div class="col-md-12 text-center">
            	<ul class="pagination">
                  <li><a href="#" class="vaipag1" id="p<?php echo $ant; ?>">&laquo;</a></li>
				  <?php
				  
				  for($i=1; $i<=$countpage; $i++)
					{ 
					if ($page == $i){$v_classep = "paginatual";} else{$v_classep = "mudapagina";}
						echo '<li><a href="#" class="movepag1" id="p'.$i.'">'.$i.'</a></li>'; 
					}
				   ?>
                  <li><a href="#" class="vaipag1" id="p<?php echo $prox; ?>">&raquo;</a></li>
                </ul>
            </div>
        </div>
        	
        </div><!-- End container -->
        <?php
		function validarPermissaoCurso($tipo_limite_acesso, $stTransacao, $dataPg, $qtDiasAcesso, $dtFimAcesso, $dt_inicio_curso){
			$ret ="";
			
			$dataAtual = getDateCurrent();
			
			if(strtotime($dt_inicio_curso) > strtotime($dataAtual)){
				$ret = "inicia na data ".converte_data_br($dt_inicio_curso);
			}else{
				if($tipo_limite_acesso == "1"){
					if($dataAtual <= $dtFimAcesso){
						//return true;
					}else {
						$ret = " expirou há ".diffDate(substr($dtFimAcesso,0,10),$dataAtual,'D')." dia(s)";
					}
						
				} elseif ($tipo_limite_acesso == "2"){
						
					$diasCorridos = getDiasCorridos($dataPg);
					if($diasCorridos <= $qtDiasAcesso){
						//return true;
					}else{
						$ret = " expirou há ".($diasCorridos-$qtDiasAcesso)." dia(s)";
					}
				
				}
				
			}
			return $ret;
		}
		
		function getDiasCorridos($data){
			
			// Define os valores a serem usados
		
			$data_inicial = $data;
			$data_final = getDateCurrent();
			
			// Usa a função strtotime() e pega o timestamp das duas datas:
			$time_inicial = strtotime($data_inicial);
			$time_final = strtotime($data_final);
			
			// Calcula a diferença de segundos entre as duas datas:
			$diferenca = $time_final - $time_inicial; // 19522800 segundos
			
			// Calcula a diferença de dias
			$dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias
			
			// Exibe uma mensagem de resultado:
			return $dias;
				
		}
		
		function getDateCurrent(){
			date_default_timezone_set('America/Sao_Paulo');
			return date("Y-m-d");
		}
		
		function diffDate($d1, $d2, $type='', $sep='-')
		{
			$d1 = explode($sep, $d1);
			$d2 = explode($sep, $d2);
			switch ($type)
			{
				case 'A':
					$X = 31536000;
					break;
				case 'M':
					$X = 2592000;
					break;
				case 'D':
					$X = 86400;
					break;
				case 'H':
					$X = 3600;
					break;
				case 'MI':
					$X = 60;
					break;
				default:
					$X = 1;
			}
			return floor( ( ( mktime(0, 0, 0, $d2[1], $d2[2], $d2[0]) - mktime(0, 0, 0, $d1[1], $d1[2], $d1[0] ) ) / $X ) );
		}
		
		function converte_data_br($data) {
		
			/*
			 * Caso a data tenha horas,
			 * separa a data da hora.
			 */
			$hora = '';
		
			if (strstr($data, ' ')) {
				$data = explode(' ', $data);
		
				$hora = $data[1];
				$data = $data[0];
			}
		
			/*
			 * Reorganiza a data para ficar
			 * no padrão americano.
			 * yyyy-mm-dd hh:mm:ss
			 */
			$data = explode('-', $data);
			$data = array_reverse($data);
			$data = implode('/',$data);
		
			/*
			 * Se a data possui hora,
			 * a função retorna a data e hora.
			 * Caso não exista hora,
			 * retorna apenas a data
			*/
			if ($hora != '') {
				return $data . ' ' . $hora;
			}
			else {
				return $data;
			}
		
		}
		?>
		</div>
	</div>
	</div>
	<!-- END CONTENT -->
	
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<footer>
<div class="page-footer">
	<div class="page-footer-inner">
		 2014 &copy; Jaleko Acadêmicos.
	</div>
	<div class="scroll-to-top">
		<i class="fa fa-arrow-up"></i>
	</div>
</div>
</footer>
<!-- END FOOTER -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="./global/plugins/respond.min.js"></script>
<script src="./global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="./global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="./global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="./global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="./global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="./global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>


<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->



<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->


<!-- END PAGE LEVEL SCRIPTS -->



<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
<?php
break;
}
} 
mysql_close($con);
?>