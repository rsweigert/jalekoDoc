	<?php
include "configura.php";
include $P_js."funcoes_bd.php";

if ($c=conexao($servidor,$usuario,$senha))
{
if (isset($_REQUEST["cd_usuario"])) { $v_id = $_REQUEST['cd_usuario'];} else {$v_id = ""; }
if (isset($_REQUEST['co_curso_apostila']))              { $co_curso_apostila = $_REQUEST['co_curso_apostila'];}             else {$co_curso_apostila = "0"; }
if (isset($_REQUEST['tp']))              { $tp = $_REQUEST['tp'];}             else {$tp = "1"; }
if (isset($_REQUEST['cd_topico']))      { $cd_topico      = $_REQUEST['cd_topico'];}      else {$cd_topico = ""; }
if (isset($_REQUEST['co_capitulo_apostila']))      { $co_capitulo_apostila      = $_REQUEST['co_capitulo_apostila'];}      else {$co_capitulo_apostila = ""; }

mysql_select_db($banco);

	?>
	<div class="">
        
       
        <div class="col-md-12">
	
		
        <?php
        $qry ="SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'";
					executa_query($qry);
		$nomecapitulo = "";
		switch($tp){
			case "0":
			$qrycap = "SELECT DISTINCT c.co_capitulo_apostila, c.cd_curso, c.no_capitulo_apostila, c.nu_ordem";
			$qrycap = $qrycap." FROM tb_capitulo_apostila c where c.co_capitulo_apostila = ".$co_capitulo_apostila ." order by c.nu_ordem";
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
					$co_capitulo_apostilaA = $co_capitulo_apostila;
				}else{
					$nu_ordem1 = $nu_ordem - 1;
					$qrycap1 = "SELECT DISTINCT c.co_capitulo_apostila";
					$qrycap1 = $qrycap1." FROM tb_capitulo_apostila c where c.cd_curso = ".$var_cd_curso ." and nu_ordem = ".$nu_ordem1." order by c.nu_ordem";
					$querycap1 = executa_query($qrycap1);
					if (num_recs($querycap1) > 0)
						{ 
				
							for ($v1=0; $v1 < num_recs($querycap1); $v1++)
							{		
								$co_capitulo_apostilaA= coluna($querycap1,$v1,"co_capitulo_apostila");
							}
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
				
				if ($nu_ordem == $nu_ordemMaior){
					$nu_ordem2 = $nu_ordem;
				}else{
					$nu_ordem2 = $nu_ordem + 1;
					
				}
				$qrycap2 = "SELECT DISTINCT c.co_capitulo_apostila";
				$qrycap2 = $qrycap2." FROM tb_capitulo_apostila c where c.cd_curso = ".$var_cd_curso ." and nu_ordem = ".$nu_ordem2." order by c.nu_ordem";
				$querycap2 = executa_query($qrycap2);
				if (num_recs($querycap2) > 0)
						{ 
				
							for ($v2=0; $v2 < num_recs($querycap2); $v2++)
							{		
								$co_capitulo_apostilaM = coluna($querycap2,$v2,"co_capitulo_apostila");
							}
						}
				echo "<h3>".$no_capitulo_apostila."</h3>";
				
				$qry_count_curso = "SELECT c.no_capitulo,c.co_curso_apostila, c.ds_resumo FROM tb_curso_apostila c where c.co_capitulo_apostila = ".$co_capitulo_apostila;
				
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
				echo '<hr /><div id="botoes">';
				echo '<a href="#" id="ant'.$co_capitulo_apostilaA.'" class="ant-maiorcapitulo"><i class="icon-left-hand"></i> Sessão Anterior</a> | ';
				echo '<a href="#" id="todas" class="ver-sessao"><i class="icon-left-hand"></i> Todas as Sessão</a> | ';
                echo '<a href="#" id="prx'.$co_capitulo_apostilaM.'" class="ant-maiorcapitulo"><i class="icon-right-hand"></i> Próxima Sessão</a>';
                echo '</div>';
				break;
			case "1":
				$qry_count_curso = "SELECT c.no_capitulo,c.co_curso_apostila, c.ds_resumo, c.cd_curso, c.nu_ordem FROM tb_curso_apostila c where c.co_curso_apostila = ".$co_curso_apostila;
				
				$query1 = executa_query($qry_count_curso);
				if (num_recs($query1) > 0)
				{ 
				
					for ($r=0; $r < num_recs($query1); $r++)
					{
						
							$co_curso_apostila = coluna($query1,$r,"co_curso_apostila");
							$no_capitulo = coluna($query1,$r,"no_capitulo");
							$ds_resumo = coluna($query1,$r,"ds_resumo");
							$nu_ordem = coluna($query1,$r,"nu_ordem");
							$var_cd_curso = coluna($query1,$r,"cd_curso");
							// anterior
							if ($nu_ordem == 1){
								$nu_ordem1 = $nu_ordem;
								$co_curso_apostilaA = $co_curso_apostila;
							}else{
								$nu_ordem1 = $nu_ordem - 1;
								$qrycap1 = "SELECT DISTINCT c.co_curso_apostila";
								$qrycap1 = $qrycap1." FROM tb_curso_apostila c where c.cd_curso = ".$var_cd_curso ." and c.nu_ordem = ".$nu_ordem1." order by c.nu_ordem";
								$querycap1 = executa_query($qrycap1);
							if (num_recs($querycap1) > 0)
							{ 
				
							for ($v1=0; $v1 < num_recs($querycap1); $v1++)
							{		
								$co_curso_apostilaA = coluna($querycap1,$v1,"co_curso_apostila");
							}
							}

					
							}
							
							
							// posterior
							$qry2 = "select max(nu_ordem) as NUM from tb_curso_apostila where cd_curso = ".$var_cd_curso;
							$linhas = executa_query($qry2);
							if (num_recs($linhas) > 0)
							{ 
				
							for ($vt=0; $vt < num_recs($linhas); $vt++)
							{		
								$nu_ordemMaior = coluna($linhas,$vt,"NUM");
							}
							}
			
							if ($nu_ordem == $nu_ordemMaior){
								$nu_ordem2 = $nu_ordem;
							}else{
								$nu_ordem2 = $nu_ordem + 1;
					
							}
							$qrycap2 = "SELECT DISTINCT c.co_curso_apostila";
							$qrycap2 = $qrycap2." FROM tb_curso_apostila c where c.cd_curso = ".$var_cd_curso ." and c.nu_ordem = ".$nu_ordem2." order by c.nu_ordem";
							$querycap2 = executa_query($qrycap2);
							if (num_recs($querycap2) > 0)
								{ 
				
									for ($v2=0; $v2 < num_recs($querycap2); $v2++)
									{		
										$co_curso_apostilaM = coluna($querycap2,$v2,"co_curso_apostila");
									}
								}
							echo "<h4>".$no_capitulo."</h4>";
						
                            
							$qry_topico = "SELECT t.cd_topico, t.tx_titulo_topico, t.tx_descricao, r.nu_ordem, r.cd_curso FROM rl_capitulo_topico r INNER JOIN tb_topico t ON t.cd_topico = r.cd_topico where r.co_curso_apostila = ".$co_curso_apostila;
							$query2 = executa_query($qry_topico);
							if (num_recs($query1) > 0)
							{ 
				
								for ($r1=0; $r1 < num_recs($query2); $r1++)
								{
									$cd_topico = coluna($query2,$r1,"cd_topico");
									$tx_titulo_topico = coluna($query2,$r1,"tx_titulo_topico");
									$tx_descricao = coluna($query2,$r1,"tx_descricao");
									$nu_ordem = coluna($query2,$r1,"nu_ordem");
									$cd_curso = coluna($query2,$r1,"cd_curso");


									echo '<p><strong>'.$tx_titulo_topico.'</strong></p>';
									echo $tx_descricao;
                            	}
                            }
							
							
					}
						
				}
				echo '<hr /><div id="botoes">';
				echo '<a href="#" id="act'.$co_curso_apostilaA.'" class="ant-capitulo"><i class="icon-left-hand"></i> Capítulo Anterior</a> | ';
				echo '<a href="#" id="tcodas" class="todos-capitulos"><i class="icon-left-hand"></i> Todas os Capítulos</a> | ';
                echo '<a href="#" id="pcx'.$co_curso_apostilaM.'" class="ant-capitulo"><i class="icon-right-hand"></i> Próximo Capítulo</a>';
                echo '</div>';
				break;
				case "2":
				$qry_count_curso = "SELECT c.no_capitulo,c.co_curso_apostila, c.ds_resumo FROM tb_curso_apostila c where c.co_curso_apostila = ".$co_curso_apostila;
				
				$query1 = executa_query($qry_count_curso);
				if (num_recs($query1) > 0)
				{ 
				
					for ($r=0; $r < num_recs($query1); $r++)
					{
						
							$co_curso_apostila = coluna($query1,$r,"co_curso_apostila");
							$no_capitulo = coluna($query1,$r,"no_capitulo");
							$ds_resumo = coluna($query1,$r,"ds_resumo");
							
							echo "<h4>".$no_capitulo."</h4>";
							
                            
							$qry_topico = "SELECT t.cd_topico, t.tx_titulo_topico, t.tx_descricao, r.nu_ordem, r.cd_curso  FROM tb_topico t INNER JOIN rl_capitulo_topico r ON r.cd_topico = t.cd_topico  where t.cd_topico = ".$cd_topico." and r.co_curso_apostila = ".$co_curso_apostila;
							$query2 = executa_query($qry_topico);
							if (num_recs($query1) > 0)
							{ 
				
								for ($r1=0; $r1 < num_recs($query2); $r1++)
								{
									$cd_topico = coluna($query2,$r1,"cd_topico");
									$tx_titulo_topico = coluna($query2,$r1,"tx_titulo_topico");
									$tx_descricao = coluna($query2,$r1,"tx_descricao");
									$nu_ordem = coluna($query2,$r1,"nu_ordem");
									$var_cd_curso = coluna($query2,$r1,"cd_curso");
									// anterior
									if ($nu_ordem == 1){
										$nu_ordem1 = $nu_ordem;
									}else{
										$nu_ordem1 = $nu_ordem - 1;
					
									}
							$qrycap1 = "SELECT DISTINCT t.cd_topico";
							$qrycap1 = $qrycap1." FROM tb_topico t INNER JOIN rl_capitulo_topico r ON r.cd_topico = t.cd_topico where r.cd_curso = ".$var_cd_curso ." and r.nu_ordem = ".$nu_ordem1." order by r.nu_ordem";
							$querycap1 = executa_query($qrycap1);
							if (num_recs($querycap1) > 0)
							{ 
				
							for ($v1=0; $v1 < num_recs($querycap1); $v1++)
							{		
								$cd_topicoA = coluna($querycap1,$v1,"cd_topico");
							}
							}

							// posterior
							$qry2 = "select max(nu_ordem) as NUM from rl_capitulo_topico where co_curso_apostila = ".$co_curso_apostila." and cd_curso = ".$var_cd_curso;
							$linhas = executa_query($qry2);
							if (num_recs($linhas) > 0)
							{ 
				
							for ($vt=0; $vt < num_recs($linhas); $vt++)
							{		
								$nu_ordemMaior3 = coluna($linhas,$vt,"NUM");
							}
							}
			
							if ($nu_ordem == $nu_ordemMaior3){
								$nu_ordem2 = $nu_ordem;
							}else{
								$nu_ordem2 = $nu_ordem + 1;
					
							}
							$qrycap2 = "SELECT DISTINCT t.cd_topico";
							$qrycap2 = $qrycap2." FROM tb_topico t INNER JOIN rl_capitulo_topico r ON r.cd_topico = t.cd_topico where r.cd_curso = ".$var_cd_curso ." and r.nu_ordem = ".$nu_ordem2." order by r.nu_ordem";
							$querycap2 = executa_query($qrycap2);
							if (num_recs($querycap2) > 0)
								{ 
				
									for ($v2=0; $v2 < num_recs($querycap2); $v2++)
									{		
										$cd_topicoM = coluna($querycap2,$v2,"cd_topico");
									}
								}
									echo '<p><strong>'.$tx_titulo_topico.'</strong></p>';
									echo $tx_descricao;
                            	}
                            }
							
							
					}
						
				}
				echo '<hr /><div id="botoes">';
				echo '<a href="#" id="att'.$cd_topicoA.'-'.$co_curso_apostila.'" class="ant-topico-capitulo"><i class="icon-left-hand"></i> Tópico Anterior</a> | ';
				echo '<a href="#" id="ttodas" class="todos-topico"><i class="icon-left-hand"></i> Todas os Tópicos</a> | ';
                echo '<a href="#" id="ptx'.$cd_topicoM.'-'.$co_curso_apostila.'" class="ant-topico-capitulo"><i class="icon-right-hand"></i> Próximo Tópico</a>';
                echo '</div>';
				break;
			}	
			?>	
			



			</div>
        
       	  
       
        
        			
                        
        
        
        
       
            	
        </div><!-- End container -->
		<?php
		}
		encerra_con($c); 
		
		
		
		?>