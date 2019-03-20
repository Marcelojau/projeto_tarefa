<!DOCTYPE html>
<html>

<head>
	<title>Tarefas cadastradas</title>
	<meta http-equiv=”Content-Type” content=”text/html; charset=iso-8859-1″>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.1.1.js"></script>

	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
 
 	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
 

	
	<style>
		.loader {
			border: 16px solid #f3f3f3; /* Light grey */
			border-top: 16px solid #3498db; /* Blue */
			border-radius: 50%;
			width: 120px;
			height: 120px;
		animation: spin 2s linear infinite;
		}

		@keyframes spin {
			0% { transform: rotate(0deg); }
			100% { transform: rotate(360deg); }
		}
	</style>
</head>

<body>

	<?php
		include ('menu_informacao.php');
	?>
	<div class="container">
		<div class="row" align ="center">
			<div class="col-sm-12 col-md-6 col-lg-6">
				<div class="card " style="background-color: #ff6666;" >
					<div class="card-body">
						<br/>
						<h5 class="card-title"><strong>Tarefa em cor vermelha</strong></h5>
						<p class="card-text">Tarefa em cor vermelha singnifica que a tarefa está cancelada</p>
						<br/>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6 col-lg-6">
				<div class="card " style="background-color: #66ff33;">
					<div class="card-body">
						<br/>
						<h5 class="card-title"><strong>Tarefa em cor verde</strong></h5>
						<p class="card-text">Significa que a tarefa já foi executada</p>
						<br/>
					</div>
				</div>
			</div>
		</div>
		<br/>
		<div class="row">
			<div class="col-sm-12 col-xs-12 col-md-12 text-center" align="center">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Administração das tarefass</h3>
					</div>
					
					<div class="panel-body">
						<div class="row">
							<h3>Tarefas cadastradas (Busque pelos filtros)</h3>
						</div>
						<br/>
                        <div class="row">
                            <div class="col-sm-12 col-xs-4 col-lg-4 col-md-4">
                                <label for="">Data inicial</label>
								
								<input type="date" name="data_inicial" id="data_inicial" class="form-control" value="<?= date('Y-m-01') ?>"  title="">
								
                            </div>
                            <div class="col-sm-12 col-xs-4 col-lg-4 col-md-4">
                                <label for="">Data final</label>
								<input type="date" name="data_final" id="data_final" class="form-control" value="<?= date('Y-m-t') ?>"  title="">
                            </div>
                            <div class="col-sm-12 col-xs-4 col-lg-4 col-md-4">
                                <label for="">Selecione o status</label>
								
								<select name="buscar_status" id="buscar_status" class="form-control" >
									<option value="todas" selected>Todas os status</option>
									<option value="Aberto">Aberto</option>
									<option value="Em andamento">Em andamento</option>
									<option value="Concluido">Concluído</option>
									<option value="Cancelado">Cancelado</option>
								</select>
								
                            </div>
                        </div>
						<br/>
						<div class="row" align="left">
							
							<div class="col-sm-12 col-xs-4 col-lg-4">
								<button type="button" class="btn btn-lg btn-success" onclick="buscandoInformacao()" id="buscar_informacao">Buscar informação</button>
							</div>
						</div>
                        <br/>
						<div id="loader_informacao" align="center" style="display:none">
							<div class="loader"></div>
							<br/>
							<label for="">Carregando as informações aguarde...</span>
						</div>
						
						<div id="informacao_total" style="display:none">
							
						</div>
						<br/>
						<div id="cadastrarNovaTarefa" style="display:none">
							
							<button type="button" class="btn btn-large btn-success" Onclick="cadastrarNovaTarefa()">Cadastrar nova tarefa</button>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal_cad_tarefa">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="trocar_titulo">Cadastrar nova tarefa</h4>
				</div>
				<div class="modal-body">
					<div class="row " >
						<div class="col-sm-12 col-xs-12 col-lg-12">
							<label for="">Titulo tarefa</label>						
							<input type="text" name="titulo_tarefa" id="titulo_tarefa" class="form-control" value=""  pattern="" title="" Onblur="verificarNomeTarefa()">
						</div>
					</div>
					<br/>
					<div class="row ">
						<div class="col-sm-12 col-xs-12 col-lg-12">
							<label for="">Descrição tarefa</label>						
							<input type="text" name="descricao_tarefa" id="descricao_tarefa" class="form-control" value=""  pattern="" title="">
						</div>
					</div>
					<br/>
					<div class="row  ">
						<div class="col-sm-12 col-xs-12 col-lg-12">
							<label for="">Selecione a prioridade</label>
							
							<select name="selecionar_status" id="selecionar_status" class="form-control" >
								<option value="selecione" selected>Selecione...</option>
								<option value="Aberto">Aberto</option>
								<option value="Em andamento">Em andamento</option>
								<option value="Concluido">Concluído</option>
								<option value="Cancelado">Cancelado</option>
							</select>
						</div>
						
						<input type="hidden" name="cod_tarefa" id="cod_tarefa" class="form-control" value="">
						<input type="hidden" name="titulo_antigo" id="titulo_antigo" class="form-control" value="">
						<input type="hidden" name="descricao_antiga" id="descricao_antiga" class="form-control" value="">
						<input type="hidden" name="status_antigo" id="status_antigo" class="form-control" value="">
						
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="button" class="btn btn-primary" onclick="salvarAlteracao()" id="btnEditarInformacao" style="display:none">Editar informações</button>
					<button type="button" class="btn btn-primary" onclick="salvarInformacao()" id="btnSalvarInformacao">Salvar informações</button>
				</div>
			</div>
		</div>
	</div>



	<script>

		//Função para cadastar uma nova tarefa
		function cadastrarNovaTarefa(){
			
			//Seto os campos para vazio, pois uso tambem os mesmos campos para atualização de uma tarefa
			$('#titulo_tarefa').val("");
			$('#descricao_tarefa').val("");
			//Coloco o selecione como selected
			document.getElementById('selecionar_status').value = "selecione";
			//Sumo com o botao de editar
			$('#btnEditarInformacao').hide();
			//Mostro o botão de salvar
			$('#btnSalvarInformacao').show();
			//Modifico o titulo para cadastrar nova tarefa
			$('#trocar_titulo').html("Cadastrar nova tarefa");
			//Faço aparecer o modal
			$('#modal_cad_tarefa').modal('show');
		}

		//Função para salvar a informação
		function salvarInformacao(){

			//variaveis usadas para receber os valores
			var titulo = $('#titulo_tarefa').val();
			var desc_tarefa = $('#descricao_tarefa').val();
			var status = $('#selecionar_status').val();

			
			//Verifico se a informação foi inserida se ela não, for mostro um alert e retorno false, para ele colocar a informação
			if ( titulo == "#" || titulo == "" )
			{
				$.alert("Você não pode cadastrar uma tarefa sem titúlo");
				return false;
			}

			//Verifico se a informação foi inserida se ela não, for mostro um alert e retorno false, para ele colocar a informação
			if ( desc_tarefa == "#" || desc_tarefa == "" )
			{
				$.alert("Você não pode cadastrar uma tarefa sem a descrição dela");
				return false;
			}

			//Verifico se a informação foi inserida se ela não, for mostro um alert e retorno false, para ele colocar a informação
			if ( status == "selecione" )
			{
				$.alert("Você não pode cadastrar a tarefa sem um status para ela");
				return false;
			}

			//Se tudo ocorreu certo, modifico o botão para cadastrando
			$('#btnSalvarInformacao').html("Cadastrando aguarde...");

			$.post(
				"funcoes/parametros_tarefas.php"
				, {
					titulo_tarefa: titulo.toString(),
					desc_tarefa: desc_tarefa.toString(),
					status: status.toString(),
					ocorrencia: "Cadastrar"
				}
				, function (data) {

					//Se tudo deu certo
					if( data == true){
						//Mostro o alert para avisar que tudo deu certo
						$.alert("Cadastro feito com sucesso, estamos atualizando a tabela");
						//Atualizo a tabela
						buscandoInformacao();
						//Sumo com o modal de cadastrar
						$('#modal_cad_tarefa').modal('hide');
						//Seto os valores para vazio , os valores dentro do modal
						$('#titulo_tarefa').val("");
						$('#descricao_tarefa').val("");
						$('#selecionar_status').val("");
						//Volto o html do botão para salvar informações
						$('#btnSalvarInformacao').html("Salvar informações");
					}else{
						//Se nada deu certo, mostro um alert , para tentar denovo ou entrar em contato com o suporte
						$.alert("Erro ao cadastrar, por favor tente denovo, ou entre em contato com o suporte");
						return false;
					}
				}
			);




		}

		//Função para buscar as informações 
		function buscandoInformacao(){

			//Troco o html do botão para buscando as informações
			$('#buscar_informacao').html("Buscando as informações...");

			//Pego os parâmetros 
			var data_inicial = $('#data_inicial').val(); 
			var data_final =  $('#data_final').val();
			var status = $('#buscar_status').val();

			//Escondo o informação total
			$('#informacao_total').hide();


			//Mostro o loader 
			$('#loader_informacao').show();

			$.post(
				"funcoes/buscar_informacao_parametro.php"
				, {
					data_inicial: data_inicial.toString(),
					data_final: data_final.toString(),
					status_parametro: status.toString()
				}
				, function (data) {

					//Volto o botão para buscar informação
					$('#buscar_informacao').html("Buscar informação");

					//Insiro as informações do data no informacao_total
					$('#informacao_total').html(data);
	

					//Sumo com o loader 
					$('#loader_informacao').hide();

					//Insiro o datatables, que ja faz vários processos
					var table = $('#tabela_tarefa').dataTable();

					//Ordeno por código da parcela, que está na posição 0, fazendo assim que ela sempre mostre da maior para menor
					table.fnSort([[0,'desc']]);

					//Mostro a informação
					$('#informacao_total').show();
					$('#cadastrarNovaTarefa').show();
				}
			);
		}

		//Funçãpo de excluir tarefa
		function excluirTarefa(codigo){
			//Mostro o confirm para saber se realmente quer fazer isso
			$.confirm({
				title: 'Atenção!',
				content: 'Deseja realmente excluir essa tarefa!',
				buttons: {
					confirm: {
						text: 'Sim',
						btnClass: 'btn-red',
						keys: ['enter', 'shift'],
						action: function(){
							$.post(
								"funcoes/parametros_tarefas.php"
								, {
									codigo_tarefa: codigo.toString(),
									ocorrencia: "Excluir"
								}
								, function (data) {
									//Se tudo der certo mostro a informação que a tarefa, foi excluida com sucesso
									if( data == true){
										$.alert("Excluida com sucesso, iremos atualizar a tabela");
										//Atualizo a tabela
										buscandoInformacao();
										
									}else{
										//Mostro o alert de erro caso deu algum problema 
										$.alert("Erro ao excluir, por favor tente denovo, ou entre em contato com o suporte");
										return false;
									}
								}
							);

						}
					},
					nao: {
						text: 'Não',
						btnClass: 'btn-blue',
						keys: ['enter', 'shift'],
						action: function(){
							$.alert('OK');
						}
					},
				}
			});
		}



		//Função que envia para o modal os dados
		function alterarTarefa(codigo, titulo, descricao, status ){
			//Troco o titulo do modal para edita tarefa
			$('#trocar_titulo').html("Editar tarefa");
			//Coloco no campos seus devidos valores
			$('#cod_tarefa').val(codigo);
			$('#titulo_tarefa').val(titulo);
			$('#descricao_tarefa').val(descricao);
			//Deixo o select para deixar selecionado aquele que veio por paramêtro
			document.getElementById('selecionar_status').value = status;

			//guardo também os dados que vieram em campos como antigo, para depois fazer uma compração
			$('#titulo_antigo').val(titulo);
			$('#descricao_antiga').val(descricao);
			$('#status_antigo').val(status);
			//Escondo o botão salvar
			$('#btnSalvarInformacao').hide();
			//Mostro o botão editar
			$('#btnEditarInformacao').show();
			//Abro o modal
			$('#modal_cad_tarefa').modal('show');
		}

		//Função para salvar alterações
		function salvarAlteracao(){
			//Coloco os valores em suas variaveis
			var titulo = $('#titulo_tarefa').val();

			var desc_tarefa = $('#descricao_tarefa').val();

			var status = $('#selecionar_status').val();

			var codigo = $('#cod_tarefa').val();

			var titulo_antigo = $('#titulo_antigo').val();

			var desc_antiga = $('#descricao_antiga').val();
			
			var status_antigo = $('#status_antigo').val();

			//Verifico se a informação foi inserida se ela não, for mostro um alert e retorno false, para ele colocar a informação
			if ( titulo == "#" || titulo == "" )
			{
				$.alert("Você não pode cadastrar uma tarefa sem titúlo");
				return false;
			}

			//Verifico se a informação foi inserida se ela não, for mostro um alert e retorno false, para ele colocar a informação
			if ( desc_tarefa == "#" || desc_tarefa == "" )
			{
				$.alert("Você não pode cadastrar uma tarefa sem a descrição dela");
				return false;
			}

			//Verifico se a informação foi inserida se ela não, for mostro um alert e retorno false, para ele colocar a informação
			if ( status == "selecione" )
			{
				$.alert("Você não pode cadastrar a tarefa sem um status para ela");
				return false;
			}

			//Verifico se o titulo foi modificado para mostrar o que ele mudou , para mostrar no confirm
			if ( titulo != titulo_antigo){
				var titulo_concat = "Você atualizou o titulo ";
			}else{
				var titulo_concat = "";
			}

			//Verifico se a descrição foi modificada para mostrar o que ele mudou , para mostrar no confirm
			if ( desc_tarefa != desc_antiga){
				var desc_concat = "Você atualizou a descrição"
			}else{
				var desc_concat = "";
			}

			//Verifico se o status foi modificado para mostrar o que ele mudou , para mostrar no confirm
			if ( status != status_antigo){
				var status_concat = "Você atualizou os status ";
			}else{
				var status_concat = "";
			}

			//Verifico se alguma coisa foi mudada, se nada foi mudado, nao tem o porque deixar a pessoa atualizar a tarefa, então envio para ela um alert, avisando que ela nao editou nenhum campo
			//E para continuar precisa modificar algum dos campos
			if ( titulo == titulo_antigo && desc_tarefa == desc_antiga && status == status_antigo){

				$.alert("Você nao atualizou nenhum dos campos, por favor edite os campos para continuar a edição");
				return false;
			}

			$.confirm({
				title: 'Atenção!',
				//Mostro os campos que foi modificado com as variaveis, titulo_concat, desc_concat, status_concat
				content: 'Você atualizou os campos ' + titulo_concat +',' +desc_concat + ','+status_concat +' tem certeza que deseja concluir?',
				buttons: {
					confirm: {
						text: 'Sim',
						btnClass: 'btn-red',
						keys: ['enter', 'shift'],
						action: function(){
							$.post(
								"funcoes/parametros_tarefas.php"
								, {
									codigo_tarefa: codigo.toString(),
									titulo_tarefa: titulo.toString(),
									desc_tarefa: desc_tarefa.toString(),
									status: status.toString(),
									ocorrencia: "Alterar"
								}
								, function (data) {

									//Verifico se tudo deu certo, se tudo deu certo mostro o atualizado com sucesso
									if( data == true){
										$.alert("Atualizado com sucesso");
										//Atualizo a tabela
										buscandoInformacao();
										
										
									}else{
										//Se nada deu certo mostro o erro 
										$.alert("Erro ao excluir, por favor tente denovo, ou entre em contato com o suporte");
										return false;
									}
								}
							);

						}
					},
					nao: {
						text: 'Não',
						btnClass: 'btn-blue',
						keys: ['enter', 'shift'],
						action: function(){
							$.alert('OK');
						}
					},
				}
			});
			
		}


		//Função para verificar o nome da tarefa
		function verificarNomeTarefa(){
			//Variaveis para usar na função , recebendo os valores
			var nome_tarefa = $('#titulo_tarefa').val();
			var codigo = $('#cod_tarefa').val();

			//Verificio se existe um código, se existir não executo essa função
			if ( codigo == ""){

				if ( nome_tarefa != "" ){
					$.post(
					"funcoes/parametros_tarefas.php"
						, {
							nome_tarefa : nome_tarefa.toString(),
							ocorrencia: "VerificarNome"
						}
						, function (data) {

							//Se nada deu certo passo o data como true
							if( data == true){
								return false;
								
							}else{
								//Senão mostro o erro, que não pode cadastrar essa tarefa com esse titulo
								$.alert("Você nao pode cadastrar a tarefa com esse titúlo, já existe em nosso sistema");
								//volto o valor do titulo para vazio
								$('#titulo_tarefa').val("");
							}
						}
					);
				}
			}
		}


	
	</script> 
</body>

</html>