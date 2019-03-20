<?php
require 'controllers/Tarefas.php';
require 'modelo/Tarefa.php';
//Autoload
$loader = require 'vendor/autoload.php';
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

//Instanciando objeto
$app = new Slim\App(array(
    'templates.path' => 'templates'
));




//Api de verificação do titulo, se já existe na base de dados
$app->post('/verificarTitulo',function (Request $request, Response $response, array $args )  {
	//Pegando as informações enviadas
	$informacao  =  $request->getParsedBody();
	
	//Instânciando a classe controller Tarefa
	$tarefa_parametro = new \controllers\Tarefas;

	//Chamando da função de validarNome enviando a ele os parâmetros requisitados para a consulta
	$retorno_informacao = $tarefa_parametro->validarNome($informacao);

	//Verifico se o retorno é true, se for é porque existe um titulo já cadastrado
	if ( $retorno_informacao == true){
		$existe = 1;
	}else{
		$existe = 0;
	}

	//Converto a informação para o array
	$array = array(
		"existe" => $existe,
		
	); 
	
	//Transformando em json 
	$arrayInfo =  json_encode($array);

	//Retornando a informação
	return $arrayInfo;

});

//Api de busca de informações por parâmetro
$app->post('/buscarInformacaoParametro',function (Request $request, Response $response, array $args )  {
	//Pegando as informações enviadas
	$informacao  =  $request->getParsedBody();
	
	//Instânciando a classe controller Tarefa
	$tarefa_parametro = new \controllers\Tarefas;

	//Cahamda da função de buscarInformaçãoPorParametro enviando a ele os parâmetros requisitados para a consulta
	$retorno_informacao = $tarefa_parametro->buscarInformacaoPorParametro($informacao);
	
		
	$arrayInfo = array();

	//Passo ela por um laço de repetição para colocar todas em um array
	foreach ($retorno_informacao as $informacao){
	
		//Coloco os valores no primeiro array
		$array = array(
			"codigo" => $informacao['cod_tarefa'],
			"titulo" => utf8_encode($informacao['titulo']),
			"descricao" => utf8_encode($informacao['desc_tarefa']),
			"data_criacao" => $informacao['data_criacao'],
			"status" => $informacao['status'],
		); 
		//Depois com a função array_push envio o array, para o arrayinfo
		array_push($arrayInfo, $array);
	}
	
	//Transformando em json 
	$arrayInfo =  json_encode($arrayInfo);
	
	//Retornando a informação
	return $arrayInfo;
	


});


//Api de alterar a tarefa
$app->post('/alterarInformacao',function (Request $request, Response $response, array $args )  {
	//Pegando as informações enviadas
	$informacao  =  $request->getParsedBody();

	//Instâncio a classe modelo
	$model_tarefa = new Tarefa();

	//Coloco seus parâmetros em seus devidos lugares
	$model_tarefa->setCodTarefa($informacao['codigo']);
	$model_tarefa->setTitulo($informacao['titulo']);
	$model_tarefa->setDescricao($informacao['desc_tarefa']);
	$model_tarefa->setStatus($informacao['status']);
	
	//Instânciando a classe controller Tarefa
	$tarefa_parametro = new \controllers\Tarefas;

	//Cahamda da função de alterarTarefa enviando a ele os parâmetros requisitados para a consulta
	$retorno_informacao = $tarefa_parametro->alterarTarefa($model_tarefa);
		
	//Verifico se o retorno da informação foi true, se for igual true tudo ocorreu bem 
	if ( $retorno_informacao == true){
		$ok = 1;
	}else{
		$ok = 0;
	}


	//Colocando a informação em um array
	$array = array(
		"OK" => $ok
	); 

	
	//Transformando em json 
	$arrayInfo =  json_encode($array);
	
	//Retornando a informação
	return $arrayInfo;
	


});

//Api de inserir informações
$app->post('/inserirInformacao',function (Request $request, Response $response, array $args )  {
	//Pegando as informações enviadas
	$informacao  =  $request->getParsedBody();

	//Instânciando a classe de modelo 
	$model_tarefa = new Tarefa();

	//Coloco seus parâmetros em seus devidos lugares
	$model_tarefa->setTitulo($informacao['titulo']);
	$model_tarefa->setDescricao($informacao['desc_tarefa']);
	$model_tarefa->setStatus($informacao['status']);
	
	//Instânciando a classe controller Tarefa
	$tarefa_parametro = new \controllers\Tarefas;

	//Cahamda da função de inserirInformacao enviando a ele os parâmetros requisitados para a consulta
	$retorno_informacao = $tarefa_parametro->inserirInformacao($model_tarefa);
		
	//Verifico se o retorno da informação foi igualmente a true
	if ( $retorno_informacao == true){
		$ok = 1;
	}else{
		$ok = 0;
	}

	$array = array(
		"OK" => $ok
	); 

	

	//Transformando em json 
	$arrayInfo =  json_encode($array);
	
	//Retornando a informação
	return $arrayInfo;
	


});

//Api de função de excluir tarefa
$app->post('/excluirTarefa' ,function (Request $request, Response $response, array $args )  {
	//Pegando as informações enviadas
	$informacao  =  $request->getParsedBody();
	
	//Instânciando a classe controller tarefa
	$tarefa_parametro = new \controllers\Tarefas;

	//Cahamda da função de excluirTarefa enviando a ele os parâmetros requisitados para a consulta
	$retorno_informacao = $tarefa_parametro->excluirTarefa($informacao);
		
	//Verifico se ocorreu tudo bem, se ocorreu envio a informação ok como 1 
	if ( $retorno_informacao == true){
		$ok = 1;
	}else{
		$ok = 0;
	}

	$array = array(
		"OK" => $ok
	); 

	

	//Transformando em json 
	$arrayInfo =  json_encode($array);
	
	//Retornando a informação
	return $arrayInfo;

});


$app->run();




