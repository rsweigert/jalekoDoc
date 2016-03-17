	<?php
include "configura.php";
include $P_js."funcoes_bd.php";

if ($c=conexao($servidor,$usuario,$senha))
{
if (isset($_REQUEST["cd_usuario"])) { $v_id = $_REQUEST['cd_usuario'];} else {$v_id = ""; }
if (isset($_REQUEST['cd_curso']))              { $cd_curso = $_REQUEST['cd_curso'];}             else {$cd_curso = "0"; }
if (isset($_REQUEST['pagcont']))              { $pagcont = $_REQUEST['pagcont'];}             else {$pagcont = ""; }
if (isset($_REQUEST['page']))      { $page      = $_REQUEST['page'];}      else {$page = "1"; }
$_SESSION['PAGCONT_S'] = $pagcont;
$start = ($page-1)*6;
 $prox = $page + 1;
 $ant = $page - 1;
 if ($ant == 0){$ant = 1;}
mysql_select_db($banco);

	?>
	<div class="">
        
       <div class="col-md-12"> 
        <div class="col-md-4 box_style_1">
	
		<ul class="submenu-col1">
        <?php
        $qry ="SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'";
					executa_query($qry);
		$nomecapitulo = "";
		
		$qrycap = "SELECT DISTINCT c.co_capitulo_apostila, c.cd_curso, c.no_capitulo_apostila";
		$qrycap = $qrycap." FROM tb_capitulo_apostila c where c.cd_curso = ".$cd_curso." order by c.nu_ordem";
		$querycap = executa_query($qrycap);
		if (num_recs($querycap) > 0)
		{ 
				
			for ($v=0; $v < num_recs($querycap); $v++)
			{		
				$co_capitulo_apostila = coluna($querycap,$v,"co_capitulo_apostila");
				$no_capitulo_apostila = coluna($querycap,$v,"no_capitulo_apostila");
				if ($v==0){$nco_capitulo_apostila = $co_capitulo_apostila;}
				echo "<li>";
				echo '<a id="cap'.$co_capitulo_apostila.'" data-rel="close" href="#" rel="external" data-transition="slide" data-prefetch="true" class="ver-maiorcapitulo"><i class="fa fa-plus"></i> '.$no_capitulo_apostila.'</a>';
                     echo "<ul id='cpo".$co_capitulo_apostila."' class='submenu-col2 inibe'>";
						$qry_count_curso = "SELECT c.no_capitulo,c.co_curso_apostila,c.ds_resumo FROM tb_curso_apostila c where c.co_capitulo_apostila = ".$co_capitulo_apostila." and c.cd_curso = ".$cd_curso." order by c.nu_ordem";
				
					$query1 = executa_query($qry_count_curso);
					if (num_recs($query1) > 0)
					{ 
				
						for ($r=0; $r < num_recs($query1); $r++)
						{
						
							$co_curso_apostila = coluna($query1,$r,"co_curso_apostila");
							$no_capitulo = coluna($query1,$r,"no_capitulo");
							$ds_resumo = coluna($query1,$r,"ds_resumo");
							if ($r==0){
	
								$nco_curso_apostila = $co_curso_apostila;
								
							}
							echo "<li>";
							echo '<a id="sub'.$co_curso_apostila.'" data-rel="close" href="#" rel="external" data-transition="slide" data-prefetch="true" class="ver-capitulo"><i class="fa fa-plus"></i> '.$no_capitulo.'</a>';
							echo "<ul id='apo".$co_curso_apostila."' class='submenu-col2 inibe'>";
							$tx_titulo_topicoini ="";
							$qry_topico = "SELECT t.cd_topico, t.tx_titulo_topico, t.tx_descricao FROM rl_capitulo_topico r INNER JOIN tb_topico t ON t.cd_topico = r.cd_topico where r.co_curso_apostila = ".$co_curso_apostila." order by r.nu_ordem";
							$query2 = executa_query($qry_topico);
							if (num_recs($query1) > 0)
							{ 
				
								for ($r1=0; $r1 < num_recs($query2); $r1++)
								{
									$cd_topico = coluna($query2,$r1,"cd_topico");
									$tx_titulo_topico = coluna($query2,$r1,"tx_titulo_topico");
									$tx_descricao = coluna($query2,$r1,"tx_descricao");
									echo '<li><a id="top'.$cd_topico.'-'.$co_curso_apostila.'" data-rel="close" href="#" rel="external" data-transition="slide" data-prefetch="true" class="ver-topico-capitulo">'.$tx_titulo_topico.'</a></li>';
                            	    
                            	} // for topico
                            } // if topico
                            
							echo "</ul>";
							
							echo "</li>";	
							
							
						}
					}
					echo "</ul>";
				echo "</li>";	
			}  // for Capitulo
		} // if  Capitulo
				
			?>	
			
		</ul>



			</div>
        
       	  
        <div class="col-lg-8">
        	<div class="row" id="capitulo-curso">
        		<div class="">
        
       
        <div class="col-md-12">
        	<?php
        $qry ="SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'";
					executa_query($qry);
				$nomecapitulo = "";
		if ($nco_capitulo_apostila != 0){
		$qrycap = "SELECT DISTINCT c.co_capitulo_apostila, c.cd_curso, c.no_capitulo_apostila, c.nu_ordem";
		$qrycap = $qrycap." FROM tb_capitulo_apostila c where c.co_capitulo_apostila = ".$nco_capitulo_apostila." and c.cd_curso = ".$cd_curso." order by c.nu_ordem";
		$querycap = executa_query($qrycap);
		if (num_recs($querycap) > 0)
		{ 
				
			for ($v=0; $v < num_recs($querycap); $v++)
			{		
				$co_capitulo_apostila = coluna($querycap,$v,"co_capitulo_apostila");
				$no_capitulo_apostila = coluna($querycap,$v,"no_capitulo_apostila");
				$var_cd_curso = coluna($querycap,$v,"cd_curso");
				$nu_ordem = coluna($querycap,$v,"nu_ordem");
				// anterior
				if ($nu_ordem == 1){
					$nu_ordem1 = $nu_ordem;
				}else{
					$nu_ordem1 = $nu_ordem - 1;
					
				}
				$qrycap1 = "SELECT DISTINCT c.co_capitulo_apostila";
				$qrycap1 = $qrycap1." FROM tb_capitulo_apostila c where c.cd_curso = ".$var_cd_curso ." and c.nu_ordem = ".$nu_ordem1." order by c.nu_ordem";
					$querycap1 = executa_query($qrycap1);
					if (num_recs($querycap1) > 0)
						{ 
				
							for ($v1=0; $v1 < num_recs($querycap1); $v1++)
							{		
								$co_capitulo_apostila = coluna($querycap1,$v1,"co_capitulo_apostila");
							}
						}

				// posterior
				$qry2 = "select max(nu_ordem) as NUM from tb_capitulo_apostila where cd_curso = ".$var_cd_curso;
				$linhas = executa_query($qry2);
				if (num_recs($linhas) > 0)
						{ 
				
							for ($vt=0; $vt < num_recs($linhas); $vt++)
							{		
								$nu_ordemMaior = coluna($linhas,$vt,"NUM");
							}
						}
			//	echo "<br />MaiorOrdem:".$nu_ordemMaior."<br />";
				if ($nu_ordem == $nu_ordemMaior){
					$nu_ordem2 = $nu_ordem;
				}else{
					$nu_ordem2 = $nu_ordem + 1;
					
				}
			//	echo "<br />Ordem:".$nu_ordem2."<br />";
				$qrycap2 = "SELECT DISTINCT c.co_capitulo_apostila";
				$qrycap2 = $qrycap2." FROM tb_capitulo_apostila c where c.cd_curso = ".$var_cd_curso ." and c.nu_ordem = ".$nu_ordem2." order by c.nu_ordem";
				$querycap2 = executa_query($qrycap2);
				if (num_recs($querycap2) > 0)
						{ 
				
							for ($v2=0; $v2 < num_recs($querycap2); $v2++)
							{		
								$co_capitulo_apostilaM = coluna($querycap2,$v2,"co_capitulo_apostila");
							}
						}
				echo "<h3>".$no_capitulo_apostila."</h3>";
		$qry_count_curso = "SELECT c.no_capitulo,c.co_curso_apostila, c.ds_resumo FROM tb_curso_apostila c where c.co_capitulo_apostila = ".$nco_capitulo_apostila;
				
				$query1 = executa_query($qry_count_curso);
				if (num_recs($query1) > 0)
				{ 
				
					for ($r=0; $r < num_recs($query1); $r++)
					{
						
							$co_curso_apostila = coluna($query1,$r,"co_curso_apostila");
							$no_capitulo = coluna($query1,$r,"no_capitulo");
							$ds_resumo = coluna($query1,$r,"ds_resumo");
							echo "<h4>".$no_capitulo."</h4>";
						//	echo '<h5>Resumo</h5><i>'.$ds_resumo.'</i><br /><p>&nbsp;</p>';
                            
							$qry_topico = "SELECT t.cd_topico, t.tx_titulo_topico, t.tx_descricao FROM rl_capitulo_topico r INNER JOIN tb_topico t ON t.cd_topico = r.cd_topico where r.co_curso_apostila = ".$co_curso_apostila;
							$query2 = executa_query($qry_topico);
							if (num_recs($query1) > 0)
							{ 
				
								for ($r1=0; $r1 < num_recs($query2); $r1++)
								{
									$cd_topico = coluna($query2,$r1,"cd_topico");
									$tx_titulo_topico = coluna($query2,$r1,"tx_titulo_topico");
									$tx_descricao = coluna($query2,$r1,"tx_descricao");

									echo '<p><strong>'.$tx_titulo_topico.'</strong></p>';
									echo $tx_descricao;
                            	}
                            }
							
							
					}
						
				}
				}
						
				}
				}
				echo '<hr /><div id="botoes">';
				echo '<a href="#" id="ant'.$co_capitulo_apostila.'" class="ant-maiorcapitulo"><i class="icon-left-hand"></i> Sessão Anterior</a> | ';
				echo '<a href="#" id="todas" class="ver-sessao"><i class="icon-left-hand"></i> Todas as Sessão</a> | ';
                echo '<a href="#" id="prx'.$co_capitulo_apostilaM.'" class="prox-maiorcapitulo"><i class="icon-right-hand"></i> Próxima Sessão</a>';
                echo '</div>';
				?>
				</div><!-- End col-lg-12 -->
				</div><!-- End container -->
       		</div><!-- End row -->
        </div><!-- End col-lg-8-->
        
        			
                        
        
        
        
       </div>
            	
        </div><!-- End container -->
		<?php
		}
		encerra_con($c); 
		
		
		
		?>