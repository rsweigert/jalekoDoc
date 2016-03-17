<?php
$msg_erro = "";
//echo "entrei usuario = ".$_SESSION['CO_USUARIO_F'] ;
if ($_SESSION['CO_USUARIO_F'] <> "")
		{
					mysql_select_db($banco);
					$sql="SELECT * FROM  mdl_user WHERE deleted = 0 and  id = ". addslashes($_SESSION['CO_USUARIO_F']) ;
					$row=executa_query($sql);
					if ($row=='erro') (exit);
					if (num_recs($row) > 0)
					{
						$co_usuario=coluna($row,0,"id");
						$no_usuario_inteiro=coluna($row,0,"firstname"). " ".coluna($row,0,"lastname");
						$no_usuario=coluna($row,0,"firstname");
						if (coluna($row,0,"imagealt") != ""){
						$no_foto_usuario=coluna($row,0,"imagealt");
						}
						else
						{
							$no_foto_usuario = "semfoto.png";
						}
						$_SESSION['NO_FOTO_USUARIO_S'] = $no_foto_usuario;
						$_SESSION['CO_USUARIO_F'] = $co_usuario;
						$_SESSION['NO_USUARIO'] = $no_usuario;
						$_SESSION['NO_USUARIO_F'] = $no_usuario_inteiro;
						$qry_perm_esus = "select * from mdl_permissao_questao where st_permissao_questao = 1 and co_usuario_mdl = ".$co_usuario;
						mysql_select_db($banco);
						$row_perm=executa_query($qry_perm_esus);
						if (num_recs($row_perm) > 0)
						{
								
							$co_perfil_usuario=coluna($row_perm,0,"co_perfil_usuario");
							$_SESSION['CO_PERFIL_USUARIO_F'] = $co_perfil_usuario;
						//	echo "Perf: ".$_SESSION['CO_PERFIL_USUARIO_F'];
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
							$msg_erro = "Usurio INVALIDO";
							echo "<script>alert(".$msg_erro.");</script>";
							$id= 99;
							$co_usuario = "";
							$st_menu = "0";
							$VMeio = "0";
							$no_usuario = "";
							$co_pagina  = "";
							$co_perfil_usuario = "0";
							$msg_erro = "Digite o usurio e senha e pressione avançar!";
							$_SESSION['logado'] = 0;
							$pg = "";
						}
						
					}else{
						$msg_erro = "Usurio INVALIDO";
						echo "<script>alert(".$msg_erro.");</script>";
						$id= 99;
						$co_usuario = "";
						$st_menu = "0";
						$VMeio = "0";
						$no_usuario = "";
						$co_pagina  = "";
						$co_perfil_usuario = "0";
						$msg_erro = "Digite o usurio e senha e pressione avançar!";
						$_SESSION['logado'] = 0;
						$pg = "";
						
					}
			
		}				
else
		{
								$msg_erro = "Usurio INVALIDO";
								echo "<script>alert(".$msg_erro.");</script>";
								$id= 99;
								$co_usuario = "";
								$st_menu = "0";
								$VMeio = "0";
								$no_usuario = "";
								$co_pagina  = "";
								$co_perfil_usuario = "0";
								$msg_erro = "Digite o usurio e senha e pressione avançar!";
								$_SESSION['logado'] = 0;
								$pg = "";
					
		}
?>
