<?php
function executa_query($sql)
{
	$resultado = mysql_query($sql);
	if (!$resultado) 
	   {
        echo mysql_errno().':'. mysql_error();
        return 'erro';
		exit;
       }
	return $resultado;
}

function num_recs($qry)
{
   return mysql_num_rows($qry);
}
function sequencial($qry,$rec,$col)
{
   $seq = coluna($qry,$rec,$col);
   $seq = $seq + 1;
   return $seq;
}
function conexao($serv,$usu,$snh)
{
 return mysql_connect($serv,$usu,$snh);
}

function coluna($qry,$ln,$cmp)
{
 return mysql_result($qry,$ln,$cmp);
}

function encerra_con($c)
{
 mysql_close($c);
}
function gravaLog($v_co_paciente, $usuario, $acao, $datetime){
       
         $sql  = "Insert into tb_paciente_usuario (co_paciente, co_usuario, ds_acao, dt_uso) 
                                           values ('$v_co_paciente', '$usuario', '$acao', '$datetime')";

         $stmt = executa_query($sql);
}
function posiciona_paciente( $v_co_paciente_parametro, $v_ds_nome_paciente, $banco ){
                                                                  
//  echo $sql="SELECT * FROM tb_paciente  WHERE co_paciente=".$v_co_paciente;
    $SQL = "select * from tb_paciente  
                         where  co_paciente = ".$v_co_paciente_parametro;
    mysql_select_db($banco);
    $query = executa_query($sql);  
       
    if (num_recs($query) > 0)
	      	 	{ for ($rec=0; $rec < num_recs($query); $rec++) 
	       		 {  
                             echo $v_ds_nome_paciente  = coluna($query,$rec,"ds_nome");
                                                                                 
                         }
		 	}
      return $v_ds_nome_paciente;
    
}
function calcula_idade($v_dt_nascimento){
          $v_data_nascimento = substr($v_dt_nascimento,6,4).substr($v_dt_nascimento,3,2).substr($v_dt_nascimento,0,2);                                                    
          $v_ano = substr($v_dt_nascimento,6,4);
          $v_mes = substr($v_dt_nascimento,3,2);
          $v_dia = substr($v_dt_nascimento,0,2);
          
          $v_hoje = date("Ymd");
          
          $v_anoHoje = substr($v_hoje,0,4);
          $v_mesHoje = substr($v_hoje,4,2);
          $v_diaHoje = substr($v_hoje,6,2);
        
       if ($v_mesHoje < $v_mes){
           $v_idade = $v_anoHoje - $v_ano - 1;       
       }  else {
           $v_idade = $v_anoHoje - $v_ano;       
       }
   //    echo  '$v_idade = '.$v_idade.'<br />';
  
      return $v_idade;
    
}

?>
