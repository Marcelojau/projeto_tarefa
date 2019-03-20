
<?php

//Pego a ocorrência desejada pelo usuario 
$ocorrencia = $_POST['ocorrencia'];
switch ($ocorrencia) {
    //Cadastrar
    case 'Cadastrar':

        //Parâmetros usados para cadastrar uma nova tarefa
        $array = array(
            
            "titulo" => $_POST['titulo_tarefa'],
            "desc_tarefa" => $_POST['desc_tarefa'],
            "status" => $_POST['status'],
        ); 

        //Convertendo a informação para json
        $informacao_parametro = json_encode($array);
    
        $ch = curl_init();

    
        //Envio a informação dos parâmetros via api 
        //Detalhe na parte do localhost:8080, você pode usar apenas localhost, ou localhost:(porta usada pelo seu xampp ou wampp ou servidor)
        curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/projeto_tarefa/inserirInformacao");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST , "POST");
        curl_setopt($ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $informacao_parametro);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
        ));
    

        //Resposta do curl em formato json
        $response = curl_exec($ch);
        $informacao = json_decode($response);

        //Verifico se ocorreu tudo certo se o Ok voltar como 1 e que ocorreu tudo certo, então envio para meu javascript o true, senao, envio o ERRO
        if ($informacao->OK == 0 ){
            echo "Erro";
        }else{
            echo true;
        }
    break;

    //Excluindo informação
    case 'Excluir':

        //Coloco o código em um array
        $array = array(
            
            "codigo" => $_POST['codigo_tarefa'],
        ); 

        //Converto a informação para json
        $informacao_parametro = json_encode($array);
    
        $ch = curl_init();

        
        //Envio a informação dos parâmetros via api 
        //Detalhe na parte do localhost:8080, você pode usar apenas localhost, ou localhost:(porta usada pelo seu xampp ou wampp ou servidor)
        curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/projeto_tarefa/excluirTarefa");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST , "POST");
        curl_setopt($ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $informacao_parametro);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
        ));
        //Resposta via curl
        $response = curl_exec($ch);

        //decodificando a informação
        $informacao = json_decode($response);

        //Verificando se deu tudo certo para a exclusão, se ocorreu bem o OK volta como 1 e eu retorno no echo true
        if ($informacao->OK == "1"){
            echo true;
        }else{
            echo false;
        }
    
    break;

    //Alterando a informações
    case 'Alterar':

        //Parâmetros usado para usar para alterar, e inclui o código da tarefa de quem será alterado
        $array = array(
            "codigo" => $_POST['codigo_tarefa'],    
            "titulo" => $_POST['titulo_tarefa'],
            "desc_tarefa" => $_POST['desc_tarefa'],
            "status" => $_POST['status'],
        ); 

        //Gero o arquivo json
        $informacao_parametro = json_encode($array);

        $ch = curl_init();


        //Envio a informação dos parâmetros via api 
        //Detalhe na parte do localhost:8080, você pode usar apenas localhost, ou localhost:(porta usada pelo seu xampp ou wampp ou servidor)
        curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/projeto_tarefa/alterarInformacao");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST , "POST");
        curl_setopt($ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $informacao_parametro);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
        ));


        //Resposta do curl em formato json
        $response = curl_exec($ch);
        $informacao = json_decode($response);

        //Verifico se o OK  == 0 se for, deu problema na hora de atualizar, senão envio true que ocorreu tudo bem
        if ($informacao->OK == 0 ){
            echo "Erro";
        }else{
            echo true;
        }


    break;

    //Função para verificar se o nome do titulo ja existe na base
    case 'VerificarNome':
        
        //Coloco o nome do titulo em um arquivo array
        $array = array(
            "titulo" => $_POST['nome_tarefa'],
        ); 

        //Codifico essa informação para json
        $informacao_parametro = json_encode($array);

        $ch = curl_init();


        //Envio a informação dos parâmetros via api 
        //Detalhe na parte do localhost:8080, você pode usar apenas localhost, ou localhost:(porta usada pelo seu xampp ou wampp ou servidor)
        curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/projeto_tarefa/verificarTitulo");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST , "POST");
        curl_setopt($ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $informacao_parametro);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
        ));


        //Resposta do curl em formato json
        $response = curl_exec($ch);
        $informacao = json_decode($response);

        //Verifico se existe o existe == 0 , se for é que não existe nenhuma tarefa com esse titulo, então envio echo true, senão envio echo false caso ocorra problema
        if ($informacao->existe == 0 ){
            echo true;
        }else{
            echo false;
        }
    break;

    
    default:
        # code...
        break;
}

?>