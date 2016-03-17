<?php
/**
* Tutorial jSON
*/

//Definir formato de arquivo
header('Content-Type:' . "text/plain");
if (isset($_REQUEST['co_modalidade_concurso'])) { $v_co_modalidade_concurso = $_REQUEST['co_modalidade_concurso'];} else {$v_co_modalidade_concurso= "55"; }
if (isset($_REQUEST['tx_nome_concurso'])) { $v_tx_nome_concurso = $_REQUEST['tx_nome_concurso'];} else {$v_tx_nome_concurso = "PM"; }


include "configura.php";
include "./_js/funcoes_bd.php";
if ($c=conexao($servidor,$usuario,$senha))
	{
	mysql_select_db($banco);
	//SQL de BUSCA LISTAGEM
	$sql 	= "SELECT q.cd_questao,q.tx_nome_concurso,q.st_conteudo_questao, q.ds_ano, q.tx_titulo, case q.nr_opcao_correta when '1' then 'A' when '2' then 'B' when '3' then 'C' when '4' then 'D' when '5' then 'E' end as opcao,e.tx_nome, x.tx_nome AS tx_espec , m.ds_modalidade_concurso from java_questao q INNER JOIN tb_modalidade m ON q.co_modalidade_concurso = m.co_modalidade_concurso INNER JOIN java_questao_especialidade j ON j.cd_questao = q.cd_questao INNER JOIN java_especialidade e ON e.cd_especialidade = j.cd_especialidade INNER JOIN java_especialidade x ON e.cd_espec_pai = x.cd_especialidade WHERE q.in_ativa = 1"; 
	$sql = $sql. "  AND q.co_modalidade_concurso = 55";
	$sql = $sql. "  AND q.tx_nome_concurso = 'PM'";
	
	$result = executa_query($sql);
	$n 		= num_recs($result); //Número de Linhas retornadas

	if (!$result) {
		//Caso não haja retorno
		echo '[{"erro": "Há algum erro com a busca. Não retorna resultados"';
		echo '}]';
	}else if($n<1) {
		//Caso não tenha nenhum item
		echo '[{"erro": "Não há nenhum dado cadastrado"';
		echo '}]';
	}else {
	
	    $dados["draw"] = intval($_REQUEST['draw']);
		$dados["recordsTotal"] = $n;
		$dados["recordsFiltered"] = $n;
		//Mesclar resultados em um array
		for($i = 0; $i<$n; $i++) {
			$dados["data"][$i] = mysql_fetch_assoc($result);
		}
		
		encerra_con($c);
		echo json_encode($dados, 128);
	}
}


?>