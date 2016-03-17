<?php
function hash_internal_user_password($password) {
	global $CFG;

	if (isset($CFG->passwordsaltmain)) {
		return md5($password.$CFG->passwordsaltmain);
	} else {
		return md5($password);
	}
}

if (isset($_REQUEST['login']))     { $login = addslashes($_REQUEST['login']);} else {$login = "";}
if (isset($_REQUEST['senha_log'])) { $senha_log = addslashes($_REQUEST['senha_log']);} else {$senha_log = ""; }
if (isset($_REQUEST['id']))        { $id = $_REQUEST['id'];} else {$id = ""; }
$msg_erro = "";
if ($login <> "")
{
	if ($senha_log <> "")
			{
				$senha_crip =  md5($senha_log.'wey_yaJ&VEz(9YlCveAqQxgW~f');
				$senha_log = $senha_crip;
				mysql_select_db($banco);
				$sql="SELECT * FROM ".$banco.".mdl_user WHERE   deleted = 0 and  username = '$login' AND password = '$senha_log'";
				$row=executa_query($sql);
				if ($row=='erro') (exit);
				if (num_recs($row) > 0)
				{
					
					$co_usuario=coluna($row,0,"id");
					$no_usuario_inteiro=coluna($row,0,"firstname"). " ".coluna($row,0,"lastname");
					$no_usuario=coluna($row,0,"firstname");
					$_SESSION['CO_USUARIO_F'] = $co_usuario;
					if (coluna($row,0,"imagealt") != ""){
						$no_foto_usuario=coluna($row,0,"imagealt");
					}
					else
					{
						$no_foto_usuario = "semfoto.png";
					}
					$_SESSION['NO_FOTO_USUARIO_S'] = $no_foto_usuario;
					$_SESSION['NO_USUARIO'] = $no_usuario;
					$_SESSION['NO_USUARIO_F'] = $no_usuario_inteiro;
					$qry_perm_esus = "select * from ".$banco.".mdl_permissao_questao where st_permissao_questao = 1 and co_usuario_mdl = ".$co_usuario;
					mysql_select_db($banco);
					$row_perm=executa_query($qry_perm_esus);
					if (num_recs($row_perm) > 0)
					{
						//echo "Passou OK";
						$co_perfil_usuario=coluna($row_perm,0,"co_perfil_usuario");
						$_SESSION['CO_PERFIL_USUARIO_F'] = $co_perfil_usuario;
						$_SESSION['id'] = 1;
						$_SESSION['logado'] = 1;
						switch ($co_perfil_usuario)
						{
							case 1:
								$_SESSION['administrador'] = 1;
								$st_menu = "1";
								break;
							case 2:
								$_SESSION['administrador'] = 2;
								$st_menu = "2";
								break;
							case 3:
								$_SESSION['administrador'] = 3;
								$st_menu = "3";
								break;
							case 4:
								$_SESSION['administrador'] = 4;
								$st_menu = "4";
								break;
							default:
								$_SESSION['administrador'] = 3;
								$st_menu = "3";
								break;
						}
						$id= 1;
							
					}
					else 
					{
						$msg_erro = "Usu&aacute;rio INVALIDO";
						echo "<script>alert(".$msg_erro.");</script>";
						$id= 9;
						$co_usuario = "";
						$st_menu = "0";
						$VMeio = "0";
						$no_usuario = "";
						$co_pagina  = "";
						$co_perfil_usuario = "0";
						$msg_erro = "Digite o usurio e senha e pressione avanar!";
						$_SESSION['logado'] = 0;
						$pg = "";
					}
					
				
					
				}
					
			}
			else
			{
						$msg_erro = "Usu&aacute;rio INVALIDO";
						echo "<script>alert(".$msg_erro.");</script>";
						$id= 9;
						$co_usuario = "";
						$st_menu = "0";
						$VMeio = "0";
						$no_usuario = "";
						$co_pagina  = "";
						$co_perfil_usuario = "0";
						$msg_erro = "Digite o usurio e senha e pressione avanar!";
						$_SESSION['logado'] = 0;
						$pg = "";
			}
}
else
{
			if ($co_perfil_usuario <> "")
			{
					switch ($co_perfil_usuario)
					{
					case 1:
					$_SESSION['administrador'] = 1;
					$st_menu = "1";
					break;
					case 2:
					$_SESSION['administrador'] = 2;
					$st_menu = "2";
					break;
					case 3:
					$_SESSION['administrador'] = 3;
					$st_menu = "3";
					break;
					case 4:
					$_SESSION['administrador'] = 4;
					$st_menu = "4";
					break;
					default:
					$_SESSION['administrador'] = 3;
					$st_menu = "3";
					break;
					}
			}
			$_SESSION['logado'] = 0;
			$pg = "";
}
//header('http://127.0.0.1:8080/administrador/index.php?id=$cod', false);
?>
