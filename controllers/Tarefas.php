<?php

namespace controllers{
	/*
	Classe pessoa
	*/
	class Tarefas{
		//Atributo para banco de dados
		private $PDO;

		/*
		__construct
		Conectando ao banco de dados
		*/
		function __construct(){
			$this->PDO = new \PDO('mysql:host=localhost;dbname=projeto_tarefa', 'root', ''); //Conexão
			$this->PDO->setAttribute( \PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION ); //habilitando erros do PDO
		}
		
		//Inserindo tarefa no banco
		public function inserirInformacao($informacao){
			global $app;
			$sth = 
			$this->PDO->prepare("INSERT INTO tarefa (titulo, desc_tarefa, status, data_criacao) 
			VALUES ('".utf8_decode($informacao->getTitulo())."', '".utf8_decode($informacao->getDescricao())."', '".$informacao->getStatus()."', NOW())");
			$resultado = $sth->execute();
		
			//Se tudo ocorreu bem envio a informação de retorno passando true = para tudo certo, false = para errado
			if($resultado = true){
				return true;
			}else{
				return false;
			}
		}

		//Buscando a informação por parametros
		public function buscarInformacaoPorParametro($parametros){
			global $app;
			$data_inicio = $parametros['data_inicial'];
			$data_final = $parametros['data_final'];
			$status = $parametros['status'];

			//Se for status todas, busco todas as tarefas , independente de status
			if($status == "todas"){
				$sth = 
				$this->PDO->prepare("
					SELECT 
					*
					FROM 
						tarefa  
					WHERE
						DATE(data_criacao) between :dataInicio AND :dataFinal
					ORDER BY status DESC");
				//Seto os valores para :dataInicio, e :dataFinal, com as variáveis $data_inicio, $data_final
				$sth ->bindValue(':dataInicio',$data_inicio);
				$sth ->bindValue(':dataFinal',$data_final);
				
			}else{
				//Se o status não for igual todas trago pelo status selecionado
				$sth = 
				$this->PDO->prepare("
					SELECT 
					*
					FROM 
						tarefa  
					WHERE
						DATE(data_criacao) between :dataInicio AND :dataFinal
						AND status = :status
					");
				//Seto os valores de dataInicio, dataFinal e status  com bindvalue, usando aqueles que o usuario digitou
				$sth ->bindValue(':dataInicio',$data_inicio);
				$sth ->bindValue(':dataFinal',$data_final);
				$sth ->bindValue(':status', $status);
			}

			
			$sth->execute();
			$result_informacao = $sth->fetchAll(\PDO::FETCH_ASSOC);

			return $result_informacao;
		}

		//Função para validar se o titulo já existe
		public function validarNome($informacao){
			global $app;
			//Consulta para buscar o titulo com o nome informado no campo text
			$sth = 
			$this->PDO->prepare("
				SELECT 
				*
				FROM 
					tarefa  
				WHERE
					titulo = :titulo_informado
				");
			//Seto a informação do bindValue com o parametro $informacao['titulo'], uso o utf8_decode para não ter problemas com acentuação ou caracteres especiais
			$sth ->bindValue(':titulo_informado',utf8_decode($informacao['titulo']));

			$sth->execute();
			$result_informacao = $sth->fetchAll(\PDO::FETCH_ASSOC);

			if ($result_informacao != false){
				return true;
			}else{
				return false;
			}
		}

		//Função para excluir uma tarefa , de acordo com o código passado
		public function excluirTarefa($codTarefa){
			global $app;
			//Delete para exlcuir a tarefa desejada de acordo com o código que vem 
			$sth = 
			$this->PDO->prepare("
				DELETE FROM tarefa WHERE cod_tarefa = :codigoTarefa");

			//Seto o bindValue com o código da tarefa
			$sth ->bindValue(':codigoTarefa',$codTarefa['codigo']);

			$resultado = $sth->execute();
		
			//Se tudo ocorreu bem envio a informação de retorno passando true = para tudo certo, false = para errado
			if($resultado = true){
				return true;
			}else{
				return false;
			}
	
			
		}

		//Função para alterar tarefa
		public function alterarTarefa($informacao){
			global $app;
			//Update de acordo com os dados passados, e com o código da tarefa
			$sth = $this->PDO->prepare("UPDATE tarefa SET titulo = :titulo , desc_tarefa = :desc_tarefa, status = :status_inf WHERE cod_tarefa = :cod_tarefa");
			//Uso o bind value para colocar seus respectivos valores
			$sth ->bindValue(':titulo',utf8_decode($informacao->getTitulo()));
			$sth ->bindValue(':desc_tarefa',utf8_decode($informacao->getDescricao()));
			$sth ->bindValue(':status_inf',$informacao->getStatus());
			$sth ->bindValue(':cod_tarefa',$informacao->getCodTarefa());

			
			$resultado = $sth->execute();
		
			//Se tudo ocorreu bem envio a informação de retorno passando true = para tudo certo, false = para errado
			if($resultado = true){
				return true;
			}else{
				return false;
			}

		}
	
	}
}