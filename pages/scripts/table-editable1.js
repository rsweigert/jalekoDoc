var TableEditable = function () {

    var handleTable = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }
	
		function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
			oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
			oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
			oTable.fnUpdate(jqInputs[6].value, nRow, 6, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 10, false);
            oTable.fnDraw();
        }
		function carregarItens(n){
	
	var url = "function_selecionar_questao_edicao.php?cd_questao="+n;
	 $.ajax({
		url: url,
	    cache: false,
	    dataType: "json",
	    beforeSend: function() {
		  // $("div#aguarde").show("slow").delay(3000).hide("slow");
		   
	    },
	    error: function() {
		   // $("#aguarde").html("Há algum problema com a fonte de dados");
	    },
		success: function(retorno) {
		    if(retorno[0].erro){
			    $("#aguarde").html(retorno[0].erro);
		    }
		    else{
			    //Laço para criar linhas da tabela
			    for(var i = 0; i < retorno.length; i++){
					ntxquestao = retorno[i].tx_questao;
					alert(ntxquestao);
					ntx_resposta1 = retorno[i].tx_resposta1;
					ntx_resposta2 = retorno[i].tx_resposta2;
					ntx_resposta3 = retorno[i].tx_resposta3;
					ntx_resposta4 = retorno[i].tx_resposta4;
					ntx_resposta5 = retorno[i].tx_resposta5;
					nnr_opcao_correta = retorno[i].nr_opcao_correta;
					ntx_comentario_feedback = retorno[i].tx_comentario_feedback;
					nin_ativa = retorno[i].in_ativa;
					ncdquestao = retorno[i].cd_questao;
					$("#editor2").val(ntxquestao);
					$("#tx_resposta1_edt").val(ntx_resposta1);
					$("#tx_resposta2_edt").val(ntx_resposta2);
					$("#tx_resposta3_edt").val(ntx_resposta3);
					$("#tx_resposta4_edt").val(ntx_resposta4);
					$("#tx_resposta5_edt").val(ntx_resposta5);
					$("#nr_opcao_correta_edt").val(nnr_opcao_correta);
					$("#editor1").val(ntx_comentario_feedback);
					$("#in_ativa_edt").val(nin_ativa);
										
				}
			}
		}
	 });
	}
	  var table = $('#sample_editable_1');
	 
      var oTable = table.dataTable({

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            
            "lengthMenu": [
                [5, 15, 20, 100, -1],
                [5, 15, 20, 100, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 100,

            "language": {
				"sProcessing":   "Processando...",
				"sLengthMenu":   "Mostrar _MENU_ registros",
				"sZeroRecords":  "N&atilde;o foram encontrados resultados",
				"sInfo":         "Mostrando de _START_ at&eacute; _END_ de _TOTAL_ registros",
				"sInfoEmpty":    "Mostrando de 0 at&eacute; 0 de 0 registros",
				"sInfoFiltered": "(filtrado de _MAX_ registros no total)",
				"sInfoPostFix":  "",
				"sSearch":       "Buscar:",
				"sUrl":          "",
				"oPaginate": {
					"sFirst":    "Primeiro",
					"sPrevious": "Anterior",
					"sNext":     "Seguinte",
					"sLast":     "&Uacute;ltimo"
				}
            },
			
            "columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ] // set first column as a default sort by asc
			
        });

        var tableWrapper = $("#sample_editable_1_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

		
        var nEditing = null;
        var nNew = false;
		
$('#sample_editable_1_new').click(function (e) {
            e.preventDefault();
			$('#titulo-tag').html('Ativa?');
			$('#titulo-video').html('Salva');
			$('#titulo-edit').html('Cancela');
			$('#titulo-trash').html('Anexos');
		    var ntx_nome_concurso = ""; 
			var nacao = "1";
			$.post('function_ler_concurso_insere.php',{acao:nacao}, function(data_conc){
					
					ntx_nome_concurso = data_conc;				
						
			
		
			//alert(ntx_nome_concurso);
					
            var aiNew = oTable.fnAddData(['<a id="abre-painel" class="op-panel" href="javascript:void(0);"><i class="fa fa-plus"></i></a>',
			'<select name="tx_nome_concurso_new" id="tx_nome_concurso_new" class="form-control input-small">'+ntx_nome_concurso+'</select>', 
			'<select name="co_modalidade_concurso_new" id="co_modalidade_concurso_new" class="form-control input-small"><option value="0">---selecione---</option></select>', 
			'<select name="cd_especialidade_new" id="cd_especialidade_new" class="form-control input-small"><option value="0">---selecione---</option></select>', 
			'<select name="cd_sub_especialidade_new" id="cd_sub_especialidade_new" class="form-control input-small"><option value="0">---selecione---</option></select>', 
			'<input type="text" name="ds_ano_new" id="ds_ano_new" class="form-control"  value="">',
			'<input type="text" name="ds_num_questao_new" id="ds_num_questao_new" size="3" class="form-control" value="">', 
			'<input type="text" name="tx_titulo_new" id="tx_titulo_new" class="form-control input-small" value="">',
			'<select name="st_conteudo_questao_new" id="st_conteudo_questao_new" class="form-control input-small"><option value="1">Cadastrada e Comentada</option><option value="2">Cadastrada</option><option value="3">Revisada</option><option value="4" selected="selected">Pendente</option></select>',
			'<select name="in_ativa_new" id="in_ativa_new" class="form-control input-small"><option value="0">Não</option><option value="1">Sim</option></select>',
			'<a class="btn blue" id="btnSalvar" href="javascript:void(0);"><i class="fa fa-floppy-o"></i></a>',
			'<a class="btn green" id="btnCancelar" href="javascript:void(0);"><i class="fa fa-undo"></i></a>',
			'<a class="btn default" id="anexos-questao" href="javascript:void(0);" title="Incluir Anexos da questao após pressionar o botão SALVAR"><i class="fa fa-picture-o"></i></a>']);
			
			}); 
						
			var meucss = $("#collapse_1").attr("class");
			if (meucss == 'panel-collapse collapse in'){
					$("#collapse_1").removeClass('panel-collapse collapse in').addClass('panel-collapse collapse');
			}
			var meucss = $("#collapse_1").attr("class");
			if (meucss == 'panel-collapse collapse in'){
					$("#collapse_1").removeClass('panel-collapse collapse in').addClass('panel-collapse collapse');
			}
			var meucss1 = $('#filtro-collapse').attr("class");
			if (meucss1 == 'fa fa-caret-up'){
				$('#filtro-collapse').removeClass('fa fa-caret-up').addClass('fa fa-caret-down');
			}
			
			 $('html, body').animate({
			scrollTop: $("#marca-reg").offset().top
			}, 2000);
	   
        }); 
		table.on('click', '.edita-questao', function (e) {
					 e.preventDefault();
					 var nRow = $(this).parents('tr')[0];
					var id = $(this).attr("id");
					var tam = id.length - 1; 
					var cod = id.substr(1,tam);
					$("#codigo_questao").val(cod);
					if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow);
                nEditing = nRow;
				} else if (nEditing == nRow && this.innerHTML == "Save") {
                /* Editing this row and want to save it */
                saveRow(oTable, nEditing);
                nEditing = null;
                alert("Alterado! Do not forget to do some ajax to sync with backend :)");
				} else {
                /* No edit in progress - let's start one */
                editRow(oTable, nRow, cod);
                nEditing = nRow;
				}
						
		}); 
		
		function editRow(oTable, nRow, ncod) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
			var ncod = $("#codigo_questao").val();
			var var_especialidade = "";
			var var_subespecialidade = "";
			var esp = "";
			var subesp = "";
			esp = aData[3];
			
			$.get('function_buscar_especialidade_edicao.php',{subespecialidade:esp}, function(data_espc){
	
				var var_especialidade = data_espc;	
				subesp = aData[4];
				
				$.get('function_buscar_subespecialidade_edicao.php',{subespecialidade:subesp}, function(data_subespc){
	
					var var_subespecialidade = data_subespc;	
										
					jqTds[0].innerHTML = '<a id="'+ncod+'" class="op-panel-edit" href="javascript:void(0);"><i class="fa fa-plus"></i></a>';
					jqTds[1].innerHTML = aData[1];
					jqTds[2].innerHTML = aData[2];
					jqTds[3].innerHTML = '<select name="cd_especialidade_edt" id="cd_especialidade_edt" class="form-control">'+ var_especialidade +'</select>';
					jqTds[4].innerHTML = '<select name="cd_sub_especialidade_edt" id="cd_sub_especialidade_edt" class="form-control">'+ var_subespecialidade +'</select>';
					jqTds[5].innerHTML = aData[5];
					jqTds[6].innerHTML = aData[6];
					jqTds[7].innerHTML = aData[7];
					jqTds[8].innerHTML = ' '+ aData[8] +' ';
					jqTds[9].innerHTML = '<a class="tags" href=""><i class="fa fa-key"></i></a>';
					jqTds[10].innerHTML = '<a class="videos" href=""><i class="fa fa-video-camera"></i></a>';
					jqTds[11].innerHTML = '<a class="btn blue" id="btnAtualiza" href="javascript:void(0);"><i class="fa fa-floppy-o"></i></a>';
					jqTds[12].innerHTML = '<a class="op-anexos-edit btn default" id="an'+ncod+'" href="javascript:void(0);" title="Editar Anexos"><i class="fa fa-picture-o"></i></a>';
					
				
				}); 
						
			}); 
			
            
			
		
		}
		
	
	
		
		
		
		
		$(document).on("click",".op-panel",function(e) {
			var ninc = '<tr id="campos-questao"><td colspan="3"><label class="control-label" for="editor2">Enunciado</label>&nbsp;<br /><textarea class="ckeditor form-control" name="tx_questao_new" id="editor2" rows="10" data-error-container="#editor2_error"></textarea><div id="editor2_error"></div></td><td colspan="3"><label for="editor1">Comentario</label>&nbsp;<br /><textarea class="ckeditor form-control" name="tx_comentario_feedback_new" id="editor1" rows="10" data-error-container="#editor1_error"></textarea><div id="editor1_error"></div></td>';
			var ninc1 = '<td colspan="3"><label for="tx_resposta1_new">Resposta A</label><br /><input type="text" name="tx_resposta1_new" id="tx_resposta1_new" class="form-control" value=""><br />';
			ninc1 = ninc1 + '<label for="tx_resposta3_new">Resposta C</label><br /><input type="text" name="tx_resposta3_new" id="tx_resposta3_new" class="form-control" value=""><br />';
			ninc1 = ninc1 + '<label for="tx_resposta5_new">Resposta E</label><br /><input type="text" name="tx_resposta5_new" id="tx_resposta5_new" class="form-control" value=""><br />';
			ninc1 = ninc1 + '</td>';
			var ninc2 = '<td colspan="4">';
			ninc2 = ninc2 + '<label for="tx_resposta2_new">Resposta B</label><input type="text" name="tx_resposta2_new" id="tx_resposta2_new" class="form-control" value=""><br />';
			ninc2 = ninc2 + '<label for="tx_resposta4_new">Resposta D</label><input type="text" name="tx_resposta4_new" id="tx_resposta4_new" class="form-control" value=""><br />';
			ninc2 = ninc2 + '<label for="nr_opcao_correta_new">Opção Correta</label><select name="nr_opcao_correta_new" id="nr_opcao_correta_new" class="form-control"><option value="1">A</option><option value="2">B</option><option value="3">C</option><option value="4">D</option><option value="5">E</option></select>';
			ninc2 = ninc2 + '</td></tr>';
			var ninc3 = ninc + ninc1 + ninc2;
			$('#sample_editable_1 tr').last().after(ninc3); // adding new tr after last tr of table
			$('#abre-painel').html('<i class="fa fa-minus"></i>');
			$('#abre-painel').removeClass("op-panel").addClass("cl-panel");
			$( 'textarea#editor2' ).ckeditor();
			$( 'textarea#editor1' ).ckeditor();
		});
		
		$(document).on("click",".cl-panel",function(e) {
			
			$('#campos-questao').hide(); // adding new tr after last tr of table
			$('#abre-painel').html('<i class="fa fa-plus"></i>');
			$('#abre-painel').removeClass("cl-panel").addClass("vs-panel");
		});
		$(document).on("click",".vs-panel",function(e) {
			
			$('#campos-questao').show(); // adding new tr after last tr of table
			$('#abre-painel').html('<i class="fa fa-minus"></i>');
			$('#abre-painel').removeClass("vs-panel").addClass("cl-panel");
		});
		$(document).on("click",".op_anexos",function(e) {
			var ninc = '<tr id="campos-anexos"><td><a class="fecha-anexos" href="javascript:void(0);"><i class="fa fa-times"></i></a></td><td colspan="5"><h5>Anexos do Enunciado</h5><br /><form action="file_upload_questao.php" class="dropzone" id="my-dropzone1"><input type="hidden"  name="cd_questao_enunciado" id="cd_questao_enunciado" class=" form-control" value=""></form></td>';
			var ninc1 = '<td colspan="7"><h5>Anexos do Comentário</h5><br /><form action="file_upload_comment.php" class="dropzone" id="my-dropzone2"><input type="hidden"  name="cd_questao_comment" id="cd_questao_comment" class=" form-control" value=""></form></td>';
			var ninc3 = ninc + ninc1;
			$('#sample_editable_1 tr').last().after(ninc3); // adding new tr after last tr of table
			var newid =  $(this).attr("id");
			$('#anexos-questao').removeClass("op_anexos").addClass("cl_anexos");
			$("#my-dropzone1").dropzone();
			$("#my-dropzone2").dropzone();
			$("#cd_questao_enunciado").val(newid);
			$("#cd_questao_comment").val(newid);
			 $('html, body').animate({
			scrollTop: $(".fecha-anexos").offset().top
			}, 2000);
		});
		$(document).on("click",".op-anexos-edit",function(e) {
					var id = $(this).attr("id");
					var tam = id.length - 2; 
					var cod = id.substr(2,tam);
					var nRow = $(this).parents('tr')[0];
					var ninc3 = '<tr id="campos-anexos-edit"><td><a class="fecha-anexos-edit" href="javascript:void(0);"><i class="fa fa-times"></i></a></td><td colspan="5"><h5>Anexos do Enunciado</h5><br /><form action="file_upload_questao.php" class="dropzone" id="my-dropzone1"><input type="hidden"  name="cd_questao_enunciado" id="cd_questao_enunciado" class=" form-control" value="'+cod+'"><div id="texto_questao"></div></form></td>';
					ninc3 = ninc3 + '<td colspan="7"><h5>Anexos do Comentário</h5><br /><form action="file_upload_comment.php" class="dropzone" id="my-dropzone2"><input type="hidden"  name="cd_questao_comment" id="cd_questao_comment" class=" form-control" value="'+cod+'"><div id="texto_comentario"></div></form></td></tr>';
					$(ninc3).insertAfter( nRow );
					$("#my-dropzone1").dropzone();
					$("#my-dropzone2").dropzone();
					$('#'+cod).removeClass("op-anexos-edit").addClass("cl-anexos-edit");
			$.post('function_imagens_questao.php',{cd_questao:cod}, function(data_en){
				$("#texto_questao").html(data_en);
				
				
			});
			$.post('function_imagens_comentario',{cd_questao:cod}, function(data_com){
				$("#texto_comentario").html(data_com);
				alert(data_com);
				
				
			});
			
			
			
			$('html, body').animate({
			scrollTop: $(".fecha-anexos-edit").offset().top
			}, 2000);
		});
		$(document).on("click",".fecha-anexos",function(e) {
			
			$('#campos-anexos').hide(); // fecha anexos
			
		});
		$(document).on("click",".fecha-anexos-edit",function(e) {
			
			$('#campos-anexos-edit').hide(); // fecha anexos
			
		});
		$(document).on("click",".cl_anexos",function(e) {
			
			$('#campos-anexos').show(); // fecha anexos
			
		});
		$(document).on("click",".cl-anexos-edit",function(e) {
			
			$('#campos-anexos-edit').show(); // fecha anexos
			
		});
		$(document).on("click","#anexos-questao",function(e) {
			
			alert("Para incluir anexos, primeiro salve a questão."); // avisa que [e necessario salvar
			
		});
        
		 $(document).on("click","#btnAtualiza",function(e) {
			var nesp =  $("#cd_especialidade_edt").val();
			var nsubesp =  $("#cd_sub_especialidade_edt").val();
			if (nesp != "0"){
				if (nsubesp == "0"){
					nsubesp = nesp;
					nesp = "23";
				}
			}
			
			var cod = $("#codigo_questao").val();
			var nres1 = $("#tx_resposta1_edt").val();
			var nres2 = $("#tx_resposta2_edt").val();
			var nres3 = $("#tx_resposta3_edt").val();
			var nres4 = $("#tx_resposta4_edt").val();
			var nres5 = $("#tx_resposta5_edt").val();
			var nopc = $("#nr_opcao_correta_edt").val();
			var nst = $("#st_conteudo_questao_edt").val();
			var nina = $("#in_ativa_edt").val();
			var nqst = $("#editor2").val();
			var ncomt = $("#editor1").val();
			$.post('function_atualizar_questao.php',{cd_questao:cod,cd_especialidade:nsubesp,st_conteudo_questao:nst,in_ativa:nina,tx_questao:nqst,tx_comentario_feedback:ncomt,tx_resposta1:nres1,tx_resposta2:nres2,tx_resposta3:nres3,tx_resposta4:nres4,tx_resposta5:nres5,nr_opcao_correta:nopc}, function(data_qstao){
				
				$("#btnAtualiza").html('<i class="fa fa-check"></i>');
				    var ncod = $.trim(data_qstao);
					var nespx =  $("#cd_especialidade_edt option:selected").text();
					var nsubesptx =  $("#cd_sub_especialidade_edt option:selected").text();
					$("#formTab").submit();	
						
			});
			if ($('#sem_modalidade').is(':checked')) {nsem_modalidade = "1";}else{nsem_modalidade = "0";}
			if ($('#sem_especialidade').is(':checked')) {nsem_especialidade = "1";}else{nsem_especialidade = "0";}
			if ($('#sem_comentario').is(':checked')) {nsem_comentario = "1";}else{nsem_comentario = "0";}
			if ($('#rd_busca1').is(':checked')) {nrd_busca1 = "1";}else{nrd_busca1 = "0";}
			if ($('#rd_busca2').is(':checked')) {nrd_busca2 = "1";}else{nrd_busca2 = "0";}
			if ($('#rd_busca2').is(':checked')) {nrd_busca3 = "1";}else{nrd_busca3 = "0";}
			if ($('#edt_bloco').is(':checked')) {nedt_bloco = "1";}else{nedt_bloco = "0";}
			var ncbusca = $("#cbusca").val();
			var nco_publico_alvo = $("#co_publico_alvo").val();
			var ntx_nome_concurso = $("#tx_nome_concurso").val();
			var nco_modalidade_concurso = $("#co_modalidade_concurso").val();
			var ncd_especialidade = $("#cd_especialidade").val();
			var ncd_sub_especialidade = $("#cd_sub_especialidade").val();
			var nespx =  $("#cd_especialidade_edt option:selected").text();
			var nsubesptx =  $("#cd_sub_especialidade_edt option:selected").text();
			var nparametros = $("#parametros").val();
			var nRow = $(this).parents('tr')[0];
			
			/*
			$.post('function_monta_lista_questoes_refresh.php',{sem_modalidade:nsem_modalidade,sem_especialidade:nsem_especialidade,sem_comentario:nsem_comentario,rd_busca1:nrd_busca1,rd_busca2:nrd_busca2,rd_busca3:nrd_busca3,edt_bloco:nedt_bloco,cbusca:ncbusca,co_publico_alvo:nco_publico_alvo,tx_nome_concurso:ntx_nome_concurso,co_modalidade_concurso:nco_modalidade_concurso,cd_especialidade:ncd_especialidade,cd_sub_especialidade:ncd_sub_especialidade,parametros:nparametros}, function(retorno){
				
				$('#sample_editable_1 tbody').destroy();
				$("#sample_editable_1 tbody").hide().html(retorno).fadeIn('fast');
				$('#sample_editable_1 tbody').fnUpdate('nespx',nRow,3);
				$('#sample_editable_1 tbody').fnUpdate('nsubesptx',nRow,4);
			//	$('#sample_editable_1 tbody').draw();
				
				
			});
			*/
		});
		$(document).on("click",".op-panel-edit",function(e) {
			var cod = $(this).attr("id");
			var nRow = $(this).parents('tr')[0];
			$('#'+cod).html('<i class="fa fa-minus"></i>');
			$('#'+cod).removeClass("op-panel-edit").addClass("cl-panel-edit");
			var url = "function_selecionar_questao_edicao.php?cd_questao="+cod;
			 $.ajax({
				url: url,
				cache: false,
				dataType: "json",
				beforeSend: function() {
				  // $("div#aguarde").show("slow").delay(3000).hide("slow");
				   
				},
				error: function() {
				   // $("#aguarde").html("Há algum problema com a fonte de dados");
				},
				success: function(retorno) {
					if(retorno[0].erro){
						$("#aguarde").html(retorno[0].erro);
					}
					else{
						//Laço para criar linhas da tabela
						for(var i = 0; i < retorno.length; i++){
							ntxquestao = retorno[i].tx_questao;
							ntx_resposta1 = retorno[i].tx_resposta1;
							ntx_resposta2 = retorno[i].tx_resposta2;
							ntx_resposta3 = retorno[i].tx_resposta3;
							ntx_resposta4 = retorno[i].tx_resposta4;
							ntx_resposta5 = retorno[i].tx_resposta5;
							nnr_opcao_correta = retorno[i].nr_opcao_correta;
							ntx_comentario_feedback = retorno[i].tx_comentario_feedback;
							nin_ativa = retorno[i].in_ativa;
							nst_conteudo_questao = retorno[i].st_conteudo_questao;
							ncdquestao = retorno[i].cd_questao;
							
							
											
						
			
			var ninc = '<tr id="campos-questao-edit"><td colspan="3"><label class="control-label" for="editor2">Enunciado</label>&nbsp;<br /><textarea class="ckeditor form-control" name="tx_questao_new" id="editor2" rows="12" data-error-container="#editor2_error">'+ntxquestao+'</textarea><div id="editor2_error"></div></td><td colspan="3"><label for="editor1">Comentario</label>&nbsp;<br /><textarea class="ckeditor form-control" name="tx_comentario_feedback_new" id="editor1" rows="12" data-error-container="#editor1_error">'+ntx_comentario_feedback+'</textarea><div id="editor1_error"></div></td>';
			var ninc1 = '<td colspan="3"><label for="tx_resposta1_edt">Resposta A</label><br /><input type="text" name="tx_resposta1_edt" id="tx_resposta1_edt" class="form-control" value="'+ntx_resposta1+'">';
			ninc1 = ninc1 + '<label for="tx_resposta3_edt">Resposta C</label><br /><input type="text" name="tx_resposta3_edt" id="tx_resposta3_edt" class="form-control" value="'+ntx_resposta3+'">';
			ninc1 = ninc1 + '<label for="tx_resposta5_edt">Resposta E</label><br /><input type="text" name="tx_resposta5_edt" id="tx_resposta5_edt" class="form-control" value="'+ntx_resposta5+'">';
			var nat0 = "";
			var nat1 = "";
			switch(nin_ativa){
				case "1": nat1 = ' selected="selected"';break;
				case "0": nat0 = ' selected="selected"';break;
				
			}
			ninc1 = ninc1 + '<label for="in_ativa_edt">Ativa?</label><select name="in_ativa_edt" id="in_ativa_edt" class="form-control"><option value="1" '+nat1+'>Ativa</option><option value="0" '+nat0+'>Inativa</option></select>';
			ninc1 = ninc1 + '</td>';
			var ninc2 = '<td colspan="4">';
			ninc2 = ninc2 + '<label for="tx_resposta2_edt">Resposta B</label><input type="text" name="tx_resposta2_edt" id="tx_resposta2_edt" class="form-control" value="'+ntx_resposta2+'">';
			ninc2 = ninc2 + '<label for="tx_resposta4_edt">Resposta D</label><input type="text" name="tx_resposta4_edt" id="tx_resposta4_edt" class="form-control" value="'+ntx_resposta4+'">';
			ninc2 = ninc2 + '<label for="nr_opcao_correta_edt">Opção Correta</label><select name="nr_opcao_correta_edt" id="nr_opcao_correta_edt" class="form-control">';
			var nresp1 = "";
			var nresp2 = "";
			var nresp3 = "";
			var nresp4 = "";
			var nresp5 = "";
			switch(nnr_opcao_correta){
				case "1": nresp1 = ' selected="selected"';break;
				case "2": nresp2 = ' selected="selected"';break;
				case "3": nresp3 = ' selected="selected"';break;
				case "4": nresp4 = ' selected="selected"';break;
				case "5": nresp5 = ' selected="selected"';break;
			}
			ninc2 = ninc2 + '<option value="1" '+nresp1+'>A</option><option value="2" '+nresp2+'>B</option><option value="3" '+nresp3+'>C</option><option value="4" '+nresp4+'>D</option><option value="5" '+nresp5+'>E</option></select>';
			var nst1 = "";
			var nst2 = "";
			var nst3 = "";
			var nst4 = "";
			
			switch(nst_conteudo_questao){
				case "1": nst1 = ' selected="selected"';break;
				case "2": nst2 = ' selected="selected"';break;
				case "3": nst3 = ' selected="selected"';break;
				case "4": nst4 = ' selected="selected"';break;
				
			}
			ninc2 = ninc2 + '<label for="st_conteudo_questao_edt">Status</label><select name="st_conteudo_questao_edt" id="st_conteudo_questao_edt" class="form-control"><option value="1" '+nst1+'>Cadastrada</option><option value="2" '+nst2+'>Cadastrada e Comentada</option><option value="3" '+nst3+'>Revisada</option><option value="4" '+nst4+'>Pendente</option></select>';
			ninc2 = ninc2 + '</td></tr>';
			var ninc3 = ninc + ninc1 + ninc2;
			$(ninc3).insertAfter( nRow );
		//	$('#sample_editable_1#'+cod+' tr').after(ninc3); // adding new tr after last tr of table
			
		//	$( 'textarea#editor2' ).ckeditor();
		//	$( 'textarea#editor1' ).ckeditor();
			}
			}
			}
			});	
		
		});
		$(document).on("click",".cl-panel-edit",function(e) {
			var cod = $(this).attr("id");
			$('#campos-questao-edit').hide(); // adding new tr after last tr of table
			$('#'+cod).html('<i class="fa fa-plus"></i>');
			$('#'+cod).removeClass("cl-panel-edit").addClass("vs-panel-edit");
		});
		$(document).on("click",".vs-panel-edit",function(e) {
			var cod = $(this).attr("id");
			$('#campos-questao-edit').show(); // adding new tr after last tr of table
			$('#'+cod).html('<i class="fa fa-minus"></i>');
			$('#'+cod).removeClass("vs-panel-edit").addClass("cl-panel-edit");
		});

      
    }

    return {

        //main function to initiate the module
        init: function () {
            handleTable();
			
        }

    };

}();