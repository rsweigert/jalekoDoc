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
            "pageLength": 15,

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
		    var ntx_nome_concurso = $('#tx_nome_concurso').html();       
            var aiNew = oTable.fnAddData(['<a id="abre-painel" href="javascript:void(0);"><i class="fa fa-plus"></i></a>',
			'<select name="tx_nome_concurso_new" id="tx_nome_concurso_new" class="form-control input-small">'+ntx_nome_concurso+'</select>', 
			'<select name="co_modalidade_concurso_new" id="co_modalidade_concurso_new" class="form-control input-small"><option value="0">---selecione---</option></select>', 
			'<select name="cd_especialidade_new" id="cd_especialidade_new" class="form-control input-small"><option value="0">---selecione---</option></select>', 
			'<select name="cd_sub_especialidade_new" id="cd_sub_especialidade_new" class="form-control input-small"><option value="0">---selecione---</option></select>', 
			'<input type="text" name="ds_ano_new" id="ds_ano_new" class="form-control input-small"  value="">',
			'<input type="text" name="ds_num_questao_new" id="ds_num_questao_new" size="3" class="form-control input-small" value="">', 
			'<input type="text" name="tx_titulo_new" id="tx_titulo_new" class="form-control input-small" value="">',
			'<input type="text" name="tx_resposta1_new" id="tx_resposta1_new" class="form-control input-small" value="">',
			'<input type="text" name="tx_resposta2_new" id="tx_resposta2_new" class="form-control input-small" value="">',
			'<input type="text" name="tx_resposta3_new" id="tx_resposta3_new" class="form-control input-small" value="">',
			'<input type="text" name="tx_resposta4_new" id="tx_resposta4_new" class="form-control input-small" value="">',
			'<input type="text" name="tx_resposta5_new" id="tx_resposta5_new" class="form-control input-small" value="">',
			'<select name="nr_opcao_correta_new" id="nr_opcao_correta_new" class="form-control input-small"><option value="1">A</option><option value="2">B</option><option value="3">C</option><option value="4">D</option><option value="5">E</option></select>',
			'<a  href="#"><i class="fa fa-key"></i></i></a>',
			'<a  href="#"><i class="fa fa-video-camera"></i></a>',
			'<select name="st_conteudo_questao_new" id="st_conteudo_questao_new" class="form-control input-small"><option value="1">Cadastrada e Comentada</option><option value="2">Cadastrada</option><option value="3">Revisada</option><option value="4" selected="selected">Pendente</option></select>',
			'<a class="edit" href="javascript:void(0);">Save</a>',
			'<a class="cancel" href="javascript:void(0);">Cancel</a>']);
			 $('html, body').animate({
			scrollTop: $("#marca-reg").offset().top
			}, 2000);
	   
        }); 
	//	var aiNew1 = oTable.fnAddData(['','','','','','','','','','','','','','','','','','','','',''];
		$( document ).on( 'change', '#tx_nome_concurso_new', function () {
			var nconcurso = $("#tx_nome_concurso_new").val();
			var npublico = $('#co_publico_alvo').val();
			$.post('function_ler_modalidade_publico.php',{tx_nome_concurso:nconcurso}, function(data_mod){
	
			$('#co_modalidade_concurso_new').html(data_mod);				
						
			}); 
			$('#co_modalidade_concurso_new').selectmenu("refresh", true);	
			$.post('function_ler_especialidade_concurso.php',{tx_nome_concurso:nconcurso}, function(data_espc){
	
				$('#cd_especialidade_new').html(data_espc);				
						
			}); 
			$('#cd_especialidade_new').selectmenu("refresh", true);	
		} );
		$( document ).on( 'change', '#co_modalidade_concurso_new', function () {
			var nmodalidade = $(this).val();
			$.post('function_ler_especialidade_modalidade.php',{co_modalidade_concurso:nmodalidade}, function(data_esp){
	
			$('#cd_especialidade_new').html(data_esp);				
						
			}); 
			$('#cd_especialidade_new').selectmenu("refresh", true);	
		} );
		$( document ).on( 'change', '#cd_especialidade_new', function () {
			var nespecilidade = $(this).val();
			$.post('function_ler_subespecialidade.php',{cd_especialidade:nespecilidade}, function(data_sub){
	
			$('#cd_sub_especialidade_new').html(data_sub);				
						
			}); 
			$('#cd_sub_especialidade_new').selectmenu("refresh", true);	
		} );
		
		$(document).on("focus","#tx_titulo_new",function(e) {
			var nconc =  $("#tx_nome_concurso_new").val();
			var nmod =  $("#co_modalidade_concurso_new").val();
			var nmodal = "";
			$.post('function_ler_modalidade_nome.php',{co_modalidade_concurso:nmod}, function(data_nome){
	
				nmodal = data_nome;	
				var nano =  $("#ds_ano_new").val();
			var nqst = $("#ds_num_questao_new").val();
			var ntit =  nconc+"-"+nmodal+"-"+nano+"-Q"+nqst;
				$("#tx_titulo_new").val(ntit);				
						
			}); 
			
		});
		$(document).on("click","#abre-painel",function(e) {
			
			$('#sample_editable_1 tr').last().after('<tr><td colspan="7"><label for="tx_questao_new">Enunciado</label>&nbsp;<a  href="#" title="Anexos do Enunciado"><i class="fa fa-key"></i></a><br /><textarea name="tx_questao_new" rows="4" cols="125" id="tx_questao_new"></textarea></td><td colspan="7"><label for="tx_comentario_feedback_new">Comentario</label>&nbsp;<a  href="#" title="Anexos do Comentario"><i class="fa fa-key"></i></a><br /><textarea name="tx_comentario_feedback_new" rows="4" cols="125" id="tx_comentario_feedback_new"></textarea></td><td colspan="7">&nbsp;</td></tr>'); // adding new tr after last tr of table
 

		});
		

      
    }

    return {

        //main function to initiate the module
        init: function () {
            handleTable();
			
        }

    };

}();