	<?php
function retorna_dados($texto,$cd_curso){
include "configura.php";
include $P_js."funcoes_bd.php";

if ($c=conexao($servidor,$usuario,$senha))
{

mysql_select_db($banco);
$arr = "";
	?>
	
	
		
        <?php
        $arr = $arr. '<div class="">';
        
       
        $arr = $arr. '<div class="col-md-12">';
        $qry ="SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'";
					executa_query($qry);
		$nomecapitulo = "";
		
		$qry_count_curso = "SELECT DISTINCT c.no_capitulo, c.co_curso_apostila, c.ds_resumo, t.cd_topico, t.tx_titulo_topico, t.tx_descricao";
		$qry_count_curso = $qry_count_curso." FROM tb_curso_apostila c";
		$qry_count_curso = $qry_count_curso." INNER JOIN rl_capitulo_topico r ON r.co_curso_apostila = c.co_curso_apostila";
		$qry_count_curso = $qry_count_curso." INNER JOIN tb_topico t ON t.cd_topico = r.cd_topico";
		$qry_count_curso = $qry_count_curso." WHERE c.cd_curso = ".$cd_curso;
		$qry_count_curso = $qry_count_curso." AND (c.ds_resumo LIKE  '%".$texto."%' OR t.tx_titulo_topico LIKE  '%".$texto."%' OR t.tx_descricao LIKE  '%".$texto."%')"; 
				
				$query1 = executa_query($qry_count_curso);
				if (num_recs($query1) > 0)
				{ 
				
					for ($r=0; $r < num_recs($query1); $r++)
					{
						
							$co_curso_apostila = coluna($query1,$r,"co_curso_apostila");
							$no_capitulo = coluna($query1,$r,"no_capitulo");
							$ds_resumo = coluna($query1,$r,"ds_resumo");
							if ($nomecapitulo != $no_capitulo){
							$arr = $arr. "<h4>".$no_capitulo."</h4>";
							$arr = $arr. '<h5>Resumo</h5><i>'.$ds_resumo.'</i><br /><p>&nbsp;</p>';
							$nomecapitulo = $no_capitulo;
							}
							
                            $cd_topico = coluna($query1,$r,"cd_topico");
							$tx_titulo_topico = coluna($query1,$r,"tx_titulo_topico");
							$tx_descricao = coluna($query1,$r,"tx_descricao");
							$arr = $arr. '<p><strong>'.$tx_titulo_topico.'</strong></p>';
							$arr = $arr. $tx_descricao;
                            
							
							
					}
						
				}
				$arr = $arr. '</div>';
				$arr = $arr. '</div>';
				$new_text = '<i class="letramediaY">'.$texto.'</i>';
				$arr = str_replace($texto,$new_text,$arr);
				$dados = $arr;
					
		
		}
		encerra_con($c); 
		return $dados;
	}	

if (isset($_REQUEST["texto"])) { $texto = $_REQUEST['texto'];} else {$texto = ""; }
if (isset($_REQUEST['cd_curso']))              { $cd_curso = $_REQUEST['cd_curso'];}             else {$cd_curso = "0"; }

echo retorna_dados($texto,$cd_curso);	
		
		?>